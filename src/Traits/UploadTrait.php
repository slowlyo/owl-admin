<?php

namespace Slowlyo\OwlAdmin\Traits;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    /**
     * 图片上传路径
     *
     * @return string
     */
    public function uploadImagePath()
    {
        return admin_url('upload_image');
    }

    public function uploadImage()
    {
        return $this->upload('image');
    }

    /**
     * 文件上传路径
     *
     * @return string
     */
    public function uploadFilePath()
    {
        return admin_url('upload_file');
    }

    public function uploadFile()
    {
        return $this->upload();
    }

    /**
     * 富文本编辑器上传路径
     *
     * @return string
     */
    public function uploadRichPath($needPrefix = false)
    {
        return admin_url('upload_rich', $needPrefix);
    }

    public function uploadRich()
    {
        $fromWangEditor = false;
        $file           = request()->file('file');

        if (!$file) {
            $fromWangEditor = true;
            $file           = request()->file('wangeditor-uploaded-image');
            if (!$file) {
                $file = request()->file('wangeditor-uploaded-video');
            }
        }

        if (!$file) {
            return $this->response()->additional(['errno' => 1])->fail(admin_trans('admin.upload_file_error'));
        }

        $path = $file->store(Admin::config('admin.upload.directory.rich'), Admin::config('admin.upload.disk'));

        $link = Storage::disk(Admin::config('admin.upload.disk'))->url($path);

        if ($fromWangEditor) {
            return $this->response()->additional(['errno' => 0])->success(['url' => $link]);
        }

        return $this->response()->additional(compact('link'))->success(compact('link'));
    }

    protected function upload($type = 'file')
    {
        $file = request()->file('file');

        if (!$file) {
            return $this->response()->fail(admin_trans('admin.upload_file_error'));
        }

        $path = $file->store(Admin::config('admin.upload.directory.' . $type), Admin::config('admin.upload.disk'));

        return $this->response()->success(['value' => $path]);
    }

    public function chunkUploadStart()
    {
        $uploadId = (string) Str::uuid();

        cache()->put($uploadId, [], 600);

        app('filesystem')->makeDirectory(storage_path('app/public/chunk/' . $uploadId));

        return $this->response()->success(compact('uploadId'));
    }

    public function chunkUpload()
    {
        $uploadId   = request('uploadId');
        $partNumber = request('partNumber');
        $file       = request()->file('file');

        if (
            !is_string($uploadId) ||
            !Str::isUuid($uploadId) ||
            str_contains($uploadId, '..') ||
            str_contains($uploadId, "\0") ||
            str_contains($uploadId, '/') ||
            str_contains($uploadId, '\\') ||
            !cache()->has($uploadId)
        ) {
            return $this->response()->fail('分片上传失败');
        }

        if (
            !is_numeric($partNumber) ||
            (int) $partNumber < 0 ||
            str_contains((string) $partNumber, '..') ||
            str_contains((string) $partNumber, "\0") ||
            str_contains((string) $partNumber, '/') ||
            str_contains((string) $partNumber, '\\')
        ) {
            return $this->response()->fail('分片上传失败');
        }

        if (!$file || !$file->isValid()) {
            return $this->response()->fail('分片上传失败');
        }

        $partNumber = (string) (int) $partNumber;
        $path       = 'chunk/' . $uploadId;

        $file->storeAs($path, $partNumber, 'public');

        $eTag = md5(Storage::disk('public')->get($path . '/' . $partNumber));

        return $this->response()->success(compact('eTag'));
    }

    public function chunkUploadFinish()
    {
        $fileName = request('filename');
        $partList = request('partList');
        $uploadId = request('uploadId');
        $type     = request('t', 'uploads');

        if (
            !is_string($uploadId) ||
            !Str::isUuid($uploadId) ||
            str_contains($uploadId, '..') ||
            str_contains($uploadId, "\0") ||
            str_contains($uploadId, '/') ||
            str_contains($uploadId, '\\') ||
            !cache()->has($uploadId)
        ) {
            return $this->response()->fail('分片上传失败');
        }

        if (
            !is_string($type) ||
            str_contains($type, '..') ||
            str_contains($type, "\0") ||
            str_contains($type, '/') ||
            str_contains($type, '\\') ||
            !preg_match('/^[a-zA-Z0-9_-]+$/', $type)
        ) {
            return $this->response()->fail('分片上传失败');
        }

        $allowedTypes = array_unique(array_filter(array_merge(
            ['uploads', 'images', 'files', 'rich', 'image', 'file', 'video', 'videos', 'audio', 'audios'],
            array_keys((array) Admin::config('admin.upload.directory', [])),
            array_values((array) Admin::config('admin.upload.directory', []))
        )));

        if (!in_array($type, $allowedTypes, true)) {
            return $this->response()->fail('分片上传失败');
        }

        if (
            !is_string($fileName) ||
            trim($fileName) === '' ||
            str_contains($fileName, "\0")
        ) {
            return $this->response()->fail('分片上传失败');
        }

        $fileName = basename($fileName);
        if (
            str_contains($fileName, '..') ||
            str_contains($fileName, "\0") ||
            str_contains($fileName, '/') ||
            str_contains($fileName, '\\')
        ) {
            return $this->response()->fail('分片上传失败');
        }

        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $dangerousExts = [
            'php', 'php3', 'php4', 'php5', 'php7', 'php8', 'pht', 'phtml', 'phar', 'phps',
            'htaccess', 'htpasswd', 'sh', 'bash', 'cgi', 'pl', 'py', 'asp', 'aspx', 'jsp',
            'jspx', 'env', 'cer', 'exe', 'bat', 'cmd', 'vbs',
        ];

        if (
            $ext === '' ||
            !preg_match('/^[a-zA-Z0-9]+$/', $ext) ||
            in_array($ext, $dangerousExts, true) ||
            str_starts_with(strtolower($fileName), '.ht') ||
            str_starts_with(strtolower($fileName), '.env')
        ) {
            return $this->response()->fail('分片上传失败');
        }

        if (!is_array($partList) || empty($partList)) {
            return $this->response()->fail('分片上传失败');
        }

        $baseDir  = realpath(storage_path('app/public')) ?: storage_path('app/public');
        $path     = $type . '/' . $uploadId . '.' . $ext;
        $fullPath = storage_path('app/public/' . $path);

        make_dir(dirname($fullPath));
        $targetDir = realpath(dirname($fullPath));
        if (!$targetDir || !str_starts_with($targetDir, realpath(storage_path('app/public')) ?: storage_path('app/public'))) {
            return $this->response()->fail('分片上传失败');
        }

        file_put_contents($fullPath, '');

        for ($i = 0; $i < count($partList); $i++) {
            $partNumber = $partList[$i]['partNumber'] ?? null;
            $eTag       = $partList[$i]['eTag'] ?? null;

            if (
                !is_numeric($partNumber) ||
                (int) $partNumber < 0 ||
                str_contains((string) $partNumber, '..') ||
                str_contains((string) $partNumber, "\0") ||
                str_contains((string) $partNumber, '/') ||
                str_contains((string) $partNumber, '\\')
            ) {
                @unlink($fullPath);
                return $this->response()->fail('分片上传失败');
            }

            $partNumber = (int) $partNumber;
            $partPath   = 'chunk/' . $uploadId . '/' . $partNumber;

            if (!Storage::disk('public')->exists($partPath)) {
                @unlink($fullPath);
                return $this->response()->fail('分片上传失败');
            }

            $partContent = Storage::disk('public')->get($partPath);
            $partETag    = md5($partContent);

            if (!is_string($eTag) || !hash_equals(strtolower($eTag), strtolower($partETag))) {
                @unlink($fullPath);
                return $this->response()->fail('分片上传失败');
            }

            file_put_contents($fullPath, $partContent, FILE_APPEND);
        }

        clearstatcache();

        $realFullPath = realpath($fullPath);
        $publicDir    = realpath(storage_path('app/public'));
        if (!$realFullPath || !$publicDir || !str_starts_with($realFullPath, $publicDir . DIRECTORY_SEPARATOR)) {
            @unlink($fullPath);
            return $this->response()->fail('分片上传失败');
        }

        app('files')->deleteDirectory(storage_path('app/public/chunk/' . $uploadId));
        cache()->forget($uploadId);

        return $this->response()->success(['value' => $path], '上传成功');
    }
}

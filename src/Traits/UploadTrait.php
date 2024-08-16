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

        $path = 'chunk/' . $uploadId;

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

        $ext      = pathinfo($fileName, PATHINFO_EXTENSION);
        $path     = $type . '/' . $uploadId . '.' . $ext;
        $fullPath = storage_path('app/public/' . $path);

        make_dir(dirname($fullPath));

        for ($i = 0; $i < count($partList); $i++) {
            $partNumber = $partList[$i]['partNumber'];
            $eTag       = $partList[$i]['eTag'];

            $partPath = 'chunk/' . $uploadId . '/' . $partNumber;

            $partETag = md5(Storage::disk('public')->get($partPath));

            if ($eTag != $partETag) {
                return $this->response()->fail('分片上传失败');
            }

            file_put_contents($fullPath, Storage::disk('public')->get($partPath), FILE_APPEND);
        }

        clearstatcache();

        app('files')->deleteDirectory(storage_path('app/public/chunk/' . $uploadId));

        return $this->response()->success(['value' => $path], '上传成功');
    }
}

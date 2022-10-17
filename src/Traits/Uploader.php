<?php

namespace Slowlyo\SlowAdmin\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

trait Uploader
{
    public function uploadImagePath(): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return admin_url('upload_image');
    }

    public function uploadImage(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        return $this->upload('image');
    }

    public function uploadFilePath(): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return admin_url('upload_file');
    }

    public function uploadFile()
    {
        return $this->upload();
    }

    protected function upload($type = 'file')
    {
        $file = request()->file('file');

        if (!$file) {
            return $this->response()->fail(__('admin.upload_file_error'));
        }

        $path = $file->store(config('admin.upload.directory.' . $type), config('admin.upload.disk'));

        return $this->response()->success(['value' => $path]);
    }
}

<?php

namespace Slowlyo\OwlAdmin\Traits;

use Illuminate\Http\JsonResponse;
use Slowlyo\OwlAdmin\Libs\Excel\AdminExport;
use Illuminate\Http\Resources\Json\JsonResource;

trait Export
{
    /**
     * 导出
     *
     * @return JsonResponse|JsonResource
     */
    protected function export()
    {
        // 默认在 storage/app/ 下
        $path = sprintf('%s-%s.xlsx', $this->exportFileName(), date('YmdHis'));

        // 导出本页和导出选中项都是通过 _ids 查询
        $ids = request()->input('_ids');

        // listQuery() 为列表查询条件，与获取列表数据一致
        $query = $this->service->listQuery()
            ->when($ids, fn($query) => $query->whereIn($this->service->primaryKey(), explode(',', $ids)));

        // 此处使用 laravel-excel 导出，可自行修改
        AdminExport::make($query)
            ->setHeadings($this->exportHeadings())
            ->setMap(fn($row) => $this->exportColumns($row))
            ->store($path);

        return $this->response()->success(compact('path'));
    }

    /**
     * 导出表头
     *
     * @return array
     */
    protected function exportHeadings()
    {
        return [];
    }

    /**
     * 导出列
     * eg: return [$row->id, $row->name];
     * 文档: https://docs.laravel-excel.com/3.1/exports/mapping.html#mapping-rows
     *
     * @param $row
     *
     * @return mixed
     */
    protected function exportColumns($row)
    {
        return $row->toArray();
    }

    /**
     * 导出文件名
     *
     * @return string
     */
    protected function exportFileName()
    {
        return strtolower(str_replace('Controller', '', class_basename($this)));
    }
}

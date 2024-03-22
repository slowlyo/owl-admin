<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Slowlyo\OwlAdmin\Models\AdminRelationship;
use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlAdmin\Services\AdminRelationshipService;

class RelationshipController extends AdminController
{
    protected string $serviceName = AdminRelationshipService::class;

    public function list()
    {
        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->headerToolbar([
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('title', '名称')->searchable(),
                amis()->TableColumn('sign', '标识')->searchable(),
                $this->rowActions([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton(),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form()
    {
        return $this->baseForm()->body([
            amis()->TextControl('model', '模型')->required(),
            amis()->TextControl('title', '名称')->required(),
            amis()->TextControl('remark', '备注'),
            amis()->SelectControl('type', '类型')->required()->options(map2options(AdminRelationship::TYPE_LABEL_MAP)),
            amis()->ComboControl('args', '参数')->multiLine()->items([
                amis()->SelectControl('related', '关联模型'),
                amis()->TextControl('foreignKey', 'foreignKey'),
                amis()->TextControl('localKey', 'localKey'),
            ])->visibleOn('${type == "' . AdminRelationship::TYPE_HAS_ONE . '"}'),
        ]);
    }


    public function detail($id)
    {
        return $this->baseDetail()->body([]);
    }
}

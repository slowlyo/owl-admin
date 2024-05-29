<?php

namespace Slowlyo\OwlAdmin\Extend;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Facades\Validator;

/**
 * @property \Symfony\Component\Console\Output\OutputInterface $output
 */
trait CanImportMenu
{
    protected $menu = [];

    protected array $menuValidationRules = [
        'parent'   => 'nullable',
        'title'    => 'required',
        'url'      => 'nullable',
        'url_type' => 'nullable',
        'icon'     => 'nullable',
    ];

    /**
     * 获取菜单节点.
     *
     * @return array
     */
    protected function menu()
    {
        return $this->menu;
    }

    /**
     * 添加菜单.
     *
     * @param array $menu
     *
     * @throws \Exception
     */
    protected function addMenu(array $menu = [])
    {
        $menu = $menu ?: $this->menu();

        if (!Arr::isAssoc($menu)) {
            foreach ($menu as $v) {
                $this->addMenu($v);
            }

            return;
        }

        if (!$this->validateMenu($menu)) {
            return;
        }

        if ($menuModel = $this->getMenuModel()) {
            $lastOrder = $menuModel::max('custom_order');

            $menuModel::create([
                'parent_id' => $this->getParentMenuId($menu['parent'] ?? 0),
                'custom_order'     => $lastOrder + 1,
                'title'     => $menu['title'],
                'icon'      => (string)($menu['icon'] ?? ''),
                'url'       => (string)($menu['url'] ?? ''),
                'url_type'  => (string)($menu['url_type'] ?? 1),
                'extension' => $this->getName(),
            ]);
        }
    }

    /**
     * 刷新菜单.
     *
     * @throws \Exception
     */
    protected function refreshMenu()
    {
        $this->flushMenu();

        $this->addMenu();
    }

    /**
     * 根据名称获取菜单ID.
     *
     * @param int|string $parent
     *
     * @return int
     */
    protected function getParentMenuId($parent)
    {
        if (is_numeric($parent) || !$parent) {
            return $parent;
        }

        $menuModel = $this->getMenuModel();

        return $menuModel::query()
            ->where('title', $parent)
            ->where('extension', $this->getName())
            ->value('id') ?: 0;
    }

    /**
     * 删除菜单.
     */
    protected function flushMenu()
    {
        $menuModel = $this->getMenuModel();

        if (!$menuModel) {
            return;
        }

        $menuModel::query()
            ->where('extension', $this->getName())
            ->delete();
    }

    /**
     * 验证菜单字段格式是否正确.
     *
     * @param array $menu
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function validateMenu(array $menu)
    {
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($menu, $this->menuValidationRules);

        if ($validator->passes()) {
            return true;
        }

        return false;
    }

    protected function getMenuModel()
    {
        return Admin::adminMenuModel();
    }
}

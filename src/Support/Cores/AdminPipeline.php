<?php

namespace Slowlyo\OwlAdmin\Support\Cores;

use Slowlyo\OwlAdmin\Admin;

class AdminPipeline
{
    /** @var string 基础页面 */
    const PIPE_BASE_PAGE = 'pipe_schema_base_page';
    /** @var string 返回按钮 */
    const PIPE_BACK_ACTION = 'pipe_schema_back_action';
    /** @var string 批量删除按钮 */
    const PIPE_BULK_DELETE_ACTION = 'pipe_schema_bulk_delete_action';
    /** @var string 添加按钮 */
    const PIPE_CREATE_ACTION = 'pipe_schema_create_action';
    /** @var string 编辑按钮 */
    const PIPE_EDIT_ACTION = 'pipe_schema_edit_action';
    /** @var string 查看按钮 */
    const PIPE_SHOW_ACTION = 'pipe_schema_show_action';
    /** @var string 删除按钮 */
    const PIPE_DELETE_ACTION = 'pipe_schema_delete_action';
    /** @var string 行操作按钮 */
    const PIPE_ROW_ACTIONS = 'pipe_schema_row_actions';
    /** @var string 基础筛选 */
    const PIPE_BASE_FILTER = 'pipe_schema_base_filter';
    /** @var string 基础CRUD */
    const PIPE_BASE_CRUD = 'pipe_schema_base_crud';
    /** @var string 基础头部工具栏 */
    const PIPE_BASE_HEADER_TOOLBAR = 'pipe_schema_base_header_toolbar';
    /** @var string 基础表单 */
    const PIPE_BASE_FORM = 'pipe_schema_base_form';
    /** @var string 基础详情 */
    const PIPE_BASE_DETAIL = 'pipe_schema_base_detail';
    /** @var string 基础列表 */
    const PIPE_BASE_LIST = 'pipe_schema_base_list';
    /** @var string 导出按钮 */
    const PIPE_EXPORT_ACTION = 'pipe_schema_export_action';

    /**
     * @param               $key
     * @param               $passable
     * @param callable|null $callback
     *
     * @return mixed
     */
    public static function handle($key, $passable, callable $callback = null)
    {
        $do    = fn($i) => $callback ? $callback($i) : $i;
        $pipes = Admin::context()->get($key, []);

        if (blank($pipes)) {
            return $do($passable);
        }

        return admin_pipeline($passable)->through($pipes)->then(fn($i) => $do($i));
    }

    /**
     * @param          $key
     * @param callable $callback
     *
     * @return mixed
     */
    public static function tap($key, callable $callback)
    {
        return self::handle($key, null, $callback);
    }

    /**
     * @param array|mixed $pipes
     *
     * @return void
     */
    public static function through($key, $pipes)
    {
        Admin::context()->set($key, $pipes);
    }

    public static function parseKey($suffix = '', $getChild = false)
    {
        $callUser = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1];

        $callUser = $getChild ? get_class($callUser['object']) : $callUser['class'];

        return $callUser . ($suffix ? ':' . $suffix : '');
    }
}

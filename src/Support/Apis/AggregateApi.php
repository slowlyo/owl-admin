<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Services\AdminService;

/**
 * 聚合统计接口
 */
class AggregateApi extends AdminBaseApi
{
    public string $method = 'get';

    /**
     * 获取接口标题
     *
     * @return string
     */
    public function getTitle()
    {
        return admin_trans('admin.api_templates.aggregate');
    }

    /**
     * 执行聚合统计
     *
     * @return mixed
     */
    public function handle()
    {
        $service = $this->service();
        $query = $service->query();
        $groupBy = $this->resolveGroupBy($service);

        $service->searchable($query);

        // 配置了分组字段时，返回分组聚合结果。
        if ($groupBy) {
            return Admin::response()->success([
                'items' => $this->groupedAggregate($query, $service, $groupBy),
            ]);
        }

        return Admin::response()->success([
            'value' => $this->plainAggregate($query, $service),
        ]);
    }

    /**
     * 获取参数配置表单
     *
     * @return array
     */
    public function argsSchema()
    {
        return [
            amis()->SelectControl('model', admin_trans('admin.relationships.model'))
                ->required()
                ->menuTpl('${label} <span class="text-gray-300 pl-2">${table}</span>')
                ->source('/dev_tools/relation/model_options')
                ->searchable(),
            amis()->RadiosControl('aggregate_type', '聚合方式')->options([
                ['label' => 'count', 'value' => 'count'],
                ['label' => 'sum', 'value' => 'sum'],
                ['label' => 'avg', 'value' => 'avg'],
                ['label' => 'min', 'value' => 'min'],
                ['label' => 'max', 'value' => 'max'],
            ])->selectFirst(),
            amis()->TextControl('aggregate_field', '聚合字段')
                ->visibleOn('${aggregate_type != "count"}')
                ->source('/dev_tools/relation/column_options?model=${model}'),
            amis()->TextControl('group_by', '分组字段')
                ->source('/dev_tools/relation/column_options?model=${model}'),
            amis()->NumberControl('limit', '分组数量')->value(20)->min(1)->max(200),
        ];
    }

    /**
     * 创建通用数据服务
     *
     * @return AdminService
     */
    protected function service()
    {
        $service = $this->blankService();

        $service->setModelName($this->getArgs('model'));

        return $service;
    }

    /**
     * 计算单值聚合结果
     *
     * @param Builder $query
     * @param AdminService $service
     *
     * @return mixed
     */
    protected function plainAggregate(Builder $query, AdminService $service)
    {
        $aggregateType = $this->resolveAggregateType();

        // 计数聚合时，不需要指定字段。
        if ($aggregateType === 'count') {
            return $query->count();
        }

        $field = $this->resolveAggregateField($service);

        return $query->{$aggregateType}($field);
    }

    /**
     * 计算分组聚合结果
     *
     * @param Builder $query
     * @param AdminService $service
     * @param string $groupBy
     *
     * @return mixed
     */
    protected function groupedAggregate(Builder $query, AdminService $service, string $groupBy)
    {
        $aggregateType = $this->resolveAggregateType();
        $aggregateSql = $this->resolveAggregateSql($query, $service, $aggregateType);
        $groupBySql = $query->getQuery()->getGrammar()->wrap($groupBy);

        $query->selectRaw("{$groupBySql} as label, {$aggregateSql} as value")
            ->groupBy($groupBy)
            ->orderByDesc('value')
            ->limit($this->resolveLimit());

        return $query->get();
    }

    /**
     * 解析聚合方式
     *
     * @return string
     */
    protected function resolveAggregateType(): string
    {
        $aggregateType = strtolower($this->getArgs('aggregate_type', 'count'));

        // 非白名单聚合方式时，直接中断请求。
        if (!in_array($aggregateType, ['count', 'sum', 'avg', 'min', 'max'])) {
            admin_abort('聚合方式不支持');
        }

        return $aggregateType;
    }

    /**
     * 解析聚合字段
     *
     * @param AdminService $service
     *
     * @return string
     */
    protected function resolveAggregateField(AdminService $service): string
    {
        $field = $this->getArgs('aggregate_field');

        admin_abort_if(blank($field), '请配置聚合字段');
        admin_abort_if(!$service->hasColumn($field), '聚合字段不存在');

        return $field;
    }

    /**
     * 解析分组字段
     *
     * @param AdminService $service
     *
     * @return string|null
     */
    protected function resolveGroupBy(AdminService $service): ?string
    {
        $groupBy = $this->getArgs('group_by');

        // 未配置分组字段时，按单值聚合处理。
        if (blank($groupBy)) {
            return null;
        }

        admin_abort_if(!$service->hasColumn($groupBy), '分组字段不存在');

        return $groupBy;
    }

    /**
     * 解析聚合 SQL
     *
     * @param Builder $query
     * @param AdminService $service
     * @param string $aggregateType
     *
     * @return string
     */
    protected function resolveAggregateSql(Builder $query, AdminService $service, string $aggregateType): string
    {
        // 计数聚合时，直接统计记录数量。
        if ($aggregateType === 'count') {
            return 'count(*)';
        }

        $field = $query->getQuery()->getGrammar()->wrap($this->resolveAggregateField($service));

        return sprintf('%s(%s)', $aggregateType, $field);
    }

    /**
     * 解析分组返回数量
     *
     * @return int
     */
    protected function resolveLimit(): int
    {
        $limit = (int) $this->getArgs('limit', 20);

        // 小于 1 时，使用默认分组数量。
        if ($limit < 1) {
            return 20;
        }

        return min($limit, 200);
    }
}

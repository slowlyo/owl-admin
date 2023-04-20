<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 表格列，不指定类型时默认为文本类型。
 *
 * @method self fixed($value) 配置是否固定当前列 可选值: left | right | none | 
 * @method self width($value) 列宽度
 * @method self align($value) 列对齐方式 可选值: left | right | center | justify | 
 * @method self value($value) 默认值, 只有在 inputTable 里面才有用
 * @method self innerStyle($value) 单元格内部组件自定义样式 style作为单元格自定义样式的配置
 * @method self name($value) 绑定字段名
 * @method self popOver($value) 配置查看详情功能
 * @method self searchable($value) 是否可快速搜索
 * @method self className($value) 列样式表
 * @method self filterable($value) todo
 * @method self remark($value) 提示信息
 * @method self quickEdit($value) 配置快速编辑功能
 * @method self copyable($value) 配置点击复制功能
 * @method self sortable($value) 配置是否可以排序
 * @method self labelClassName($value) 列头样式表
 * @method self unique($value) 是否唯一, 只有在 inputTable 里面才有用
 * @method self canAccessSuperData($value) 表格列单元格是否可以获取父级数据域值，默认为true，该配置对当前列内单元格生效
 * @method self label($value) 列标题
 * @method self quickEditOnUpdate($value) 作为表单项时，可以单独配置编辑时的快速编辑面板。
 * @method self toggled($value) 配置是否默认展示
 * @method self classNameExpr($value) 单元格样式表达式
 * @method self breakpoint($value) 结合表格的 footable 一起使用。 填写 *、xs、sm、md、lg指定 footable 的触发条件，可以填写多个用空格隔开 可选值: * | xs | sm | md | lg | 
 */
class TableColumn extends BaseRenderer
{

	public function type($type)
	{
		$this->type = $type;

		$instance = $this;

        /** @noinspection all */
		if ($type == 'input-tag') { /** @var TagControl $instance */ }

        /** @noinspection all */
		if ($type == 'qrcode') { /** @var QRCode $instance */ }

        /** @noinspection all */
		if ($type == 'native-date') { /** @var TextControl $instance */ }

        /** @noinspection all */
		if ($type == 'formula') { /** @var FormulaControl $instance */ }

        /** @noinspection all */
		if ($type == 'remark') { /** @var Remark $instance */ }

        /** @noinspection all */
		if ($type == 'divider') { /** @var Divider $instance */ }

        /** @noinspection all */
		if ($type == 'input-time') { /** @var TimeControl $instance */ }

        /** @noinspection all */
		if ($type == 'portlet') { /** @var Portlet $instance */ }

        /** @noinspection all */
		if ($type == 'input-range') { /** @var RangeControl $instance */ }

        /** @noinspection all */
		if ($type == 'static-month') { /** @var StaticExactControl $instance */ }

        /** @noinspection all */
		if ($type == 'tpl') { /** @var Tpl $instance */ }

        /** @noinspection all */
		if ($type == 'video') { /** @var Video $instance */ }

        /** @noinspection all */
		if ($type == 'password') { /** @var Password $instance */ }

        /** @noinspection all */
		if ($type == 'input-rich-text') { /** @var RichTextControl $instance */ }

        /** @noinspection all */
		if ($type == 'javascript-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-repeat') { /** @var RepeatControl $instance */ }

        /** @noinspection all */
		if ($type == 'color') { /** @var Color $instance */ }

        /** @noinspection all */
		if ($type == 'breadcrumb') { /** @var Breadcrumb $instance */ }

        /** @noinspection all */
		if ($type == 'plain') { /** @var Plain $instance */ }

        /** @noinspection all */
		if ($type == 'iframe') { /** @var IFrame $instance */ }

        /** @noinspection all */
		if ($type == 'transfer') { /** @var TransferControl $instance */ }

        /** @noinspection all */
		if ($type == 'submit') { /** @var VanillaAction $instance */ }

        /** @noinspection all */
		if ($type == 'markdown-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'ruby-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'datetime') { /** @var Date $instance */ }

        /** @noinspection all */
		if ($type == 'mapping') { /** @var Mapping $instance */ }

        /** @noinspection all */
		if ($type == 'java-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'crud2') { /** @var CRUD2Table $instance */ }

        /** @noinspection all */
		if ($type == 'cards') { /** @var Cards $instance */ }

        /** @noinspection all */
		if ($type == 'chart') { /** @var Chart $instance */ }

        /** @noinspection all */
		if ($type == 'date') { /** @var Date $instance */ }

        /** @noinspection all */
		if ($type == 'less-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-month') { /** @var MonthControl $instance */ }

        /** @noinspection all */
		if ($type == 'nested-select') { /** @var NestedSelectControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-number') { /** @var NumberControl $instance */ }

        /** @noinspection all */
		if ($type == 'tree-select') { /** @var TreeSelectControl $instance */ }

        /** @noinspection all */
		if ($type == 'reset') { /** @var VanillaAction $instance */ }

        /** @noinspection all */
		if ($type == 'sol-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'hbox') { /** @var HBox $instance */ }

        /** @noinspection all */
		if ($type == 'pagination-wrapper') { /** @var PaginationWrapper $instance */ }

        /** @noinspection all */
		if ($type == 'static-table') { /** @var StaticExactControl $instance */ }

        /** @noinspection all */
		if ($type == 'editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'razor-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'sql-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'group') { /** @var GroupControl $instance */ }

        /** @noinspection all */
		if ($type == 'tabs-transfer-picker') { /** @var TabsTransferPickerControl $instance */ }

        /** @noinspection all */
		if ($type == 'audio') { /** @var Audio $instance */ }

        /** @noinspection all */
		if ($type == 'input-file') { /** @var FileControl $instance */ }

        /** @noinspection all */
		if ($type == 'chart-radios') { /** @var ChartRadios $instance */ }

        /** @noinspection all */
		if ($type == 'csharp-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'css-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'msdax-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'users-select') { /** @var UserSelectControl $instance */ }

        /** @noinspection all */
		if ($type == 'multiline-text') { /** @var MultilineText $instance */ }

        /** @noinspection all */
		if ($type == 'tabs-transfer') { /** @var TabsTransferControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-table') { /** @var TableControl $instance */ }

        /** @noinspection all */
		if ($type == 'timeline') { /** @var Timeline $instance */ }

        /** @noinspection all */
		if ($type == 'map') { /** @var Mapping $instance */ }

        /** @noinspection all */
		if ($type == 'input-excel') { /** @var InputExcel $instance */ }

        /** @noinspection all */
		if ($type == 'pug-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'vbox') { /** @var VBox $instance */ }

        /** @noinspection all */
		if ($type == 'drawer') { /** @var Drawer $instance */ }

        /** @noinspection all */
		if ($type == 'search-box') { /** @var SearchBox $instance */ }

        /** @noinspection all */
		if ($type == 'php-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'r-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'fieldSet') { /** @var FieldSetControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-color') { /** @var InputColorControl $instance */ }

        /** @noinspection all */
		if ($type == 'carousel') { /** @var Carousel $instance */ }

        /** @noinspection all */
		if ($type == 'link') { /** @var Link $instance */ }

        /** @noinspection all */
		if ($type == 'input-quarter') { /** @var QuarterControl $instance */ }

        /** @noinspection all */
		if ($type == 'hidden') { /** @var HiddenControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-group') { /** @var InputGroupControl $instance */ }

        /** @noinspection all */
		if ($type == 'property') { /** @var Property $instance */ }

        /** @noinspection all */
		if ($type == 'qr-code') { /** @var QRCode $instance */ }

        /** @noinspection all */
		if ($type == 'input-array') { /** @var ArrayControl $instance */ }

        /** @noinspection all */
		if ($type == 'json-schema-editor') { /** @var JSONSchemaEditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'pagination') { /** @var Pagination $instance */ }

        /** @noinspection all */
		if ($type == 'flex') { /** @var Flex $instance */ }

        /** @noinspection all */
		if ($type == 'postiats-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'powershell-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'scss-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-text') { /** @var TextControl $instance */ }

        /** @noinspection all */
		if ($type == 'card') { /** @var Card $instance */ }

        /** @noinspection all */
		if ($type == 'avatar') { /** @var Avatar $instance */ }

        /** @noinspection all */
		if ($type == 'input-url') { /** @var TextControl $instance */ }

        /** @noinspection all */
		if ($type == 'uuid') { /** @var UUIDControl $instance */ }

        /** @noinspection all */
		if ($type == 'diff-editor') { /** @var DiffControl $instance */ }

        /** @noinspection all */
		if ($type == 'custom') { /** @var Custom $instance */ }

        /** @noinspection all */
		if ($type == 'static-image') { /** @var StaticExactControl $instance */ }

        /** @noinspection all */
		if ($type == 'cpp-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'operation') { /** @var Operation $instance */ }

        /** @noinspection all */
		if ($type == 'input-sub-form') { /** @var SubFormControl $instance */ }

        /** @noinspection all */
		if ($type == 'static') { /** @var StaticExactControl $instance */ }

        /** @noinspection all */
		if ($type == 'page') { /** @var Page $instance */ }

        /** @noinspection all */
		if ($type == 'alert') { /** @var Alert $instance */ }

        /** @noinspection all */
		if ($type == 'spinner') { /** @var Spinner $instance */ }

        /** @noinspection all */
		if ($type == 'dockerfile-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'html-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'condition-builder') { /** @var ConditionBuilderControl $instance */ }

        /** @noinspection all */
		if ($type == 'grid') { /** @var Grid $instance */ }

        /** @noinspection all */
		if ($type == 'xml-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-date') { /** @var DateControl $instance */ }

        /** @noinspection all */
		if ($type == 'c-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'ini-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'status') { /** @var Status $instance */ }

        /** @noinspection all */
		if ($type == 'steps') { /** @var Steps $instance */ }

        /** @noinspection all */
		if ($type == 'input-date-range') { /** @var DateRangeControl $instance */ }

        /** @noinspection all */
		if ($type == 'go-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'progress') { /** @var Progress $instance */ }

        /** @noinspection all */
		if ($type == 'grid-2d') { /** @var Grid2D $instance */ }

        /** @noinspection all */
		if ($type == 'picker') { /** @var PickerControl $instance */ }

        /** @noinspection all */
		if ($type == 'markdown') { /** @var Markdown $instance */ }

        /** @noinspection all */
		if ($type == 'swift-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'yaml-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'native-time') { /** @var TextControl $instance */ }

        /** @noinspection all */
		if ($type == 'combo') { /** @var ComboControl $instance */ }

        /** @noinspection all */
		if ($type == 'button-toolbar') { /** @var ButtonToolbar $instance */ }

        /** @noinspection all */
		if ($type == 'html') { /** @var Html $instance */ }

        /** @noinspection all */
		if ($type == 'coffeescript-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'handlebars-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'plaintext-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'fieldset') { /** @var FieldSetControl $instance */ }

        /** @noinspection all */
		if ($type == 'matrix-checkboxes') { /** @var MatrixControl $instance */ }

        /** @noinspection all */
		if ($type == 'transfer-picker') { /** @var TransferPickerControl $instance */ }

        /** @noinspection all */
		if ($type == 'crud') { /** @var CRUDTable $instance */ }

        /** @noinspection all */
		if ($type == 'radios') { /** @var RadiosControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-month-range') { /** @var MonthRangeControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-city') { /** @var InputCityControl $instance */ }

        /** @noinspection all */
		if ($type == 'checkbox') { /** @var CheckboxControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-email') { /** @var TextControl $instance */ }

        /** @noinspection all */
		if ($type == 'tooltip-wrapper') { /** @var TooltipWrapper $instance */ }

        /** @noinspection all */
		if ($type == 'list-select') { /** @var ListControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-quarter-range') { /** @var QuarterRangeControl $instance */ }

        /** @noinspection all */
		if ($type == 'list') { /** @var ListRenderer $instance */ }

        /** @noinspection all */
		if ($type == 'select') { /** @var SelectControl $instance */ }

        /** @noinspection all */
		if ($type == 'icon-picker') { /** @var IconPickerControl $instance */ }

        /** @noinspection all */
		if ($type == 'anchor-nav') { /** @var AnchorNav $instance */ }

        /** @noinspection all */
		if ($type == 'dialog') { /** @var Dialog $instance */ }

        /** @noinspection all */
		if ($type == 'checkboxes') { /** @var CheckboxesControl $instance */ }

        /** @noinspection all */
		if ($type == 'icon') { /** @var Icon $instance */ }

        /** @noinspection all */
		if ($type == 'month') { /** @var Date $instance */ }

        /** @noinspection all */
		if ($type == 'image') { /** @var Image $instance */ }

        /** @noinspection all */
		if ($type == 'input-time-range') { /** @var DateRangeControl $instance */ }

        /** @noinspection all */
		if ($type == 'panel') { /** @var Panel $instance */ }

        /** @noinspection all */
		if ($type == 'location-picker') { /** @var LocationControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-datetime-range') { /** @var DateRangeControl $instance */ }

        /** @noinspection all */
		if ($type == 'native-number') { /** @var TextControl $instance */ }

        /** @noinspection all */
		if ($type == 'dropdown-button') { /** @var DropdownButton $instance */ }

        /** @noinspection all */
		if ($type == 'static-datetime') { /** @var StaticExactControl $instance */ }

        /** @noinspection all */
		if ($type == 'words') { /** @var Words $instance */ }

        /** @noinspection all */
		if ($type == 'input-year') { /** @var YearControl $instance */ }

        /** @noinspection all */
		if ($type == 'card2') { /** @var Card2 $instance */ }

        /** @noinspection all */
		if ($type == 'tag') { /** @var Tag $instance */ }

        /** @noinspection all */
		if ($type == 'input-tree') { /** @var TreeControl $instance */ }

        /** @noinspection all */
		if ($type == 'tabs') { /** @var Tabs $instance */ }

        /** @noinspection all */
		if ($type == 'table') { /** @var Table $instance */ }

        /** @noinspection all */
		if ($type == 'sb-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-password') { /** @var TextControl $instance */ }

        /** @noinspection all */
		if ($type == 'form') { /** @var Form $instance */ }

        /** @noinspection all */
		if ($type == 'container') { /** @var Container $instance */ }

        /** @noinspection all */
		if ($type == 'code') { /** @var Code $instance */ }

        /** @noinspection all */
		if ($type == 'wizard') { /** @var Wizard $instance */ }

        /** @noinspection all */
		if ($type == 'tasks') { /** @var Tasks $instance */ }

        /** @noinspection all */
		if ($type == 'input-datetime') { /** @var DateTimeControl $instance */ }

        /** @noinspection all */
		if ($type == 'input-image') { /** @var ImageControl $instance */ }

        /** @noinspection all */
		if ($type == 'switch') { /** @var SwitchControl $instance */ }

        /** @noinspection all */
		if ($type == 'static-date') { /** @var StaticExactControl $instance */ }

        /** @noinspection all */
		if ($type == 'bat-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'table-view') { /** @var TableView $instance */ }

        /** @noinspection all */
		if ($type == 'grid-nav') { /** @var GridNav $instance */ }

        /** @noinspection all */
		if ($type == 'multi-select') { /** @var SelectControl $instance */ }

        /** @noinspection all */
		if ($type == 'control') { /** @var FormControl $instance */ }

        /** @noinspection all */
		if ($type == 'button-group-select') { /** @var ButtonGroupControl $instance */ }

        /** @noinspection all */
		if ($type == 'calendar') { /** @var Calendar $instance */ }

        /** @noinspection all */
		if ($type == 'collapse-group') { /** @var CollapseGroup $instance */ }

        /** @noinspection all */
		if ($type == 'time') { /** @var Date $instance */ }

        /** @noinspection all */
		if ($type == 'static-time') { /** @var StaticExactControl $instance */ }

        /** @noinspection all */
		if ($type == 'web-component') { /** @var WebComponent $instance */ }

        /** @noinspection all */
		if ($type == 'button') { /** @var VanillaAction $instance */ }

        /** @noinspection all */
		if ($type == 'sparkline') { /** @var SparkLine $instance */ }

        /** @noinspection all */
		if ($type == 'input-rating') { /** @var RatingControl $instance */ }

        /** @noinspection all */
		if ($type == 'lua-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'objective-c-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'nav') { /** @var Nav $instance */ }

        /** @noinspection all */
		if ($type == 'textarea') { /** @var TextareaControl $instance */ }

        /** @noinspection all */
		if ($type == 'fsharp-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'vb-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'wrapper') { /** @var Wrapper $instance */ }

        /** @noinspection all */
		if ($type == 'each') { /** @var Each $instance */ }

        /** @noinspection all */
		if ($type == 'collapse') { /** @var Collapse $instance */ }

        /** @noinspection all */
		if ($type == 'button-group') { /** @var ButtonGroup $instance */ }

        /** @noinspection all */
		if ($type == 'chained-select') { /** @var ChainedSelectControl $instance */ }

        /** @noinspection all */
		if ($type == 'barcode') { /** @var Barcode $instance */ }

        /** @noinspection all */
		if ($type == 'json-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'python-editor') { /** @var EditorControl $instance */ }

        /** @noinspection all */
		if ($type == 'date-range') { /** @var DateRange $instance */ }

        /** @noinspection all */
		if ($type == 'service') { /** @var Service $instance */ }

        /** @noinspection all */
		if ($type == 'typescript-editor') { /** @var EditorControl $instance */ }

		return $instance;
	}
}

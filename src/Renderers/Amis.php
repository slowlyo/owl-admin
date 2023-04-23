<?php 

namespace Slowlyo\OwlAdmin\Renderers;

class Amis 
{ 
    public static function make()
    { 
        return new self(); 
    }

    public function Action()
    {
        return Action::make();
    }

    public function AjaxAction()
    {
        return AjaxAction::make();
    }

    public function Alert()
    {
        return Alert::make();
    }

    public function AnchorNav()
    {
        return AnchorNav::make();
    }

    public function AnchorNavSection()
    {
        return AnchorNavSection::make();
    }

    public function ArrayControl($name = '', $label = '')
    {
        return ArrayControl::make()->name($name)->label($label);
    }

    public function Audio()
    {
        return Audio::make();
    }

    public function Avatar()
    {
        return Avatar::make();
    }

    public function Badge()
    {
        return Badge::make();
    }

    public function Barcode()
    {
        return Barcode::make();
    }

    public function BaseApi()
    {
        return BaseApi::make();
    }

    public function BaseRenderer()
    {
        return BaseRenderer::make();
    }

    public function Breadcrumb()
    {
        return Breadcrumb::make();
    }

    public function Button()
    {
        return Button::make();
    }

    public function ButtonGroup()
    {
        return ButtonGroup::make();
    }

    public function ButtonGroupControl($name = '', $label = '')
    {
        return ButtonGroupControl::make()->name($name)->label($label);
    }

    public function ButtonToolbar()
    {
        return ButtonToolbar::make();
    }

    public function CRUD2Cards()
    {
        return CRUD2Cards::make();
    }

    public function CRUD2List()
    {
        return CRUD2List::make();
    }

    public function CRUD2Table()
    {
        return CRUD2Table::make();
    }

    public function CRUDCards()
    {
        return CRUDCards::make();
    }

    public function CRUDList()
    {
        return CRUDList::make();
    }

    public function CRUDTable()
    {
        return CRUDTable::make();
    }

    public function Calendar()
    {
        return Calendar::make();
    }

    public function Card()
    {
        return Card::make();
    }

    public function Card2()
    {
        return Card2::make();
    }

    public function Cards()
    {
        return Cards::make();
    }

    public function Carousel()
    {
        return Carousel::make();
    }

    public function ChainedSelectControl($name = '', $label = '')
    {
        return ChainedSelectControl::make()->name($name)->label($label);
    }

    public function Chart()
    {
        return Chart::make();
    }

    public function ChartRadios()
    {
        return ChartRadios::make();
    }

    public function CheckboxControl($name = '', $label = '')
    {
        return CheckboxControl::make()->name($name)->label($label);
    }

    public function CheckboxesControl($name = '', $label = '')
    {
        return CheckboxesControl::make()->name($name)->label($label);
    }

    public function Code()
    {
        return Code::make();
    }

    public function Collapse()
    {
        return Collapse::make();
    }

    public function CollapseGroup()
    {
        return CollapseGroup::make();
    }

    public function Color()
    {
        return Color::make();
    }

    public function Column()
    {
        return Column::make();
    }

    public function ComboCondition()
    {
        return ComboCondition::make();
    }

    public function ComboControl($name = '', $label = '')
    {
        return ComboControl::make()->name($name)->label($label);
    }

    public function Component()
    {
        return Component::make();
    }

    public function ConditionBuilderControl($name = '', $label = '')
    {
        return ConditionBuilderControl::make()->name($name)->label($label);
    }

    public function ConditionGroupValue()
    {
        return ConditionGroupValue::make();
    }

    public function Container()
    {
        return Container::make();
    }

    public function CopyAction()
    {
        return CopyAction::make();
    }

    public function Custom()
    {
        return Custom::make();
    }

    public function Date()
    {
        return Date::make();
    }

    public function DateControl($name = '', $label = '')
    {
        return DateControl::make()->name($name)->label($label);
    }

    public function DateRange()
    {
        return DateRange::make();
    }

    public function DateRangeControl($name = '', $label = '')
    {
        return DateRangeControl::make()->name($name)->label($label);
    }

    public function DateTimeControl($name = '', $label = '')
    {
        return DateTimeControl::make()->name($name)->label($label);
    }

    public function Dialog()
    {
        return Dialog::make();
    }

    public function DialogAction()
    {
        return DialogAction::make();
    }

    public function DiffControl($name = '', $label = '')
    {
        return DiffControl::make()->name($name)->label($label);
    }

    public function Divider()
    {
        return Divider::make();
    }

    public function Drawer()
    {
        return Drawer::make();
    }

    public function DrawerAction()
    {
        return DrawerAction::make();
    }

    public function DropdownButton()
    {
        return DropdownButton::make();
    }

    public function Each()
    {
        return Each::make();
    }

    public function EditorControl($name = '', $label = '')
    {
        return EditorControl::make()->name($name)->label($label);
    }

    public function EmailAction()
    {
        return EmailAction::make();
    }

    public function Expandable()
    {
        return Expandable::make();
    }

    public function FeedbackDialog()
    {
        return FeedbackDialog::make();
    }

    public function FieldSetControl($name = '', $label = '')
    {
        return FieldSetControl::make()->name($name)->label($label);
    }

    public function FileControl($name = '', $label = '')
    {
        return FileControl::make()->name($name)->label($label);
    }

    public function Flex()
    {
        return Flex::make();
    }

    public function Form()
    {
        return Form::make();
    }

    public function FormControl($name = '', $label = '')
    {
        return FormControl::make()->name($name)->label($label);
    }

    public function FormulaControl($name = '', $label = '')
    {
        return FormulaControl::make()->name($name)->label($label);
    }

    public function Grid()
    {
        return Grid::make();
    }

    public function Grid2D()
    {
        return Grid2D::make();
    }

    public function GridColumn()
    {
        return GridColumn::make();
    }

    public function GridNav()
    {
        return GridNav::make();
    }

    public function GroupControl($name = '', $label = '')
    {
        return GroupControl::make()->name($name)->label($label);
    }

    public function HBox()
    {
        return HBox::make();
    }

    public function HBoxColumn()
    {
        return HBoxColumn::make();
    }

    public function HiddenControl($name = '', $label = '')
    {
        return HiddenControl::make()->name($name)->label($label);
    }

    public function Html()
    {
        return Html::make();
    }

    public function IFrame()
    {
        return IFrame::make();
    }

    public function Icon()
    {
        return Icon::make();
    }

    public function IconChecked()
    {
        return IconChecked::make();
    }

    public function IconItem()
    {
        return IconItem::make();
    }

    public function IconPickerControl($name = '', $label = '')
    {
        return IconPickerControl::make()->name($name)->label($label);
    }

    public function Image()
    {
        return Image::make();
    }

    public function ImageControl($name = '', $label = '')
    {
        return ImageControl::make()->name($name)->label($label);
    }

    public function ImageToolbarAction()
    {
        return ImageToolbarAction::make();
    }

    public function Images()
    {
        return Images::make();
    }

    public function InputCityControl($name = '', $label = '')
    {
        return InputCityControl::make()->name($name)->label($label);
    }

    public function InputColorControl($name = '', $label = '')
    {
        return InputColorControl::make()->name($name)->label($label);
    }

    public function InputDatetimeRange()
    {
        return InputDatetimeRange::make();
    }

    public function InputExcel()
    {
        return InputExcel::make();
    }

    public function InputGroupControl($name = '', $label = '')
    {
        return InputGroupControl::make()->name($name)->label($label);
    }

    public function InputKV()
    {
        return InputKV::make();
    }

    public function InputKVS()
    {
        return InputKVS::make();
    }

    public function InputTimeRange()
    {
        return InputTimeRange::make();
    }

    public function InputYearRange()
    {
        return InputYearRange::make();
    }

    public function JSONSchemaEditorControl($name = '', $label = '')
    {
        return JSONSchemaEditorControl::make()->name($name)->label($label);
    }

    public function Json()
    {
        return Json::make();
    }

    public function Link()
    {
        return Link::make();
    }

    public function LinkAction()
    {
        return LinkAction::make();
    }

    public function ListBodyField($name = '', $label = '')
    {
        return ListBodyField::make()->name($name)->label($label);
    }

    public function ListControl($name = '', $label = '')
    {
        return ListControl::make()->name($name)->label($label);
    }

    public function ListItem()
    {
        return ListItem::make();
    }

    public function ListRenderer()
    {
        return ListRenderer::make();
    }

    public function ListenerAction()
    {
        return ListenerAction::make();
    }

    public function LocationControl($name = '', $label = '')
    {
        return LocationControl::make()->name($name)->label($label);
    }

    public function Log()
    {
        return Log::make();
    }

    public function Mapping()
    {
        return Mapping::make();
    }

    public function Markdown()
    {
        return Markdown::make();
    }

    public function MatrixControl($name = '', $label = '')
    {
        return MatrixControl::make()->name($name)->label($label);
    }

    public function MonthControl($name = '', $label = '')
    {
        return MonthControl::make()->name($name)->label($label);
    }

    public function MonthRangeControl($name = '', $label = '')
    {
        return MonthRangeControl::make()->name($name)->label($label);
    }

    public function MultilineText()
    {
        return MultilineText::make();
    }

    public function Nav()
    {
        return Nav::make();
    }

    public function NavItem()
    {
        return NavItem::make();
    }

    public function NavOverflow()
    {
        return NavOverflow::make();
    }

    public function NestedSelectControl($name = '', $label = '')
    {
        return NestedSelectControl::make()->name($name)->label($label);
    }

    public function NumberControl($name = '', $label = '')
    {
        return NumberControl::make()->name($name)->label($label);
    }

    public function Operation()
    {
        return Operation::make();
    }

    public function Option()
    {
        return Option::make();
    }

    public function Options()
    {
        return Options::make();
    }

    public function OtherAction()
    {
        return OtherAction::make();
    }

    public function Page()
    {
        return Page::make();
    }

    public function Pagination()
    {
        return Pagination::make();
    }

    public function PaginationWrapper()
    {
        return PaginationWrapper::make();
    }

    public function Panel()
    {
        return Panel::make();
    }

    public function Password()
    {
        return Password::make();
    }

    public function PickerControl($name = '', $label = '')
    {
        return PickerControl::make()->name($name)->label($label);
    }

    public function Plain()
    {
        return Plain::make();
    }

    public function Portlet()
    {
        return Portlet::make();
    }

    public function PortletTab()
    {
        return PortletTab::make();
    }

    public function Progress()
    {
        return Progress::make();
    }

    public function Property()
    {
        return Property::make();
    }

    public function QRCode()
    {
        return QRCode::make();
    }

    public function QRCodeImageSettings()
    {
        return QRCodeImageSettings::make();
    }

    public function QuarterControl($name = '', $label = '')
    {
        return QuarterControl::make()->name($name)->label($label);
    }

    public function QuarterRangeControl($name = '', $label = '')
    {
        return QuarterRangeControl::make()->name($name)->label($label);
    }

    public function RadiosControl($name = '', $label = '')
    {
        return RadiosControl::make()->name($name)->label($label);
    }

    public function RangeControl($name = '', $label = '')
    {
        return RangeControl::make()->name($name)->label($label);
    }

    public function RatingControl($name = '', $label = '')
    {
        return RatingControl::make()->name($name)->label($label);
    }

    public function ReloadAction()
    {
        return ReloadAction::make();
    }

    public function Remark()
    {
        return Remark::make();
    }

    public function RepeatControl($name = '', $label = '')
    {
        return RepeatControl::make()->name($name)->label($label);
    }

    public function RichTextControl($name = '', $label = '')
    {
        return RichTextControl::make()->name($name)->label($label);
    }

    public function RowSelection()
    {
        return RowSelection::make();
    }

    public function RowSelectionOptions()
    {
        return RowSelectionOptions::make();
    }

    public function SchemaApi()
    {
        return SchemaApi::make();
    }

    public function SchemaCopyable()
    {
        return SchemaCopyable::make();
    }

    public function SchemaMessage()
    {
        return SchemaMessage::make();
    }

    public function SchemaPopOver()
    {
        return SchemaPopOver::make();
    }

    public function SearchBox()
    {
        return SearchBox::make();
    }

    public function SelectControl($name = '', $label = '')
    {
        return SelectControl::make()->name($name)->label($label);
    }

    public function Service()
    {
        return Service::make();
    }

    public function SparkLine()
    {
        return SparkLine::make();
    }

    public function Spinner()
    {
        return Spinner::make();
    }

    public function StaticExactControl($name = '', $label = '')
    {
        return StaticExactControl::make()->name($name)->label($label);
    }

    public function Status()
    {
        return Status::make();
    }

    public function Step()
    {
        return Step::make();
    }

    public function Steps()
    {
        return Steps::make();
    }

    public function SubFormControl($name = '', $label = '')
    {
        return SubFormControl::make()->name($name)->label($label);
    }

    public function SvgIcon()
    {
        return SvgIcon::make();
    }

    public function SwitchControl($name = '', $label = '')
    {
        return SwitchControl::make()->name($name)->label($label);
    }

    public function Tab()
    {
        return Tab::make();
    }

    public function Table()
    {
        return Table::make();
    }

    public function TableColumn($name = '', $label = '')
    {
        return TableColumn::make()->name($name)->label($label);
    }

    public function TableControl($name = '', $label = '')
    {
        return TableControl::make()->name($name)->label($label);
    }

    public function TableSchema2()
    {
        return TableSchema2::make();
    }

    public function TableView()
    {
        return TableView::make();
    }

    public function Tabs()
    {
        return Tabs::make();
    }

    public function TabsTransferControl($name = '', $label = '')
    {
        return TabsTransferControl::make()->name($name)->label($label);
    }

    public function TabsTransferPickerControl($name = '', $label = '')
    {
        return TabsTransferPickerControl::make()->name($name)->label($label);
    }

    public function Tag()
    {
        return Tag::make();
    }

    public function TagControl($name = '', $label = '')
    {
        return TagControl::make()->name($name)->label($label);
    }

    public function Tasks()
    {
        return Tasks::make();
    }

    public function TextControl($name = '', $label = '')
    {
        return TextControl::make()->name($name)->label($label);
    }

    public function TextareaControl($name = '', $label = '')
    {
        return TextareaControl::make()->name($name)->label($label);
    }

    public function TimeControl($name = '', $label = '')
    {
        return TimeControl::make()->name($name)->label($label);
    }

    public function Timeline()
    {
        return Timeline::make();
    }

    public function TimelineItem()
    {
        return TimelineItem::make();
    }

    public function Toast()
    {
        return Toast::make();
    }

    public function ToastAction()
    {
        return ToastAction::make();
    }

    public function TooltipWrapper()
    {
        return TooltipWrapper::make();
    }

    public function Tpl()
    {
        return Tpl::make();
    }

    public function TransferControl($name = '', $label = '')
    {
        return TransferControl::make()->name($name)->label($label);
    }

    public function TransferPickerControl($name = '', $label = '')
    {
        return TransferPickerControl::make()->name($name)->label($label);
    }

    public function TreeControl($name = '', $label = '')
    {
        return TreeControl::make()->name($name)->label($label);
    }

    public function TreeSelectControl($name = '', $label = '')
    {
        return TreeSelectControl::make()->name($name)->label($label);
    }

    public function UUIDControl($name = '', $label = '')
    {
        return UUIDControl::make()->name($name)->label($label);
    }

    public function UrlAction()
    {
        return UrlAction::make();
    }

    public function UserSelectControl($name = '', $label = '')
    {
        return UserSelectControl::make()->name($name)->label($label);
    }

    public function VBox()
    {
        return VBox::make();
    }

    public function VanillaAction()
    {
        return VanillaAction::make();
    }

    public function Video()
    {
        return Video::make();
    }

    public function WangEditor($name = '', $label = '')
    {
        return WangEditor::make()->name($name)->label($label);
    }

    public function WebComponent()
    {
        return WebComponent::make();
    }

    public function Wizard()
    {
        return Wizard::make();
    }

    public function WizardStep($name = '', $label = '')
    {
        return WizardStep::make()->name($name)->label($label);
    }

    public function Words()
    {
        return Words::make();
    }

    public function Wrapper()
    {
        return Wrapper::make();
    }

    public function YearControl($name = '', $label = '')
    {
        return YearControl::make()->name($name)->label($label);
    }

}
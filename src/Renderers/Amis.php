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
        $instance = ArrayControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function Audio()
    {
        return Audio::make();
    }

    public function AutoFillHeight()
    {
        return AutoFillHeight::make();
    }

    public function AutoGenerateFilter()
    {
        return AutoGenerateFilter::make();
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
        $instance = ButtonGroupControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = ChainedSelectControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = CheckboxControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function CheckboxesControl($name = '', $label = '')
    {
        $instance = CheckboxesControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = ComboControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function Component()
    {
        return Component::make();
    }

    public function ConditionBuilderControl($name = '', $label = '')
    {
        $instance = ConditionBuilderControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = DateControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function DateRange()
    {
        return DateRange::make();
    }

    public function DateRangeControl($name = '', $label = '')
    {
        $instance = DateRangeControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function DateTimeControl($name = '', $label = '')
    {
        $instance = DateTimeControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = DiffControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = EditorControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = FieldSetControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function FileControl($name = '', $label = '')
    {
        $instance = FileControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = FormControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function FormulaControl($name = '', $label = '')
    {
        $instance = FormulaControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = GroupControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = HiddenControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = IconPickerControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function Image()
    {
        return Image::make();
    }

    public function ImageControl($name = '', $label = '')
    {
        $instance = ImageControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = InputCityControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function InputColorControl($name = '', $label = '')
    {
        $instance = InputColorControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = InputGroupControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = JSONSchemaEditorControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = ListBodyField::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function ListControl($name = '', $label = '')
    {
        $instance = ListControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = LocationControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = MatrixControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function MonthControl($name = '', $label = '')
    {
        $instance = MonthControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function MonthRangeControl($name = '', $label = '')
    {
        $instance = MonthRangeControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = NestedSelectControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function NumberControl($name = '', $label = '')
    {
        $instance = NumberControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = PickerControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = QuarterControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function QuarterRangeControl($name = '', $label = '')
    {
        $instance = QuarterRangeControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function RadioControl($name = '', $label = '')
    {
        $instance = RadioControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function RadiosControl($name = '', $label = '')
    {
        $instance = RadiosControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function RangeControl($name = '', $label = '')
    {
        $instance = RangeControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function RatingControl($name = '', $label = '')
    {
        $instance = RatingControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = RepeatControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function RichTextControl($name = '', $label = '')
    {
        $instance = RichTextControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = SelectControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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

    public function State()
    {
        return State::make();
    }

    public function StaticExactControl($name = '', $label = '')
    {
        $instance = StaticExactControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = SubFormControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function SvgIcon()
    {
        return SvgIcon::make();
    }

    public function SwitchContainer()
    {
        return SwitchContainer::make();
    }

    public function SwitchControl($name = '', $label = '')
    {
        $instance = SwitchControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = TableColumn::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function TableControl($name = '', $label = '')
    {
        $instance = TableControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = TabsTransferControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function TabsTransferPickerControl($name = '', $label = '')
    {
        $instance = TabsTransferPickerControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function Tag()
    {
        return Tag::make();
    }

    public function TagControl($name = '', $label = '')
    {
        $instance = TagControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function Tasks()
    {
        return Tasks::make();
    }

    public function TextControl($name = '', $label = '')
    {
        $instance = TextControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function TextareaControl($name = '', $label = '')
    {
        $instance = TextareaControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function TimeControl($name = '', $label = '')
    {
        $instance = TimeControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = TransferControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function TransferPickerControl($name = '', $label = '')
    {
        $instance = TransferPickerControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function TreeControl($name = '', $label = '')
    {
        $instance = TreeControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function TreeSelectControl($name = '', $label = '')
    {
        $instance = TreeSelectControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function UUIDControl($name = '', $label = '')
    {
        $instance = UUIDControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

    public function UrlAction()
    {
        return UrlAction::make();
    }

    public function UserSelectControl($name = '', $label = '')
    {
        $instance = UserSelectControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = WangEditor::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = WizardStep::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
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
        $instance = YearControl::make();

        if ($name !== '') {
            $instance->name($name);
        }

        if ($label !== '') {
            $instance->label($label);
        }

        return $instance;
    }

}

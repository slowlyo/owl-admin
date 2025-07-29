<?php

namespace Slowlyo\OwlAdmin\Traits;

trait IconifyPickerTrait
{
    /**
     * iconify 图标选择器
     *
     * @param string $name
     * @param string $label
     *
     * @return \Slowlyo\OwlAdmin\Renderers\PickerControl
     */
    public function iconifyPicker(string $name = '', string $label = '')
    {
        $schema = amis()->CRUDTable()
            ->perPage(10)
            ->loadDataOnce()
            ->footerToolbar(['pagination', 'statistics'])
            ->api('/_iconify_search')
            ->filter(
                amis()->Form()->wrapWithPanel(false)->body([
                    amis()->GroupControl()->className('pt-3 pb-3')->body([
                        amis()->TextControl('query')
                            ->size('md')
                            ->value('${' . $name . ' || "home"}')
                            ->clearable()
                            ->required(),
                        amis()->Button()
                            ->label(admin_trans('admin.search'))
                            ->level('primary')
                            ->actionType('submit')
                            ->icon('fa fa-search'),
                        amis()->UrlAction()
                            ->className('ml-2')
                            ->icon('fa fa-external-link-alt')
                            ->label('Icones')
                            ->blank()
                            ->url('https://icones.js.org/collection/all'),
                    ]),
                ])
            )
            ->columns([
                amis()->Flex()->justify('flex-start')->alignItems('center')->items([
                    amis()->SvgIcon()->icon('${icon}')->className('text-2xl'),
                    amis()->Tpl()->className('ml-3')->tpl('${icon}')
                ])
            ]);

        return amis()->PickerControl($name, $label)
            ->pickerSchema($schema)
            ->modalSize('md')
            ->source('/_iconify_search')
            ->labelField('icon')
            ->valueField('icon');
    }
}

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
        $schema = amis()->CRUDCards()
            ->perPage(40)
            ->loadDataOnce()
            ->set('columnsCount', 8)
            ->footerToolbar(['statistics', 'pagination'])
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
                            ->label(__('admin.search'))
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
            ->card(
                amis()->Card()->body([
                    amis()->SvgIcon()->icon('${icon}')->className('text-2xl'),
                ])
            );

        return amis()->PickerControl($name, $label)
            ->pickerSchema($schema)
            ->source('/_iconify_search')
            ->size('lg')
            ->labelField('icon')
            ->valueField('icon');
    }
}

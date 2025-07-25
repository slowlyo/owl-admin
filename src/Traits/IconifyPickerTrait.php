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
            ->set('itemClassName', 'col-xs-4 col-sm-4 col-md-6 col-lg-8 col-xl-12')
            ->card(
                amis()->Card()->body([
                    amis()->SvgIcon()->icon('${icon}')->className('text-2xl'),
                ])
            );

        return amis()->PickerControl($name, $label)
            ->pickerSchema($schema)
            ->source('/_iconify_search')
            ->modalMode('drawer')
            ->modalSize('xl')
            ->labelField('icon')
            ->valueField('icon');
    }
}

<?php

namespace Slowlyo\OwlAdmin\Traits;

trait IconifyPickerTrait
{
    public function iconifyPicker($name = '', $label = '')
    {
        $schema = amis()->CRUDCards()
            ->innerClassName('pt-5')
            ->footerToolbar(['statistics', 'pagination'])
            ->api('/_iconify_search')
            ->card(
                amis()->Card()->body([
                    amis()->SvgIcon()->icon('${icon}')->className('text-xl'),
                ])
            )->set('columnsCount', 8);

        return amis()->PickerControl($name, $label)
            ->pickerSchema($schema)
            ->source('/_iconify_search')
            ->size('lg')
            ->labelField('icon')
            ->valueField('icon');
    }
}

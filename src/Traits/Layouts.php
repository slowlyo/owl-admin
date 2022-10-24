<?php

namespace Slowlyo\SlowAdmin\Traits;

use Slowlyo\SlowAdmin\SlowAdmin;
use Slowlyo\SlowAdmin\Renderers\Flex;
use Slowlyo\SlowAdmin\Renderers\Avatar;
use Slowlyo\SlowAdmin\Renderers\Button;
use Slowlyo\SlowAdmin\Renderers\Wrapper;
use Slowlyo\SlowAdmin\Renderers\Component;
use Slowlyo\SlowAdmin\Renderers\DropDownButton;

trait Layouts
{
    private static array $leftHeader  = [];
    private static array $rightHeader = [];

    public function baseApp(): static
    {
        $this->userInfo();

        $app = Component::make()
            ->setType('app')
            ->brandName(config('admin.name'))
            ->logo(url(config('admin.logo')))
            ->api(url(config('admin.route.prefix') . '/base'))
            ->header($this->header())
            ->toJson();

        $this->setVariable('app', $app);

        return $this;
    }

    /**
     * 用户信息部分
     *
     * @return void|null
     */
    protected function userInfo()
    {
        if (!config('admin.layout.enable_user_menu')) {
            return null;
        }

        self::appendRightHeader(
            Avatar::make()
                ->size(30)
                ->src(SlowAdmin::user()->avatar),
            DropDownButton::make()->label(SlowAdmin::user()?->name ?? __('admin.administrator'))
                ->trigger('hover')
                ->btnClassName('admin-user-info mr-2')
                ->hideCaret(true)
                ->align('right')
                ->size('sm')
                ->buttons([
                    Button::make()
                        ->icon('fa-solid fa-user-gear')
                        ->iconClassName('mr-2')
                        ->label(__('admin.user_setting'))
                        ->actionType('link')
                        ->link('/user_setting'),
                    Button::make()
                        ->icon('fa-solid fa-arrow-right-from-bracket')
                        ->iconClassName('mr-2')
                        ->label(' ' . __('admin.logout'))
                        ->actionType('ajax')
                        ->api('get:' . url(config('admin.route.prefix') . '/logout'))
                        ->redirect(url(config('admin.route.prefix') . '/login')),
                ]),
        );
    }

    public static function appendLeftHeader(...$content)
    {
        array_push(static::$leftHeader, ...$content);
    }

    public static function prependLeftHeader(...$content)
    {
        array_unshift(static::$leftHeader, ...$content);
    }

    public static function appendRightHeader(...$content)
    {
        array_push(static::$rightHeader, ...$content);
    }

    public static function prependRightHeader(...$content)
    {
        array_unshift(static::$rightHeader, ...$content);
    }

    protected function header(): Flex
    {
        return Flex::make()->className('w-full h-full')
            ->justify('space-between')
            ->alignItems('center')
            ->items([
                Wrapper::make()->size('none')->body(
                    Flex::make()->items(static::$leftHeader)
                ),
                Wrapper::make()->size('none')->body(
                    Flex::make()->items(static::$rightHeader)
                ),
            ]);
    }
}

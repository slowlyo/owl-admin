<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Support\Captcha;
use Slowlyo\OwlAdmin\Models\AdminUser;
use Illuminate\Support\Facades\Validator;
use Slowlyo\OwlAdmin\Renderers\TextControl;
use Slowlyo\OwlAdmin\Renderers\ImageControl;
use Symfony\Component\HttpFoundation\Response;
use Slowlyo\OwlAdmin\Services\AdminUserService;

class AuthController extends AdminController
{
    protected string $serviceName = AdminUserService::class;

    public function login(Request $request)
    {
        if (Admin::config('admin.auth.login_captcha')) {
            if (!$request->has('captcha')) {
                return $this->response()->fail(__('admin.required', ['attribute' => __('admin.captcha')]));
            }

            if (strtolower(admin_decode($request->sys_captcha)) != strtolower($request->captcha)) {
                return $this->response()->fail(__('admin.captcha_error'));
            }
        }

        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ], [
                'username' . '.required' => __('admin.required', ['attribute' => __('admin.username')]),
                'password.required'      => __('admin.required', ['attribute' => __('admin.password')]),
            ]);

            if ($validator->fails()) {
                abort(Response::HTTP_BAD_REQUEST, $validator->errors()->first());
            }
            $adminModel = Admin::adminUserModel();
            $user       = $adminModel::query()->where('username', $request->username)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                $module = Admin::currentModule(true);
                $prefix = $module ? $module . '.' : '';
                $token  = $user->createToken($prefix . 'admin')->plainTextToken;

                return $this->response()->success(compact('token'), __('admin.login_successful'));
            }

            abort(Response::HTTP_BAD_REQUEST, __('admin.login_failed'));
        } catch (\Exception $e) {
            return $this->response()->fail($e->getMessage());
        }
    }

    public function loginPage()
    {
        $captcha       = null;
        $enableCaptcha = Admin::config('admin.auth.login_captcha');

        // 验证码
        if ($enableCaptcha) {
            $captcha = amis()->InputGroupControl()->body([
                amis()->TextControl()->name('captcha')->placeholder(__('admin.captcha'))->required(),
                amis()->HiddenControl()->name('sys_captcha'),
                amis()->Service()->id('captcha-service')->api('get:' . admin_url('/captcha'))->body(
                    amis()
                        ->Image()
                        ->src('${captcha_img}')
                        ->height('1.917rem')
                        ->className('p-0 captcha-box')
                        ->imageClassName('rounded-r')
                        ->set(
                            'clickAction',
                            ['actionType' => 'reload', 'target' => 'captcha-service']
                        )
                ),
            ]);
        }

        $form = amis()->Form()->panelClassName('border-none')->id('login-form')->title()->api(admin_url('/login'))->initApi('/no-content')->body([
            amis()->TextControl()->name('username')->placeholder(__('admin.username'))->required(),
            amis()
                ->TextControl()
                ->type('input-password')
                ->name('password')
                ->placeholder(__('admin.password'))
                ->required(),
            $captcha,
            amis()->CheckboxControl()->name('remember_me')->option(__('admin.remember_me'))->value(true),

            // 登录按钮
            amis()
                ->VanillaAction()
                ->actionType('submit')
                ->label(__('admin.login'))
                ->level('primary')
                ->className('w-full'),
        ])->actions([]); // 清空默认的提交按钮

        $failAction = [];
        if ($enableCaptcha) {
            // 登录失败后刷新验证码
            $failAction = [
                // 登录失败事件
                'submitFail' => [
                    'actions' => [
                        // 刷新验证码外层Service
                        ['actionType' => 'reload', 'componentId' => 'captcha-service'],
                    ],
                ],
            ];
        }
        $form->onEvent(array_merge([
            // 页面初始化事件
            'inited'     => [
                'actions' => [
                    // 读取本地存储的登录参数
                    [
                        'actionType' => 'custom',
                        'script'     => <<<JS
let loginParams = localStorage.getItem(window.\$owl.getCacheKey('loginParams'))
if(loginParams){
    loginParams = JSON.parse(decodeURIComponent(window.atob(loginParams)))
    doAction({
        actionType: 'setValue',
        componentId: 'login-form',
        args: { value: loginParams }
    })
}
JS
                        ,

                    ],
                ],
            ],
            // 登录成功事件
            'submitSucc' => [
                'actions' => [
                    // 保存登录参数到本地, 并跳转到首页
                    [
                        'actionType' => 'custom',
                        'script'     => <<<JS
let _data = {}
if(event.data.remember_me){
    _data = { username: event.data.username, password: event.data.password }
}
window.\$owl.afterLoginSuccess(_data, event.data.result.data.token)
JS,

                    ],
                ],
            ],
        ], $failAction));

        $card = amis()->Card()->className('w-96 m:w-full')->body([
            amis()->Flex()->justify('space-between')->className('px-2.5 pb-2.5')->items([
                amis()->Image()->src(url(Admin::config('admin.logo')))->width(40)->height(40),
                amis()
                    ->Tpl()
                    ->className('font-medium')
                    ->tpl('<div style="font-size: 24px">' . Admin::config('admin.name') . '</div>'),
            ]),
            $form,
        ]);

        return amis()->Page()->className('login-bg')->css([
            '.captcha-box .cxd-Image--thumb' => [
                'padding' => '0',
                'cursor'  => 'pointer',
                'border'  => 'var(--Form-input-borderWidth) solid var(--Form-input-borderColor)',

                'border-top-right-radius'    => '4px',
                'border-bottom-right-radius' => '4px',
            ],
            '.cxd-Image-thumb'               => ['width' => 'auto'],
            '.login-bg' => [
                'background' => 'var(--owl-body-bg)'
            ]
        ])->body(
            amis()->Wrapper()->className("h-screen w-full flex items-center justify-center")->body($card)
        );
    }

    /**
     * 刷新验证码
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function reloadCaptcha()
    {
        $captcha = new Captcha();

        $captcha_img = $captcha->showImg();
        $sys_captcha = admin_encode($captcha->getCaptcha());

        return $this->response()->success(compact('captcha_img', 'sys_captcha'));
    }

    public function logout(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $this->guard()->user()->currentAccessToken()->delete();

        return $this->response()->successMessage();
    }

    protected function guard(): \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
    {
        return Admin::guard();
    }

    public function currentUser()
    {
        $userInfo = Admin::user()->only(['name', 'avatar']);

        $menus = amis()
            ->DropdownButton()
            ->hideCaret()
            ->trigger('hover')
            ->label($userInfo['name'])
            ->className('h-full')
            ->btnClassName('navbar-user')
            ->menuClassName('min-w-0 p-2')
            ->set('icon', $userInfo['avatar'])
            ->buttons([
                amis()
                    ->VanillaAction()
                    ->iconClassName('pr-2')
                    ->icon('fa fa-user-gear')
                    ->label(__('admin.user_setting'))
                    ->onClick('window.location.hash = "#/user_setting"'),
                amis()
                    ->VanillaAction()
                    ->iconClassName('pr-2')
                    ->label(__('admin.logout'))
                    ->icon('fa-solid fa-right-from-bracket')
                    ->onClick('window.$owl.logout()'),
            ]);

        return $this->response()->success(array_merge($userInfo, compact('menus')));
    }

    public function userSetting(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $user = $this->user()->makeHidden([
            'username',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
            'roles',
        ]);

        $form = Form::make()
            ->title()
            ->panelClassName('px-48 m:px-0')
            ->mode('horizontal')
            ->data($user)
            ->api('put:' . admin_url('/user_setting'))
            ->body([
                ImageControl::make()
                    ->label(__('admin.admin_user.avatar'))
                    ->name('avatar')
                    ->receiver($this->uploadImagePath()),
                TextControl::make()->label(__('admin.admin_user.name'))->name('name')->required(),
                TextControl::make()->type('input-password')->label(__('admin.old_password'))->name('old_password'),
                TextControl::make()->type('input-password')->label(__('admin.password'))->name('password'),
                TextControl::make()
                    ->type('input-password')
                    ->label(__('admin.confirm_password'))
                    ->name('confirm_password'),
            ]);

        return $this->response()->success(Page::make()->body($form));
    }

    public function saveUserSetting(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $result = $this->service->updateUserSetting($this->user()->id,
            request()->only([
                'avatar',
                'name',
                'old_password',
                'password',
                'confirm_password',
            ]));

        return $this->autoResponse($result);
    }
}

<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\Request;
use Slowlyo\SlowAdmin\SlowAdmin;
use Illuminate\Contracts\View\View;
use Slowlyo\SlowAdmin\Libs\Captcha;
use Slowlyo\SlowAdmin\Renderers\Card;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Flex;
use Illuminate\Contracts\View\Factory;
use Slowlyo\SlowAdmin\Renderers\Image;
use Slowlyo\SlowAdmin\Renderers\Button;
use Slowlyo\SlowAdmin\Renderers\Wrapper;
use Slowlyo\SlowAdmin\Renderers\Service;
use Illuminate\Support\Facades\Validator;
use Slowlyo\SlowAdmin\Renderers\Form\Form;
use Slowlyo\SlowAdmin\Renderers\Form\Hidden;
use Slowlyo\SlowAdmin\Renderers\Form\Checkbox;
use Symfony\Component\HttpFoundation\Response;
use Slowlyo\SlowAdmin\Renderers\Form\InputText;
use Slowlyo\SlowAdmin\Renderers\Form\InputImage;
use Slowlyo\SlowAdmin\Services\AdminUserService;
use Illuminate\Contracts\Foundation\Application;
use Slowlyo\SlowAdmin\Renderers\Form\InputPassword;

class AuthController extends AdminController
{
    protected string $serviceName = AdminUserService::class;

    /**
     * 登录页面
     *
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $remember = '';
        if (config('admin.auth.remember')) {
            $remember = Checkbox::make()->name('remember')->label(" ")->option('记住我');
        }
        $form = Form::make()
            ->title('')
            ->api(url(config('admin.route.prefix') . '/login'))
            ->redirect('/' . config('admin.route.prefix'))
            ->actions([
                Wrapper::make()->size('none')->className('pt-3')->body(
                    Button::make()
                        ->actionType('submit')
                        ->label('登 录')
                        ->level('primary')
                        ->className('w-24')
                ),
            ])
            ->body([
                InputText::make()->name('username')->label('用户名')->required(true),
                InputPassword::make()->name('password')->label('密码')->required(true),
                $this->captcha(),
                $remember,
            ]);

        if (config('admin.auth.captcha')) {
            $form = $form->onEvent([
                'submitFail' => [
                    'actions' => [
                        [
                            'actionType'  => 'reload',
                            'componentId' => 'captcha-service',
                        ],
                    ],
                ],
            ]);
        }

        $wrapper = Wrapper::make()
            ->className('w-full flex justify-center h-screen items-center bg-default')
            ->size('none')
            ->body(
                Wrapper::make()->size('none')->className('w-96 pb-60')->body([
                    Wrapper::make()
                        ->className('w-full flex justify-center p-5 text-2xl')
                        ->size('none')
                        ->body(config('admin.name')),
                    Card::make()->body($form),
                ])
            );

        $page = Page::make()
            ->css([
                '.amis-scope .cxd-Page-body'    => ['padding' => 0],
                '.amis-scope .cxd-Panel'        => ['border' => 0, 'margin-bottom' => 0],
                '.amis-scope .cxd-Panel-footer' => ['border' => 0],
                '.amis-scope .cxd-Image--thumb' => [
                    'padding'     => 0,
                    'width'       => '6.7rem',
                    'height'      => '2rem',
                    'padding-top' => '8px',
                ],
                '.amis-scope .cxd-Image-thumb'  => ['padding' => 0, 'width' => '6.5rem', 'height' => '2rem'],
                '.amis-scope .cxd-Image'        => ['border' => 'none'],
                '.amis-scope .cxd-Image-image'  => ['border-radius' => 'var(--borderRadius)'],
                '.amis-scope .cxd-Page-content' => ['padding' => 0],
            ])
            ->className('flex justify-center')
            ->body($wrapper)
            ->toJson();

        return SlowAdmin::make()->setVariable('page', $page)->render('slow-admin::login');
    }

    /**
     * 验证码
     *
     * @return mixed
     */
    protected function captcha()
    {
        if (!config('admin.auth.captcha')) {
            return '';
        }
        return Service::make()->initFetch(true)
            ->id('captcha-service')
            ->name('captcha-service')
            ->api(admin_url('login/reload-captcha'))
            ->data([
                'sys_captcha' => '',
                'captcha_img' => '',
            ])->body(
                Flex::make()->justify('space-between')->alignItems('center')->items([
                    Hidden::make()->name('sys_captcha')->value('${sys_captcha}'),
                    InputText::make()->name('captcha')->label('验证码')->required(true)->size('sm'),
                    Image::make()->src('${captcha_img}')->className('cursor-pointer')->clickAction([
                        'actionType' => 'reload',
                        'target'     => 'captcha-service',
                    ]),
                ])
            );
    }

    public function reloadCaptcha()
    {
        $captcha = new Captcha();

        $captcha_img = $captcha->showImg();
        $sys_captcha = admin_encode($captcha->getCaptcha());

        return $this->response()->success(compact('captcha_img', 'sys_captcha'));
    }

    public function login(Request $request)
    {
        if (strtolower(admin_decode($request->sys_captcha)) != strtolower($request->captcha) && config('admin.auth.captcha')) {
            return $this->response()->fail('验证码有误');
        }

        try {
            $validator = Validator::make($request->all(), [
                $this->username() => 'required',
                'password'        => 'required',
            ], [
                $this->username() . '.required' => '请填写用户名',
                'password.required'             => '请填写密码',
            ]);

            if ($validator->fails()) {
                abort(Response::HTTP_BAD_REQUEST, $validator->errors()->first());
            }

            $credentials = $request->only([$this->username(), 'password']);
            $remember    = $request->get('remember', false);

            if ($this->guard()->attempt($credentials, $remember)) {
                $request->session()->regenerate();

                return $this->response()->successMessage("登录成功");
            }

            abort(Response::HTTP_BAD_REQUEST, "用户名或密码错误");
        } catch (\Exception $e) {
            return $this->response()->fail($e->getMessage());
        }
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->response()->successMessage('');
    }

    protected function username(): string
    {
        return 'username';
    }

    protected function guard(): \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
    {
        return SlowAdmin::guard();
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
            ->title('')
            ->panelClassName('px-64')
            ->mode('horizontal')
            ->data($user)
            ->api('put:' . $this->adminPrefix . '/user_setting' . '/' . $user->id)
            ->body([
                InputImage::make()->label('头像')->name('avatar')->receiver($this->uploadImagePath()),
                InputText::make()->label('名称')->name('name')->required(true),
                InputPassword::make()->label('原密码')->name('old_password'),
                InputPassword::make()->label('密码')->name('password'),
                InputPassword::make()
                    ->label('确认密码')
                    ->name('confirm_password'),
            ]);

        $page = Page::make()->title('个人设置')->body($form);

        return $this->response()->success($page);
    }

    public function saveUserSetting($id): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $result = $this->service->updateUserSetting($id,
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

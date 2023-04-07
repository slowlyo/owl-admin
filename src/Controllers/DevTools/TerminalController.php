<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\Libs\Composer;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Artisan;
use Slowlyo\OwlAdmin\Controllers\AdminController;

class TerminalController extends AdminController
{
    public function index()
    {
        return $this->response()->success($this->page());
    }

    public function page()
    {
        return amisMake()->Card()->body(
            amisMake()
                ->Form()
                ->id('terminal_form')
                ->api(admin_url('dev_tools/terminal/preload'))
                ->wrapWithPanel(false)
                ->body([
                    amisMake()->GroupControl()->body([
                        amisMake()->ButtonGroupControl()->name('type')->options([
                            ['label' => 'artisan', 'value' => 'artisan'],
                            ['label' => 'composer', 'value' => 'composer'],
                        ])->value('artisan'),

                        amisMake()
                            ->VanillaAction()
                            ->className('float-right')
                            ->actionType('submit')
                            ->label('执行')
                            ->level('primary'),
                    ]),

                    amisMake()->GroupControl()->direction('vertical')->body([
                        amisMake()
                            ->NestedSelectControl()
                            ->name('command')
                            ->label('命令')
                            ->options($this->artisanOptions())
                            ->onlyLeaf(true)
                            ->hideNodePathLabel(true)
                            ->set('searchable', true)
                            ->size('md')
                            ->required(true),
                        amisMake()
                            ->Service()
                            ->schemaApi(admin_url('dev_tools/terminal/artisan_schema?command=${command}')),
                    ])->visibleOn('${type == "artisan"}'),

                    amisMake()->GroupControl()->direction('vertical')->body([
                        amisMake()->ButtonGroupControl()->name('action_type')->options([
                            ['label' => '安装', 'value' => 'require'],
                            ['label' => '卸载', 'value' => 'remove'],
                        ])->value('require'),
                        amisMake()
                            ->TextControl()
                            ->name('package')
                            ->label('包名')
                            ->size('md')
                            ->required(true)
                            ->visibleOn('${action_type == "require"}')
                            ->validateOnChange(true)
                            ->validations([
                                'matchRegexp' => '^[\w\-_]+\/[\w\-_]+$',
                            ])->validationErrors([
                                'matchRegexp' => '包名格式不正确',
                            ]),
                        amisMake()
                            ->TextControl()
                            ->name('version')
                            ->label('版本')
                            ->size('md')
                            ->visibleOn('${action_type == "require"}'),
                        amisMake()
                            ->SelectControl()
                            ->name('package')
                            ->label('包名')
                            ->size('md')
                            ->selectMode('group')
                            ->required(true)
                            ->source(admin_url('dev_tools/terminal/composer_options'))
                            ->searchable(true)
                            ->visibleOn('${action_type != "require"}'),
                    ])->visibleOn('${type == "composer"}'),

                    amisMake()
                        ->Dialog()
                        ->id('terminal_dialog')
                        ->title('')
                        ->visibleOn('${uuid}')
                        ->size('lg')
                        ->body([
                            amisMake()
                                ->Alert()
                                ->level('warning')
                                ->title('注意')
                                ->showIcon(true)
                                ->showCloseButton(true)
                                ->body('此功能无法保证命令一定执行成功，如需保证命令执行成功，请使用命令行工具！<br> 输出有时可能会很慢, 让子弹飞一会儿~   (如果太久没有输出, 可能是命令执行失败了, 请自行检查命令是否被执行)'),
                            amisMake()->Log()->className('mt-3')->height(600)->source([
                                'url'        => url(admin_url('dev_tools/terminal/exec?uuid=${uuid}', true)),
                                'expression' => '${uuid}',
                                'method'     => 'post',
                                'headers'    => ['Authorization' => 'Bearer ' . request()->bearerToken(),],
                                'data'       => ['uuid' => '${uuid}',],
                            ]),
                        ])
                        ->showCloseButton(false)
                        ->actions([
                            amisMake()
                                ->VanillaAction()
                                ->label('刷新页面')
                                ->level('success')
                                ->confirmText('刷新页面后将无法查看日志！')
                                ->onEvent(['click' => ['actions' => [['actionType' => 'refresh']]]]),
                            amisMake()
                                ->VanillaAction()
                                ->label('关闭')
                                ->level('primary')
                                ->confirmText('请自行确认命令是否执行完毕，关闭后将无法查看日志！')
                                ->onEvent([
                                    'click' => [
                                        'actions' => [
                                            [
                                                'actionType'  => 'setValue',
                                                'componentId' => 'terminal_form',
                                                'args'        => ['value' => ['uuid' => '']],
                                            ],
                                            [
                                                'actionType'  => 'setValue',
                                                'componentId' => 'terminal_dialog',
                                                'args'        => ['value' => ['uuid' => '']],
                                            ],
                                            [
                                                'actionType'  => 'reset',
                                                'componentId' => 'terminal_form',
                                            ],
                                        ],
                                    ],
                                ]),
                        ]),
                ]),
        );
    }

    public function preload(Request $request)
    {
        $type  = $request->input('type');
        $alias = config('admin.dev_tools.terminal.' . ($type == 'artisan' ? 'php' : 'composer') . '_alias');

        if ($type == 'artisan') {
            $info    = $this->artisanInfo($request->input('command'));
            $command = sprintf('%s artisan %s', $alias, $request->input('command'));

            if ($arguments = $request->input('arguments')) {
                foreach ($arguments as $key => $item) {
                    if ($item && in_array($key, array_keys($info['arguments']))) {
                        $command .= ' ' . $item;
                    }
                }
            }

            if ($options = $request->input('options')) {
                foreach ($options as $key => $item) {
                    if ($item && in_array($key, array_keys($info['options']))) {
                        $command .= ' --' . $key;
                        if (!is_bool($info['options'][$key]['default'])) {
                            $command .= '=' . $item;
                        }
                    }
                }
            }
        }

        if ($type == 'composer') {
            $actionType = $request->input('action_type');
            $command    = sprintf('%s %s %s', $alias, $actionType, $request->input('package'));

            if ($version = $request->input('version')) {
                $command .= ':' . $version;
            }
        }

        $uuid = Str::uuid()->toString();

        Cache::set($uuid, $command, 30);

        return $this->response()->success(compact('uuid'));
    }

    public function exec(Request $request)
    {
        $uuid = $request->input('uuid');

        if (!$uuid) {
            echo '';
            exit;
        }

        $command = Cache::get($uuid);

        if (!$command) {
            echo 'command not found';
            exit;
        }

        $command = sprintf('cd %s && %s', base_path(), $command);

        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        return response()->stream(function () use ($command) {
            $process = Process::fromShellCommandline($command, null, null, null, 3600);

            echo 'executing command: ' . $command . PHP_EOL;

            $process->run(function ($type, $buffer) {
                echo self::outputFilter($buffer) . PHP_EOL;
                ob_flush();
                flush();
            });
        }, 200, [
            'Content-Type'      => 'text/event-stream',
            'Cache-Control'     => 'no-cache',
            'Connection'        => 'keep-alive',
            'X-Accel-Buffering' => 'no',
        ]);

    }

    public static function outputFilter($str)
    {
        $str  = trim($str);
        $preg = '/\[(.*?)m/i';
        $str  = preg_replace($preg, '', $str);
        return mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
    }

    public function artisanOptions()
    {
        /** @var \Illuminate\Console\Application[] $list */
        $list = Artisan::all();

        $options = [];
        foreach ($list as $item) {
            $name  = $item->getName();
            $_item = ['label' => $name, 'value' => $name];

            if (Str::contains($name, ':')) {
                $name = explode(':', $name);
                $name = array_shift($name);

                if (!isset($options[$name])) {
                    $options[$name] = ['label' => $name, 'children' => []];
                }

                $options[$name]['children'][] = $_item;
                continue;
            }

            $options[] = $_item;
        }

        return array_values($options);
    }

    public function artisanInfo($command)
    {
        /** @var \Illuminate\Console\Application[] $list */
        $list = Artisan::all();

        $parse = function ($item) {
            $options   = $item->getDefinition()->getOptions();
            $arguments = $item->getDefinition()->getArguments();

            $options = array_map(function ($item) {
                return [
                    'name'        => $item->getName(),
                    'mode'        => $item->isValueRequired() ? 'required' : 'optional',
                    'default'     => $item->getDefault(),
                    'description' => $item->getDescription(),
                ];
            }, $options);

            $arguments = array_map(function ($item) {
                return [
                    'name'        => $item->getName(),
                    'mode'        => $item->isRequired() ? 'required' : 'optional',
                    'default'     => $item->getDefault(),
                    'description' => $item->getDescription(),
                ];
            }, $arguments);

            return [
                'name'        => $item->getName(),
                'description' => $item->getDescription(),
                'usage'       => $item->getDefinition()->getSynopsis(),
                'help'        => $item->getHelp(),
                'options'     => $options,
                'arguments'   => $arguments,
            ];
        };

        return $parse($list[$command]);
    }

    public function artisanSchema()
    {
        $command = request()->input('command');

        if (!$command) {
            return $this->response()->success();
        }

        $command = $this->artisanInfo($command);

        $inputs = function ($arr) {
            $_option = [];
            foreach ($arr as $item) {
                $_option[] = amisMake()
                    ->TextControl()
                    ->name($item['name'])
                    ->label($item['name'])
                    ->required($item['mode'] == 'required')
                    ->size('lg')
                    ->value(strval(is_array($item['default']) ? null : $item['default']))
                    ->labelRemark($item['description']);
            }
            return $_option;
        };

        $combo = function ($name, $label) use ($inputs, $command) {
            return amisMake()
                ->ComboControl()
                ->multiLine(true)
                ->items($inputs($command[$name]))
                ->name($name)
                ->label($label)
                ->size('lg');
        };

        $options = '';
        if (count($command['options'])) {
            $options = $combo('options', '选项');
        }

        $arguments = '';
        if (count($command['arguments'])) {
            $arguments = $combo('arguments', '参数');
        }

        $schema = amisMake()->Card()->header([
            'title'    => $command['name'],
            'subTitle' => $command['description'],
        ])->body([
            amisMake()->TextControl()->label('用法')->value($command['usage'])->static(true),
            amisMake()->StaticExactControl()->type('static-tpl')->label('帮助')->tpl($command['help']),
            $options,
            $arguments,
        ]);

        return $this->response()->success($schema);
    }

    public function composerOptions()
    {
        $composer = Composer::parse(base_path('composer.json'));

        $options = [
            [
                'label'    => 'require',
                'children' => array_map(function ($item) {
                    return ['label' => $item, 'value' => $item];
                }, array_keys($composer->require)),
            ],
            [
                'label'    => 'require-dev',
                'children' => array_map(function ($item) {
                    return ['label' => $item, 'value' => $item];
                }, array_keys($composer->require_dev)),
            ],
        ];

        return $this->response()->success($options);
    }
}

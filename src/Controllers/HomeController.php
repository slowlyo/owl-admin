<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeController extends AdminController
{
    public function index(): JsonResponse|JsonResource
    {
        $page = $this->basePage()->css($this->css())->body([
            amis()->Grid()->columns([
                $this->frameworkInfo()->md(5),
                amis()->Flex()->items([
                    $this->pieChart(),
                    $this->cube(),
                ]),
            ]),
            amis()->Grid()->columns([
                $this->lineChart()->md(8),
                amis()->Flex()->className('h-full')->items([
                    $this->clock(),
                    $this->codeView(),
                ])->direction('column'),
            ]),
        ]);

        return $this->response()->success($page);
    }

    public function codeView()
    {
        return amis()->Panel()->className('h-full clear-card-mb rounded-md')->body([
            amis()->Markdown()->options(['html' => true, 'breaks' => true])->value(<<<MD
### __The beginning of everything__

```php
<?php

echo 'Hello World';
```
MD
            ),
        ]);
    }

    public function clock()
    {
        return amis()->Card()->className('h-full bg-blingbling')->header(['title' => 'Clock'])->body([
            amis()->Custom()
                ->name('clock')
                ->html('<div id="clock" class="text-4xl"></div><div id="clock-date" class="mt-5"></div>')
                ->onMount(<<<JS
const clock = document.getElementById('clock');
const tick = () => {
    clock.innerHTML = (new Date()).toLocaleTimeString();
    requestAnimationFrame(tick);
};
tick();

const clockDate = document.getElementById('clock-date');
clockDate.innerHTML = (new Date()).toLocaleDateString();
JS

                ),
        ]);
    }

    public function frameworkInfo()
    {
        $link = function ($label, $link) {
            return amis()->Action()
                ->level('link')
                ->className('text-lg font-semibold')
                ->label($label)
                ->blank(true)
                ->actionType('url')
                ->link($link);
        };

        return amis()->Card()->className('h-96')->body(
            amis()->Wrapper()->className('h-full')->body([
                amis()->Flex()
                    ->className('h-full')
                    ->direction('column')
                    ->justify('center')
                    ->alignItems('center')
                    ->items([
                        amis()->Image()->src(url(Admin::config('admin.logo'))),
                        amis()->Wrapper()->className('text-3xl mt-9 font-bold')->body(Admin::config('admin.name')),
                        amis()->Flex()->className('w-full mt-5')->justify('center')->items([
                            $link('GitHub', 'https://github.com/slowlyo/owl-admin'),
                            $link('Official website', 'https://owladmin.com'),
                            $link('Documentation', 'https://doc.owladmin.com'),
                            $link('Demo', 'http://demo.owladmin.com'),
                        ]),
                    ]),
            ])
        );
    }

    public function pieChart()
    {
        return amis()->Card()->className('h-96')->body(
            amis()->Chart()->height(350)->config([
                'backgroundColor' => '',
                'tooltip'         => ['trigger' => 'item'],
                'legend'          => ['bottom' => 0, 'left' => 'center'],
                'series'          => [
                    [
                        'name'              => 'Access From',
                        'type'              => 'pie',
                        'radius'            => ['40%', '70%'],
                        'avoidLabelOverlap' => false,
                        'itemStyle'         => ['borderRadius' => 10, 'borderColor' => '#fff', 'borderWidth' => 2],
                        'label'             => ['show' => false, 'position' => 'center'],
                        'emphasis'          => [
                            'label' => [
                                'show'       => true,
                                'fontSize'   => '40',
                                'fontWeight' => 'bold',
                            ],
                        ],
                        'labelLine'         => ['show' => false],
                        'data'              => [
                            ['value' => 1048, 'name' => 'Search Engine'],
                            ['value' => 735, 'name' => 'Direct'],
                            ['value' => 580, 'name' => 'Email'],
                            ['value' => 484, 'name' => 'Union Ads'],
                            ['value' => 300, 'name' => 'Video Ads'],
                        ],
                    ],
                ],
            ])
        );
    }

    public function lineChart()
    {
        $randArr = function () {
            $_arr = [];
            for ($i = 0; $i < 7; $i++) {
                $_arr[] = random_int(10, 200);
            }
            return $_arr;
        };

        $random1 = $randArr();
        $random2 = $randArr();

        $chart = amis()->Chart()->height(380)->className('h-96')->config([
            'backgroundColor' => '',
            'title'           => ['text' => 'Users Behavior'],
            'tooltip'         => ['trigger' => 'axis'],
            'xAxis'           => [
                'type'        => 'category',
                'boundaryGap' => false,
                'data'        => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            ],
            'yAxis'           => ['type' => 'value'],
            'grid'            => ['left' => '7%', 'right' => '3%', 'top' => 60, 'bottom' => 30,],
            'legend'          => ['data' => ['Visits', 'Bounce Rate']],
            'series'          => [
                [
                    'name'      => 'Visits',
                    'data'      => $random1,
                    'type'      => 'line',
                    'areaStyle' => [],
                    'smooth'    => true,
                    'symbol'    => 'none',
                ],
                [
                    'name'      => 'Bounce Rate',
                    'data'      => $random2,
                    'type'      => 'line',
                    'areaStyle' => [],
                    'smooth'    => true,
                    'symbol'    => 'none',
                ],
            ],
        ]);

        return amis()->Card()->className('clear-card-mb')->body($chart);
    }

    public function cube()
    {
        return amis()->Card()->className('h-96 ml-4 w-8/12')->body(
            amis()->Html()->html(<<<HTML
<style>
    .cube-box{ height: 300px; display: flex; align-items: center; justify-content: center; }
  .cube { width: 100px; height: 100px; position: relative; transform-style: preserve-3d; animation: rotate 10s linear infinite; }
  .cube:after {
    content: '';
    width: 100%;
    height: 100%;
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
    position: absolute;
    transform-origin: bottom;
    transform-style: preserve-3d;
    transform: rotateX(90deg) translateY(50px) translateZ(-50px);
    background-color: rgba(0, 0, 0, 0.1);
  }
  .cube div {
    background-color: rgba(64, 158, 255, 0.7);
    position: absolute;
    width: 100%;
    height: 100%;
    border: 1px solid rgb(27, 99, 170);
    box-shadow: 0 0 60px rgba(64, 158, 255, 0.7);
  }
  .cube div:nth-child(1) { transform: translateZ(-50px); animation: shade 10s -5s linear infinite; }
  .cube div:nth-child(2) { transform: translateZ(50px) rotateY(180deg); animation: shade 10s linear infinite; }
  .cube div:nth-child(3) { transform-origin: right; transform: translateZ(50px) rotateY(270deg); animation: shade 10s -2.5s linear infinite; }
  .cube div:nth-child(4) { transform-origin: left; transform: translateZ(50px) rotateY(90deg); animation: shade 10s -7.5s linear infinite; }
  .cube div:nth-child(5) { transform-origin: bottom; transform: translateZ(50px) rotateX(90deg); background-color: rgba(0, 0, 0, 0.7); }
  .cube div:nth-child(6) { transform-origin: top; transform: translateZ(50px) rotateX(270deg); }

  @keyframes rotate {
    0% { transform: rotateX(-15deg) rotateY(0deg); }
    100% { transform: rotateX(-15deg) rotateY(360deg); }
  }
  @keyframes shade { 50% { background-color: rgba(0, 0, 0, 0.7); } }
</style>
<div class="cube-box">
    <div class="cube">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
HTML

            )
        );
    }

    private function css(): array
    {
        return [
            '.clear-card-mb'                 => [
                'margin-bottom' => '0 !important',
            ],
            '.cxd-Image'                     => [
                'border' => '0',
            ],
            '.bg-blingbling'                 => [
                'color'             => '#fff',
                'background'        => 'linear-gradient(to bottom right, #2C3E50, #FD746C, #FF8235, #ffff1c, #92FE9D, #00C9FF, #a044ff, #e73827)',
                'background-repeat' => 'no-repeat',
                'background-size'   => '1000% 1000%',
                'animation'         => 'gradient 60s ease infinite',
            ],
            '@keyframes gradient'            => [
                '0%{background-position:0% 0%} 50%{background-position:100% 100%} 100%{background-position:0% 0%}',
            ],
            '.bg-blingbling .cxd-Card-title' => [
                'color' => '#fff',
            ],
        ];
    }
}

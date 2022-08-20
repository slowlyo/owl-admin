<?php

namespace Slowlyo\SlowAdmin\Controllers;

use GuzzleHttp\Client;
use Slowlyo\SlowAdmin\SlowAdmin;
use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Tpl;
use Slowlyo\SlowAdmin\Renderers\Card;
use Slowlyo\SlowAdmin\Renderers\Flex;
use Slowlyo\SlowAdmin\Renderers\Grid;
use Slowlyo\SlowAdmin\Renderers\Html;
use Slowlyo\SlowAdmin\Renderers\Chart;
use Slowlyo\SlowAdmin\Renderers\Image;
use Slowlyo\SlowAdmin\Renderers\Grid2d;
use Slowlyo\SlowAdmin\Renderers\Avatar;
use Slowlyo\SlowAdmin\Renderers\Action;
use Slowlyo\SlowAdmin\Renderers\Wrapper;
use Slowlyo\SlowAdmin\Renderers\Service;
use GuzzleHttp\Exception\GuzzleException;
use Slowlyo\SlowAdmin\Renderers\Component;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeController extends AdminController
{
    protected string $queryPath = 'home';

    protected string $pageTitle = '首页';

    public function index(): JsonResponse|JsonResource
    {
        $js = <<<JS
JS;

        // todo: 页面注入blade, 正则匹配出script标签的内容, 放到inited事件内, 再加上amis数据流

        $page = $this->basePage()->initApi('http://slow-admin.test/admin/base')->onEvent([
            'inited' => [
                'actions' => [
                    'actionType' => 'custom',
                    'script'     => <<<JS
let inner = document.getElementById('root')

let myJs = document.createElement('script')
myJs.innerText = ''

inner.appendChild(myJs)
JS
                    ,
                ],
            ],
        ])->css([
            '.clear-card-mb'         => [
                'margin-bottom' => '0 !important',
            ],
            '.amis-scope .cxd-Image' => [
                'border' => '0',
            ],
        ])->body([
            Grid2d::make()->gap(15)->grids([
                Grid2d::make()->gap(15)->grids([
                    $this->hitokoto()->x(1)->y(1)->w(8),
                    $this->userCount()->x(9)->y(1),
                    $this->userChart()->x(1)->y(2),
                ])->x(1)->y(1)->w(7),
                $this->frameworkInfo()->x(8)->y(1),
                Card::make()->body(
                    Html::make()->html(view('slow-admin::demo.demo-chart')->render())
                )->x(1)->y(3),
            ]),
        ]);

        return $this->response()->success($page);
    }

    /**
     * 一言
     *
     * @return Card
     */
    public function hitokoto()
    {
        $client = new Client();

        try {
            $result = $client->request('GET', 'http://v1.hitokoto.cn');
        } catch (GuzzleException $e) {
        }

        $data = [
            'hitokoto' => '海到无涯天作案，山登绝顶我为峰',
            'from'     => 'Slowlyo',
        ];

        if ($result->getStatusCode() == 200) {
            $data = json_decode($result->getBody()->getContents(), true);
        }

        return Card::make()->className('h-full')->body([
            Wrapper::make()->body('"' . $data['hitokoto'] . '"'),
            Wrapper::make()->size('none')->className('text-right')->body('—— ' . $data['from']),
        ]);
    }

    public function userCount()
    {
        return Card::make()->className('h-full')->body(
            Flex::make()->direction('column')->items([
                Wrapper::make()->size('none')->className('w-full text-left')->body('会员总数'),
                Wrapper::make()->size('none')->className('text-3xl pt-5')->body(12),
            ])
        );
    }

    public function userChart()
    {
        $randArr = function () {
            $_arr = [];
            for ($i = 0; $i < 7; $i++) {
                $_arr[] = random_int(10, 200);
            }
            return '[' . implode(',', $_arr) . ']';
        };

        $random1 = $randArr();
        $random2 = $randArr();

        $chart = Chart::make()->config("{
title:{ text: '会员增长情况', },
tooltip: { trigger: 'axis' },
xAxis: { type: 'category', boundaryGap: false, data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] },
yAxis: { type: 'value' },
grid:{ left: '7%', right:'3%', top: 60, bottom: 30, },
legend: { data: ['访问量','注册量'] },
series: [
    { name: '访问量', data: {$random1}, type: 'line', areaStyle: {}, smooth: true, symbol: 'none', },
    { name:'注册量', data: {$random2}, type: 'line', areaStyle: {}, smooth: true, symbol: 'none', },
]
}");

        return Card::make()->className('clear-card-mb')->body($chart);
    }

    public function frameworkInfo()
    {
        return Wrapper::make()->className('h-full')->body([
            Flex::make()->className('h-full')->direction('column')->justify('center')->items([
                Image::make()
                    ->className('animate__animated animate__pulse animate__infinite animate__slow')
                    ->src(url(config('admin.logo'))),
                Wrapper::make()->className('text-3xl mt-9')->body(config('admin.name')),
                Flex::make()->className('w-36 mt-5')->justify('space-around')->items([
                    Action::make()->level('link')->label('GitHub')->actionType('link')->link(''),
                    Action::make()->level('link')->label('文档')->actionType('link')->link(''),
                ]),
            ]),
        ]);
    }
}

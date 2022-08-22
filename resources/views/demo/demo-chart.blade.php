<div id="demo-chart" style="height:300px"></div>

<script>
    $(() => {
        setTimeout(() => {
            const echarts = amisRequire('echarts');

            let chartDom = document.getElementById('demo-chart')
            let myChart = echarts.init(chartDom)
            let option

            const data = []
            for (let i = 0; i < 5; ++i) {
                data.push(Math.round(Math.random() * 200))
            }
            option = {
                xAxis: {
                    max: 'dataMax'
                },
                yAxis: {
                    type: 'category',
                    data: ['A', 'B', 'C', 'D', 'E'],
                    inverse: true,
                    animationDuration: 300,
                    animationDurationUpdate: 300,
                    max: 4
                },
                series: [
                    {
                        realtimeSort: true,
                        name: 'X',
                        type: 'bar',
                        data: data,
                        barMaxWidth: 15,
                        label: {
                            show: true,
                            position: 'right',
                            valueAnimation: true
                        }
                    }
                ],
                grid:{ left: '5%', right:'5%', top: 30, bottom: 30, },
                animationDuration: 0,
                animationDurationUpdate: 3000,
                animationEasing: 'linear',
                animationEasingUpdate: 'linear'
            }

            function run() {
                for (let i = 0; i < data.length; ++i) {
                    if (Math.random() > 0.9) {
                        data[i] += Math.round(Math.random() * 2000)
                    } else {
                        data[i] += Math.round(Math.random() * 200)
                    }
                }
                myChart.setOption({
                    series: [
                        {
                            type: 'bar',
                            data
                        }
                    ]
                })
            }

            setTimeout(function () {
                run()
            }, 200)
            setInterval(function () {
                run()
            }, 3000)

            option && myChart.setOption(option)
        }, 300)
    })
</script>

<button onclick="getAlert()">Alert</button>
<div id="demo-chart" style="height:300px"></div>
<script>
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
            max: 2 // only the largest 3 bars will be displayed
        },
        series: [
            {
                realtimeSort: true,
                name: 'X',
                type: 'bar',
                data: data,
                label: {
                    show: true,
                    position: 'right',
                    valueAnimation: true
                }
            }
        ],
        legend: {
            show: true
        },
        animationDuration: 0,
        animationDurationUpdate: 3000,
        animationEasing: 'linear',
        animationEasingUpdate: 'linear'
    }

    function run() {
        console.log(123)
        for (var i = 0; i < data.length; ++i) {
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
</script>

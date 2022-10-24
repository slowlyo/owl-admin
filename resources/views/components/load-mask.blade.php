<style>
    #load-mask {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2022;
        background: var(--slow-bg);
    }
</style>

<div id="load-mask">
    <img src="{{ asset('vendor/admin/static/loading.svg') }}" alt="">
</div>

<script>
    document.onreadystatechange = () => {
        if (document.readyState === 'complete') {
            // 页面加载完毕, 移除遮罩, 延时半秒避免闪烁
            setTimeout(() => {
                document.getElementById('load-mask').remove()
            }, 500)
        }
    }
</script>

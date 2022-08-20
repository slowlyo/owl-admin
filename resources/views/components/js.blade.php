@foreach($js as $item)
    <script src="{{ asset($item) }}"></script>
@endforeach

@if(config('admin.debug'))
    <script>
        window.enableAMISDebug = true
    </script>
@endif

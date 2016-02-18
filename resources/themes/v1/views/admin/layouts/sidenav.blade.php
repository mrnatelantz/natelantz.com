<div class="col-sm-3 col-md-2 sidebar">
    @if(isset($modules))
        <ul class="nav nav-sidebar">
            @foreach($modules as $module)
                <li>
                    <a href="{{ route($module['route']) }}">
                        <i class="{{ $module['icon'] or 'glyphicon glyphicon-option-vertical' }}"></i>
                        {{ $module['name'] }}
                        {{-- <span class="sr-only">(current)</span> --}}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    {{--
    <ul class="nav nav-sidebar">
        <li><a href="">Nav item</a></li>
        <li><a href="">Nav item again</a></li>
        <li><a href="">One more nav</a></li>
        <li><a href="">Another nav item</a></li>
        <li><a href="">More navigation</a></li>
    </ul>
    --}}

</div>
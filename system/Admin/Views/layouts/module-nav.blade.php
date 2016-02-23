@if(isset($modules))
    <ul class="nav navbar-nav navbar-left">
        @foreach($modules as $module)
            @if(!empty($module['route']) && !empty($module['name']))
                <li>
                    <a href="{{ route($module['route']) }}">
                        {{ $module['name'] }}
                        {{-- <span class="sr-only">(current)</span> --}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
@endif
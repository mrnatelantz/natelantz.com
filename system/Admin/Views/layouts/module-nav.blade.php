<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
    <a class="mdl-navigation__link" href="{{ route('dashboard') }}">
        <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>
            Dashboard
    </a>
    @if(isset($modules))
        @foreach($modules as $module)
            @if(!empty($module['route']) && !empty($module['name']))
                <a class="mdl-navigation__link" href="{{ route($module['route']) }}">
                    <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">{{ $module['icon'] }}</i>
                        {{ $module['name'] }}
                </a>
            @endif
        @endforeach
    @endif
</nav>
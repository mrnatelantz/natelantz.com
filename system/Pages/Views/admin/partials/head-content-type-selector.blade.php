<?php $rand = rand(); ?>

@if(isset($contentTypes))

    <button id="content-type-select-{{ $rand }}" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect">
        <i class="material-icons">add</i>
    </button>

    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
        for="content-type-select-{{ $rand }}">
        @foreach($contentTypes as $type)
            @if(isset($type['name']))
                <li>
                    <a href="#"
                       class="content-type-select mdl-menu__item"
                       data-href="{{ route('pages.contentType', ['name' => 'head.'.$type['name']]) }}"
                       data-location="head">
                        {{ strtoupper($type['name']) }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
@endif

<?php unset($rand); ?>
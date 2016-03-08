<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="content-types-{{ $rand }}">
    <i class="material-icons">more_vert</i>
</button>

<ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="content-types-{{ $rand }}">
    <li class="mdl-menu__item move-content-type-btn" data-id="{{ $rand }}" data-direction="up">Move Up</li>
    <li class="mdl-menu__item move-content-type-btn" data-id="{{ $rand }}" data-direction="down">Move Down</li>
    <li class="mdl-menu__item remove-content-type-btn" data-id="{{ $rand }}">Remove</li>
</ul>
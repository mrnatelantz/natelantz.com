<?php $rand = rand(); ?>


<section class="mdl-cell mdl-cell--12-col" data-id="{{ $rand }}">
    <div class="mdl-card mdl-shadow--2dp">

        <form id="submit-form-{{ $rand }}" method="POST">
            {{ csrf_field() }}

            <div class="mdl-card__supporting-text mdl-grid">

                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input"
                           type="text"
                           id="menu_item_name-{{ $rand }}"
                           name="name"
                           value="{{ $menu_item->name or null }}"
                           placeholder="Menu Item Name"
                           require aria-required="true">
                    <label class="mdl-textfield__label" for="menu_item_name-{{ $rand }}">Menu Item Name</label>
                </div>

                <div class="mdl-textfield mdl-js-textfield">
                    <select name="type" id="type-{{ $rand }}" class="mdl-textfield__input">
                        <option value="internal" @if(isset($menu_item->type) && $menu_item->type == 'internal') selected @endif>Internal</option>
                        <option value="external" @if(isset($menu_item->type) && $menu_item->type == 'external') selected @endif>External</option>
                    </select>

                    <label class="mdl-textfield__label" for="type-{{ $rand }}">Type</label>
                </div>

                <div class="mdl-textfield mdl-js-textfield">
                    <select name="page_id" id="page-{{ $rand }}" class="mdl-textfield__input">
                        <option value="">Select Page</option>
                        @if(isset($pages))
                            @foreach($pages as $page)
                                <option value="{{ $page->id }}" @if(isset($menu_item->page_id) && $menu_item->page_id == $page->id) selected @endif>{{ $page->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="mdl-textfield mdl-js-textfield">
                    <input name="url" id="url-{{ $rand }}" class="mdl-textfield__input" placeholder="Url" value="{{ $menu_item->url or null }}">
                    <label class="mdl-textfield__label" for="url-{{ $rand }}">Url</label>
                </div>

                <div class="mdl-textfield mdl-js-textfield">
                    <select name="target" id="target-{{ $rand }}" class="mdl-textfield__input">
                        <option value="_self" @if(isset($menu_item->target) && $menu_item->target == '_self') selected @endif>Same Page</option>
                        <option value="_blank" @if(isset($menu_item->target) && $menu_item->target == '_blank') selected @endif>New Page</option>
                    </select>
                    <label class="mdl-textfield__label" for="target-{{ $rand }}">Target</label>
                </div>

            </div>
        </form>

        <div class="mdl-card__actions mdl-card--border">
            @if(!isset($menu_item))
                <button type="submit" class="mdl-button menu_item_form_button" data-id="{{ $rand }}" data-method="POST" data-action="{{ route('menu.store.menu_item', ['id' => $menu_id]) }}">Create</button>
            @else
                <button type="submit" class="mdl-button menu_item_form_button" data-id="{{ $rand }}" data-method="PUT" data-action="{{ route('menu.update.menu_item', ['id' => $menu_id, 'item_id' => $menu_item->id]) }}">Save</button>
            @endif

            @if(isset($menu_item))

                <form action="{{ route('menu.destroy.menu_item', ['id' => $menu_id, 'item_id' => $menu_item->id]) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="mdl-button">Remove</button>
                </form>

            @endif

        </div>

        <div class="mdl-card__menu">
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="card-controls-{{ $rand }}">
                <i class="material-icons">more_vert</i>
            </button>

            <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="card-controls-{{ $rand }}">
                <li class="mdl-menu__item move-content-type-btn" data-id="{{ $rand }}" data-direction="up">Move Up</li>
                <li class="mdl-menu__item move-content-type-btn" data-id="{{ $rand }}" data-direction="down">Move Down</li>
                <li class="mdl-menu__item remove-content-type-btn" data-id="{{ $rand }}">Remove</li>
            </ul>
        </div>

    </div>
</section>

<?php unset($rand); ?>
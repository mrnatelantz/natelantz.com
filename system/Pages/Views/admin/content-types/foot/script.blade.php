<?php $rand = rand(); ?>

<section class="mdl-grid mdl-shadow--2dp content-type group" data-orderby="" data-id="{{ $rand }}">
    <div class="mdl-card mdl-cell mdl-cell--12-col">
        <div class="mdl-card__supporting-text mdl-grid">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell-col-12">

                <input class="mdl-textfield__input content-type-field image-full-width-{{ $rand }}"
                       id="script-{{ $rand }}"
                       data-name="script"
                       data-contentType="script"
                       data-id="{{ $rand }}"
                       value="{{ $contentType['content']->script or null }}"
                       placeholder="//domain.com/assets/js/script.js">
                <label class="mdl-textfield__label" for="script-{{ $rand }}">Script</label>
            </div>

        </div>
        <div class="mdl-card__menu">
            @include('pages::admin.partials.content-type-controls')
        </div>
    </div>
</section>

<?php unset($rand); ?>
<?php $rand = rand(); ?>

<section class="mdl-grid mdl-shadow--2dp content-type group" data-orderby="" data-id="{{ $rand }}">
    <div class="mdl-card mdl-cell mdl-cell--12-col">
        <div class="mdl-card__supporting-text mdl-grid">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell-col-12">
                <input class="mdl-textfield__input content-type-field css-{{ $rand }}"
                       type="text"
                       id="css-{{ $rand }}"
                       data-name="css"
                       data-contentType="css"
                       data-id="{{ $rand }}"
                       placeholder="//domain.com/assets/css/app.css"
                       value="{{ $contentType['content']->css or null }}">
                <label class="mdl-textfield__label" for="css-{{ $rand }}">CSS</label>
            </div>

        </div>

        <div class="mdl-card__menu">
            @include('pages::admin.partials.content-type-controls')
        </div>
    </div>
</section>

<?php unset($rand); ?>
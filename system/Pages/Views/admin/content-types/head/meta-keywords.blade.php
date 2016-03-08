<?php $rand = rand(); ?>

<section class="mdl-grid mdl-shadow--2dp content-type group" data-orderby="" data-id="{{ $rand }}">
    <div class="mdl-card mdl-cell mdl-cell--12-col">
        <div class="mdl-card__supporting-text mdl-grid">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell-col-12">
                <input class="mdl-textfield__input content-type-field meta-keywords-{{ $rand }}"
                       type="text"
                       id="meta-keywords-{{ $rand }}"
                       data-name="metaKeywords"
                       data-contentType="metaKeywords"
                       data-id="{{ $rand }}"
                       placeholder="This page is about blah blah and more blah."
                       value="{{ $contentType['content']->metaKeywords or null }}">
                <label class="mdl-textfield__label" for="meta-keywords-{{ $rand }}">Meta Keywords</label>
            </div>

        </div>

        <div class="mdl-card__menu">
            @include('pages::admin.partials.content-type-controls')
        </div>
    </div>
</section>

<?php unset($rand); ?>
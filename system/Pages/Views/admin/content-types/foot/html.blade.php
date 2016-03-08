<?php $rand = rand(); ?>

<section class="mdl-grid mdl-shadow--2dp content-type group" data-orderby="" data-id="{{ $rand }}">
    <div class="mdl-card mdl-cell mdl-cell--12-col">
        <div class="mdl-card__supporting-text mdl-grid">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell-col-12">
                <textarea class="mdl-textfield__input content-type-field html-{{ $rand }}"
                          id="html-{{ $rand }}"
                          data-name="html"
                          rows="10"
                          data-contentType="html"
                          data-id="{{ $rand }}">
                        @if(isset($contentType))
                        {!! $contentType['content']->html or null !!}
                    @endif
                </textarea>
                <label class="mdl-textfield__label" for="html-{{ $rand }}">HTML</label>
            </div>

        </div>
        <div class="mdl-card__menu">
            @include('pages::admin.partials.content-type-controls')
        </div>
    </div>
</section>

<?php unset($rand); ?>
<?php $rand = rand(); ?>

<section class="mdl-grid mdl-shadow--2dp content-type group" data-orderby="" data-id="{{ $rand }}">
    <div class="mdl-card mdl-cell mdl-cell--12-col">
        <div class="mdl-card__supporting-text mdl-grid">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell-col-12">
                <input class="mdl-textfield__input content-type-field"
                       name="styles"
                       id="styles-{{ $rand }}"
                       data-contentType="wysiwyg"
                       data-id="{{ $rand }}"
                       data-name="styles"
                       placeholder="color: #000000;"
                       value="{{  $contentType['content']->styles or null }}">
                <label class="mdl-textfield__label" for="styles-{{ $rand }}">Inline Styles</label>
            </div>
        </div>

        <div class="mdl-card__supporting-text mdl-grid">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell-col-12">
                <textarea class="mdl-textfield__input content-type-field"
                            type="text"
                            rows= "3"
                            name="styles"
                            id="wysiwyg-{{ $rand }}"
                            data-contentType="wysiwyg"
                            data-id="{{ $rand }}"
                            data-name="wysiwyg">
                    @if(isset($contentType))
                        {!! $contentType['content']->wysiwyg or null !!}
                    @endif
                </textarea>
                <label class="mdl-textfield__label" for="wysiwyg-{{ $rand }}">WYSIWYG</label>
            </div>

        </div>

        <div class="mdl-card__menu">
            @include('pages::admin.partials.content-type-controls')
        </div>
    </div>

</section>


@if(isset($contentType) && $contentType['ajax'])
    <script data-id="{{ $rand }}">
        jQuery(".wysiwyg-{{ $rand }}").summernote({
            height: 300,
            disableDragAndDrop: true,
            codemirror: {
                theme: 'monokai'
            }
        });
    </script>
@endif

<?php unset($rand); ?>

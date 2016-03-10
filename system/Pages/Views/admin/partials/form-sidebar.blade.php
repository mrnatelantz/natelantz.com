<div class="mdl-cell mdl-cell--2-col">
    <div class="submit-btns">
        @if(isset($page))
            <button class="submit-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                    data-action="{{ route('pages.update', ['id' => $page->page_id]) }}"
                    data-method="PUT">
                UPDATE
            </button>
            <button class="submit-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                    data-action="{{ route('pages.publish', ['id' => $page->page_id]) }}"
                    data-method="PUT">
                Publish
            </button>
        @else
            <button class="submit-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                    data-action="{{ route('pages.post') }}"
                    data-method="POST">
                Create
            </button>
        @endif
    </div>

    @if(isset($page))

        <a href="{{ route('pages.preview', ['id' => $page->page_id]) }}" target="_blank">Preview</a>

    @endif

    <div class="input-fields">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="text"
                   id="slug"
                   name="slug"
                   value="{{ $page->slug or null }}"
                   data-check-action="admin/pages/checkSlug"
                   required aria-required="true">
            <label class="mdl-textfield__label" for="slug">Slug</label>
            <span class="help-block hidden">Page with the same slug exists <a href=""></a> </span>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="text"
                   id="name"
                   name="name"
                   value="{{ $page->name or null }}"
                   required aria-required="true">
            <label class="mdl-textfield__label" for="name">Name</label>
        </div>
        {{--
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="text"
                   id="cover_image"
                   name="cover_image"
                   value="{{ $page->cover_image or null }}">
            <label class="mdl-textfield__label" for="cover_image">Cover Image</label>
        </div>
        --}}

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="template" class="mdl-textfield__input template" required aria-required="true">
                @if(isset($templates))
                    @foreach($templates as $template)
                        <option value="{{ $template }}" @if(isset($page->template) && $page->template == $template) selected  @endif>{{ ucfirst($template) }}</option>
                    @endforeach
                @endif
            </select>

            <label for="template" class="mdl-textfield__label">Template</label>
        </div>
        {{--
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="date"
                   id="publish_date"
                   name="publish_date"
                   value="{{ $page->publish_date or null }}">
            <label class="mdl-textfield__label" for="publish_date">Publish Date</label>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input"
                   type="date"
                   id="unpublish_date"
                   name="unpublish_date"
                   value="{{ $page->unpublish_date or null }}">
            <label class="mdl-textfield__label" for="unpublish_date">Un-Publish Date</label>
        </div>
        --}}
    </div>

    @if(isset($versions))
        <label>Versions</label>
        <ul class="demo-list-item mdl-list">
            @foreach($versions as $version)
                <li class="mdl-list__item">
                    <a href="{{  route('pages.showVersion', ['id' => $version->id]) }}"
                       target="_blank"
                       class="mdl-list__item-primary-content">
                        {{ $version->created_at }}
                    </a>
                </li>
            @endforeach
        </ul>

    @endif


    <div class="submit-btns">
        @if(isset($page))
            <br>
            <hr>
            @if($published)
                <button class="submit-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                        data-action="{{ route('pages.unPublish', ['id' => $page_id]) }}"
                        data-method="PUT">
                    Un-Publish
                </button>

            @endif
            <button class="submit-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                    data-action="{{ route('pages.delete', ['id' => $page_id]) }}"
                    data-method="DELETE">
                Delete
            </button>
        @endif
    </div>
</div>
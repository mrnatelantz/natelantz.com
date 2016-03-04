@extends('pages::admin.layouts.app')

@push('css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
    <meta name="page_id" content="{{ $page_id or 0 }}">
@endpush

@section('body')
    <div class="col-sm-10">
        <div class="clearfix"></div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="#head-content-types-panel" aria-controls="head-content-types-panel" role="tab" data-toggle="tab">Head</a></li>
            <li role="presentation" class="active"><a href="#body-content-types-panel" aria-controls="body-content-types-panel" role="tab" data-toggle="tab">Body</a></li>
            <li role="presentation"><a href="#foot-content-types-panel" aria-controls="foot-content-types-panel" role="tab" data-toggle="tab">Foot</a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="head-content-types-panel">
                @include('pages::admin.partials.head-content-types')
            </div>
            <div role="tabpanel" class="tab-pane active fade in" id="body-content-types-panel">
                @include('pages::admin.partials.body-content-types')
            </div>
            <div role="tabpanel" class="tab-pane fade" id="foot-content-types-panel">
                @include('pages::admin.partials.foot-content-types')
            </div>

        </div>

        <form action="" method="POST" id="submitForm" style="visibility: hidden;">
            {{ csrf_field() }}
        </form>

    </div>

    <div class="col-sm-2 well">
        <div class="form-group submit-btns">
            @if(isset($page))
                <button class="btn btn-default submit-button"
                        data-action="{{ route('pages.update', ['id' => $page->page_id]) }}"
                        data-method="PUT">
                    Update
                </button>
                <button class="btn btn-success submit-button"
                        data-action="{{ route('pages.publish', ['id' => $page->page_id]) }}"
                        data-method="PUT">
                    Publish
                </button>
            @else
                <button class="btn btn-primary submit-button"
                        data-action="{{ route('pages.post') }}"
                        data-method="POST">
                    Create
                </button>
            @endif
        </div>

        @if(isset($page))
            <div class="form-group">
                <a href="{{ route('pages.preview', ['id' => $page->page_id]) }}" target="_blank">Preview</a>
            </div>
        @endif
        <div class="input-fields">
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text"
                       id="slug"
                       name="slug"
                       class="form-control slug"
                       placeholder="Slug"
                       value="{{ $page->slug or null }}"
                       data-check-action="admin/pages/checkSlug"
                       required aria-required="true">
                <span class="help-block hidden">Page with the same slug exists <a href=""></a> </span>

            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                content       name="name"
                       id="name"
                       class="form-control name"
                       placeholder="Name"
                       value="{{ $page->name or null }}"
                required aria-required="true">
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="text"
                       name="cover_image"
                       id="cover_image"
                       class="form-control cover_image"
                       placeholder="Cover Image"
                       value="{{ $page->cover_image or null }}"
                       aria-required="false">
            </div>
            <div class="form-group">
                <label for="template">Template</label>
                @if(isset($templates))
                    <select name="template" class="form-control template" required aria-required="true">
                        @foreach($templates as $template)
                            <option value="{{ $template }}" @if(isset($page->template) && $page->template == $template) selected  @endif>{{ ucfirst($template) }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input type="date"
                       name="publish_date"
                       id="publish_date"
                       class="form-control">
            </div>
            <div class="form-group">
                <label for="unpublish_date">Un-Publish Date</label>
                <input type="date"
                       name="unpublish_date"
                       id="unpublish_date"
                       class="form-control">
            </div>
        </div>

        @if(isset($versions))
            <label>Versions</label>
            <ul>
                @foreach($versions as $version)
                    <li>
                        <a href="{{  route('pages.showVersion', ['id' => $version->id]) }}" target="_blank">{{ $version->created_at }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <br>
        <hr>

        <div class="form-group submit-btns">
            @if(isset($page))
                @if($published)
                    <button class="btn btn-warning submit-button"
                            data-action="{{ route('pages.unPublish', ['id' => $page_id]) }}"
                            data-method="PUT">
                        Un-Publish
                    </button>
                @endif
                <button class="btn btn-danger submit-button"
                        data-action="{{ route('pages.delete', ['id' => $page_id]) }}"
                        data-method="DELETE">
                    Delete
                </button>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    <script>
        {{-- This is getting dirty --}}
        {{-- @todo move this into a js file --}}
        $(document).ready(function() {

            $.each($('.wysiwyg'), function() {
                var ele = $(this).attr('data-id');
                $('.wysiwyg-' + ele).summernote({
                    height: 300,
                    disableDragAndDrop: true,
                    codemirror: {
                        theme: 'monokai'
                    }
                });
            });

            $('#slug').on('keyup', function(event){
                var slug = $(this).val();
                var url = $(this).attr('data-check-action');
                var pageId = $('meta[name="page_id"]').attr('content');
                var field = $(this);

                $.get( "/" + url + '/' + pageId + '/' + slug )
                        .done(function( data ) {
                            if(data.status) {
                                $(field).closest('.form-group').addClass('has-error');
                                $(field).attr('data-error', true);
                                var helpBlock = $(field).closest('.form-group').find('.help-block');
                                $(helpBlock).find('a').attr('href', '/admin/pages/' + data.page.id);
                                $(helpBlock).find('a').text(data.page.name);
                                $(helpBlock).removeClass('hidden');

                            }
                            else {
                                $(field).closest('.form-group').removeClass('has-error');
                                $(field).attr('data-error', false);
                                var helpBlock = $(field).closest('.form-group').find('.help-block');
                                $(helpBlock).addClass('hidden');
                                $(helpBlock).find('a').attr('href', '');
                                $(helpBlock).find('a').text('');
                            }
                        });
            });

            $('.submit-button').on('click', function(event) {

                if($('input[data-error="true"]').length > 0) {
                    event.preventDefault();
                    return null;
                }

                if($('#submitForm').attr('action') == "") {
                    $('#submitForm').attr('action', $(this).attr('data-action'));
                }

                // get the regular form fields, non dynamic content type
                $.each($('.input-fields input'), function() {
                    var input = '<input type="hidden" name="' + $(this).attr('name') + '" value="' + $(this).val() + '">';
                    $('form#submitForm').append(input);
                });

                getInputFields('head');
                getInputFields('body');
                getInputFields('foot');

                // set the http method spoofing
                var methodType = $(this).attr('data-method');
                var methodInput = '<input type="hidden" name="_method" value="' + methodType + '">';
                $('#submitForm').append($(methodInput));

                //event.preventDefault();
                $('#submitForm').submit();


                function getInputFields(location) {

                    var locationSelector = '.' + location + '-content-types';

                    // hack to assign the order of content types
                    $.each($(locationSelector + ' .content-type'), function(key, ele){
                       $(ele).attr('data-orderby', key);
                    });


                    $.each($(locationSelector + ' .content-type-field'), function() {

                        var contentType = $(this).attr('data-contentType');
                        var inputValue = '';
                        var inputName = $(this).attr('data-name');

                        if($(this).hasClass('wysiwyg')) {
                            inputValue = $(this).summernote('code');
                        }
                        else {
                            inputValue = $(this).val();
                        }

                        // do not save content type if no value
                        if(inputValue.length > 0) {
                            var contentCount = $(this).closest('.content-type').attr('data-orderby');
                            var content = '<input type="hidden" ' +
                                    'name="' + location + '[' + contentCount + ']['+ contentType +']['+ inputName +']" ' +
                                    'value="' + inputValue + '" ' +
                                    'class="contentType" ' +
                                    'data-location="' + location + '">';
                            $('form#submitForm').append(content);
                        }


                    });

                }
            });

            $('.content-type-select').on('click', function(event) {
                var url = $(this).attr('data-href');
                var location = $(this).attr('data-location');
                $.get(url, function( data ) {
                    var cssSelector = '.' + location + '-content-types';
                    $(cssSelector).append($(data.html));
                });
                event.preventDefault();
            });

            $('.content-types').on('click', '.remove-content-type-btn', function(event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                var location = $(this).closest('.content-types').attr('data-location');
                var removeElements = $('.' + location + '-content-types').find('[data-id="'+ id +'"]');
                $(removeElements).remove();
            });

            // move content type up or down
            $('.content-types').on('click', '.move-content-type-btn', function(event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                var direction = $(this).attr('data-direction');
                var location = $(this).closest('.content-types').attr('data-location');

                if(direction == 'up') {
                    var element = $('div.content-type.group[data-id="' + id + '"]');
                    var prependElement = $(element).prev($('div.content-type.group'));
                    $(element).insertBefore(prependElement);

                    // ghetto, needs to be a css class
                    $(this).addClass('btn-success');
                    setTimeout(function(){
                        $(element).find('.move-content-type-btn').removeClass('btn-success');
                    }, 200);

                }
                else if(direction == 'down') {
                    var element = $('div.content-type.group[data-id="' + id + '"]');
                    var afterElement = $(element).next($('div.content-type.group'));
                    $(element).insertAfter($(afterElement));

                    // ghetto, needs to be a css class
                    $(this).addClass('btn-success');
                    setTimeout(function(){
                        $(element).find('.move-content-type-btn').removeClass('btn-success');
                    }, 200);
                }

            });
        });
    </script>
@endpush

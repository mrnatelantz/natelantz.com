@extends('pages::admin.layouts.app')

@push('css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
@endpush

@section('body')
    <div class="col-sm-10">
        <div class="input-fields">
            <div class="form-group">
                <input type="text"
                       name="slug"
                       class="form-control slug"
                       placeholder="Slug"
                       value="{{ $page->slug or null }}">
            </div>
            <div class="form-group">
                <input type="text"
                       name="name"
                       class="form-control name"
                       placeholder="Name"
                       value="{{ $page->name or null }}">
            </div>

        </div>
        <hr />

        @include('pages::admin.partials.content-type-selector')

        <div class="clearfix"></div>
        <div class="content-types">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @if(isset($page) && isset($page->content))
                    @foreach($page->content as $contentTypes)
                        @foreach($contentTypes as $type => $content)
                            <?php $orderCount = 0; ?>
                            @if(View::exists('admin.content-types.'.$type))
                                <?php $contentType = [
                                        'content' => $content,
                                        'orderByCount' => $orderCount++,
                                        'ajax' => false
                                ]; ?>
                                    @include('admin.content-types.'.$type, ['contentType' => $contentType])
                            @elseif(View::exists('pages::admin.content-types.'.$type))
                                <?php $contentType = [
                                        'content' => $content,
                                        'orderByCount' => $orderCount++,
                                        'ajax' => false
                                ]; ?>
                                @include('pages::admin.content-types.'.$type, ['contentType' => $contentType])
                            @endif
                        @endforeach
                    @endforeach
                @else
                    @if(View::exists('admin.content-types.wysiwyg'))
                        <?php $contentType = [
                                'content' => '',
                                'orderByCount' => 0,
                                'ajax' => false
                        ]; ?>
                        @include('admin.content-types.wysiwyg', ['contentType' => $contentType])
                    @elseif(View::exists('pages::admin.content-types.wysiwyg'))
                        <?php $contentType = [
                                'content' => '',
                                'orderByCount' => 0,
                                'ajax' => false
                        ]; ?>
                        @include('pages::admin.content-types.wysiwyg', ['contentType' => $contentType])
                    @endif
                @endif
            </div>
        </div>

        @if(isset($page))
            <form action="" method="POST" id="submitForm" style="visibility: hidden;">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
            </form>
        @else
            <form action="{{ route('pages.post') }}" method="POST" id="submitForm" style="visibility: hidden;">
                {{ csrf_field() }}
            </form>
        @endif
    </div>

    <div class="col-sm-2 well">
        <div class="form-group submit-btns">
            @if(isset($page))
                <button class="btn btn-default submit-button" data-action="{{ route('pages.update', ['id' => $page->page_id]) }}">Update</button>
                <button class="btn btn-success submit-button" data-action="{{ route('pages.publish', ['id' => $page->page_id]) }}">Publish</button>
            @else
                <button class="btn btn-primary submit-button" data-action="{{ route('pages.post') }}">Save</button>
            @endif
        </div>
        @if(isset($page))
            <div class="form-group">
                <a href="{{ route('pages.preview', ['id' => $page->page_id]) }}" target="_blank">Preview</a>
            </div>
        @endif
        <div class="input-fields">
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="text"
                       name="cover_image"
                       id="cover_image"
                       class="form-control cover_image"
                       placeholder="Cover Image"
                       value="{{ $page->cover_image or null }}">
            </div>
            <div class="form-group">
                <label for="template">Template</label>
                @if(isset($templates))
                    <select name="template" class="form-control template">
                        @foreach($templates as $template)
                            <option value="{{ $template }}" @if($page->template == $template) selected  @endif>{{ ucfirst($template) }}</option>
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
    </div>
@endsection

@push('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    <script>
        {{-- This is getting dirty --}}
        {{-- @todo move this into a js file --}}
        $(document).ready(function() {
            //$('.wysiwyg').summernote();
            $.each($('.wysiwyg'), function() {
                var ele = $(this).attr('data-id');
                $('.wysiwyg-' + ele).summernote();
            });

            $('.submit-button').on('click', function(event) {

                if($('#submitForm').attr('action') == "") {
                    $('#submitForm').attr('action', $(this).attr('data-action'));
                }
                // get all of the dynamic content type values
                $.each($('.content-type-field'), function() {
                    var contentCount = $('input.contentType[type="hidden"]').length;
                    var contentType = $(this).attr('data-contentType');
                    var inputValue = '';
                    if(contentType == 'wysiwyg') {
                        inputValue = $(this).summernote('code');
                    }
                    else {
                        inputValue = $(this).val();
                    }
                    var content = '<input type="hidden" name="content[' + contentCount + ']['+ contentType +']" value="' + inputValue + '" class="contentType">';
                    $('form#submitForm').append(content);
                });

                // get the regular form fields, non dynamic content type
                $.each($('.input-fields input'), function() {
                    var input = '<input type="hidden" name="' + $(this).attr('name') + '" value="' + $(this).val() + '">';
                    $('form#submitForm').append(input);
                });
                $('#submitForm').submit();
                //event.preventDefault();
            });

            $('.content-type-select').on('click', function(event) {
                var url = $(this).attr('data-href');
                $.get(url, function( data ) {
                    $('.content-types').append(data.html);
                });
                event.preventDefault();
            });

            $('.content-types').on('click', '.remove-content-type-btn', function(event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                var removeElements = $('.content-types').find('[data-id="'+ id +'"]');
                $(removeElements).remove();
            });

            // move content type up or down
            $('.content-types').on('click', '.move-content-type-btn', function(event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                var direction = $(this).attr('data-direction');
                if(direction == 'up') {
                    var element = $(this).closest('div.content-type.group');
                    var prependElement = $(element).prev($('div.content-type.group'));
                    $(element).insertBefore($(prependElement));

                    // ghetto, needs to be a css class
                    $(this).addClass('btn-success');
                    setTimeout(function(){
                        $(element).find('.move-content-type-btn').removeClass('btn-success');
                    }, 200);

                }
                else if(direction == 'down') {
                    var element = $(this).closest('div.content-type.group');
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

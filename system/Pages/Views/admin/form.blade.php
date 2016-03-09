@extends('pages::admin.layouts.app')

@push('css')
    <link rel="stylesheet" href="/dist/ui/trumbowyg.css">
    <meta name="page_id" content="{{ $page_id or 0 }}">
@endpush

@section('body')
    <div class="md-cell mdl-cell--10-col">
        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-tabs__tab-bar">
                <a href="#head-content-types-panel" class="mdl-tabs__tab">Head</a>
                <a href="#body-content-types-panel" class="mdl-tabs__tab is-active">Body</a>
                <a href="#foot-content-types-panel" class="mdl-tabs__tab">Foot</a>
            </div>

            <div class="mdl-tabs__panel" id="head-content-types-panel">
                @include('pages::admin.partials.head-content-types')
            </div>
            <div class="mdl-tabs__panel is-active" id="body-content-types-panel">
                @include('pages::admin.partials.body-content-types')
            </div>
            <div class="mdl-tabs__panel" id="foot-content-types-panel">
                @include('pages::admin.partials.foot-content-types')
            </div>
        </div>
    </div>

    @include('pages::admin.partials.form-sidebar')

    <form action="" method="POST" id="submitForm" style="visibility: hidden;">
        {{ csrf_field() }}
    </form>


@endsection

@push('scripts')
    <script src="/dist/trumbowyg.js"></script>

    <script>
        {{-- This is getting dirty --}}
        {{-- @todo move this into a js file --}}
        $(document).ready(function() {


            $.each($('.wysiwyg'), function() {

                var id = $(this).attr('data-id');
                $(this).trumbowyg({
                    fullscreenable: false,
                    //closable: true,
                    //btns: ['bold', 'italic', '|', 'insertImage']
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
                        var id = $(this).attr('data-id');

                        if($(this).hasClass('wysiwyg')) {
                            inputValue = $(this).trumbowyg('html');
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
                    //componentHandler.upgradeElement(components);
                    componentHandler.upgradeDom(); // needed for mdl components to register

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
                    var element = $('.content-type.group[data-id="' + id + '"]');
                    var prependElement = $(element).prev($('.content-type.group'));
                    $(element).insertBefore(prependElement);

                    // ghetto, needs to be a css class
                    $(this).addClass('btn-success');
                    setTimeout(function(){
                        $(element).find('.move-content-type-btn').removeClass('btn-success');
                    }, 200);

                }
                else if(direction == 'down') {
                    var element = $('.content-type.group[data-id="' + id + '"]');
                    var afterElement = $(element).next($('.content-type.group'));
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

<?php $time = rand(); ?>

@if(isset($contentType))
<div class="content-type group" data-orderby="{{ $contentType['orderByCount'] or null }}" data-id="{{ $time }}">
@else
<div class="content-type group" data-orderby="" data-id="{{ $time }}">
@endif
    <button class="btn btn-default move-content-type-btn" data-id="{{ $time }}" data-direction="down">
        <i class="glyphicon glyphicon-arrow-down"></i>
    </button>
    <button class="btn btn-default move-content-type-btn" data-id="{{ $time }}" data-direction="up">
        <i class="glyphicon glyphicon-arrow-up"></i>
    </button>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#{{ $time }}">
        WYSIWYG
    </button>
    <button class="btn btn-danger remove-content-type-btn" data-id="{{ $time }}">
        <i class="glyphicon glyphicon-remove"></i>
    </button>

    <div class="modal fade" id="{{ $time }}" tabindex="-1" role="dialog" aria-labelledby="{{ $time }}-Label">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="{{ $time }}-Label">Content Type: WYSIWYG</h4>
                </div>
                <div class="modal-body">
                    <div class="wysiwyg content-type-field wysiwyg-{{ $time }}" data-contentType="wysiwyg" data-id="{{ $time }}">
                        @if(isset($contentType))
                            {!! $contentType['content'] or null !!}
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <hr />
</div>


@if(isset($contentType) && $contentType['ajax'])
    <script data-id="{{ $time }}">
        jQuery(".wysiwyg-{{ $time }}").summernote();
    </script>
@endif
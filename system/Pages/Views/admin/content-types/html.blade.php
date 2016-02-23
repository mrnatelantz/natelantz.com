<?php $time = rand(); ?>

@if(isset($contentType))
    <div class="content-type group" data-orderby="{{ $contentType['orderByCount'] or null }}" data-id="{{ $time }}">
@else
    <div class="content-type group" data-orderby="" data-id="{{ $time }}">
        @endif
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#{{ $time }}">
            HTML
        </button>
        <button class="btn btn-danger remove-content-type-btn" data-id="{{ $time }}">
            <i class="glyphicon glyphicon-remove"></i>
        </button>
        <div class="modal fade" id="{{ $time }}" tabindex="-1" role="dialog" aria-labelledby="{{ $time }}-Label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="{{ $time }}-Label">Content Type: HTML</h4>
                    </div>
                    <div class="modal-body">
                        <textarea class="content-type-field html-{{ $time }} form-control" rows="10" data-contentType="html" data-id="{{ $time }}">
                            @if(isset($contentType))
                                {!! $contentType['content'] or null !!}
                            @endif
                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
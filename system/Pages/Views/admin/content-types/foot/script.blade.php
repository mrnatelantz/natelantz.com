<?php $rand = rand(); ?>

@if(isset($contentType))
    <div class="panel panel-default content-type group" data-orderby="{{ $contentType['orderByCount'] or null }}" data-id="{{ $rand }}">
        @else
            <div class="panel panel-default content-type group" data-orderby="" data-id="{{ $rand }}">
                @endif
                <div class="panel-heading" role="tab" id="headingOne-{{ $rand }}">
                    <h4 class="panel-title">
                        <div class="col-md-3">
                            <div class="btn-group" role="group">
                                <button class="btn btn-xs btn-default move-content-type-btn" data-id="{{ $rand }}" data-direction="down">
                                    <i class="glyphicon glyphicon-arrow-down"></i>
                                </button>
                                <button class="btn btn-xs btn-default move-content-type-btn" data-id="{{ $rand }}" data-direction="up">
                                    <i class="glyphicon glyphicon-arrow-up"></i>
                                </button>
                            </div>
                            <button class="btn btn-xs btn-danger remove-content-type-btn" data-id="{{ $rand }}">
                                <i class="glyphicon glyphicon-remove"></i>
                            </button>
                        </div>

                        <div class="col-md-3">
                            <a class="collapsed" aria-expanded="false" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-{{ $rand }}"  aria-controls="collapseOne-{{ $rand }}">
                                Script
                            </a>
                        </div>

                        <div class="clearfix"></div>
                    </h4>
                </div>

                <div id="collapseOne-{{ $rand }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne-{{ $rand }}">
                    <div class="panel-body">
                        <input class="content-type-field image-full-width-{{ $rand }} form-control"
                               data-contentType="script"
                               data-id="{{ $rand }}"
                               value="{{ $contentType['content'] or null }}"
                               placeholder="//domain.com/assets/js/script.js">
                    </div>
                </div>
            </div>

    <?php unset($rand); ?>
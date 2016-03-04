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
                                Meta Keywords
                            </a>
                        </div>

                    </h4>
                    <div class="clearfix"></div>
                </div>

                <div id="collapseOne-{{ $rand }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne-{{ $rand }}">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="meta-keywords-{{ $rand }}">Content</label>
                            <input type="text"
                                   id="meta-keywords-{{ $rand }}"
                                   data-name="content"
                                   data-contentType="meta-keywords"
                                   data-id="{{ $rand }}"
                                   class="form-control content-type-field meta-keywords-{{ $rand }}"
                                   placeholder="This page is about blah blah and more blah."
                                   @if(isset($contentType)) value="{{ $contentType['content']->content or null }} @endif">
                        </div>
                    </div>
                </div>
            </div>
    <?php unset($rand); ?>
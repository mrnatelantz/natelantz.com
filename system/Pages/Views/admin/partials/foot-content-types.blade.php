<div class="row">

    <div class="col-sm-12">
        @include('pages::admin.partials.foot-content-type-selector')
    </div>

    <div class="foot-content-types content-types col-md-12" data-location="foot">
        @if(isset($page) && isset($page->foot) && !is_null($page->foot))

            @foreach($page->foot as $contentTypes)
                @foreach($contentTypes as $type => $content)
                    <?php $orderCount = 0; ?>
                    @if(View::exists('admin.content-types.foot.'.$type))
                        <?php $contentType = [
                                'content' => $content,
                                'orderByCount' => $orderCount++,
                                'ajax' => false
                        ]; ?>
                        @include('admin.content-types.foot.'.$type, ['contentType' => $contentType])
                    @elseif(View::exists('pages::admin.content-types.foot.'.$type))
                        <?php $contentType = [
                                'content' => $content,
                                'orderByCount' => $orderCount++,
                                'ajax' => false
                        ]; ?>
                        @include('pages::admin.content-types.foot.'.$type, ['contentType' => $contentType])
                    @endif
                @endforeach
            @endforeach
        @endif
    </div>

</div>
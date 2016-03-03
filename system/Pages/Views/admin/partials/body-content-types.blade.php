<div class="row">

    <div class="body-content-types col-md-10">
        @if(isset($page) && isset($page->content) && !is_null($page->content))

            @foreach($page->content as $contentTypes)
                @foreach($contentTypes as $type => $content)
                    <?php $orderCount = 0; ?>
                    @if(View::exists('admin.content-types.body.'.$type))
                        <?php $contentType = [
                                'content' => $content,
                                'orderByCount' => $orderCount++,
                                'ajax' => false
                        ]; ?>
                        @include('admin.content-types.body.'.$type, ['contentType' => $contentType])
                    @elseif(View::exists('pages::admin.content-types.body.'.$type))
                        <?php $contentType = [
                                'content' => $content,
                                'orderByCount' => $orderCount++,
                                'ajax' => false
                        ]; ?>
                        @include('pages::admin.content-types.body.'.$type, ['contentType' => $contentType])
                    @endif
                @endforeach
            @endforeach
        @else
            @if(View::exists('admin.content-types.body.wysiwyg'))
                <?php $contentType = [
                        'content' => '',
                        'orderByCount' => 0,
                        'ajax' => false
                ]; ?>
                @include('admin.content-types.body.wysiwyg', ['contentType' => $contentType])
            @elseif(View::exists('pages::admin.content-types.body.wysiwyg'))
                <?php $contentType = [
                        'content' => '',
                        'orderByCount' => 0,
                        'ajax' => false
                ]; ?>
                @include('pages::admin.content-types.body.wysiwyg', ['contentType' => $contentType])
            @endif
        @endif
    </div>

    <div class="col-md-2">
        @include('pages::admin.partials.body-content-type-selector')
    </div>
</div>
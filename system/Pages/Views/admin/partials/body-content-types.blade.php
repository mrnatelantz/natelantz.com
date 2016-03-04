<div class="row">
    <div class="col-sm-12">
        @include('pages::admin.partials.body-content-type-selector')
    </div>

    <div class="body-content-types content-types col-md-12" data-location="body">
        @if(isset($page) && isset($page->body) && !is_null($page->body))

            @foreach($page->body as $key => $contentTypes)
                @foreach($contentTypes as $type => $content)
                    <?php $orderCount = 0; ?>
                    @if(View::exists('admin.content-types.body.'.$type))

                        <?php $contentType = [
                                'content' => $content,
                                'ajax' => false
                        ]; ?>
                        @include('admin.content-types.body.'.$type, ['contentType' => $contentType])
                    @elseif(View::exists('pages::admin.content-types.body.'.$type))
                        <?php $contentType = [
                                'content' => $content,
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
                        'ajax' => false
                ]; ?>
                @include('admin.content-types.body.wysiwyg', ['contentType' => $contentType])
            @elseif(View::exists('pages::admin.content-types.body.wysiwyg'))
                <?php $contentType = [
                        'content' => '',
                        'ajax' => false
                ]; ?>
                @include('pages::admin.content-types.body.wysiwyg', ['contentType' => $contentType])
            @endif
        @endif
    </div>

</div>
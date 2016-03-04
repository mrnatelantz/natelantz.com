<div class="row">

    <div class="col-sm-12">
        @include('pages::admin.partials.head-content-type-selector')
    </div>

    <div class="head-content-types content-types col-md-12" data-location="head">
        @if(isset($page) && isset($page->head) && !is_null($page->head))
            @foreach($page->head as $contentTypes)
                @foreach($contentTypes as $type => $content)
                    <?php $orderCount = 0; ?>
                    @if(View::exists('admin.content-types.head.'.$type))
                        <?php $contentType = [
                                'content' => $content,
                                'orderByCount' => $orderCount++,
                                'ajax' => false
                        ]; ?>
                        @include('admin.content-types.head.'.$type, ['contentType' => $contentType])
                    @elseif(View::exists('pages::admin.content-types.head.'.$type))
                        <?php $contentType = [
                                'content' => $content,
                                'orderByCount' => $orderCount++,
                                'ajax' => false
                        ]; ?>
                        @include('pages::admin.content-types.head.'.$type, ['contentType' => $contentType])
                    @endif
                @endforeach
            @endforeach
        @else
            @if(View::exists('admin.content-types.head.meta-description'))
                <?php $contentType = [
                        'content' => '',
                        'orderByCount' => 0,
                        'ajax' => false
                ]; ?>
                @include('admin.content-types.head.meta-description', ['contentType' => $contentType])
            @elseif(View::exists('pages::admin.content-types.head.meta-description'))
                <?php $contentType = [
                        'content' => '',
                        'orderByCount' => 0,
                        'ajax' => false
                ]; ?>
                @include('pages::admin.content-types.head.meta-description', ['contentType' => $contentType])
            @endif

            @if(View::exists('admin.content-types.head.meta-keywords'))
                <?php $contentType = [
                        'content' => '',
                        'orderByCount' => 0,
                        'ajax' => false
                ]; ?>
                @include('admin.content-types.head.meta-keywords', ['contentType' => $contentType])
            @elseif(View::exists('pages::admin.content-types.head.meta-keywords'))
                <?php $contentType = [
                        'content' => '',
                        'orderByCount' => 0,
                        'ajax' => false
                ]; ?>
                @include('pages::admin.content-types.head.meta-keywords', ['contentType' => $contentType])
            @endif
        @endif
    </div>

</div>
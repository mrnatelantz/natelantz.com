<?php $rand = rand(); ?>

<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne-{{ $rand }}">
        <h4 class="panel-title">
            <div class="col-sm-6">
                <a class="collapsed" aria-expanded="false" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-{{ $rand }}"  aria-controls="collapseOne-{{ $rand }}">
                    {{ $menu_id }} &nbsp;-&nbsp; {{ $menu_item->name or  'New Menu Item' }}
                </a>
            </div>
            @if(isset($menu_item))
                <div class="col-sm-6">
                    <form action="{{ route('menu.destroy.menu_item', ['id' => $menu_id, 'item_id' => $menu_item->id]) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-xs btn-danger pull-right"><i class="glyphicon glyphicon-remove"></i></button>
                    </form>
                </div>
            @endif
            <div class="clearfix"></div>
        </h4>
    </div>

    <div id="collapseOne-{{ $rand }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne-{{ $rand }}">
        <div class="panel-body">
            @if(isset($menu_item))
                <form class="form-horizontal" method="post" action="{{ route('menu.update.menu_item', ['id' => $menu_id, 'item_id' => $menu_item->id]) }}">
                    <input type="hidden" name="_method" value="PUT">
            @else
                <form class="form-horizontal" method="post" action="{{ route('menu.store.menu_item', ['id' => $menu_id]) }}">
            @endif

                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-10">
                        <select name="type" class="form-control">
                            <option value="internal" @if(isset($menu_item->type) && $menu_item->type == 'internal') selected @endif>Internal</option>
                            <option value="external" @if(isset($menu_item->type) && $menu_item->type == 'external') selected @endif>External</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input name="name" class="form-control" placeholder="Menu Item Name" value="{{ $menu_item->name or null }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Page</label>
                    <div class="col-sm-10">
                        <select name="page_id" class="form-control">
                            <option value="">Select Page</option>
                            @if(isset($pages))
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}" @if(isset($menu_item->page_id) && $menu_item->page_id == $page->id) selected @endif>{{ $page->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Link</label>
                    <div class="col-sm-10">
                        <select name="target" class="form-control">
                            <option value="_self" @if(isset($menu_item->target) && $menu_item->target == '_self') selected @endif>Same Page</option>
                            <option value="_blank" @if(isset($menu_item->target) && $menu_item->target == '_blank') selected @endif>New Page</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Url</label>
                    <div class="col-sm-10">
                        <input name="url" class="form-control" placeholder="Url" value="{{ $menu_item->url or null }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2 pull-right">
                        @if(!isset($menu_item))
                            <button type="submit" class="btn btn-success pull-right">Create</button>
                        @else
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php unset($rand); ?>
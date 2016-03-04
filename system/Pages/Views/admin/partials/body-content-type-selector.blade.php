@if(isset($contentTypes))
    <div class="btn-group pull-right">
        <button type="button"
                class="btn btn-default dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                    <i class="glyphicon glyphicon-plus"></i>
        </button>
        <ul class="dropdown-menu">
            @foreach($contentTypes as $type)
                @if(isset($type['name']))
                    <li>
                        <a href="#"
                           class="content-type-select"
                           data-href="{{ route('pages.contentType', ['name' => 'body.'.$type['name']]) }}"
                           data-location="body">
                            {{ strtoupper($type['name']) }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
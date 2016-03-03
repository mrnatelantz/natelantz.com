@if(isset($contentTypes))
    <div class="btn-group pull-right">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Add Content Type <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            @foreach($contentTypes as $type)
                @if(isset($type['name']))
                    <li>
                        <a href="#"
                           class="content-type-select"
                           data-href="{{ route('pages.contentType', ['name' => 'foot.'.$type['name']]) }}"
                           data-location="foot">
                            {{ strtoupper($type['name']) }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
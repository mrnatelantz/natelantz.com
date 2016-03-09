@extends('media::admin.layouts.app')

@section('body')
    <div id="media" class="mdl-grid">
        <template v-for="item in media">
            <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp" style="background: url(@{{ item.src }}) center / cover;">
                <div class="mdl-card__title mdl-card--expand"></div>
                <div class="mdl-card__actions">
                    <span class="demo-card-image__filename">Image.jpg</span>
                </div>
                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="card-menu-@{{ $index }}">
                        <i class="material-icons">more_vert</i>
                    </button>

                    <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="card-menu-@{{ $index }}">
                        <li class="mdl-menu__item" data-id="@{{ $index }}">Edit</li>
                        <li class="mdl-menu__item" data-id="@{{ $index }}">Remove</li>
                    </ul>
                </div>
            </div>
        </template>
    </div>
@endsection


@push('scripts')
    <script src="//cdn.jsdelivr.net/vue/1.0.17/vue.min.js"></script>

    <script>
        new Vue({
            el: '#media',
            data: {
                media: [
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"},
                    {src: "http://placehold.it/300x300"}
                ]
                /*
                media: function(){
                    var data;
                    for(var i = 0; i < 10; i++) {
                        data[i] = {
                            name: i,
                            src: "http://placehold.it/300x300"
                        }
                    }
                    console.log(data);
                    return data;
                }
                */
            },
            methods: {

            }
        })
    </script>
@endpush
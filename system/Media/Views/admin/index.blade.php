@extends('media::admin.layouts.app')

@section('body')
    <div id="media">
        <template v-for="item in media">
            <div class="col-md-3">
                <img src="@{{ item.src }}" class="img-circle img-responsive" style="padding-bottom: 10px;"/>
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
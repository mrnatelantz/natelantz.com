@extends('menu::admin.layouts.app')

@section('body')
    @if(isset($menu))
        <div class="form col-md-6 form-horizontal">

            <div class="form-group">

                <div class="col-sm-12">
                    <input class="form-control" value="{{ $menu->name or null }}">
                </div>
            </div>
            <div class="panel-group col-md-offset-1" id="accordion" role="tablist" aria-multiselectable="true">
                @if(isset($menu->menu_items) && count($menu->menu_items))
                    @foreach($menu->menu_items as $menu_item)
                        @include('menu::admin.partials.menu_item', ['menu_item' => $menu_item, 'menu_id' => $menu->id])
                    @endforeach
                @endif
                @include('menu::admin.partials.menu_item', ['menu_item' => null, 'menu_id' => $menu->id])
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/vue/1.0.16/vue.min.js"></script>
<script>
    <?php /*
    new Vue({
        el: '#menu-form',
        data: {
            menu: {
                name: ''
            }
        },
        methods: {
            submit: function () {
                var text = this.newTodo.trim()
                if (text) {
                    this.todos.push({ text: text })
                    this.newTodo = ''
                }
            }
        }
    });
    */ ?>
</script>
@endpush
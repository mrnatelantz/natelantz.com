@extends('menu::admin.layouts.app')

@section('body')
    @if(isset($menu))
        <div class="form">
            <input class="form-control" value="{{ $menu->name or null }}">
            <ul>
                @if(isset($menu->child))

                @endif
            </ul>
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
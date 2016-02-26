@extends('menu::admin.layouts.app')

@section('body')

    <div id="menu-form">
        <div class="form-horizontal col-md-4">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input v-model="menu.name" v-on:keyup.enter="submit" id="name" class="form-control" placeholder="Menu Name" required aria-required="true">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" v-on:click="">Save</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/vue/1.0.16/vue.min.js"></script>
<script>
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

</script>
@endpush
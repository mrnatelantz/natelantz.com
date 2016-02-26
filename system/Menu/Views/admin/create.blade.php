@extends('menu::admin.layouts.app')

@section('body')
        <form action="{{ route('menu.store') }}" menthod="POST" class="form-horizontal col-md-4">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                    <input v-model="menu.name" id="name" class="form-control" placeholder="Menu Name" required aria-required="true">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
@endsection

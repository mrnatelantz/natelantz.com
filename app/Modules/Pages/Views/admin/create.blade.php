@extends('pages::admin.layouts.app')

@push('css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
@endpush

@section('body')
    <div class="input-fields">
        <div>
            <input type="text" name="slug" class="form-control slug" placeholder="Slug">
        </div>
        <div>
            <input type="text" name="name" class="form-control name" placeholder="Name">
        </div>
        <div>
            <input type="text" name="cover_image" class="form-control slug" placeholder="Cover Image">
        </div>
    </div>
    <div class="summernote"></div>
    <button class="submitButton btn btn-primary">Save</button>
    <form action="{{ route('pages.post') }}" method="POST" id="submitForm" style="visibility: hidden;">
        {{ csrf_field() }}

    </form>
@endsection

@push('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();



            $('.submitButton').on('click', function(event) {
                var content = '<input type="hidden" name="content" value="' + $('.summernote').summernote('code') + '">';
                $('form#submitForm').append(content);

                $.each($('.input-fields input'), function() {
                    console.log($(this).val());
                    var input = '<input type="hidden" name="' + $(this).attr('name') + '" value="' + $(this).val() + '">';
                    $('form#submitForm').append(input);
                });
                $('#submitForm').submit();
            });
        });
    </script>
@endpush

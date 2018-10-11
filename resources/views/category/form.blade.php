<?php
$route = route('category.store');
$name = "";
$display_name = "";
$state = "Add";
$method = "post";

if (isset($category) && sizeof($category->toArray())) {
    $route = route('category.update', $category->id);
    $name = $category->name;
    $display_name = $category->display_name;
    $state = "Edit";
    $method = "put";
}

if (isset($errors) && sizeof($errors)) {
    $name = old('name');
    $display_name = old('display_name');
}
?>


@extends('layouts.app')
@section('title') {{$state}} Category
@stop
@section('content')
    <div class="box">
        <form role="form" id="form" action="{{$route}}" method="{{$method}}" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="box-body">
                <div class="form-group">
                    <label for="paid_at">Display Name</label>
                    <input type="text" name="display_name" class="form-control dispay_name" id="display_name" value="{{$display_name}}" required>
                </div>

                <div class="form-group">
                    <label for="name">Name (Slug)</label>
                    <input type="text" name="name" id="name" class="form-control name" value="{{$name}}" required>
                </div>
            </div>
            <div class="box-footer">
                <a class="btn btn-danger" href="{{route('category.index')}}">Cancel</a>
                <button class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>


@stop
@section('scripts')

    <script>
        // CKEDITOR.replace( 'description' );

        $('#form').validate()



        $(function () {
            var base_url = "{{Config::get('constants.WEBSITE_NAME')}}";
            $('#name,#display_name').keyup(function () {
                var title = $(this).val();
                if (title === '') {
                    return;
                }
//                $('#h1_title').val(title);

                title = title.toLowerCase();
                title = title.replace(/[^a-z0-9 ]+/g, '');
                title = title.replace('  ', ' ');

                var url = title.replace(/\s/g, '-');
                $('.name').val(url);
            });
        });
    </script>

@stop
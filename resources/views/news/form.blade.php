<?php
$route = route('news.store');
$title = "";
$content = "";
$highlights = "";
$publish_date = "";
$image = "";
$state = "Add";
$method = "post";

if (isset($news) && sizeof($news->toArray())) {
    $route = route('news.update', $news->id);
    $title = $news->title;
    $content = $news->content;
    $highlights = $news->highlights;
    $publish_date = $news->publish_date;
    $image = $news->image;
    $state = "Edit";
    $method = "put";
}

if (isset($errors) && sizeof($errors)) {
    $title = old('title');
    $content = old('content');
    $highlights = old('highlights');
    $content = old('content');
}
?>


@extends('layouts.app')
@section('title') {{$state}} News
@stop
@section('content')
    <div class="box">
        <form role="form" id="form" action="{{$route}}" method="{{$method}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-8 col-sm-8">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control dispay_name" id="title"
                                   value="{{$title}}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="highlights">Highlights</label>
                            <input type="text" name="highlights" id="highlights" class="form-control"
                                   value="{{$highlights}}"
                                   required>
                        </div>
                        <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content">Description</label>

                            <textarea id="content" name="content"
                                      class="ckeditor" required> {{ $content }}</textarea>
                            @if ($errors->has('content'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="Image">Image</label>

                            <input type="file" id="imageFile" class="form-control" placeholder="Image"
                                   name="image" data-ratio="16" data-ratiowidth="11"
                                   @if(empty($image)) required @endif>

                            <div id="previewWrapper" class="hidden">
                                <br>
                                <img id="croppedImagePreview" height="150"><br>
                                <input type="hidden" name="inputCroppedPic" id="inputCroppedPic" tabindex="-1">
                                <button class="col-sm-offset-2 col-xs-offset-4 btn btn-danger btn-sm" type="button"
                                        id="removeCroppedImage" style="margin-top: 7px;">Remove
                                </button>
                            </div>
                            @if(!empty($image))
                                <img src="{{url($image)}}" style="width: 20%;">
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="form-group">
                        <label for="category">Publish Date</label><br>
                        <input type="date" name="publish_date" value="{{$publish_date}}" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label><br>
                        <input type="hidden" name="categoryIds[]" id="categoryIds">
                        @if(!empty($categories))
                            @foreach($categories as $category)
                                <input type="checkbox" name="category" class="__selected"
                                       value="{{$category->id}}" @if(!empty($news)){{$news->categories->contains($category->id) ? 'checked' :''}} @endif> {{$category->display_name}}
                                <br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a class="btn btn-danger" href="{{route('news.index')}}">Cancel</a>
                <button class="btn btn-success submit">Submit</button>
            </div>
        </form>
        <div class="modal" id="imageCropperModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" style="margin-top: 5px!important; font-size: 25px;"
                                data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Edit Image</h4>
                    </div>
                    <div class="modal-body">
                        <img id="cropImgSrc" class="h400">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary button saveImage" id="saveCroppedImg">Save
                            changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('scripts')
    @include('includes.ckeditor')
    @include('includes.cropperjs')
    <script>
        CKEDITOR.replace('content');


        $('.submit').on('click', function (e) {
            e.preventDefault();
            var form = $('#form');
            var checkedIds = [];

            $("input:checkbox[name=category]:checked").each(function () {
                checkedIds.push($(this).val());
            });
            $('#categoryIds').val(checkedIds);

            form.validate(
                {
                    ignore: [],
                    debug: false,
                    rules: {

                        content: {
                            required: function () {
                                CKEDITOR.instances.content.updateElement();
                            },

                            minlength: 10
                        }
                    },
                    messages:
                        {

                            content: {
                                required: "This field is required.",
                                minlength: "Please enter 10 characters"


                            }
                        }
                }
            );
            console.log(checkedIds);
            {

                if (form.valid()) {
                    if (checkedIds.length < 1) {
                        alert('Please select at least one Category.');
                    } else {
                        form.submit()
                    }
                }
            }
        });


    </script>


@stop
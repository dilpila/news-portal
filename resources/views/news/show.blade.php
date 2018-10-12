<?php
$title = "";
$content = "";
$highlights = "";
$publish_date = "";
$image = "";

if (isset($news) && sizeof($news->toArray())) {
    $title = $news->title;
    $content = $news->content;
    $highlights = $news->highlights;
    $publish_date = $news->publish_date;
    $image = $news->image;
}
?>


@extends('layouts.app')
@section('title') News
@stop
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3">
                    <h4>Title</h4>
                    <p>{{$title}}</p>
                </div>
                <div class="col-lg-3">
                    <h4>Title</h4>
                    <p>{{$title}}</p>
                </div>
                <div class="col-lg-3">
                    <h4>Highlights</h4>
                    <p>{{$highlights}}</p>
                </div>
                <div class="col-lg-3">
                    <h4>Category</h4>
                    @if(!empty($news->categories))
                        <ul>
                            @foreach($news->categories as $category)
                                <li>
                                    {{$category->display_name}}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-lg-12">
                    <h4>Content</h4>
                    <p>{!! $content !!}</p>
                </div>

                <div class="col-lg-12">
                    <img src="{{$image}}" width="20%">
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('news.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

@stop
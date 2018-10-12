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
@section('styles')
    <style>

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
@endsection

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
                    <img id="myImg" src="{{$image}}" alt="Image" style="width:100%;max-width:300px">
                    {{--<img src="{{$image}}" width="20%">--}}
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('news.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

@stop
@section('scripts')
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
    </script>
@stop
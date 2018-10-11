<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <style>
        @media print {
            .hidden-print {
                display: none !important;
            }
        }
        .error{
            color: red;
        }
    </style>
    @include('partials.top_nav')
    @include('partials.side_nav')

    <div class="content-wrapper">
        <section class="content-header">
            @yield('button')

            <h1>
                @yield('title')
                <small>@yield('sub_title')</small>
            </h1>
        </section>

        <section class="content">
            @include('partials.message') @yield('content')
        </section>
    </div>
</div>
<script src="{{asset("js/app.js")}}"></script>


@yield('scripts')
<script>
    $(function () {
        $('body').on('click', '[data-action=delete]',
            function (e) {
                e.preventDefault();
                var source = $(e.target);
                if (source.get(0).tagName == "I") {
                    source = source.closest('a');
                }
                var url = source.attr('href');
                var id = source.data('id');

                swal(
                    {
                        title: "Are you sure?",
                        text: "You will not be able to revert this action.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    },
                    function () {

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "GET",
                            url: url,
                            data: {id: id},

                        })
                            .done(function (data) {
                                console.log(data);
                                swal({
                                    title: "Deleted",
                                    text: "Data has been deleted successfully",
                                    type: "success"
                                }, function () {
                                    location.reload();
                                });
                            })
                            .error(function (data) {
                                swal("Oops", "We couldn't connect to the server!", "error");
                            });
                    });
            }
        )
    })
</script>
</body>

</html>
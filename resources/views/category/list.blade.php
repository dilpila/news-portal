@extends('layouts.app')
@section('title') Category
@stop
@section('button')
    <div class="">
        <a href="{{route('category.create')}}" class="btn btn-primary pull-right">
            <span class="fa fa-plus"></span> New</a>
    </div>
@stop
@section('styles')
    <link rel="stylesheet" href="{{asset('css/datatable.css')}}" type="text/css">
@endsection

@section('content')

    <div class="box">
        <div class="box-body">
            <table id="table" class="table">
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name(Slug)</th>
                    <th>Display Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).on('delete.success', function () {
            location.reload();
        })
    </script>
    <script>
        $(function () {
            var table = $('#table').DataTable({
                ajax: "{{route('category.index')}}",
                autoWidth: false,
                responsive: true,
                order: [0, 'desc'],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'display_name', name: 'display_name'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (val, type, data) {
                            var edit = "{{ route('category.edit', ':id') }}";
                            edit = edit.replace(':id', data.id);
                            return "<div class='dropdown'>" +
                                "  <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Action " +
                                "  <span class='caret'></span></button>" +
                                "  <ul class='dropdown-menu'>" +
                                "    <li><a href='"+edit+"' class='' data-toggle='tooltip' title='Edit'><i class='fa fa-edit'></i>Edit</a></li>" +
                                "    <li><a class='' data-toggle='tooltip' title='Delete' data-action='delete' href='{{route('category.delete')}}' data-id='" + data.id + "'><i class='fa fa-trash'></i>Delete</a></li>" +
                                "  </ul>" +
                                "</div>";

                        }
                    },
                ],
                "createdRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                },

            })
        });
    </script>
@stop
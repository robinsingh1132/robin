@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Home Banners</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('admin-dashboard') }}">
                            <i class="flaticon-home text-primary"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);">Home Banner List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Home Banner List
                                <span class="float-right"><a href="{{ route('new-home-banner') }}" class="text-info"><i class="fas fa-plus-circle"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-home-banner" class="display table table-striped table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Image</th>
                                                    <th>Mobile</th>
                                                    <th>Banner Link</th>
                                                    <th>Position</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="image-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding-top: 0px !important;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" style="color: red">&times;</button>
                    <img id="banner-image-id" src="" alt="" style="width: 100%">
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click','.image-viewer', function(){
                var imgSrc = $(this).attr('src');
                $('#banner-image-id').attr('src', imgSrc);
                $('#image-modal').modal('show');
            });
        });
    </script>
    <script>
        $(function() {
            $('#dt-home-banner').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: '{!! route('data-home-banner') !!}',
                columnDefs: [
                    { "width": "100px", "targets": 6 }
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'id', name: 'id',"visible":false },
                    { data: 'name', name: 'name' },
                    { data: 'image_link', name: 'image_link', "render": function (data, type, full, meta) {
                        return "<img class=\"image-viewer\" style=\"cursor: pointer\" src=\"{{ url('/banner') }}/" + data + "\" height=\"50px\" width=\"50px\"/>";
                    }, orderable: false, searchable: false },
                    { data: 'mobile_image_link', name: 'mobile_image_link', "render": function (data, type, full, meta) {
                        return "<img class=\"image-viewer\" style=\"cursor: pointer\" src=\"{{ url('/banner') }}/" + data + "\" height=\"50px\" width=\"50px\"/>";
                    }, orderable: false, searchable: false },
                    {data: 'url', name: 'url', "render": function(data){
                        return '<a target="_blank" name="link" href="' + data +'">Link</a>';
                    }, orderable: false, searchable: false },
                    { data: 'position', name: 'position'},
                    { data: 'status', name: 'status',render: function ( data, type, full, meta ) {
                        return data ? "Active" : "Inactive" ;
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
               /* "order":[['1','desc']]*/
            });
        });
    </script>
@endsection
@extends('layouts.admin')
@section('content')
<?php
if(empty($duplicate_records))
$duplicate_records='';
?>
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Dealers List</h4>
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
                        <a href="javascript:void(0);">Dealers List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <form id="import_form" class="" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <i class="fas fa-list-alt text-success"></i> Dealers List
                                    <span class="float-right"><a href="{{ route('add-dealer') }}" class="text-info" data-toggle="tooltip" title="Add New"><i class="fas fa-plus-circle"></i></a></span>
                                    <label class="btn btn-file btn-warning mr-5 float-right">
                                        <i class="fa fa-download"></i>
                                        <a class="text-white" href="{{asset('dealers_sample_file.xlsx')}}"> Download Sample File</a>
                                    </label>
                                    <label class="btn btn-file btn-primary text-white mr-5 float-right">
                                        <i class="fa fa-upload"></i> Import Dealers
                                        <input id="choose_upload_btn" name="dealer_file" type="file" accept=".xlsx,.xls" style="display: none;">
                                    </label>
                                    <label class="btn btn-file btn-warning mr-5 float-right">
                                        <i class="fa fa-download"></i>
                                        <a class="text-white" href="{{ route('export') }}"> Export Dealers</a>
                                    </label>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                        @include('flash::message')

                        @if(!empty($duplicate_records))
                        <div class="container duplicate_records" style="border:1px solid red; padding:15px;margin-bottom: 10px">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-danger">Following records were duplicate, all remaining were saved.</h4>
                                    <div class="table-responsive">
                                        <table  class="display table table-striped table-hover table-sm">
                                            <thead>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>    
                                                <th>Contact</th>
                                                <th>Address</th>
                                            </thead>
                                            <tbody>
                                                @foreach($duplicate_records as $rec)
                                                <tr>
                                                    <th>{{$loop->index+1}}</th>
                                                    <td>{{$rec['first_name']}}</td>
                                                    <td>{{$rec['last_name']}}</td>
                                                    <td>{{$rec['email']}}</td>
                                                    <td>{{$rec['contact_number']}}</td>
                                                    <td>{{$rec['address']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="dt-dealer-list" class="display table table-striped table-hover table-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>    
                                                <th>Contact</th>
                                                <th>Address</th>
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
    <div>
        <img style="display: none; margin-left: 35%; margin-right: 30%; width: 30%;" class="loader" src="{{asset('/admin/img/small_loader.gif')}}">
    </div>
    <!-- food import csv file confirmation box -->
    <div class="modal fade" id="import_confirmation_csv" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:380px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to upload this csv file ?
                </div>
                <div class="modal-footer">
                    <button type="button" id="importCancelCsv" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" id="importConfirmCsv" class="btn btn-success del-confirm">Ok</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(function() {
            $('#dt-dealer-list').DataTable({
                processing: true,
                serverSide: true,
                columnDefs: [
                    { "width": "100px", "targets": 6 }
                ],
                ajax: '{!! route('dealer-data') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                    { data: 'id', name: 'id',"visible":false},
                    { data: 'first_name', name: 'first_name'},
                    { data: 'last_name', name: 'last_name'},
                    { data: 'email', name: 'email' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "order":[['1','desc']]
            });
        });
    
    //import data with confirmation box
        $(document).on('change', '#choose_upload_btn', function(e){
            var filename = $('#choose_upload_btn').val();
            if (filename.substring(3,11) == 'fakepath') {
                filename = filename.substring(12);
            }
            // modify message on box
            $('#import_confirmation_csv').find('.modal-body').html('Are you sure you want to upload '+filename+' file ?');
            $('#import_confirmation_csv').modal('show');

            //trigger submit
            $('#importConfirmCsv').on('click',function(){
                $('#import_form').trigger('submit');
            });

            // remove file on outside click
            $('#import_confirmation_csv').on('hidden.bs.modal', function () {
                location.reload(true);
            });
            return false;
        });        
    </script>
@endsection
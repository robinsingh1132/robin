@extends('layouts.admin')
@section('content')
    <div class="panel-header">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Highlight</h4>
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
                        <a href="javascript:void(0);">Highlight List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-list-alt text-success"></i> Highlight List
                                <span class="float-right"><a href="{{ route('new-highlight') }}" class="text-info" data-toggle="tooltip" title="Add New"><i class="fas fa-plus-circle"></i></a></span>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('flash::message')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive" >
                                        <table id="dt-highlight-list" class="display table table-striped table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Subcategory</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($highlights))
                                                    @foreach($highlights as $highlight)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$highlight->name}}</td>
                                                        <td> @foreach($highlight->highlightSubcategories as $subcat)
                                                                 @if($loop->last)
                                                                    {{$subcat->productSubCategory['name']}}
                                                                @else
                                                                    {{$subcat->productSubCategory['name']}},
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <a href="{{route('view-highlight',$highlight->id)}}" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a>&nbsp                           
                                                            <a href="{{route('edit-highlight',$highlight->id)}}" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>&nbsp
                                                            <a href="{{route('delete-highlight',$highlight->id)}}" onclick="confirm('Are you sure you want to delete this Highlight?')" data-toggle="tooltip" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                                                        </td>                                          
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
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
@endsection
@section('script')
    <script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(function() {
            $('#dt-highlight-list').DataTable({
               columnDefs: [
                    {targets: [0,1,3]}
                ],
                ordering: true 
            });           
            
        });
    </script>
@endsection


@extends('admin.layout.app')
@section('contents')



        <div class="card mb-4">
            <div class="card-body">

                <h3 class="float-left"> Statuses List </h3>
            
                <button data-toggle="modal" data-target="#AddModal" class="btn btn-primary float-right" data-toggle="tooltip" title="add">
                    <i class="fa fa-home"></i> Create Status 
                </button>

                <hr class="mt-5 mb-5">
            
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Serial</th>
                            <th>Status Name</th>
                            <th>status</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($allStatuses as $status)
                        <tr>
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->status==1 ? 'Published' : 'Unpublished' }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#EditModal{{ $status->id }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="update">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            </td>
                        </tr>

                        <div id="EditModal{{ $status->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <form method="POST" action = "{{ route('admin.submit_edited_status', $status->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-row mb-4">
                                                <div class="col-md-6">
                                                    <label for="validationServer01">Status Name</label>
                                                    <input type="text" name="name" class="form-control form-control-lg"  value="{{$status->name}}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="validationServer01">Status</label>
                                                    
                                                    <select name="status" class="form-control form-control-lg" required="true">
                                                        <option value="1" @if($status->status==1) selected @endif>Published</option>
                                                        <option value="0" @if($status->status==0) selected @endif>Unpublished</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <br>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-block btn-lg btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--
                        <div id="myModal{{ $status->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form action="{{route('admin.delete_status',$status->id)}}" method="POST">
                                    @method('delete')    
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Confirmation</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Are You Sure ??</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        --}}

                    @endforeach
                    </tbody>
                </table>


                <div id="AddModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">

                                <form method="POST" action = "{{ route('admin.submit_created_status') }}" enctype="multipart/form-data">
                                    
                                    @csrf

                                    <div class="form-row mb-4">
                                        <div class="col-md-6">
                                            <label for="validationServer01">Status Name</label>
                                            <input type="text" name="name" class="form-control form-control-lg"  placeholder="Status Name">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationServer01">Status</label>
                                            
                                            <select name="status" class="form-control form-control-lg" required="true">
                                                <option value="1">Published</option>
                                                <option value="0">Unpublished</option>
                                            </select>
                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-block btn-lg btn-primary">Create</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="pagination text-right">
            
            </div>
        </div>

  

@stop


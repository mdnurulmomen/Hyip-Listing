
@extends('admin.layout.app')
@section('contents')

        

        <div class="card mb-4">
            <div class="card-body">
            
                <h3 class="float-left"> Features List </h3>
                <button data-toggle="modal" data-target="#AddModal" class="btn btn-primary float-right" data-toggle="tooltip" title="add">
                    <i class="fa fa-home"></i> Create Feature
                </button>

                <hr class="mt-5 mb-5">
            
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Serial</th>
                            <th>Feature Name</th>
                            <th>Feature Logo </th>
                            <th>Feature Status </th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($allFeatures as $feature)
                        <tr>
                            <td>{{ $feature->id }}</td>
                            <td>{{ $feature->name }}</td>
                            <td>
                                <img src="{{ asset('assets/admin/images/feature/'.$feature->logo) }}" width="25" alt="No Image">
                            </td>
                            <td>{{ $feature->status==1 ? 'Published' : 'Unpublished' }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#EditModal{{ $feature->id }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="update">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>

                            </td>
                        </tr>

                        <div id="EditModal{{ $feature->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <form method="POST" action = "{{ route('admin.submit_edited_feature', $feature->id) }}" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-row mb-4">
                                                <div class="col-md-6">
                                                    <label for="validationServer01">Feature name</label>
                                                    <input type="text" name="name" class="form-control form-control-lg"  value="{{ $feature->name }}" placeholder="Feature Name" required="true">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="validationServer01">Status</label>
                                                    <select name="status" class="form-control form-control-lg" required="true">
                                                        <option value="1" @if($feature->status==1) selected @endif>Published</option>
                                                        <option value="0" @if($feature->status==0) selected @endif>Unpublished</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row mb-4">
                                                <div class="col-md-6">
                                                    <label for="validationServer02">Features Logo</label>
                                                    <div>
                                                        <img src="{{ asset('assets/admin/images/feature/'.$feature->logo) }}" class="img-thumbnail img-fluid" alt="No Image">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="validationServer02">Upload Logo</label>
                                                    <input type="file" name="logo" class="form-control form-control-lg" accept="image/*">
                                                </div>
                                            </div>

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
                        <div id="myModal{{ $feature->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form action="{{route('admin.delete_feature',$feature->id)}}" method="POST">
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

                                <form method="POST" action = "{{ route('admin.submit_created_feature') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row mb-4">
                                        <div class="col-md-4">
                                            <label for="validationServer01">Feature name</label>
                                            <input type="text" name="name" class="form-control form-control-lg"  placeholder="Feature Name">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationServer01">Status</label>
                                            <select name="status" class="form-control form-control-lg" required="true">
                                                <option value="1">Published</option>
                                                <option value="0">Unpublished</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationServer02">Features Logo</label>
                                            <input type="file" name="logo" class="form-control form-control-lg" accept="image/*">
                                        </div>

                                    </div>

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



@extends('admin.layout.app')
@section('contents')


        <div class="card mb-4">

            <div class="card-body">
                <h3 class="float-left"> Sizes List </h3>
                <button data-toggle="modal" data-target="#AddModal" class="btn btn-primary float-right" data-toggle="tooltip" title="add">
                    <i class="fa fa-home"></i> Create New Ad Size
                </button>
                <hr class="mt-5 mb-5">
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                    <tr>
                        <th>Size Serial</th>
                        <th>Size Name</th>
                        <th>Width </th>
                        <th>Height </th>
                        <th>Status </th>
                        <th class="actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allAdSizes as $adSize)
                        <tr>
                            <td>{{ $adSize->id }}</td>
                            <td>{{ $adSize->name }}</td>
                            <td>{{ $adSize->width }}</td>
                            <td>{{ $adSize->height }}</td>
                            <td>{{ $adSize->status==1 ? 'Published' : 'Unpublished' }}</td>

                            <td>

                                <a data-toggle="modal" data-target="#editModal{{ $adSize->id }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="update">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>


                                {{--
                                <a data-toggle="modal" data-target="#myModal{{ $adSize->id }}" class="btn btn-icon btn-pill btn-danger delete_button" data-toggle="tooltip" title="delete">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                                --}}

                            </td>
                        </tr>

                        <div id="editModal{{ $adSize->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form method="POST" action = "{{ route('admin.submit_edited_ad_size', $adSize->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <label for="validationServer01">Size Width</label>
                                                    <input type="text" name="width" class="form-control form-control-lg"  value="{{ $adSize->width }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="validationServer01">Size Height</label>
                                                    <input type="text" name="height" class="form-control form-control-lg"  value="{{ $adSize->height }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="validationServer01">Status</label>
                                                    
                                                    <select name="status" class="form-control form-control-lg" required="true">
                                                        <option value="1" @if($adSize->status==1) selected @endif>Published</option>
                                                        <option value="0" @if($adSize->status==0) selected @endif>Unpublished</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-block btn-lg btn-primary">Updated</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--

                        <div id="myModal{{ $adSize->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form action="{{route('admin.delete_ad_size',$adSize->id)}}" method="POST">
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

                    <div id="AddModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <form method="POST" action = "{{ route('admin.submit_created_ad_size') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="validationServer01">Size Width</label>
                                                <input type="text" name="width" class="form-control form-control-lg"  placeholder="Size Width">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="validationServer01">Size Height</label>
                                                <input type="text" name="height" class="form-control form-control-lg"  placeholder="Size Height">
                                            </div>

                                            <div class="col-md-4">
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
                </table>
            </div>
            <div class="pagination text-right">
            
            </div>
        </div>

  

@stop


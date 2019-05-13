
@extends('admin.layout.app')
@section('contents')


        <div class="card mb-4">

            <div class="card-body">
                <h3 class="float-left"> Ad Packages List </h3>
                <button data-toggle="modal" data-target="#addModal" class="btn btn-primary float-right" data-toggle="tooltip" title="add">
                    <i class="fa fa-home"></i> Create New Ad Package
                </button>
                <hr class="mt-5 mb-5">
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                    <tr>
                        <th>Package Serial</th>
                        <th>Name</th>
                        <th>Days </th>
                        <th>Size </th>
                        <th>Amount </th>
                        <th>Status </th>
                        <th class="actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allAdPackages as $adPackage)
                        <tr>
                            <td>{{ $adPackage->id }}</td>
                            <td>{{ $adPackage->name }}</td>
                            <td>{{ $adPackage->days }}</td>
                            <td>{{ $adPackage->adSize->name }}</td>
                            <td>{{ $adPackage->amount }}</td>
                            <td>{{ $adPackage->status==1 ? 'Published' : 'Unpublished' }}</td>

                            <td>

                                <a data-toggle="modal" data-target="#editModal{{ $adPackage->id }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="update">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>


                                {{--
                                <a data-toggle="modal" data-target="#myModal{{ $adPackage->id }}" class="btn btn-icon btn-pill btn-danger delete_button" data-toggle="tooltip" title="delete">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                                --}}

                            </td>
                        </tr>

                        <div id="editModal{{ $adPackage->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form method="POST" action = "{{ route('admin.submit_edited_ad_package', $adPackage->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="form-row mb-4">
                                                <div class="col-md-6">
                                                    <label for="validationServer01">Name</label>
                                                    <input type="text" name="name" class="form-control form-control-lg"  value="{{ $adPackage->name }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="validationServer01">Size</label>
                                                    
                                                    <select name="size" class="form-control form-control-lg" required="true">

                                                        @foreach($allAdSizes as $adSize)
                                                        <option value="{{$adSize->id}}" @if($adPackage->size==$adSize->id) selected @endif>
                                                            {{$adSize->name}}
                                                        </option>
                                                        @endforeach
                                                        
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="form-row mb-4">
                                                <div class="col-md-4">
                                                    <label for="validationServer01">Days</label>
                                                    <input type="text" name="days" class="form-control form-control-lg"  value="{{ $adPackage->days }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="validationServer01">Money Amount</label>
                                                    <input type="text" name="amount" class="form-control form-control-lg"  value="{{ $adPackage->amount }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="validationServer01">Status</label>
                                                    
                                                    <select name="status" class="form-control form-control-lg" required="true">
                                                        <option value="1" @if($adPackage->status==1) selected @endif>Published</option>
                                                        <option value="0" @if($adPackage->status==0) selected @endif>Unpublished</option>
                                                    </select>
                                                </div>
                                            </div>
                                           
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
                        <div id="myModal{{ $adPackage->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form action="{{route('admin.delete_ad_size',$adPackage->id)}}" method="POST">
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

                    <div id="addModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form method="POST" action = "{{ route('admin.submit_created_ad_package') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row mb-4">
                                            <div class="col-md-6">
                                                <label for="validationServer01">Name</label>
                                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Package Name">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="validationServer01">Size</label>
                                                
                                                <select name="size" class="form-control form-control-lg" required="true">

                                                    @foreach($allAdSizes as $adSize)
                                                    <option value="{{$adSize->id}}">
                                                        {{$adSize->name}}
                                                    </option>
                                                    @endforeach
                                                    
                                                </select>

                                            </div>
                                        </div>


                                        <div class="form-row mb-4">
                                            <div class="col-md-4">
                                                <label for="validationServer01">Days</label>
                                                <input type="number" name="days" placeholder="Number Days" class="form-control form-control-lg">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="validationServer01">Money Amount</label>
                                                <input type="number" name="amount" placeholder="Money Amount" class="form-control form-control-lg">
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

                </table>
            </div>
            <div class="pagination text-right">
            
            </div>
        </div>

  

@stop



@extends('admin.layout.app')
@section('contents')


        <div class="card mb-4">
            <div class="card-body">

                <h3 class="float-left"> Categories List </h3>

                <button data-toggle="modal" data-target="#AddModal" class="btn btn-primary float-right" data-toggle="tooltip" title="add">
                    <i class="fa fa-home"></i>
                    Create Category
                </button>

                <hr class="mt-5 mb-5">

                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Serial</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($allCategories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->status==1 ? 'Published' : 'Unpublished' }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#EditModal{{ $category->id }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="update">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            </td>
                        </tr>

                        <div id="EditModal{{ $category->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <form method="POST" action = "{{ route('admin.submit_edited_category', $category->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-row mb-4">
                                                <div class="col-md-6">
                                                    <label for="validationServer01">Category Name</label>
                                                    <input type="text" name="name" class="form-control form-control-lg"  value="{{$category->name}}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="validationServer01">Status</label>
                                                    
                                                    <select name="status" class="form-control form-control-lg" required="true">
                                                        <option value="1" @if($category->status==1) selected @endif>Published</option>
                                                        <option value="0" @if($category->status==0) selected @endif>Unpublished</option>
                                                    </select>
                                                </div>


                                            </div>

                                            <div class="form-row mb-4">
                                                <div class="col-md-12">
                                                    <label for="validationServer01">Category Description</label>
                                                    <textarea class="form-control form-control-lg text-left p-0" name="description" rows="5" placeholder="Category Description" id="textArea1" required>
                                                        {{$category->description}}
                                                    </textarea>
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
                    @endforeach
                    </tbody>

                    <div id="AddModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <form method="POST" action = "{{ route('admin.submit_created_category') }}" enctype="multipart/form-data">

                                        @csrf

                                        <div class="form-row mb-4">
                                            <div class="col-md-6">
                                                <label for="validationServer01">Category Name</label>
                                                <input type="text" name="name" class="form-control form-control-lg">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="validationServer01">Status</label>
                                                
                                                <select name="status" class="form-control form-control-lg" required="true">
                                                    <option value="1" @if($category->status==1) selected @endif>Published</option>
                                                    <option value="0" @if($category->status==0) selected @endif>Unpublished</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row mb-4">
                                            <div class="col-md-12">
                                                <label for="validationServer01">Category Description</label>
                                                <textarea class="form-control form-control-lg" name="description" id="textArea2" rows="5" placeholder="Category Description" required></textarea>
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

                </table>
            </div>
            <div class="pagination text-right">
            
            </div>
        </div>

        <script type="text/javascript">
            
            // $(document).ready(function() {
            //     bkLib.onDomLoaded(function () {
            //         new nicEditor({iconsPath: '{{asset('assets/admin/images/nicEditorIcons.gif')}}'}).panelInstance('textArea1');
            //     });
            // });

            // $(document).ready(function() {
            //     bkLib.onDomLoaded(function () {
            //         new nicEditor({iconsPath: '{{asset('assets/admin/images/nicEditorIcons.gif')}}'}).panelInstance('textArea2');
            //     });
            // });

        </script>
@stop


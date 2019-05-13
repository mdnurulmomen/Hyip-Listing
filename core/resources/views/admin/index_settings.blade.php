@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            
            <div class="card-body">
                <h3> Index Page Settings </h3>
                <hr class="mb-4">
                <form method="post" action = "{{ route('admin.submit_settings_index') }}" enctype="multipart/form-data">
                    @csrf
                    @Method('put')
                    
                    <div class="form-row mb-4">
                        <div class="col-md-6">
                            <label for="validationServer02">Index Page Heading:</label>
                            <input type="tel" name="index_heading" class="form-control form-control-lg"  value="{{$indexSettings->index_heading}}">
                        </div>

                        <div class="col-md-6">
                            <label for="validationServer02">Learn More Link:</label>
                            <input type="url" name="learn_more_link" class="form-control form-control-lg"  value="{{$indexSettings->learn_more_link}}">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col-md-6">
                            <label>Index Image:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$indexSettings->index_image) }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label>Upload Index New Image:</label>
                            <input type="file" name="index_image" class="form-control form-control-lg" accept="image/*">
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
@stop
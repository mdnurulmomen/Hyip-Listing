@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            
            <div class="card-body">
                <h3>Logo & Favicon Settings </h3>
                <hr class="mb-4">
                <form method="post" action = "{{ route('admin.submit_settings_logo') }}" enctype="multipart/form-data">
                    @csrf
                    @Method('put')

                    <div class="form-row row mb-4">
                        <div class="col-md-6">
                            <label >Logo:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$logoSettings->logo) }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label >Favicon:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$logoSettings->favicon) }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>
                    </div>

                    <div class="form-row row mb-4">
                        <div class="col-md-6">
                            <label for="validationServer02">Upload Logo:</label>
                            <input type="file" name="logo" class="form-control form-control-lg" accept="image/*">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="validationServer02">Upload Favicon:</label>
                            <input type="file" name="favicon" class="form-control form-control-lg" accept="image/*">
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
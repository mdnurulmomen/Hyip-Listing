@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            
            <div class="card-body">
                <h3> Details Page Settings </h3>
                <hr class="mb-4">
                <form method="post" action = "{{ route('admin.submit_settings_details') }}" enctype="multipart/form-data">
                    @csrf
                    @Method('put')
                    <div class="form-row mb-4">
                        <div class="col-md-12">
                            <label class="col-form-label" for="validationServer02">Detail Page Heading:</label>
                            <input type="tel" name="detail_heading" class="form-control form-control-lg"  value="{{$detailSettings->detail_heading}}">
                        </div>
                        
                    </div>

                    <div class="form-row row mb-4">
                        <div class="col-md-6">
                            <label class="col-form-label" for="validationServer02">Page Image:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$detailSettings->detail_image) }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="col-form-label" for="validationServer02">Upload New Image:</label>
                            <input type="file" name="detail_image" class="form-control form-control-lg" accept="image/*">
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
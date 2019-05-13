@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            
            <div class="card-body">
                <h3> Footer Settings </h3>
                <hr class="mb-4">
                <form method="post" action = "{{ route('admin.submit_settings_footer') }}" enctype="multipart/form-data">
                    @csrf
                    @Method('put')
                    
                    <div class="form-row mb-4">
                        
                        <div class="col-md-4">
                            <label for="validationServer02">Footer Heading:</label>
                            <input type="tel" name="footer_heading" class="form-control form-control-lg"  value="{{$footerSettings->footer_heading}}">
                        </div>

                        <div class="col-md-4">
                            <label for="validationServer02">Contact Number:</label>
                            <input type="tel" name="contact_number" class="form-control form-control-lg"  value="{{$footerSettings->contact_number}}">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="validationServer02">Contact Mail:</label>
                            <input type="email" name="contact_mail" class="form-control form-control-lg"  value="{{$footerSettings->contact_mail}}">
                        </div>

                    </div>

                    <div class="form-row mb-4">
                        <div class="col-md-6">
                            <label for="validationServer02">Footer Image:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$footerSettings->footer_image) }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="validationServer02">Footer Image:</label>
                            <div>
                                <input type="file" name="footer_image" class="form-control form-control-lg" accept="image/*">
                            </div>
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
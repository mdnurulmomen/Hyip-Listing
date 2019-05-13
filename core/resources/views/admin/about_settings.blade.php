@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            
            <div class="card-body">
                <h3> About Us Page Settings </h3>
                <hr class="mb-4">
                <form method="post" action = "{{ route('admin.submit_settings_about') }}" enctype="multipart/form-data">
                    @csrf
                    @Method('put')
                    <div class="form-row row mb-4">
                        <div class="col-md-4">
                            <label>About Page Image:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$aboutSettings->about_image ?? 'none') }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Mission Image:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$aboutSettings->mission_image) }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Businees Image:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$aboutSettings->business_image) }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-row mb-4">
                        <div class="col-md-4">
                            <label>Upload About Image:</label>
                            <input type="file" name="about_image" class="form-control form-control-lg" accept="image/*">
                        </div>
                        
                        <div class="col-md-4">
                            <label>Upload Mission Image</label>
                            <input type="file" name="mission_image" class="form-control form-control-lg" accept="image/*">
                        </div>

                        <div class="col-md-4">
                            <label>Upload Business Image</label>
                            <input type="file" name="business_image" class="form-control form-control-lg" accept="image/*">
                        </div>
                        
                    </div>

                    <div class="form-row mb-4">
                        <div class="col-md-4">
                            <label>About Heading:</label>
                            <input type="tel" name="about_heading" class="form-control form-control-lg"  value="{{$aboutSettings->about_heading}}">
                        </div>
                        <div class="col-md-4">
                            <label>Mission Heading:</label>
                            <input type="tel" name="mission_heading" class="form-control form-control-lg"  value="{{$aboutSettings->mission_heading}}">
                        </div>
                        <div class="col-md-4">
                            <label>Business Heading:</label>
                            <input type="tel" name="business_heading" class="form-control form-control-lg"  value="{{$aboutSettings->business_heading}}">
                        </div>
                    </div>
 
                    <div class="form-row mb-4">
                        <div class="col-md-6">
                            <label>Mission Details</label>
                            <textarea class="form-control form-control-lg" name="mission_description" id="textArea_1" rows="5" required>
                                {{ $aboutSettings->mission_description }}
                            </textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Business Details</label>
                            <textarea class="form-control form-control-lg" name="business_description" id="textArea_2" rows="5" required>
                                {{ $aboutSettings->business_description }}
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

    <script>
        $(document).ready(function() {
            bkLib.onDomLoaded(function () {
                new nicEditor({iconsPath: '{{asset('assets/admin/images/nicEditorIcons.gif')}}'}).panelInstance('textArea_1');
            });
        });

        $(document).ready(function() {
            bkLib.onDomLoaded(function () {
                new nicEditor({iconsPath: '{{asset('assets/admin/images/nicEditorIcons.gif')}}'}).panelInstance('textArea_2');
            });
        });
    </script>
@stop
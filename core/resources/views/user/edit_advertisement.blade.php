@extends('user.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">
        <div class="card-body">
            <h3> Advertisement Editing Form </h3>
            <hr class="mb-5">
            <form method="POST" action = "{{ route('user.submit_edited_advertisement', $advertisementToUpdate->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row mb-5">
                    <div class="col-md-4">
                        <label for="validationServer01">Package Type</label>
                        <select name="package" class="form-control form-control-lg " required="true">
                            @foreach($allAdPackages as $package)
                            <option value="{{$package->id}}" @if($advertisementToUpdate->package_id == $package->id) selected @endif>{{$package->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Advertisement Type</label>
                        <select name="type" class="form-control form-control-lg " required="true"> 
                            <option selected="true" disabled="true">--Please Select Ad Type--</option>
                            <option value="banner" @if($advertisementToUpdate->type=='banner') selected @endif>Banner</option>
                            <option value="script" @if($advertisementToUpdate->type=='script') selected @endif>Script</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Advertisement Size</label>
                        <select name="size" class="form-control form-control-lg " required="true">
                            <option selected="true" disabled="true">--Please Select Ad Size--</option>
                            @foreach($allAdSizes as $adSize)
                            <option value="{{$adSize->id}}" @if($adSize->id == $advertisementToUpdate->size) selected @endif>
                                {{$adSize->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row mb-4" id="bannerDiv" @if($advertisementToUpdate->type != "banner") style="display: none;"  @endif>
                    <div class="col-md-4">
                        <label for="validationServer02">Select Advertisement Url</label>
                        <input type="url" name="url" class="form-control form-control-lg" value="{{$advertisementToUpdate->url}}">
                    </div>

                    <div class="col-md-4">
                        <label for="validationServer01">Ad Banner</label>
                        <img src="{{ asset('assets/front/images/advertisement/'.$advertisementToUpdate->preview) }}" width="100%" height="110">
                    </div>

                    <div class="col-md-4">
                        <label for="validationServer02">Upload New Banner</label>
                        <input type="file" name="preview" class="form-control  form-control-lg" accept="image/*">
                    </div> 
                    
                </div>


                <div class="form-row mb-4" id="scriptDiv"  @if($advertisementToUpdate->type == "script") style="display: block;" @else style="display: none;"  @endif>
                    <div class="col-md-12">
                        <label for="validationServer02">Script</label>
                        <textarea class="form-control form-control-lg" name="script" rows="5">{{$advertisementToUpdate->script}}</textarea>
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col-md-12">
                        <label for="validationServer02">Contact Info</label>
                        <input type="text" name="contact_number" class="form-control form-control-lg"  value="{{$advertisementToUpdate->contact_number}}">
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

<script type="text/javascript">

    $('select[name="type"]').change(function(){
  
        if ($(this).val() == "banner"){
            $('#scriptDiv').hide();
            $('#bannerDiv').show();
        }else{
            $('#scriptDiv').show();
            $('#bannerDiv').hide();
        }
  
    });

</script>
@stop
@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">
        <div class="card-body">
            <h3> Advertisement Making Form </h3>
            <hr class="mb-5">
            <form method="POST" action = "{{ route('admin.submit_created_advertisement') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-4">
                    <div class="col-md-3">
                        <label for="validationServer01">Package Type</label>
                        <select name="package" class="form-control form-control-lg " required="true"> 
                            
                            <option value="-1">Unlimited</option>
                            @foreach($allAdPackages as $package)
                            <option value="{{$package->id}}">{{$package->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Advertisement Type</label>
                        <select name="type" class="form-control form-control-lg " required="true"> 
                            <option selected="true" disabled="true">--Please Select Ad Type--</option>
                            <option value="banner">Banner</option>
                            <option value="script">Script</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Advertisement Size</label>
                        <select name="size" class="form-control form-control-lg " required="true">
                            <option selected="true" disabled="true">--Please Select Ad Size--</option>
                            @foreach($allAdSizes as $adSize)
                            <option value="{{$adSize->id}}">{{$adSize->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Status</label>
                        <input type="checkbox" name="status" data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger">
                    </div>
                </div>
                
                <div class="form-row mb-4" id="bannerDiv" style="display: none;">
                    <div class="col-md-6">
                        <label for="validationServer02">Select Advertisement Url</label>
                        <input type="url" name="url" class="form-control form-control-lg"  placeholder="Ad Url">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="validationServer02">Upload Preview</label>
                        <input type="file" name="preview" class="form-control  form-control-lg" accept="image/*">
                    </div>
                </div>

                <div class="form-row mb-4" id="scriptDiv" style="display: none;">
                    <div class="col-md-12">
                        <label for="validationServer02">Script</label>
                        <textarea class="form-control form-control-lg" name="script" rows="5"></textarea>
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
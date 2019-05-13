@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold mb-4">
                <h3> General Settings </h3>
            </div>
            <div class="card-body">
                <form method="post" action = "{{ route('admin.submit_settings_general') }}">
                    @csrf
                    @Method('put')
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="validationServer01">Website Title</label>
                            <input type="text" name="name" class="form-control form-control-lg" value="{{ $settings->name }}">
                        </div>
                        <div class="col-md-6">
                            <label for="validationServer02">Color</label>
                            <input type="text" name="color" value="{{ $settings->color }}" class="form-control form-control-lg" onkeyup="backgroundColor()">
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <div class="col-md-6 mb-6">
                            <label for="validationServer01">Currency</label>
                            <input type="text" name="currency" class="form-control form-control-lg" value="{{ $settings->currency }}" style="text-transform: uppercase;">
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationServer02">Currency Sign</label>
                            <input type="text" name="currencySign" value="{{ $settings->currency_sign }}" class="form-control form-control-lg">
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-4">
                            <label for="validationServer02">User Registration :</label>
                            <input type="checkbox" name="user_registration" @if($settings->user_registration==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-md-4">
                            <label for="validationServer02">Email Verification :</label>
                            <input type="checkbox" name="email_verification" @if($settings->email_verification==1) checked @endif  data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-md-4">
                            <label for="validationServer02">SMS Verification :</label>
                            <input type="checkbox" name="sms_verification" @if($settings->sms_verification==1) checked @endif data-toggle="toggle" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger">
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
        function backgroundColor () {
            var inputSelected = document.getElementsByName("color")[0];
            inputSelected.style.backgroundColor = document.getElementsByName("color")[0].value;
        }
    </script>
@stop
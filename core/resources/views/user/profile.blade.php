@extends('user.layout.app')
@section('contents')

    <div class="card">
        <h3> Profile Setting </h3>
        <hr>
        <legend class="text-center">
            <img src="{{ asset('assets/user/images/'.$profileData->profile_pic) }}" class="img-thumbnail" alt="No Image">
        </legend>
        <div class="card-body">
            <form method="post" action= "{{ route('user.submit_profile_form') }}" enctype="multipart/form-data">
                @csrf
                @Method('put')
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">First name</label>
                        <input type="text" name="firstname" class="form-control form-control-lg"  placeholder="First Name" value="{{ $profileData->firstname }}">

                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServer02">Last name</label>
                        <input type="text" name="lastname" class="form-control form-control-lg"  placeholder="Last Name" value="{{ $profileData->lastname }}">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">Email</label>
                        <input type="text" name="email" class="form-control form-control-lg"  placeholder="Email" value="{{ $profileData->email }}">

                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServerUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" name="username" class="form-control is-invalid form-control-lg" placeholder="Username" value="{{ $profileData->username }}" aria-describedby="inputGroupPrepend3">

                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer02">Picture</label>
                        <input type="file" name="profile_pic" class="form-control form-control-lg" accept="image/*">
                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">Phone</label>
                        <input type="tel" name="phone" class="form-control form-control-lg"  placeholder="Phone Number" value="{{ $profileData->phone }}">

                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-4 mb-6">
                        <label for="validationServer02">Address</label>
                        <input type="text" name="address" class="form-control form-control-lg"  placeholder="Address" value="{{ $profileData->address }}">

                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer03">City</label>
                        <input type="text" name="city" value="{{ $profileData->city }}" class="form-control form-control-lg" placeholder="City">

                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer05">Country</label>
                        <input type="text" name="country" value="{{ $profileData->country }}" class="form-control form-control-lg" placeholder="Country Name">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-lg btn-block btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
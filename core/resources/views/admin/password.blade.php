
@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold mb-5">
                <h3> Password Setting </h3>
            </div>
            <div class="card-body">
                <form method="post" action = "{{ route('admin.submit_password_form') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2"> Current Password: </label>
                        <div class="col-sm-10">
                            <input type="password" name="currentPassword" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2"> New Password: </label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control form-control-lg"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2"> Confirm Password: </label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" class="form-control form-control-lg"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-lg btn-block btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
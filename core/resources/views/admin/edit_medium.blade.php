
@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">

        <div class="card-body">
            <h3> Payment Medium Updating </h3>
            <hr class="mb-5">
            <form method="POST" action = "{{ route('admin.submit_edited_medium', $mediumToUpdate->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Feature Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control form-control-lg" value="{{ $mediumToUpdate->name }}" placeholder="Name of Feature" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Logo:</label>
                    <div class="col-sm-3">
                        <img src="{{ asset('assets/admin/images/payment_medium/'.$mediumToUpdate->logo) }}" class="img-thumbnail img-fluid" alt="No Image">
                    </div>
                    <div class="col-sm-3">
                        <input type="file" name="logo" class="form-control form-control-lg" accept="image/*" placeholder="choose new preview">
                    </div>
                </div>
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
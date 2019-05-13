@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">
        <div class="card-body">
            <h3> Status Updating Form </h3>
            <hr class="mb-5">
            <form method="POST" action = "{{ route('admin.submit_edited_status', $statusToUpdate->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="validationServer01">Status Name</label>
                        <input type="text" name="name" class="form-control form-control-lg"  value="{{$statusToUpdate->name}}">
                    </div>
                </div>
                <br>
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
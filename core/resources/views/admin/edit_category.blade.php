@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">
        <div class="card-body">
            <h3> Category Updating Form </h3>
            <hr class="mb-5">
            <form method="POST" action = "{{ route('admin.submit_edited_category', $categoryToUpdate->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="validationServer01">Category Name</label>
                        <input type="text" name="name" class="form-control form-control-lg"  value="{{$categoryToUpdate->name}}">
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer01">Category URL</label>
                        <input type="text" name="url" class="form-control form-control-lg" value="{{$categoryToUpdate->url}}" >
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
@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">
        <div class="card-body">
            <h3> Vote Making Form </h3>
            <hr class="mb-5">
            <form method="POST" action = "{{ route('admin.submit_created_vote') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="validationServer01">Company Name</label>
                        <select name="companyId" class="form-control form-control-lg " required="true">
                            @foreach($allCompanies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-3">
                        <label for="validationServer02">Very Good</label>
                        <input type="number" name="satisfyingVote" class="form-control form-control-lg"  placeholder="Vote for Very Satisfied" required="true">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer02">Good</label>
                        <input type="number" name="goodVote" class="form-control form-control-lg"  placeholder="Vote for Good" required="true">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer02">Neutral</label>
                        <input type="number" name="neutralVote" class="form-control form-control-lg"  placeholder="Vote for Neutral" required="true">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer02">Bad</label>
                        <input type="number" name="badVote" class="form-control form-control-lg"  placeholder="Vote for Bad" required="true">
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
@stop
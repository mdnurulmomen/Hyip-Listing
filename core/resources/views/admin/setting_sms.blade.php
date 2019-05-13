
@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            <div class="card-body">
                <h3> SMS Settings </h3>
                <hr class="mb-5">

                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <label for="validationServer01">User Guide: </label>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Code </th>
                                    <th> Description </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> {<span>{message}</span>}</td>
                                    <td> Details Text From Script </td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> {<span>{number}</span>} </td>
                                    <td> Users Number. Will Pull From Database </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <form method="post" action = "{{ route('admin.submit_settings_sms') }}">
                                @csrf
                                @method('put')


                                <div class="form-group row">
                                    <div class="col-md-12 mb-6">
                                        <label for="validationServer01"> SMS API: </label>
                                        <input type="text" name="smsApi" class="form-control form-control-lg" value="{{ $settings->sms_api }}" required>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-bg btn-block btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
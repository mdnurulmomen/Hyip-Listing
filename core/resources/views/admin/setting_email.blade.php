
@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <div class="card mb-4">
            <div class="card-body">
                <h3> Mail Settings </h3>
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
                                    <td> Details Text From Script</td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> {<span>{name}</span>} </td>
                                    <td> Users Name. Will Pull From Database and Use in EMAIL text</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            
                                <form method="post" action = "{{ route('admin.submit_settings_mail') }}">
                                    @csrf
                                    @method('put')

                                    <div class="form-group row">
                                        <div class="col-md-12 mb-6">
                                            <label for="validationServer01">Mail From: </label>
                                            <input type="email" name="mailFrom" class="form-control form-control-lg" value="{{ $settings->mail_from }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-md-12 mb-6">
                                            <label for="validationServer01">Mail Template: </label>
                                            <textarea class="form-control form-control-lg" name="mailTemplate" id="textArea" rows="5" required>
                                                {{ $settings->mail_template }}
                                            </textarea>
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
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            bkLib.onDomLoaded(function () {
                new nicEditor({iconsPath: '{{ asset('assets/admin/images/nicEditorIcons.gif') }}'}).panelInstance('textArea');
            });
        });
    </script>
@stop
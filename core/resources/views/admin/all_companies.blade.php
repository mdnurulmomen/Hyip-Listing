
@extends('admin.layout.app')
@section('contents')

        <div class="card mb-4">
            <div class="card-body">
                <h3> Hyips List </h3>
                <hr class="mb-5">
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Serial</th>
                            <th>Company Name</th>
                            <th>Company Preview </th>
                            <th>Publish </th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    @foreach($allCompanies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>
                                <img src="{{ asset('assets/front/images/company/'.$company->preview) }}" width="25" alt="No Image">
                            </td>
                            <td>{{ $company->publish==1 ? 'Published' : 'Unpublished' }}</td>
                            <td>
                                <a href="{{ route('admin.edit_company_form', [$company->id]) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>

                                <a href="{{ route('admin.show_company_vote_form', [$company->id]) }}" class="btn btn-icon btn-pill btn-warning" data-toggle="tooltip" title="Vote"><i class="fa fa-star"></i></a>

                                <a data-toggle="modal" data-target="#myModal{{ $company->id }}" class="btn btn-icon btn-pill btn-danger delete_button" data-toggle="tooltip" title="delete">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <div id="myModal{{ $company->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form action="{{route('admin.delete_company',$company->id)}}" method="POST">
                                    @method('delete')    
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Confirmation</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Are You Sure ??</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination text-right">
            
            </div>
        </div>

  

@stop



@extends('admin.layout.app')
@section('contents')

        <div class="card mb-4">
            <div class="card-body">
                <h3> Votes List </h3>
                <hr class="mb-5">
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Serial</th>
                            <th>Company Name</th>
                            <th>Vote for Very Good</th>
                            <th>Vote for Good</th>
                            <th>Vote for Bad </th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($allVotes as $vote)
                        <tr>
                            <td>{{ $vote->id }}</td>
                            <td>{{ $vote->company->name ?? 'Deleted'}}</td>
                            <td>{{ $vote->very_good }}</td>
                            <td>{{ $vote->good }}</td>
                            <td>{{ $vote->bad }}</td>
                            <td>
                                <a href="{{ route('admin.edit_vote_form', [$vote->id]) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>

                                <a data-toggle="modal" data-target="#myModal{{ $vote->id }}" class="btn btn-icon btn-pill btn-danger delete_button" data-toggle="tooltip" title="delete">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <div id="myModal{{ $vote->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form action="{{route('admin.delete_vote',$vote->id)}}" method="POST">
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


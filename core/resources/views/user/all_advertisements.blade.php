
@extends('user.layout.app')
@section('contents')

    <script type="text/javascript">
        
        function runTimer(endTime, id)
        {
            // // Set the date we're counting down to
            var countDownDate = new Date(endTime).getTime();

            // // Update the count down every 1 second
            var x = setInterval(function() {

            //     // Get todays date and time
                var now = new Date().getTime();

            //     // Find the distance between now and the count down date
                var distance = countDownDate - now;

            //     // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            //     // Output the result in an element with id="demo"
                document.getElementById(id).innerHTML = days + "days " + hours + "hours "
                + minutes + "minutes " + seconds + "seconds ";

            //     // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
                }, 1000);
        }

    </script>

    <div class="card mb-4">
        <div class="card-body">
            <h3> Advertisements List </h3>
            <hr class="mb-5">
            <table class="table table-hover text-center" cellspacing="0" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Advertisement Serial</th>
                        <th>Size</th>
                        <th>Publish</th>
                        <th>Views</th>
                        <th>Clicks</th>
                        <th>Time Left</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($allMyAdvertisements as $advertisement)
                    <tr>
                        <td>{{ $advertisement->id }}</td>

                        <td>{{ $advertisement->sizeDetails->name }} </td>

                        <td>{{ $advertisement->status==1 ? 'Published' : 'Unpublished' }}</td>

                        <td>{{ $advertisement->status==0 ? 'NA' : $advertisement->views }}</td>

                        <td>{{ $advertisement->status==0 ? 'NA' : $advertisement->clicked }}</td>


                        <td>
                            <p id="{{$advertisement->id}}"> </p>

                            <script type="text/javascript">
                                runTimer( "{{$advertisement->end_time}}", "{{$advertisement->id}}" );
                            </script>  
                        </td>

                        <td>
                        
                            <a href="{{ route('user.edit_advertisement_form', [$advertisement->id]) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>

                        {{--
                            <a data-toggle="modal" data-target="#myModal{{ $advertisement->id }}" class="btn btn-icon btn-pill btn-danger delete_button" data-toggle="tooltip" title="delete">
                                <i class="fa fa-fw fa-trash"></i>
                            </a>
                            --}}
                                
                        </td>
                    </tr>


                {{--
                    <div id="myModal{{ $advertisement->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form action="{{route('user.delete_advertisement',$advertisement->id)}}" method="POST">
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
                        --}}

                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    

@stop



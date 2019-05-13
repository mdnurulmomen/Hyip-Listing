@extends('user.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">
        <div class="card-body">
            <h3> Available Gateways </h3>
            <hr class="mb-5">
            
            <div class="row">
                
                @foreach($allGateways as $gateway)
                <div class="col-sm-2">
                    <figure class="figure">
                        <div class="row-eq-height">
                            <img class="figure-img img-fluid rounded row-eq-height" src="{{ asset('assets/user/images/gateway/'.$gateway->id.'.jpg') }}" width="100%">
                        </div>
                        <figcaption class="figure-caption text-center mb-4">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter">
                                Pay
                            </button>
                        </figcaption>
                    </figure>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Payment Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action = "{{ route('user.submit_payment', $gateway->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="validationServer01">Amount</label>
                                    <input type="number" name="amount" class="form-control form-control-lg" placeholder="Your Amount" required="true">
                                </div>
                            </div>
                            
                            <br>
                            
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-block btn-lg btn-primary">Pay</button>
                                </div>
                            </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>

                @endforeach

                
            </div>

        </div>
    </div>
</div>

@stop
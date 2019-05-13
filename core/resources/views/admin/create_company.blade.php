@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">
        <div class="card-body">
            <h3> Hyip Creating Form </h3>
            <hr class="mb-5">
            <form method="POST" action = "{{ route('admin.submit_created_company') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-4">
                    <div class="col-md-4">
                        <label for="validationServer02">Category</label>
                        <select name="categoryId" class="form-control form-control-lg " required="true">
                            <option value="none" selected disabled="true">Please Select a Category</option>
                            @foreach($allCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Hyip Name</label>
                        <input type="text" name="name" class="form-control form-control-lg "  placeholder="Hyip Name" required="true">
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer02">Preview</label>
                        <input type="file" name="preview" class="form-control  form-control-lg" accept="image/*">
                    </div>
                </div>
               
                
                <div class="form-row mb-4">
                    <div class="col-md-4 mb-4">
                        <label for="validationServer01">Total Investment:</label>
                        <input type="number" name="totalInvestment" class="form-control form-control-lg "  placeholder="Total Investment" required="true">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer01">Withdrawal Type</label>
                        <select name="withdrawalType" class="form-control form-control-lg " required="true">
                            <option value="none" selected disabled="true">Please Select a Category</option>
                            @foreach($allWithdrawalTypes as $withdrawType)
                                <option value="{{ $withdrawType->id }}">{{ $withdrawType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServerUsername">Minimum Deposit</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@ </span>
                            </div>
                            <input type="number" name="depositMin" class="form-control form-control-lg " placeholder="Minimum Deposit"  aria-describedby="inputGroupPrepend3" required="true">
                        </div>
                    </div>
                </div>
              
                <div class="form-row mb-4">
                    <div class="col-md-4">
                        <label for="validationServer02">Monitoring From</label>
                        <input type="date" name="firstMonitored" class="form-control form-control-lg "  placeholder="Date">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer05">Total Monitored</label>
                        <input type="number" name="numberOfMonitor" class="form-control form-control-lg " placeholder="Monitoring Time">
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Last Payment</label>
                        <input type="date" name="paymentLast" class="form-control form-control-lg "  placeholder="Last Disbursement" required="true">
                    </div>
                </div>
             

                <div class="form-row mb-4">
                    <div class="col-md-4">
                        <label for="validationServer05">Features</label>
                        <div>
                            @if($allFeatures->isEmpty())
                                <div class="form-check-inline">  
                                    <label>No Feature Available</label>
                                </div>
                            @else
                                @foreach($allFeatures as $feature)
                                    <div class="form-check-inline">  
                                        <input type="checkbox" class="form-check-input" name="featureId[]" value="{{ $feature->id }}"> {{ $feature->name }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Accept</label>
                        <div>
                            @if($allPaymentMediums->isEmpty())
                                <div class="form-check-inline">  
                                    <label>No Payment Medium Available</label>
                                </div>
                            @else
                                @foreach($allPaymentMediums as $medium)
                                    <div class="form-check-inline">  
                                        <input type="checkbox" class="form-check-input" name="mediumId[]" value="{{ $medium->id }}">{{ $medium->name }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Status</label>
                        <select name="status" class="form-control form-control-lg " required="true">
                            <option value="none" selected disabled="true">Please Select a Category</option>
                            @foreach($allStatuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-row mb-4">
                    <div class="col-md-3">
                        <label for="validationServer03">Online Days</label>
                        <input type="number" name="onlineDays" class="form-control form-control-lg " placeholder="Online Days">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Rating</label>
                        <input type="number" name="rating" class="form-control form-control-lg "  max="5" placeholder="Rating in Five(5)" required="true">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Referral</label>
                        <input type="number" name="referral"  max="100" class="form-control form-control-lg "  placeholder="Percentage" required="true">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Contact</label>
                        <input type="text" name="contact_number" class="form-control form-control-lg "  placeholder="Contact_number" required="true">
                    </div>
                </div>
                
                <div class="form-row mb-4">
                    <div class="col-md-3">
                        <label for="validationServer01">Hyip ROI</label>
                        <input type="number" name="roi" class="form-control form-control-lg " placeholder="Hyip Roi" required="true">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Status Color</label>
                        <input type="text" name="status_color" class="form-control form-control-lg "  placeholder="Color Code or Name" onkeyup="backgroundColor()">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Roi Color</label>
                        <input type="text" name="roi_color" class="form-control form-control-lg "  placeholder="Color Code or Name" onkeyup="backgroundColor()">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer02">Publish</label>
                        <input type="checkbox" name="publish" checked data-toggle="toggle" data-on="Publish" data-off="Dont Publish" data-onstyle="success" data-offstyle="danger">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-12">
                        <label for="validationServer02">Description</label>
                        <textarea name="description" class="form-control" rows="5" id="textArea"></textarea>
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

<script>
    $(document).ready(function() {
        bkLib.onDomLoaded(function () {
            new nicEditor({iconsPath: '{{asset('assets/admin/images/nicEditorIcons.gif')}}'}).panelInstance('textArea');
        });
    });

    function backgroundColor () {
        var inputSelected = document.getElementsByName("status_color")[0];
        inputSelected.style.backgroundColor = document.getElementsByName("status_color")[0].value;

        var inputSelected = document.getElementsByName("roi_color")[0];
        inputSelected.style.backgroundColor = document.getElementsByName("roi_color")[0].value;
    }
</script>

@stop
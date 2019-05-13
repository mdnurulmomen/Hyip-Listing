@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <div class="card mb-4">
        <div class="card-body">
            <h3> Hyip Editing Form </h3>
            <hr class="mb-5">
            <form method="POST" action = "{{ route('admin.submit_edited_company', $companyToUpdate->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row mb-4">
                    <div class="col-md-4">
                        <label for="validationServer02">Category</label>

                        <select name="categoryId" class="form-control form-control-lg " required="true">
                            <option value="none" selected disabled="true">Please Select a Category</option>
                            @foreach($allCategories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $companyToUpdate->category_id) selected @endif >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Hyip name</label>
                        <input type="text" name="name" class="form-control form-control-lg" value="{{ $companyToUpdate->name }}" placeholder="Hyip Name" required="true">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="validationServer02">Preview</label>
                        <input type="file" name="preview" class="form-control form-control-lg" accept="image/*">
                    </div>
                </div>
                
                
                <div class="form-row mb-4">
                    <div class="col-md-4 mb-4">
                        <label for="validationServer01">Total Investment:</label>
                        <input type="number" name="totalInvestment" class="form-control form-control-lg" value="{{ $companyToUpdate->total_investment }}" placeholder="Total Investment" required="true" step="any">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer01">Withdrawal Type</label>

                        <select name="withdrawalType" class="form-control form-control-lg " required="true">
                            <option value="none" selected disabled="true">Please Select a Category</option>
                            @foreach($allWithdrawalTypes as $withdrawType)
                                <option value="{{ $withdrawType->id }}" @if($withdrawType->id == $companyToUpdate->withdrawal_type) selected @endif >{{ $withdrawType->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServerUsername">Minimum Deposit</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@ {{ $settings->currency }}</span>
                            </div>
                            <input type="number" name="depositMin" class="form-control form-control-lg" value="{{ $companyToUpdate->deposit_min }}" placeholder="Minimum Deposit"  aria-describedby="inputGroupPrepend3" required="true" step="any">
                        </div>
                    </div>
                </div>
                
                <div class="form-row mb-4">
                    <div class="col-md-4">
                        <label for="validationServer02">Monitoring From</label>
                        <input type="date" name="firstMonitored" class="form-control form-control-lg" value="{{ $companyToUpdate->first_monitored }}"  placeholder="Date">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer05">Total Monitored</label>
                        <input type="number" name="numberOfMonitor" class="form-control form-control-lg" value="{{ $companyToUpdate->number_monitor }}" placeholder="Monitoring Time" step="any">
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Last Payment</label>
                        <input type="date" name="paymentLast" class="form-control form-control-lg" value="{{ $companyToUpdate->payment_last }}" placeholder="Last Disbursement" required="true">
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col-md-4 mb-4">
                        <label for="validationServer05">Features</label>
                        <div>
                            @if($allFeatures->isEmpty())
                                <div class="form-check-inline">  
                                    <label>No Feature Available</label>
                                </div>
                            @else
                                @foreach($allFeatures as $feature)
                                    <div class="form-check-inline">  
                                        <input type="checkbox" class="form-check-input" name="featureId[]" value="{{ $feature->id }}" @if(in_array($feature->id, $companyToUpdate->company_features)) checked @endif > {{ $feature->name }}
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
                                        <input type="checkbox" class="form-check-input" name="mediumId[]" value="{{ $medium->id }}" @if(in_array($medium->id, $companyToUpdate->company_payment_medium)) checked @endif>{{ $medium->name }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationServer01">Status</label>
                        <select name="status" class="form-control form-control-lg " required="true">
                            @foreach($allStatuses as $status)
                                <option value="{{ $status->id }}" @if($status->id == $companyToUpdate->status) selected @endif ) >
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-3">
                        <label for="validationServer03">Online Days</label>
                        <input type="number" name="onlineDays" class="form-control form-control-lg" value="{{ $companyToUpdate->online_days }}" placeholder="Online Days" step="any">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Rating</label>
                        <input type="number" name="rating" class="form-control form-control-lg" value="{{ $companyToUpdate->rating }}"  max="5" placeholder="Rating in Five(5)" required="true" step="any">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Referral</label>
                        <input type="number" name="referral"  max="100"  class="form-control form-control-lg" value="{{ $companyToUpdate->referral }}" placeholder="Percentage" required="true" step="any">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Contact</label>
                        <input type="text" name="contact_number" class="form-control form-control-lg" value="{{ $companyToUpdate->contact_number }}" placeholder="Percentage" required="true" step="any">
                    </div>
 
                </div>

                <div class="form-row mb-4">
                    <div class="col-md-3">
                        <label for="validationServer01">Hyip ROI</label>
                        <input type="number" name="roi" class="form-control form-control-lg " value="{{ $companyToUpdate->roi }}" required="true">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Status Color</label>
                        <input type="text" name="status_color" class="form-control form-control-lg " value="{{ $companyToUpdate->status_color }}" onkeyup="backgroundColor()">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer01">Roi Color</label>
                        <input type="text" name="roi_color" class="form-control form-control-lg " value="{{ $companyToUpdate->roi_color }}" onkeyup="backgroundColor()">
                    </div>
                    <div class="col-md-3">
                        <label for="validationServer02">Publish</label>
                        <input type="checkbox" name="publish" data-toggle="toggle" data-on="Publish" data-off="Dont Publish" data-onstyle="success" data-offstyle="danger" @if($companyToUpdate->publish==1) checked @endif >
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col-md-12">
                        <label for="validationServer02">Description</label>
                        <textarea name="description" class="form-control" rows="7" id="textArea">{{ $companyToUpdate->description }}</textarea>
                    </div>
                </div>

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
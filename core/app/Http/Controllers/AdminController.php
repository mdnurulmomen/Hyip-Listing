<?php

namespace App\Http\Controllers;

use App\Vote;
use Carbon\Carbon;
use App\Status;
use App\Admin;
use App\AdPackage;
use App\IndexSetting;
use App\logoSetting;
use App\FooterSetting;
use App\Setting;
use App\BannerSetting;
use App\HyipSetting;
use App\Feature;
use App\Company;
use App\AdSize;
use App\AboutSetting;
use App\Advertisement;
use App\Category;
use App\DetailSetting;
use App\WithdrawalType;
use App\PaymentMedium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as ImageIntervention;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard('admin')->attempt(['username'=>$request->username, 'password'=>$request->password])){
            return redirect()->route('admin.home');
        }

        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod()
    {
        $totalHyips = Company::count();
        $totalFeatures = Feature::count();
        $totalPaymentMediums = PaymentMedium::count();
        $totalAds = Advertisement::count();
        return view('admin.home', compact('totalHyips', 'totalFeatures', 'totalPaymentMediums', 'totalAds'));
    }

    public function showProfileForm()
    {
       $profileData =  Auth::guard('admin')->user();
       return view('admin.profile', compact('profileData'));
    }

    public function submitProfileForm(Request $request)
    {
        $profileToUpdate = Auth::guard('admin')->user();

        $request->validate([
            'username'=>'required|unique:admins,username,'.$profileToUpdate->id,
            'email'=>'nullable|unique:admins,email,'.$profileToUpdate->id,
            'profile_pic'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        $profileToUpdate->firstname = $request->firstname;
        $profileToUpdate->lastname = $request->lastname;
        $profileToUpdate->username = $request->username;
        $profileToUpdate->email = $request->email;
        

        if($request->has('profile_pic')){
            $originImageFile = $request->file('profile_pic');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->resize(200, 200)->save('assets/admin/images/'.$originImageFile->hashname());
            
            $profileToUpdate->profile_pic = $originImageFile->hashname();
        }

        $profileToUpdate->phone = $request->phone;
        $profileToUpdate->address = $request->address;
        $profileToUpdate->city = $request->city;
        $profileToUpdate->country = $request->country;

        $profileToUpdate->save();

        return redirect()->back()->with('success', 'Profile Successfully Updated');
    }

    public function showPasswordForm()
    {
        return view('admin.password');
    }

    public function submitPasswordForm(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard('admin')->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password)){
            Auth::guard('admin')->user()->password = Hash::make($request->password);
            return redirect()->back()->with('success', 'Password is Updated');
        }

        return redirect()->back()->withErrors('Current Password is not Correct');
    }

    public function showGeneralSettingsForm()
    {
        $settings = Setting::firstOrFail();
        return view('admin.general_settings', compact('settings'));
    }

    public function submitGeneralSettingsForm(Request $request)
    {
        $request->validate([]);

        $settings = Setting::first();
        $settings->name = $request->name;
        $settings->color = $request->color;
        $settings->currency = $request->currency;
        $settings->currency_sign = $request->currencySign;

        $request->user_registration == 'on' ? $settings->user_registration = 1 : $settings->user_registration = 0;
        $request->email_verification == 'on' ? $settings->email_verification = 1 : $settings->email_verification = 0;
        $request->sms_verification == 'on' ? $settings->sms_verification = 1 : $settings->sms_verification = 0;

        $settings->save();

        return redirect()->back()->with('success', 'Settings are Updated');
    }

    public function showSmsSettingsForm ()
    {
        $settings = Setting::first();
        return view('admin.setting_sms', compact('settings'));
    }

    public function submitSmsSettingsForm(Request $request)
    {
        $settings = Setting::first();

        $settings->sms_api = $request->smsApi;
        $settings->save();

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function showMailSettingsForm ()
    {
        $settings = Setting::first();
        return view('admin.setting_email', compact('settings'));
    }

    public function submitMailSettingsForm (Request $request)
    {
        $settings = Setting::first();

        $settings->mail_from = $request->mailFrom;
        $settings->mail_from = $request->mailFrom;

        $settings->update(['mail_from' => $request->mailFrom, 'mail_template'=> $request->mailTemplate]);

        return redirect()->back()->with('success', 'Successfully Updated');
    }


    public function showCreateFeatureForm(Request $request)
    {
        return view('admin.create_feature');
    }

    public function submitCreatedFeature(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:features,name',
            'logo' => 'required|image',
        ]);

        $newFeature = new Feature();

        $newFeature->name = $request->name;

        $originImageFile = $request->file('logo');
        $imageInterventionObj = ImageIntervention::make($originImageFile)->encode('png');
        $imageInterventionObj->save('assets/admin/images/feature/'.$originImageFile->hashname());

        $newFeature->logo = $originImageFile->hashname();

        $newFeature->status = $request->status;

        $newFeature->save();

        return redirect()->back()->with('success', 'New Feature is Added');
    }

    public function viewFeaturesMethod(Request $request)
    {
        $allFeatures = Feature::all();
        return view('admin.all_features', compact('allFeatures'));
    }

    public function showFeatureEditForm($featureId)
    {
        $featureToUpdate = Feature::find($featureId);
        return view('admin.edit_feature', compact('featureToUpdate'));
    }

    public function submitFeatureEdited(Request $request, $featureId)
    {
        $featureToUpdate = Feature::find($featureId);

        $request->validate([
            'name' => 'required|unique:features,name,'.$featureToUpdate->id
        ]);    

        $featureToUpdate->name = $request->name;

        if($request->has('logo')){
            $originImageFile = $request->file('logo');
            $imageInterventionObj = ImageIntervention::make($originImageFile)->encode('png');
            $imageInterventionObj->save('assets/admin/images/feature/'.$originImageFile->hashname());

            $featureToUpdate->logo = $originImageFile->hashname();            
        }

        $featureToUpdate->status = $request->status;

        $featureToUpdate->save();

        return redirect()->back()->with('success', 'Feature is Updated');
    }

    /*
    public function featureDeleteMethod($featureId)
    {
        $featureToUpdate = Feature::find($featureId);
        $featureToUpdate->delete();

        return redirect()->back()->with('success', 'Feature is Deleted');
    }
    */

    public function showCreatePaymentMediumForm(Request $request)
    {
        return view('admin.create_payment_medium');
    }

    public function submitCreatedPaymentMedium(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image',
        ]);

        $newPaymentMedium = new PaymentMedium();

        $newPaymentMedium->name = $request->name;

        $originImageFile = $request->file('logo');
        $imageInterventionObj = ImageIntervention::make($originImageFile)->encode('png');
        $imageInterventionObj->save('assets/admin/images/payment_medium/'.$originImageFile->hashname());

        $newPaymentMedium->logo = $originImageFile->hashname();
        $newPaymentMedium->status = $request->status;

        $newPaymentMedium->save();
        return redirect()->back()->with('success', 'New Medium is Added');
    }

    public function viewMediumsMethod(Request $request)
    {
        $allMediums = PaymentMedium::all();
        return view('admin.all_mediums', compact('allMediums'));
    }

    public function showMediumEditForm($mediumId)
    {
        $mediumToUpdate = PaymentMedium::find($mediumId);
        return view('admin.edit_medium', compact('mediumToUpdate'));
    }

    public function submitMediumEdited(Request $request, $mediumId)
    {
        $mediumToUpdate = PaymentMedium::find($mediumId);

        $mediumToUpdate->name = $request->name;

        if($request->has('logo')){

            $originImageFile = $request->file('logo');
            $imageInterventionObj = ImageIntervention::make($originImageFile)->encode('png');
            $imageInterventionObj->save('assets/admin/images/payment_medium/'.$originImageFile->hashname());

            $mediumToUpdate->logo = $originImageFile->hashname();
        }

        $mediumToUpdate->status = $request->status;

        $mediumToUpdate->save();

        return redirect()->back()->with('success', 'Medium is Updated');
    }

    /*
    public function mediumDeleteMethod($mediumId)
    {
        $mediumToUpdate = PaymentMedium::find($mediumId);
        $mediumToUpdate->delete();

        return redirect()->back()->with('success', 'Medium is Deleted');
    }
    */

    public function showCreateCompanyForm(Request $request)
    {     
        $allCategories = Category::where('status', 1)->get();
        $allWithdrawalTypes = WithdrawalType::where('status', 1)->get();
        $allStatuses = Status::where('status', 1)->get();
        $settings = Setting::firstOrFail();
        $allFeatures =  Feature::where('status', 1)->get();
        $allPaymentMediums = PaymentMedium::where('status', 1)->get();

        return view('admin.create_company', compact('allCategories', 'allWithdrawalTypes', 'allStatuses', 'allFeatures', 'allPaymentMediums', 'settings'));
    }

    public function submitCreatedCompany(Request $request)
    {
        $request->validate([
            'categoryId'=>'required',
            'name'=>'required',
            'totalInvestment'=>'required',
            'withdrawalType'=>'required',
            'roi'=>'required',
            'depositMin'=>'required',
            'paymentLast'=>'required',
            'status'=>'required',
            'rating'=>'required',
            'referral'=>'required',
            'description'=>'required',
        ]);

        $newCompany = new Company();
        $newCompany->name = $request->name;
        $newCompany->roi = $request->roi;

        is_null($request->status_color) ? 1 : $newCompany->status_color = $request->status_color;
        is_null($request->roi_color) ? 1 : $newCompany->roi_color = $request->roi_color;

        if($request->has('preview')){
            $originImageFile = $request->file('preview');
            $imageInterventionObj = ImageIntervention::make($originImageFile)->encode('jpg');
            $imageInterventionObj->resize(125, 125)->save('assets/front/images/company/'.$originImageFile->hashname());
            $newCompany->preview = $originImageFile->hashname();
        }

        $newCompany->total_investment = $request->totalInvestment;
        $newCompany->withdrawal_type = $request->withdrawalType;
        $newCompany->deposit_min = $request->depositMin;
        $newCompany->first_monitored = $request->firstMonitored;
        $newCompany->number_monitor = $request->numberOfMonitor;
        $newCompany->payment_last = $request->paymentLast;

        if($request->has('featureId')){
            $newCompany->company_features = $request->featureId;
        }else{
            $newCompany->company_features = array();
        }

        if($request->has('mediumId')){
            $newCompany->company_payment_medium = $request->mediumId;
        }else{
            $newCompany->company_payment_medium = array();
        }

        $newCompany->status = $request->status;
        $newCompany->online_days = $request->onlineDays;
        $newCompany->rating = $request->rating;
        $newCompany->referral = $request->referral;
        $newCompany->contact_number = $request->contact_number;
        $newCompany->description = $request->description;
        $newCompany->category_id = $request->categoryId;

        if($request->publish == 'on'){
            $newCompany->publish = 1;
        }else{
            $newCompany->publish = 0;
        }
        
        
        $newCompany->save();

        return redirect()->back()->with('success', 'New Company is Created');

    }

    public function viewcompaniesPublishedMethod(Request $request)
    {
        $allCompanies = Company::where('publish', 1)->get();

        return view('admin.all_companies', compact('allCompanies'));
    }

    public function viewcompaniesUnPublishedMethod(Request $request)
    {
        $allCompanies = Company::where('publish', 0)->get();

        return view('admin.all_companies', compact('allCompanies'));
    }

    public function showCompanyEditForm($companyId)
    {
        $companyToUpdate = Company::find($companyId);

        $allCategories = Category::where('status', 1)->get();
        $allWithdrawalTypes = WithdrawalType::where('status', 1)->get();
        $allStatuses = Status::where('status', 1)->get();
        $settings = Setting::firstOrFail();
        $allFeatures =  Feature::where('status', 1)->get();
        $allPaymentMediums = PaymentMedium::where('status', 1)->get();

        return view('admin.edit_company', compact('companyToUpdate', 'allCategories', 'allWithdrawalTypes', 'allStatuses', 'settings', 'allFeatures', 'allPaymentMediums'));
    }

    public function submitCompanyEdited(Request $request, $companyId)
    {
        $companyToUpdate = Company::find($companyId);

        $request->validate([
            'categoryId'=>'required',
            'name'=>'required',
            'roi'=>'required',
            'totalInvestment'=>'required',
            'withdrawalType'=>'required',
            'depositMin'=>'required',
            'paymentLast'=>'required',
            'status'=>'required',
            'rating'=>'required',
            'referral'=>'required',
            'description'=>'required',
        ]);

        $companyToUpdate->name = $request->name;
        $companyToUpdate->roi = $request->roi;
        
        is_null($request->status_color) ? 1 : $companyToUpdate->status_color = $request->status_color;
        is_null($request->roi_color) ? 1 : $companyToUpdate->roi_color = $request->roi_color;

        if($request->has('preview')){
            $originImageFile = $request->file('preview');
            $imageInterventionObj = ImageIntervention::make($originImageFile)->encode('jpg');
            $imageInterventionObj->resize(125, 125)->save('assets/front/images/company/'.$originImageFile->hashname());
            $companyToUpdate->preview = $originImageFile->hashname();
        }

        $companyToUpdate->total_investment = $request->totalInvestment;
        $companyToUpdate->withdrawal_type = $request->withdrawalType;
        $companyToUpdate->deposit_min = $request->depositMin;
        $companyToUpdate->first_monitored = $request->firstMonitored;
        $companyToUpdate->number_monitor = $request->numberOfMonitor;
        $companyToUpdate->payment_last = $request->paymentLast;

        if($request->has('featureId')){
            $companyToUpdate->company_features = $request->featureId;
        }else{
            $companyToUpdate->company_features = array();
        }

        if($request->has('mediumId')){
           $companyToUpdate->company_payment_medium = $request->mediumId;
        }else{
            $companyToUpdate->company_payment_medium = array();
        }


        $companyToUpdate->status = $request->status;
        $companyToUpdate->online_days = $request->onlineDays;
        $companyToUpdate->rating = $request->rating;
        $companyToUpdate->referral = $request->referral;
        $companyToUpdate->contact_number = $request->contact_number;
        $companyToUpdate->description = $request->description;
        $companyToUpdate->category_id = $request->categoryId;
        


        if($request->publish == 'on'){
            $companyToUpdate->publish = 1;
        }else{
            $companyToUpdate->publish = 0;
        }


        $companyToUpdate->save();

        return redirect()->back()->with('success', 'Company is Updated');
        
    }

    public function companyDeleteMethod($companyId)
    {
        $companyToDelete = Company::find($companyId);
        is_null($companyToDelete->vote) ? : $companyToDelete->vote->delete();
        $companyToDelete->delete();

        return redirect()->back()->with('success', 'Company is Deleted');
    }

    public function showCreateVoteForm(Request $request)
    {     
        $allCompanies =  Company::all();

        if($allCompanies->isEmpty()){
            return redirect()->back()->withErrors('Please Make a Company');
        }
        return view('admin.create_vote', compact('allCompanies'));
    }

    public function submitCreatedVote(Request $request)
    {
        $request->validate([]);

        $allVotes = Vote::where('company_id', $request->companyId)->get();

        if($allVotes->count() > 0){
            return redirect()->back()->withErrors('Already have a Vote for this Company');
        }

        $newVote = new Vote();

        $newVote->very_good = $request->satisfyingVote;
        $newVote->good = $request->goodVote;
        $newVote->neutral = $request->neutralVote;
        $newVote->bad = $request->badVote;
        $newVote->company_id = $request->companyId;

        $newVote->save();

        return redirect()->back()->with('success', 'Vote is Created');
    }

    public function viewVotesMethod(Request $request)
    {
        $allVotes = Vote::all();
        return view('admin.all_votes', compact('allVotes'));
    }


    public function showVoteEditForm($voteId)
    {
        $voteToUpdate = Vote::find($voteId);

        $allCompanies =  Company::all();

        if($allCompanies->isEmpty()){
            return redirect()->back()->withErrors('Please Make Company');
        }

        return view('admin.edit_vote', compact('voteToUpdate', 'allCompanies'));
    }

    public function submitVoteEdited(Request $request, $voteId)
    {
        $request->validate([]);

        $voteToUpdate = Vote::find($voteId);

        $voteToUpdate->very_good = $request->satisfyingVote;
        $voteToUpdate->good = $request->goodVote;
        $voteToUpdate->neutral = $request->neutralVote;
        $voteToUpdate->bad = $request->badVote;
        $voteToUpdate->company_id = $request->companyId;

        $voteToUpdate->save();

        return redirect()->back()->with('success', 'Vote is Updated');
    }

    public function voteDeleteMethod($voteId)
    {
        $voteToDelete = Vote::find($voteId);
        $voteToDelete->delete();

        return redirect()->back()->with('success', 'Medium is Deleted');
    }

    public function showDirectVoteMethod($companyId)
    {
        $checkCompany = Vote::where('company_id', $companyId)->first();

        if(!is_null($checkCompany)){
            return redirect()->route('admin.edit_vote_form', $checkCompany->id);
        }

        return redirect()->route('admin.create_company_vote_form', $companyId);
    }

    public function showCompanyVoteForm($companyId)
    {
        $companyToVote =  Company::find($companyId);
        return view('admin.create_direct_vote', compact('companyToVote'));
    }

    public function showCreateCategoryForm(Request $request)
    {
        return view('admin.create_category');
    }

    public function submitCreatedCategory(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:categories,name',
            'description'=>'required',
            'status'=>'required'
        ]);

        $newCategory = new Category();

        $newCategory->name = urlencode($request->name);
        $newCategory->description = $request->description;
        
        
        $newCategory->status = $request->status;
        

        $newCategory->save();

        return redirect()->back()->with('success', 'Category is Created');
    }

    public function viewCategoriesMethod(Request $request)
    {
        $allCategories = Category::all();
        return view('admin.all_categories', compact('allCategories'));
    }

    public function showCategoryEditForm($categoryId)
    {
        $categoryToUpdate = Category::find($categoryId);
        return view('admin.edit_category', compact('categoryToUpdate'));
    }

    public function submitCategoryEdited(Request $request, $categoryId)
    {
        $categoryToUpdate = Category::find($categoryId);
        
        $request->validate([
            'name'=>'required|unique:categories,name,'.$categoryToUpdate->id,
            'description'=>'required',
            'status'=>'required'
        ]);

        $categoryToUpdate->name = urlencode($request->name);
        $categoryToUpdate->description = $request->description;

        $categoryToUpdate->status = $request->status;


        $categoryToUpdate->save();

        return redirect()->back()->with('success', 'Category is Updated');
    }

    /*
    public function categoryDeleteMethod($categoryId)
    {
        $categoryToDelete = Category::find($categoryId);
        $categoryToDelete->delete();

        return redirect()->back()->with('success', 'Category is Deleted');
    }
    */

    public function showCreateWithdrawalTypeForm(Request $request)
    {
        return view('admin.create_withdraw_type');
    }

    public function submitCreatedWithdrawalType(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:withdrawal_types,name'
        ]);

        $newWithdrawalType = new WithdrawalType();

        $newWithdrawalType->name = ucfirst($request->name);
        $newWithdrawalType->status = $request->status;

        $newWithdrawalType->save();

        return redirect()->back()->with('success', 'Withdrawal Type is Created');
    }

    public function viewWithdrawalTypeMethod(Request $request)
    {
        $allWithdrawalTypes = WithdrawalType::all();
        return view('admin.all_withdraw_types', compact('allWithdrawalTypes'));
    }


    public function showWithdrawalTypeEditForm($withdrawalTypeId)
    {
        $withdrawalTypeToUpdate = WithdrawalType::find($withdrawalTypeId);
        return view('admin.edit_withdrawal_type', compact('withdrawalTypeToUpdate'));
    }

    public function submitWithdrawalTypeEdited(Request $request, $withdrawalTypeId)
    {
        $withdrawalTypeToUpdate = WithdrawalType::find($withdrawalTypeId);
        
        $request->validate([
            'name'=>'required|unique:withdrawal_types,name,'.$withdrawalTypeToUpdate->id,
        ]);

        $withdrawalTypeToUpdate->name = ucfirst($request->name);
        $withdrawalTypeToUpdate->status = $request->status;

        $withdrawalTypeToUpdate->save();

        return redirect()->back()->with('success', 'Withdrawal Type is Updated');
    }

    /*
    public function withdrawalTypeDeleteMethod($withdrawalTypeId)
    {
        $withdrawalTypeToUpdate = WithdrawalType::find($withdrawalTypeId);
        // $withdrawalTypeToUpdate->company->isEmpty() ? : $withdrawalTypeToUpdate->company->delete();
        $withdrawalTypeToUpdate->delete();

        return redirect()->back()->with('success', 'Withdrawal Type is Deleted');
    }
    */

    public function showCreateStatusForm(Request $request)
    {
        return view('admin.create_status');
    }

    public function submitCreatedStatus(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:statuses,name'
        ]);

        $newStatus = new Status();

        $newStatus->name = $request->name;
        $newStatus->status = $request->status;

        $newStatus->save();

        return redirect()->back()->with('success', 'Status is Created');
    }

    public function viewAllStatusMethod(Request $request)
    {
        $allStatuses = Status::all();
        return view('admin.all_statuses', compact('allStatuses'));
    }


    public function showStatusEditForm($statusId)
    {
        $statusToUpdate = Status::find($statusId);
        return view('admin.edit_status', compact('statusToUpdate'));
    }

    public function submitStatusEdited(Request $request, $statusId)
    {
        $statusToUpdate = Status::find($statusId);
        
        $request->validate([
            'name'=>'required|unique:statuses,name,'.$statusToUpdate->id
        ]);

        $statusToUpdate->name = $request->name;
        $statusToUpdate->status = $request->status;

        $statusToUpdate->save();

        return redirect()->back()->with('success', 'Status is Updated');
    }

    /*
    public function statusDeleteMethod($statusId)
    {
        $statusToUpdate = Status::find($statusId);
        $statusToUpdate->delete();

        return redirect()->back()->with('success', 'Status is Deleted');
    }
    */
    
    /*
    public function showCreateAdPackageForm(Request $request)
    {    
        $allAdSizes = AdSize::where('status', 1)->get();

        if($allAdSizes->isEmpty()){
            return redirect()->back()->withErrors('Please Make Published Image Size');
        }

        return view('admin.create_ad_package', compact('allAdSizes'));
    }
    */

    public function submitCreatedAdPackage(Request $request)
    {   
        $request->validate([
            'name'=>'required|unique:ad_packages,name',
            'days'=>'required',
            'size'=>'required',
            'amount'=>'required',
        ]);

        if(AdPackage::where('days', $request->days)->where('size', $request->size)->exists()){
            return redirect()->back()->withErrors('You already have Same Scheme');
        }

        $newAdPackage = new AdPackage();
        $newAdPackage->name = $request->name;
        $newAdPackage->days = $request->days;
        $newAdPackage->size = $request->size;
        $newAdPackage->amount = $request->amount;
        $newAdPackage->status = $request->status;

        $newAdPackage->save();

        return redirect()->back()->with('success', 'New Ad Package is Created');
    }

    public function viewAllAdPackages(Request $request)
    {
        $allAdPackages = AdPackage::paginate(20);

        $allAdSizes = AdSize::where('status', 1)->get();


        return view('admin.all_ad_packages', compact('allAdPackages', 'allAdSizes'));
    }

    public function viewPublishedAdPackageMethod(Request $request)
    {
        $allAdPackages = AdPackage::where('status', 1)->paginate(20);

        $allAdSizes = AdSize::where('status', 1)->get();

        return view('admin.all_ad_packages', compact('allAdPackages', 'allAdSizes'));
    }

    public function viewUnPublishedAdPackageMethod(Request $request)
    {
        $allAdPackages = AdPackage::where('status', 0)->paginate(20);

        $allAdSizes = AdSize::where('status', 1)->get();

        return view('admin.all_ad_packages', compact('allAdPackages', 'allAdSizes'));
    }

    /*
    public function showAdPackageEditForm(Request $request)
    {    
        $allAdSizes = AdSize::where('status', 1)->get();

        if($allAdPackages->isEmpty()){
            return redirect()->back()->withErrors('Please Make Published Image Size');
        }

        return view('admin.create_ad_package', compact('allAdSizes'));
    }
    */

    public function submitAdPackageEdited(Request $request, $adPackageId)
    {
        $packageToUpdate = AdPackage::find($adPackageId);

        $request->validate([
            'name'=>'required|unique:ad_packages,name,'.$packageToUpdate->id,
            'days'=>'required',
            'size'=>'required',
            'amount'=>'required',
        ]);


        if(AdPackage::where('days', $request->days)->where('size', $request->size)->exists()){
            $packageToUpdate->name = $request->name;
            $packageToUpdate->amount = $request->amount;
            $packageToUpdate->status = $request->status;

            $packageToUpdate->save();

            return redirect()->back()->with('success', 'Ad Package is Updated');
        }

        $packageToUpdate->name = $request->name;
        $packageToUpdate->days = $request->days;
        $packageToUpdate->size = $request->size;
        $packageToUpdate->amount = $request->amount;
        $packageToUpdate->status = $request->status;

        $packageToUpdate->save();

        return redirect()->back()->with('success', 'Ad Package is Edited');
    }


    public function showCreateAdvertisementForm(Request $request)
    {    
        $allAdSizes = AdSize::where('status', 1)->get();
        $allAdPackages = AdPackage::where('status', 1)->get();

        if($allAdSizes->isEmpty()){
            return redirect()->back()->withErrors('Please Make Image Size First');
        }

        return view('admin.create_advertisement', compact('allAdSizes', 'allAdPackages'));
    }

    public function submitCreatedAdvertisement(Request $request)
    {
        $request->validate([
            'package'=>'required',
            'type'=>'required',
            'size'=>'required',
        ]);

        $newAdvertisement = new Advertisement();

        $newAdvertisement->package_id = $request->package;

        $newAdvertisement->end_time = $request->package == -1 ? -1 : Carbon::now()->addDays(AdPackage::find($request->package)->days);
        $newAdvertisement->publisher_type = 'App\Admin';
        $newAdvertisement->publisher_id = Auth::guard('admin')->user()->id;

        $newAdvertisement->type = $request->type;
        $newAdvertisement->size = $request->size;
        $request->status == 'on' ? $newAdvertisement->status = 1 : $newAdvertisement->status = 0;

        $sizeDetails = AdSize::where('id', $request->size)->first();

        if($request->type == 'banner'){

            $newAdvertisement->url = $request->url;

            if($request->has('preview')){
                $originalImageFile = $request->file('preview');
                $objIntervention = ImageIntervention::make($originalImageFile)->encode('jpg');
                $objIntervention->resize($sizeDetails->width, $sizeDetails->height)->save('assets/front/images/advertisement/'.$originalImageFile->hashname());

                $newAdvertisement->preview = $originalImageFile->hashname();
            }

        }else{

            $newAdvertisement->script = $request->script;
        }

        // $newAdvertisement->contact_number = $request->contact_number;

        $newAdvertisement->save();

        return redirect()->back()->with('success', 'Advertisement is Created');
    }

    public function viewPublishedAdvertisementMethod(Request $request)
    {
        $allAdvertisements = Advertisement::where('status', 1)->paginate(20);
        return view('admin.all_advertisements', compact('allAdvertisements'));
    }

    public function viewUnPublishedAdvertisementMethod(Request $request)
    {
        $allAdvertisements = Advertisement::where('status', 0)->paginate(20);
        return view('admin.all_advertisements', compact('allAdvertisements'));
    }    

    public function showAdvertisementEditForm($advertisementId)
    {
        $allAdSizes = AdSize::where('status', 1)->get();
        $allAdPackages = AdPackage::where('status', 1)->get();

        $advertisementToUpdate = Advertisement::find($advertisementId);

        return view('admin.edit_advertisement', compact('advertisementToUpdate', 'allAdSizes', 'allAdPackages'));
    }

    public function submitAdvertisementEdited(Request $request, $advertisementId)
    {
        $request->validate([
            'package'=>'required',
            'type'=>'required',
            'size'=>'required'
        ]);

        $advertisementToUpdate = Advertisement::find($advertisementId);

        $advertisementToUpdate->package_id = $request->package;


        $advertisementToUpdate->end_time = $request->package == -1 ? -1 : Carbon::now()->addDays(AdPackage::find($request->package)->days);

        $advertisementToUpdate->type = $request->type;
        $advertisementToUpdate->size = $request->size;
        $request->status == 'on' ? $advertisementToUpdate->status = 1 : $advertisementToUpdate->status = 0;

        $sizeDetails = AdSize::where('id', $request->size)->first();

        if($request->type == 'banner'){

            $advertisementToUpdate->url = $request->url;

            if($request->has('preview')){
                $originalImageFile = $request->file('preview');
                $objIntervention = ImageIntervention::make($originalImageFile)->encode('jpg');
                $objIntervention->resize($sizeDetails->width, $sizeDetails->height)->save('assets/front/images/advertisement/'.$originalImageFile->hashname());
                
                $advertisementToUpdate->preview = $originalImageFile->hashname();

                $advertisementToUpdate->script = null;
            }

        }else{
            $advertisementToUpdate->script = $request->script;

            $advertisementToUpdate->url = null;
            $advertisementToUpdate->preview = null;
        }

        // $advertisementToUpdate->contact_number = $request->contact_number;

        $advertisementToUpdate->save();

        return redirect()->back()->with('success', 'Advertisement is Updated');
    }

    public function advertisementDeleteMethod($advertisementId)
    {
        $advertisementToDelete = Advertisement::find($advertisementId);
        $advertisementToDelete->delete();

        return redirect()->back()->with('success', 'AdvertisementId is Deleted');
    }

    public function showCreateAdSizeForm(Request $request)
    {     
        return view('admin.create_ad_size');
    }

    public function submitCreatedAdSize(Request $request)
    {
        $request->validate([
            'width'=>'required',
            'height'=>'required',
        ]);

        $newAdSize = new AdSize();

        $newAdSize->name = $request->width.'*'.$request->height;
        $newAdSize->width = $request->width;
        $newAdSize->height = $request->height;
        $newAdSize->status = $request->status;

        $newAdSize->save();

        return redirect()->back()->with('success', 'New Ad Size is Created');
    }

    public function viewAllAdSizes(Request $request)
    {
        $allAdSizes = AdSize::paginate(20);
        return view('admin.all_ad_sizes', compact('allAdSizes'));
    }

    public function showAdSizeEditForm($adSizeId)
    {
        $adSizeToUpdate = AdSize::find($adSizeId);

        return view('admin.edit_ad_size', compact('adSizeToUpdate'));
    }

    public function submitAdSizeEdited(Request $request, $adSizeId)
    {
        $request->validate([
            'width'=>'required',
            'height'=>'required'
        ]);

        $adSizeToUpdate = AdSize::find($adSizeId);

        $adSizeToUpdate->name = $request->width.'*'.$request->height;
        $adSizeToUpdate->width = $request->width;
        $adSizeToUpdate->height = $request->height;
        $adSizeToUpdate->status = $request->status;

        $adSizeToUpdate->save();

        return redirect()->back()->with('success', 'Ad Size is Updated');
    }

    /*
    public function adSizeDeleteMethod($adSizeId)
    {
        $adSizeToToDelete = AdSize::find($adSizeId);
        $adSizeToToDelete->delete();

        return redirect()->back()->with('success', 'Ad Size is Deleted');
    }
    */

    public function showLogoSettingsForm ()
    {
        $logoSettings = LogoSetting::first();
        return view('admin.setting_logo', compact('logoSettings'));
    }

    public function submitLogoSettingsForm (Request $request)
    {
        $logoSettings = LogoSetting::first();

        if($request->has('logo')){
            $originImageFile = $request->file('logo');
            $imageObject = ImageIntervention::make($originImageFile)->encode('png');
            $imageObject->save('assets/front/images/setting/logo.png');
            
            $logoSettings->logo = 'logo.png';
        }

        if($request->has('favicon')){
            $originImageFile = $request->file('favicon');
            $imageObject = ImageIntervention::make($originImageFile)->encode('png');
            $imageObject->save('assets/front/images/setting/favicon.png');
            
            $logoSettings->favicon = 'favicon.png';
        }

        $logoSettings->save();

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function showIndexSettingsForm()
    {
        $indexSettings = IndexSetting::first();
        return view('admin.index_settings', compact('indexSettings'));
    }

    public function submitIndexSettingsForm(Request $request)
    {
        $request->validate([]);

        $indexSettings = IndexSetting::first();
        
        $indexSettings->index_heading = $request->index_heading;
        $indexSettings->learn_more_link = $request->learn_more_link;

        if($request->has('index_image')){
            $originImageFile = $request->file('index_image');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            
            $indexSettings->index_image = $originImageFile->hashname();
        }


        $indexSettings->save();

        return redirect()->back()->with('success', 'Index Page is Updated');
    }

    public function showFooterSettingsForm()
    {
        $footerSettings = FooterSetting::first();
        return view('admin.footer_settings', compact('footerSettings'));
    }

    public function submitFooterSettingsForm(Request $request)
    {
        $request->validate([]);

        $footerSettings = FooterSetting::first();
        
        if($request->has('footer_image')){
            $originImageFile = $request->file('footer_image');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            
            $footerSettings->footer_image = $originImageFile->hashname();
        }

        
        $footerSettings->footer_heading = $request->footer_heading;

        $footerSettings->contact_number = $request->contact_number;
        $footerSettings->contact_mail = $request->contact_mail;


        $footerSettings->save();

        return redirect()->back()->with('success', 'Index Page is Updated');
    }

    public function showAboutSettingsForm()
    {
        $aboutSettings = AboutSetting::first();
        return view('admin.about_settings', compact('aboutSettings'));
    }

    public function submitAboutSettingsForm(Request $request)
    {
        $request->validate([]);

        $aboutSettings = AboutSetting::first();
        
        if($request->has('about_image')){
            $originImageFile = $request->file('about_image');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            
            $aboutSettings->about_image = $originImageFile->hashname();
        }

        if($request->has('mission_image')){
            $originImageFile = $request->file('mission_image');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            
            $aboutSettings->mission_image = $originImageFile->hashname();
        }

        if($request->has('business_image')){
            $originImageFile = $request->file('business_image');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            
            $aboutSettings->business_image = $originImageFile->hashname();
        }

        
        $aboutSettings->about_heading = $request->about_heading;
        $aboutSettings->mission_heading = $request->mission_heading;
        $aboutSettings->business_heading = $request->business_heading;

        $aboutSettings->mission_description = $request->mission_description;
        $aboutSettings->business_description = $request->business_description;


        $aboutSettings->save();

        return redirect()->back()->with('success', 'About Page is Updated');
    }
 
    public function showHyipSettingsForm()
    {
        $hyipSettings = HyipSetting::first();
        return view('admin.hyip_settings', compact('hyipSettings'));
    }

    public function submitHyipSettingsForm(Request $request)
    {
        $request->validate([]);

        $hyipSettings = HyipSetting::first();
        
        if($request->has('hyip_image')){
            $originImageFile = $request->file('hyip_image');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            
            $hyipSettings->hyip_image = $originImageFile->hashname();
        }

        $hyipSettings->hyip_heading = $request->hyip_heading;

        $hyipSettings->save();

        return redirect()->back()->with('success', 'Hyip Page is Updated');
    }

   
    public function showDetailSettingsForm()
    {
        $detailSettings = DetailSetting::first();
        return view('admin.detail_settings', compact('detailSettings'));
    }

    public function submitDetailSettingsForm(Request $request)
    {
        $request->validate([]);

        $detailSettings = DetailSetting::first();
        
        if($request->has('detail_image')){
            $originImageFile = $request->file('detail_image');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            
            $detailSettings->detail_image = $originImageFile->hashname();
        }

        $detailSettings->detail_heading = $request->detail_heading;

        $detailSettings->save();

        return redirect()->back()->with('success', 'Detail Page is Updated');
    }


 
    public function showBannerSettingsForm()
    {
        $bannerSettings = BannerSetting::first();
        return view('admin.banner_settings', compact('bannerSettings'));
    }

    public function submitBannerSettingsForm(Request $request)
    {
        $request->validate([]);

        $bannerSettings = BannerSetting::first();
        
        if($request->has('banner_image')){
            $originImageFile = $request->file('banner_image');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            
            $bannerSettings->banner_image = $originImageFile->hashname();
        }

        $bannerSettings->banner_heading = $request->banner_heading;

        $bannerSettings->save();

        return redirect()->back()->with('success', 'Banner Page is Updated');
    }
    

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_form');
    }

}

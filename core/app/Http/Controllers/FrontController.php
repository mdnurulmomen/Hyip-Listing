<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
use Redirect;
use App\WithdrawalType;
use App\Status;
use App\BannerSetting;
use App\DetailSetting;
use App\Setting;
use App\Feature;
use App\AdPackage;
use App\HyipSetting;
use App\Advertisement;
use App\PaymentMedium;
use App\Company;
use App\AboutSetting;
use App\Vote;
use Carbon\Carbon;
use App\Http\Requests\AdRequest;
use App\Http\Requests\HyipRequest;
use App\AdSize;
use App\IndexSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as ImageIntervention;

class FrontController extends Controller
{
    public function indexPageMethod()
    {
    	$allCompanies = Company::where('publish', 1)->get();
        $indexSettings = IndexSetting::first();

    	return view('front.index', compact('allCompanies', 'indexSettings'));
    }

    public function aboutUsMethod()
    {
        $aboutSettings = AboutSetting::first();

        return view('front.about_us', compact('aboutSettings'));
    }

    public function addHyipRequest()
    {
        $hyipSettings = HyipSetting::first();
        $allCategories = Category::where('status', 1)->get();
        $allWithdrawalTypes = WithdrawalType::where('status', 1)->get();
        $allStatuses = Status::where('status', 1)->get();
        $settings = Setting::firstOrFail();
        $allFeatures =  Feature::where('status', 1)->get();
        $allPaymentMediums = PaymentMedium::where('status', 1)->get();
       

        return view('front.add_hyip', compact('allCategories', 'allWithdrawalTypes', 'allStatuses', 'allFeatures', 'allPaymentMediums', 'settings', 'hyipSettings'));
    }

    public function submitHyipRequest(HyipRequest $request)
    {
        $newCompany = new Company();
        $newCompany->name = $request->name;
        $newCompany->roi = $request->roi;

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
        
        $newCompany->save();

        return redirect()->back()->with('success', 'New Hyip is Sent');
    }

    public function addBannerRequest()
    {
        $bannerSettings = BannerSetting::first();
        $allCategories = Category::where('status', 1)->get();
        $allAdSizes = AdSize::where('status', 1)->get();
        $allAdPackages = AdPackage::where('status', 1)->get();
        $allAdvertisements = Advertisement::where('status', 1)->get();

        if($allAdSizes->isEmpty()){
            $allAdSizes = array();
        }
       
        return view('front.add_banner', compact('bannerSettings', 'allCategories', 'allAdSizes', 'allAdPackages', 'allAdvertisements'));
    }


    public function submitBannerRequest(AdRequest $request)
    {
        if(!Auth::guard()->check()){
            return redirect()->back()->withErrors('Sorry, You have to Sign in to Send Advertisement ');
        }

        $newAdvertisement = new Advertisement();

        $newAdvertisement->type = $request->type;
        $newAdvertisement->size = $request->size;
        $newAdvertisement->url = $request->url;
        $newAdvertisement->package_id = $request->packageId;

        $newAdvertisement->end_time = Carbon::now()->addDays(AdPackage::find($request->packageId)->days);
        $newAdvertisement->publisher_type = 'App\User';
        $newAdvertisement->publisher_id = Auth::guard()->user()->id;

        $sizeDetails = AdSize::where('id', $request->size)->first();

        if($request->has('preview')){
            $originalImageFile = $request->file('preview');
            $objIntervention = ImageIntervention::make($originalImageFile)->encode('jpg');
            $objIntervention->resize($sizeDetails->width, $sizeDetails->height)->save('assets/front/images/advertisement/'.$originalImageFile->hashname());
            $newAdvertisement->preview = $originalImageFile->hashname();
        }

        $newAdvertisement->contact_number = $request->contact_number;
        $newAdvertisement->status = 0;

        $newAdvertisement->save();

        return redirect()->back()->with('success', 'New Advertise is Sent');
    }


    public function companyDetailsMethod($companyId)
    {
        $allCategories = Category::where('status', 1)->get();
        $detailsPageSettings = DetailSetting::first();
        $companyToDescribe = Company::find($companyId);
    	return view('front.details', compact('detailsPageSettings', 'companyToDescribe', 'allCategories'));
    }

    public function categoryDetailsMethod($categoryName)
    {
    	$categoryId = Category::where('name', $categoryName)->first()->id;
    	$allCategories = Category::all();
    	$allCompanies = Company::where('category_id', $categoryId)->get();
    	return view('front.category', compact('allCategories', 'allCompanies'));
    }

    public function countAdvertisementViews($advertisementId)
    {
        $advertisementToCount = Advertisement::find($advertisementId);
        $advertisementToCount->increment('clicked');

        return Redirect::to($advertisementToCount->url);
    }
}

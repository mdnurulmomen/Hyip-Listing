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

class SettingController extends Controller
{
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
    
}

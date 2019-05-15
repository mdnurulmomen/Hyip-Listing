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

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_form');
    }

}

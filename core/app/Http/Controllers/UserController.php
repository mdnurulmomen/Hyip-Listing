<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AdSize;
use App\gatewayDetailsway;
use App\AdPackage;
use App\Advertisement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as ImageIntervention;
use jpmurray\LaravelCountdown\Countdown;

class UserController extends Controller
{
    public function submitRegisterForm(Request $request)
    {
    	$request->validate([
            'username'=>'required|unique:users,username',
            'email'=>'nullable|unique:users,email',
            'profile_pic'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        $newUser = new User();
        $newUser->firstname = $request->firstname;
        $newUser->lastname = $request->lastname;
        $newUser->username = $request->username;
        $newUser->password = Hash::make($request->password);
        $newUser->email = $request->email;

        if($request->has('profile_pic')){
            $originImageFile = $request->file('profile_pic');
            $imageObject = ImageIntervention::make($originImageFile);
            $imageObject->resize(200, 200)->save('assets/user/images/'.$originImageFile->hashname());
            
            $newUser->profile_pic = $originImageFile->hashname();
        }

        $newUser->phone = $request->phone;
        $newUser->address = $request->address;
        $newUser->city = $request->city;
        $newUser->country = $request->country;

        $newUser->save();

        return redirect()->back();
    }

    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard()->attempt(['username'=>$request->username, 'password'=>$request->password])){
            return redirect()->route('user.home');
        }

        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod()
    {
        return view('user.home');
    }


    public function showProfileForm()
    {
       $profileData =  Auth::guard()->user();
       return view('user.profile', compact('profileData'));
    }

    public function submitProfileForm(Request $request)
    {
        $profileToUpdate = Auth::guard()->user();

        $request->validate([
            'username'=>'required|unique:users,username,'.$profileToUpdate->id,
            'email'=>'nullable|unique:users,email,'.$profileToUpdate->id,
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
            $imageObject->resize(200, 200)->save('assets/user/images/'.$originImageFile->hashname());
            
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
        return view('user.password');
    }

    public function submitPasswordForm(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard()->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password)){
            Auth::guard()->user()->password = Hash::make($request->password);
            return redirect()->back()->with('success', 'Password is Updated');
        }

        return redirect()->back()->withErrors('Current Password is not Correct');
    }

    public function viewAdvertisements()
    {
        $allMyAdvertisements = Auth::guard()->user()->myAdvertisement;

        $pranto = "ok";
        return view('user.all_advertisements', compact('allMyAdvertisements', 'pranto'));
    }

    public function showAdvertisementEditForm($advertisementId)
    {
        $allAdSizes = AdSize::where('status', 1)->get();
        $allAdPackages = AdPackage::where('status', 1)->get();

        $advertisementToUpdate = Advertisement::find($advertisementId);

        return view('user.edit_advertisement', compact('advertisementToUpdate', 'allAdSizes', 'allAdPackages'));
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


        $advertisementToUpdate->end_time = Carbon::now()->addDays(AdPackage::find($request->package)->days);

        $advertisementToUpdate->type = $request->type;
        $advertisementToUpdate->size = $request->size;
        $advertisementToUpdate->status = 0;

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

        $advertisementToUpdate->contact_number = $request->contact_number;

        $advertisementToUpdate->save();

        return redirect()->back()->with('success', 'Advertisement is Updated');
    }

    /*
    public function advertisementDeleteMethod($advertisementId)
    {
        $advertisementToDelete = Advertisement::find($advertisementId);
        $advertisementToDelete->delete();

        return redirect()->back()->with('success', 'AdvertisementId is Deleted');
    }
    */

    public function showAllPaymentgatewayDetailsways()
    {
        $allgatewayDetailsways = gatewayDetailsway::where('status', 1)->get();
        return view('user.all_gatewayDetailsways', compact('allgatewayDetailsways'));
    }

    public function calculateOtherCharges(Request $request, $gatewayDetailswayId)
    {
        $request->validate([
            'amount'=>'required'
        ]);

        if($request->amount<=0)
        {
            return back()->withErrors('Invalid Amount');            
        }

        $gatewayDetailswayDetails = gatewayDetailsway::find($gatewayDetailswayId);
        
        if($gatewayDetails->minamo <= $request->amount || $gatewayDetails->maxamo >= $request->amount)
        {
            $charge = $gatewayDetails->fixed_charge + ($request->amount*$gatewayDetails->percent_charge/100);
            $usdamo = ($request->amount + $charge)/$gatewayDetails->rate;
            
            $depo['user_id'] = Auth::id();
            $depo['gatewayDetailsway_id'] = $gatewayDetails->id;
            $depo['amount'] = $request->amount;
            $depo['charge'] = $charge;
            $depo['usd_amo'] = round($usdamo,2);
            $depo['btc_amo'] = 0;
            $depo['btc_wallet'] = "";
            $depo['trx'] = str_random(16);
            $depo['try'] = 0;
            $depo['status'] = 0;
            Deposit::create($depo);
            
            Session::put('Track', $depo['trx']);
            
          return redirect()->route('deposit.preview');
            
        }
    }

    public function confirmPayment()
    {
        
    }

    public function viewPaymentsHistory()
    {
        
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('user.login_form');
    }
}

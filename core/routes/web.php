<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Payment IPN
Route::get('/ipnbtc', 'PaymentController@ipnBchain')->name('ipn.bchain');
Route::get('/ipnblockbtc', 'PaymentController@blockIpnBtc')->name('ipn.block.btc');
Route::get('/ipnblocklite', 'PaymentController@blockIpnLite')->name('ipn.block.lite');
Route::get('/ipnblockdog', 'PaymentController@blockIpnDog')->name('ipn.block.dog');
Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
Route::post('/ipncoinpaybtc', 'PaymentController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
Route::post('/ipncoinpayeth', 'PaymentController@ipnCoinPayEth')->name('ipn.coinPay.eth');
Route::post('/ipncoinpaybch', 'PaymentController@ipnCoinPayBch')->name('ipn.coinPay.bch');
Route::post('/ipncoinpaydash', 'PaymentController@ipnCoinPayDash')->name('ipn.coinPay.dash');
Route::post('/ipncoinpaydoge', 'PaymentController@ipnCoinPayDoge')->name('ipn.coinPay.doge');
Route::post('/ipncoinpayltc', 'PaymentController@ipnCoinPayLtc')->name('ipn.coinPay.ltc');
Route::post('/ipncoin', 'PaymentController@ipnCoin')->name('ipn.coinpay');
Route::post('/ipncoingate', 'PaymentController@ipnCoinGate')->name('ipn.coingate');

Route::post('/ipnpaytm', 'PaymentController@ipnPayTm')->name('ipn.paytm');
Route::post('/ipnpayeer', 'PaymentController@ipnPayEer')->name('ipn.payeer');
Route::post('/ipnpaystack', 'PaymentController@ipnPayStack')->name('ipn.paystack');
Route::post('/ipnvoguepay', 'PaymentController@ipnVoguePay')->name('ipn.voguepay');
//Payment IPN


Route::group(['prefix'=>'admin', 'middleware'=>'guest:admin'], function (){
    Route::get('/', 'AdminController@showLoginForm')->name('admin.login_form');
    Route::post('/', 'AdminController@login')->name('admin.login_submit');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth:admin'], function (){
    Route::get('home', 'AdminController@homeMethod')->name('admin.home');

    Route::get('profile', 'AdminController@showProfileForm')->name('admin.show_profile_form');
    Route::put('profile', 'AdminController@submitProfileForm')->name('admin.submit_profile_form');

    Route::get('password', 'AdminController@showPasswordForm')->name('admin.show_password_form');
    Route::post('password', 'AdminController@submitPasswordForm')->name('admin.submit_password_form');

    Route::get('settings/general', 'AdminController@showGeneralSettingsForm')->name('admin.show_settings_general');
    Route::put('settings/general', 'AdminController@submitGeneralSettingsForm')->name('admin.submit_settings_general');
  	
    Route::get('settings/sms', 'AdminController@showSmsSettingsForm')->name('admin.show_settings_sms');
    Route::put('settings/sms', 'AdminController@submitSmsSettingsForm')->name('admin.submit_settings_sms');

    Route::get('settings/mail', 'AdminController@showMailSettingsForm')->name('admin.show_settings_mail');
    Route::put('settings/mail', 'AdminController@submitMailSettingsForm')->name('admin.submit_settings_mail');

    Route::get('category/create', 'AdminController@showCreateCategoryForm')->name('admin.create_category_form');
    Route::post('category/create', 'AdminController@submitCreatedCategory')->name('admin.submit_created_category');
    Route::get('category/all', 'AdminController@viewCategoriesMethod')->name('admin.view_categories');
    Route::get('category/{categoryId}', 'AdminController@showCategoryEditForm')->name('admin.edit_category_form');
    Route::put('category/{categoryId}', 'AdminController@submitCategoryEdited')->name('admin.submit_edited_category');
    // Route::delete('category/{categoryId}', 'AdminController@categoryDeleteMethod')->name('admin.delete_category');

    Route::get('feature/create', 'AdminController@showCreateFeatureForm')->name('admin.create_feature_form');
    Route::post('feature/create', 'AdminController@submitCreatedFeature')->name('admin.submit_created_feature');
    Route::get('features/all', 'AdminController@viewFeaturesMethod')->name('admin.view_features');
    Route::get('feature/{featureId}', 'AdminController@showFeatureEditForm')->name('admin.edit_feature_form');
    Route::put('feature/{featureId}', 'AdminController@submitFeatureEdited')->name('admin.submit_edited_feature');
    Route::delete('feature/{featureId}', 'AdminController@featureDeleteMethod')->name('admin.delete_feature');

    Route::get('medium/create', 'AdminController@showCreatePaymentMediumForm')->name('admin.create_payment_medium_form');
    Route::post('medium/create', 'AdminController@submitCreatedPaymentMedium')->name('admin.submit_created_medium');
    Route::get('mediums/all/view', 'AdminController@viewMediumsMethod')->name('admin.view_payments_mediums');
    Route::get('medium/{mediumId}', 'AdminController@showMediumEditForm')->name('admin.edit_medium_form');
    Route::put('medium/{mediumId}', 'AdminController@submitMediumEdited')->name('admin.submit_edited_medium');
    Route::delete('medium/{mediumId}', 'AdminController@mediumDeleteMethod')->name('admin.delete_medium');

    Route::get('company/create', 'AdminController@showCreateCompanyForm')->name('admin.create_company_form');
    Route::post('company/create', 'AdminController@submitCreatedCompany')->name('admin.submit_created_company');
    Route::get('company/published', 'AdminController@viewcompaniesPublishedMethod')->name('admin.view_companies_published');
    Route::get('company/unpublished', 'AdminController@viewcompaniesUnPublishedMethod')->name('admin.view_companies_unpublished');
    Route::get('company/{companyId}', 'AdminController@showCompanyEditForm')->name('admin.edit_company_form');
    Route::put('company/{companyId}', 'AdminController@submitCompanyEdited')->name('admin.submit_edited_company');
    Route::delete('company/{companyId}', 'AdminController@companyDeleteMethod')->name('admin.delete_company');

    Route::get('vote/create', 'AdminController@showCreateVoteForm')->name('admin.create_vote_form');
    Route::post('vote/create', 'AdminController@submitCreatedVote')->name('admin.submit_created_vote');
    Route::get('vote/all/view', 'AdminController@viewVotesMethod')->name('admin.view_votes');
    Route::get('vote/{voteId}', 'AdminController@showVoteEditForm')->name('admin.edit_vote_form');
    Route::put('vote/{voteId}', 'AdminController@submitVoteEdited')->name('admin.submit_edited_vote');
    Route::delete('vote/{voteId}', 'AdminController@voteDeleteMethod')->name('admin.delete_vote');

    Route::get('vote/company/{companyId}', 'AdminController@showDirectVoteMethod')->name('admin.show_company_vote_form');
    Route::get('vote/company/{companyId}/create', 'AdminController@showCompanyVoteForm')->name('admin.create_company_vote_form');

    Route::get('type/withdrawal/create', 'AdminController@showCreateWithdrawalTypeForm')->name('admin.create_withdrawal_type_form');
    Route::post('type/withdrawal/create', 'AdminController@submitCreatedWithdrawalType')->name('admin.submit_created_withdrawal_type');
    Route::get('type/withdrawal/all', 'AdminController@viewWithdrawalTypeMethod')->name('admin.view_withdrawal_types');
    Route::get('type/withdrawal/{withdrawalId}', 'AdminController@showWithdrawalTypeEditForm')->name('admin.edit_withdrawal_type_form');
    Route::put('type/withdrawal/{withdrawalId}', 'AdminController@submitWithdrawalTypeEdited')->name('admin.submit_edited_withdrawal_type');
    Route::delete('type/withdrawal/{withdrawalId}', 'AdminController@withdrawalTypeDeleteMethod')->name('admin.delete_withdrawal_type');


    Route::get('status/create', 'AdminController@showCreateStatusForm')->name('admin.create_status_form');
    Route::post('status/create', 'AdminController@submitCreatedStatus')->name('admin.submit_created_status');
    Route::get('status/all', 'AdminController@viewAllStatusMethod')->name('admin.view_all_status');
    Route::get('status/{statusId}', 'AdminController@showStatusEditForm')->name('admin.edit_status_form');
    Route::put('status/{statusId}', 'AdminController@submitStatusEdited')->name('admin.submit_edited_status');
    Route::delete('status/{statusId}', 'AdminController@statusDeleteMethod')->name('admin.delete_status');

    Route::get('ad-size/create', 'AdminController@showCreateAdSizeForm')->name('admin.create_ad_size_form');
    Route::post('ad-size/create', 'AdminController@submitCreatedAdSize')->name('admin.submit_created_ad_size');
    Route::get('ad-size/all', 'AdminController@viewAllAdSizes')->name('admin.view_all_ad_sizes');
    Route::get('ad-size/{adSizeId}', 'AdminController@showAdSizeEditForm')->name('admin.edit_ad_size_form');
    Route::put('ad-size/{adSizeId}', 'AdminController@submitAdSizeEdited')->name('admin.submit_edited_ad_size');
    Route::delete('ad-size/{adSizeId}', 'AdminController@adSizeDeleteMethod')->name('admin.delete_ad_size');


    Route::post('ad-package/create', 'AdminController@submitCreatedAdPackage')->name('admin.submit_created_ad_package');
    Route::get('ad-package/all', 'AdminController@viewAllAdPackages')->name('admin.view_all_ad_packages');
    Route::get('ad-package/published', 'AdminController@viewPublishedAdPackageMethod')->name('admin.view_published_ad_packages');
    Route::get('ad-package/unpublished', 'AdminController@viewUnPublishedAdPackageMethod')->name('admin.view_unpublished_ad_packages');
    Route::put('ad-package/{adPackageId}', 'AdminController@submitAdPackageEdited')->name('admin.submit_edited_ad_package');
    // Route::delete('ad-package/{adPackageId}', 'AdminController@adPackageDeleteMethod')->name('admin.delete_ad_package');

    Route::get('advertisement/create', 'AdminController@showCreateAdvertisementForm')->name('admin.create_advertisement_form');
    Route::post('advertisement/create', 'AdminController@submitCreatedAdvertisement')->name('admin.submit_created_advertisement');

    Route::get('advertisement/published', 'AdminController@viewPublishedAdvertisementMethod')->name('admin.view_published_advertisements');
    Route::get('advertisement/unpublished', 'AdminController@viewUnPublishedAdvertisementMethod')->name('admin.view_unpublished_advertisements');

    Route::get('advertisement/{advertisementId}', 'AdminController@showAdvertisementEditForm')->name('admin.edit_advertisement_form');
    Route::put('advertisement/{advertisementId}', 'AdminController@submitAdvertisementEdited')->name('admin.submit_edited_advertisement');
    Route::delete('advertisement/{advertisementId}', 'AdminController@advertisementDeleteMethod')->name('admin.delete_advertisement');


    Route::get('settings/index', 'AdminController@showIndexSettingsForm')->name('admin.show_settings_index');
    Route::put('settings/index', 'AdminController@submitIndexSettingsForm')->name('admin.submit_settings_index');

    Route::get('settings/footer', 'AdminController@showFooterSettingsForm')->name('admin.show_settings_footer');
    Route::put('settings/footer', 'AdminController@submitFooterSettingsForm')->name('admin.submit_settings_footer');

    Route::get('settings/logo-favicon', 'AdminController@showLogoSettingsForm')->name('admin.show_settings_logo');
    Route::put('settings/logo-favicon', 'AdminController@submitLogoSettingsForm')->name('admin.submit_settings_logo');

    Route::get('settings/details', 'AdminController@showDetailSettingsForm')->name('admin.show_settings_details');
    Route::put('settings/details', 'AdminController@submitDetailSettingsForm')->name('admin.submit_settings_details');

    Route::get('settings/about', 'AdminController@showAboutSettingsForm')->name('admin.show_settings_about');
    Route::put('settings/about', 'AdminController@submitAboutSettingsForm')->name('admin.submit_settings_about');

    Route::get('settings/hyip', 'AdminController@showHyipSettingsForm')->name('admin.show_settings_hyip');
    Route::put('settings/hyip', 'AdminController@submitHyipSettingsForm')->name('admin.submit_settings_hyip');

    Route::get('settings/banner', 'AdminController@showBannerSettingsForm')->name('admin.show_settings_banner');
    Route::put('settings/banner', 'AdminController@submitBannerSettingsForm')->name('admin.submit_settings_banner');

    Route::get('logout', 'AdminController@logout')->name('admin.logout');
});


Route::group(['prefix'=>'user', 'middleware'=>'guest'], function (){
    Route::get('/', 'UserController@showLoginForm')->name('user.login_form');
    Route::post('/', 'UserController@login')->name('user.login_submit');
    Route::post('register', 'UserController@submitRegisterForm')->name('user.submit_register_form');
});

Route::group(['prefix'=>'user', 'middleware'=>'auth'], function (){

    Route::get('home', 'UserController@homeMethod')->name('user.home');

    Route::get('profile', 'UserController@showProfileForm')->name('user.show_profile_form');
    Route::put('profile', 'UserController@submitProfileForm')->name('user.submit_profile_form');

    Route::get('password', 'UserController@showPasswordForm')->name('user.show_password_form');
    Route::post('password', 'UserController@submitPasswordForm')->name('user.submit_password_form');

    Route::get('advertisements', 'UserController@viewAdvertisements')->name('user.view_advertisements');

    
    Route::get('advertisement/{advertisementId}', 'UserController@showAdvertisementEditForm')->name('user.edit_advertisement_form');
    Route::put('advertisement/{advertisementId}', 'UserController@submitAdvertisementEdited')->name('user.submit_edited_advertisement');
    Route::delete('advertisement/{advertisementId}', 'UserController@advertisementDeleteMethod')->name('user.delete_advertisement');


    Route::get('payment/create', 'UserController@showAllPaymentGateways')->name('user.create_payment');
    Route::post('payment/create/{gatewayId}', 'UserController@calculateOtherCharges')->name('user.submit_payment');
    Route::post('payment/confirm', 'UserController@confirmPayment')->name('user.confirm_payment');
    Route::get('payments-history', 'UserController@viewPaymentsHistory')->name('user.view_payments');

    Route::get('logout', 'UserController@logout')->name('user.logout');
});


Route::get('/', 'FrontController@indexPageMethod')->name('front.index');
Route::get('about', 'FrontController@aboutUsMethod')->name('front.about');
Route::get('add-hyip', 'FrontController@addHyipRequest')->name('front.add_hyip');
Route::post('add-hyip', 'FrontController@submitHyipRequest')->name('front.submit_hyip');
Route::get('add-banner', 'FrontController@addBannerRequest')->name('front.add_banner');
Route::post('add-banner', 'FrontController@submitBannerRequest')->name('front.submit_banner');
Route::get('details/{companyId}', 'FrontController@companyDetailsMethod')->name('front.company_details');
// Route::get('{categoryName}', 'FrontController@categoryDetailsMethod')->name('front.category');
Route::get('count-views/{advertisementId}', 'FrontController@countAdvertisementViews')->name('front.count_views');


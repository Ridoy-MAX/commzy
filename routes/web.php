<?php

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\RolePermissonController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AccountApprovalController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Spatie\Permission\Middlewares\PermissionMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', [HomeController::class, 'home'])->name('welcome');

Route::get('/all/category', [HomeController::class, 'all_category'])->name('all.category');



// Route::get('/category/service{categoryId}', [HomeController::class, 'category_service'])->name('category.service');
Route::get('/services', [HomeController::class, 'category_service'])->name('category.service');

Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/refund', [HomeController::class, 'refund'])->name('refund');
Route::get('/about', [HomeController::class, 'about'])->name('about');


// newsletter
Route::get('/newsletter',  [HomeController::class, 'newsletter'])->name('newsletter');
Route::post('/newsletter/store',  [HomeController::class, 'newsletter_store'])->name('newsletter.store');


// Route::get('/services/filter', [HomeController::class, 'filterServices'])->name('services.filter');




// Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','verified')->group(function () {
    // users---------------------------
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/user/list', [UserController::class, 'userlist'])->name('userlist')->middleware(PermissionMiddleware::class.':create-users');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/user/block/list', [UserController::class, 'blocklist'])->name('blocklist')->middleware(PermissionMiddleware::class.':block-users');

    Route::post('/users/restore', [UserController::class, 'restore'])->name('users.restore');

    Route::post('/user/create', [UserController::class, 'user_create'])->name('user.create');


    Route::put('/user/update/{id}', [UserController::class, 'user_update'])->name('user.update');
 
    Route::post('/user/block/{id}', [UserController::class, 'user_block'])->name('user.block');

    // Route::delete('/users/{id}', 'UserController@destroy')->name('user.softdelete');

    // profile----------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/seller/profile{id}', [ProfileController::class, 'seller_update'])->name('seller.profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/photo', [ProfileController::class, 'profile_photo'])->name('photo.upload');
    Route::get('/profile/delete{id}', [ProfileController::class, 'profile_delete'])->name('photo.delete');

    Route::post('/profile/language/add', [ProfileController::class, 'language_insert'])->name('language.insert');

    Route::post('/country/city', [ProfileController::class, 'country_city'])->name('country.city');




    Route::get('/profile/language/delete/{id}', [ProfileController::class, 'language_delete'])->name('language.delete');


    Route::post('/user/education', [ProfileController::class, 'education_store'])->name('education.store');
    Route::post('/user/update{id}', [ProfileController::class, 'education_update'])->name('education.update');
    Route::delete('/user/destroy{id}', [ProfileController::class, 'education_destroy'])->name('education.destroy');

    Route::post('/user/experience', [ProfileController::class, 'experience_store'])->name('experience.store');
    Route::post('/user/experience/update{id}', [ProfileController::class, 'experience_update'])->name('experience.update');
    Route::delete('/user/experience/destroy{id}', [ProfileController::class, 'experience_destroy'])->name('experience.destroy');

    Route::post('/user/award', [ProfileController::class, 'award_store'])->name('award.store');
    Route::post('/user/award/update{id}', [ProfileController::class, 'award_update'])->name('award.update');
    Route::delete('/user/award/destroy{id}', [ProfileController::class, 'award_destroy'])->name('award.destroy');

    Route::post('/getId', [ProfileController::class, 'getId']);

    // site setting----------------------------
    Route::get('/site/setting/privacy', [SiteSettingController::class, 'privacy'])->name('setting.privacy')->middleware(PermissionMiddleware::class.':site-settings');
    Route::post('/site/privacy/update', [SiteSettingController::class, 'privacy_update'])->name('privacy.update');

    Route::post('/site/commission/update', [SiteSettingController::class, 'commission_update'])->name('commission.update');

    Route::get('/site/setting/term', [SiteSettingController::class, 'term'])->name('setting.term')->middleware(PermissionMiddleware::class.':site-settings');
    Route::post('/site/term/update', [SiteSettingController::class, 'term_update'])->name('term.update');

    Route::get('/site/setting/refund', [SiteSettingController::class, 'refund'])->name('setting.refund')->middleware(PermissionMiddleware::class.':site-settings');
    Route::post('/site/refund/update', [SiteSettingController::class, 'refund_update'])->name('refund.update');

    Route::get('/site/setting/about', [SiteSettingController::class, 'about'])->name('setting.about')->middleware(PermissionMiddleware::class.':site-settings');
    Route::post('/site/about/update', [SiteSettingController::class, 'about_update'])->name('about.update');



    Route::get('/site/setting/banner', [SiteSettingController::class, 'banner'])->name('setting.banner');
    Route::post('/site/banner/update', [SiteSettingController::class, 'banner_update'])->name('banner.update');

    Route::post('/site/trusted/update', [SiteSettingController::class, 'trusted_create'])->name('trusted.create');
    Route::get('/site/trusted/{id}', [SiteSettingController::class, 'trusted_destroy'])->name('trusted.destroy');

    Route::post('/site/award/winner', [SiteSettingController::class, 'award_winner_update'])->name('award.winner.update');

    Route::post('/site/footer', [SiteSettingController::class, 'footer_update'])->name('footer.update');


    Route::get('/site/setting/general', [SiteSettingController::class, 'general'])->name('setting.general');
    Route::post('/site/general/update', [SiteSettingController::class, 'general_update'])->name('general.update');
    Route::get('/site/general/sitelogo{id}', [SiteSettingController::class, 'site_logo_destroy'])->name('site_logo.destroy');
    Route::get('/site/general/favicon{id}', [SiteSettingController::class, 'fav_icon_destroy'])->name('fav_icon.destroy');

    // support========================================================================================================
    Route::get('/support', [SupportController::class, 'support'])->name('support');
    Route::get('/support/view{id}', [SupportController::class, 'support_view'])->name('support.view');
    Route::post('/support/create', [SupportController::class, 'support_create'])->name('support.create');
    Route::post('/support/update{id}', [SupportController::class, 'support_update'])->name('support.update');
    Route::delete('/support/destroy{id}', [SupportController::class, 'support_destroy'])->name('support.destroy');

    Route::post('/support/chat{id}', [SupportController::class, 'support_chat'])->name('support.chat');

    // role and permission========================================================================================================
    Route::get('/role', [RolePermissonController::class, 'role'])->name('role')->middleware(PermissionMiddleware::class.':role-permission');


    Route::get('/assign/role', [RolePermissonController::class, 'assign_role'])->name('assign.role')->middleware(PermissionMiddleware::class.':role-permission');
    Route::post('/save/role', [RolePermissonController::class, 'store_role'])->name('store.role');
    Route::put('/roles/{id}', [RolePermissonController::class, 'updateRole'])->name('roles.update');
    Route::delete('/roles/{id}', [RolePermissonController::class, 'deleteRole'])->name('roles.delete');
    Route::post('/users/{id}/assign-role', [RolePermissonController::class, 'assignRole'])->name('users.assign-role');
    // service========================================================================================================
    Route::get('/service/view', [ServiceController::class, 'service'])->name('service.view')->middleware(PermissionMiddleware::class.':manage-service');
    Route::post('/service/block/{id}', [ServiceController::class, 'blockService'])->name('service.block');

    Route::post('/service/delete/{id}', [ServiceController::class, 'deleteService'])->name('service.delete');

    Route::post('/service/active/{id}', [ServiceController::class, 'activeService'])->name('service.active');


    Route::get('/service/create', [ServiceController::class, 'service_create'])->name('service.create')->middleware(PermissionMiddleware::class.':manage-service');

    Route::get('/service/information/update/view/{id}', [ServiceController::class, 'service_information_update'])->name('information.update');
    
    Route::post('/service/information', [ServiceController::class, 'service_information_store'])->name('service.information');

    Route::get('/service/details/{slug}', [ServiceController::class, 'service_details'])->name('service.details');


    Route::get('user/services/{id}', [ServiceController::class, 'user_details'])->name('user.services');

    Route::post('/service/information/update', [ServiceController::class, 'information_update'])->name('service.information.update');

    // faq
    Route::get('/service/faq/{serviceInformationId}', [ServiceController::class, 'service_faq'])->name('service.faq');
    Route::get('/service/faq/update/{id}', [ServiceController::class, 'service_faq_update'])->name('service.faq.update');
    Route::post('/service/update/save/faq/{id}', [ServiceController::class, 'faq_update_store'])->name('update.save.faq');


    Route::post('/service/save/faq/{serviceInformationId}', [ServiceController::class, 'faq_store'])->name('save.faq');
    Route::post('/service/update-faq{id}', [ServiceController::class, 'faq_update'])->name('update.faq');
    Route::delete('/faq/soft-delete/{id}', [ServiceController::class, 'softDelete'])->name('faq.softDelete');

    // gallery
    Route::get('/service/galleries/{serviceInformationId}', [ServiceController::class, 'service_gallery'])->name('service.galleries');

    Route::get('/service/galleries/update/{id}', [ServiceController::class, 'service_gallery_update'])->name('service.galleries.update');

    Route::get('/gallery/delete/{id}', [ServiceController::class, 'gallery_delete'])->name('gallery.delete');
    Route::post('/save/gallery/{serviceInformationId}', [ServiceController::class, 'save_gallery'])->name('save.gallery');

    Route::post('update/save/gallery/{id}', [ServiceController::class, 'update_save_gallery'])->name('update.save.gallery');

    //become seller========================================================================================================
    Route::get('/become/seller', [SellerController::class, 'seller'])->name('seller');
    Route::get('/become/seller/information', [SellerController::class, 'seller_information'])->name('seller.information');
    Route::get('/become/seller/extra/information', [SellerController::class, 'extra_information'])->name('extra.information');
    Route::get('/become/seller/extra/information/submit', [SellerController::class, 'submit_information'])->name('submit.information');


    Route::get('/seller/information/submit', [SellerController::class, 'handleFormSubmission'])->name('seller.information.submit');
    Route::get('/seller/information/thankyou', [SellerController::class, 'thankyou'])->name('thankyou');







    // AccountApprovalController========================================================================================================
    Route::get('/account/approval', [AccountApprovalController::class, 'account_approval'])->name('account.approval');
    Route::post('/users/approved/{id}', [AccountApprovalController::class, 'user_approval'])->name('users.approved');
    // Category========================================================================================================
    Route::get('/category/list', [CategoryController::class, 'category'])->name('category')->middleware(PermissionMiddleware::class.':category-list');
    Route::get('/category/delete', [CategoryController::class, 'category_delete'])->name('category.delete');
    Route::post('/category/create', [CategoryController::class, 'category_create'])->name('category.create');
    Route::post('/category/update/{id}', [CategoryController::class, 'category_update'])->name('category.update');
    Route::delete('/category/destroy/{id}', [CategoryController::class, 'category_destroy'])->name('category.destroy');
    //proposal=============================================================================================================

    Route::post('/service/proposal/sent', [ProposalController::class, 'proposal_sent'])->name('proposal.sent');
    Route::post('/service/proposal/modify/{id}', [ProposalController::class, 'proposal_modify'])->name('proposal.modify');
    Route::get('/service/proposal/list', [ProposalController::class, 'proposal'])->name('proposal');

    Route::post('/proposal/accept/{id}', [ProposalController::class, 'acceptProposal'])->name('proposal.accept');
    Route::post('/proposal/modify/accept/{id}', [ProposalController::class, 'modifyacceptProposal'])->name('modify.proposal.accept');


    Route::post('/proposal/decline/{id}', [ProposalController::class, 'declineProposal'])->name('proposal.decline');
    Route::post('/proposal/decline/send/{id}', [ProposalController::class, 'declineProposalsend'])->name('proposal.decline.send');
    


   // favoutrite===============================================================================

    Route::get('/my/favourite', [FavouriteController::class, 'myFavourite'])->name('myFavourite');
    Route::get('/favourite', [HomeController::class, 'favourite'])->name('favourite');
    Route::post('/favourite/save', [HomeController::class, 'favourite_save'])->name('favourite.save');

    Route::delete('/favourite/delete/{id}', [HomeController::class, 'favourite_delete'])->name('favourite.delete');

        // Route::get('/service/create', [SellerController::class, 'service_create'])->name('service.create');

    // order===================================
    Route::get('/order/list/', [OrderController::class, 'order_list'])->name('order');

    Route::get('/order/details/{id}', [OrderController::class, 'order_details'])->name('order.details');
    Route::get('/order/resolution/{id}', [OrderController::class, 'order_resulation'])->name('order.resulation');
    Route::get('/order/resolution/extend/time/{id}', [OrderController::class, 'order_extend_time'])->name('order.extend.time');

    Route::post('/order/resolution/deliver/extend/store', [OrderController::class, 'order_extend_time_store'])->name('extend.delivery.date');

    Route::post('/order/resolution/deliver/extend/cancel/{id}', [OrderController::class, 'order_extend_time_cancel'])
    ->name('extend.delivery.cancel.post');


    Route::post('/order/resolution/deliver/extend/approve/{id}', [OrderController::class, 'order_extend_time_approve'])->name('extend.delivery.approve');

    Route::post('/order/resolution/cancel/{id}', [OrderController::class, 'order_cancel'])->name('order.cancel');


    Route::patch('/order/cancel/reject/{id}', [OrderController::class, 'order_cancel_reject'])->name('order.cancel.reject');

    Route::post('/order/deliver', [OrderController::class, 'deliverWork'])->name('deliver.work');



    Route::post('/order/complete/{id}', [OrderController::class, 'order_complete'])
    ->name('order.complete.post');


    Route::post('/order/cancel/request', [OrderController::class, 'order_cancel_request'])->name('cancel.request');

    Route::post('/order/deliver/decline/{id}', [OrderController::class, 'deliverWork_cancel'])
    ->name('delivery.cancel.post');




    //chat=====================================================================
    Route::get('/inbox', [ChatController::class, 'index'])->name('message.inbox');
    Route::get('/inbox/open/{username}', [ChatController::class, 'open_conversation'])->name('open.conversation');
    Route::get('/inbox/delete/{conversation_id}', [ChatController::class, 'delete_conversation'])->name('delete.conversation');
    Route::post('/send-message/{receiverId}/{conversation_id}', [ChatController::class, 'sendMessage'])->name('sendMessage');
    Route::post('/broadcast/{receiverId}/{conversation_id}', [ChatController::class, 'broadcast'])->name('broadcast');
    Route::post('/receive', [ChatController::class, 'receive'])->name('receive');


    // checkout=============================================

    Route::get('/service/checkout/{id}', [HomeController::class, 'service_checkout'])->name('service.checkout');

    Route::get('/payment/cancel/', [HomeController::class, 'payment_cancel'])->name('payment.cancel');
    Route::get('/pay-with-paypal/{order_id}/{proposal_id}', [PaypalController::class, 'handlePayment'])->name('make.payment');

    Route::get('/confirm/order{id}', [HomeController::class, 'confirm_order'])->name('confirm.order');


    Route::get('/order/cancel', [HomeController::class, 'payment_cancel'])->name('cancelled');


    // Route::get('/order/cancel', function () {
    //     return "Your order has been cancelled";// Create a 'thankyou' Blade view for the thank you page
    // })->name('cancelled');

    Route::post('/service/checkout/store/{id}', [HomeController::class, 'checkout_store'])->name('checkout.store');

    // review=================================================
    Route::post('/service/review', [OrderController::class, 'service_review'])->name('service.review');
    Route::get('/service/review/list', [OrderController::class, 'reviews'])->name('reviews');

    //invoice=================================================================
    Route::get('/service/invoice', [InvoiceController::class, 'invoice'])->name('invoice');

    Route::get('/service/invoice/view/{id}', [InvoiceController::class, 'invoice_view'])->name('invoice.view');
    // earning==============================================================
    Route::get('/service/earning', [EarningController::class, 'earning'])->name('earning')->middleware(PermissionMiddleware::class.':seller');

    Route::get('/service/earning/request', [EarningController::class, 'earning_request'])->name('earning.request')->middleware(PermissionMiddleware::class.':account-approval');

    Route::controller(PaypalController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::get('payment-success/{order_id}', 'paymentSuccess')->name('success.payment');
    });

    Route::get('/service/payment/method', [EarningController::class, 'payment_method'])->name('withdrawn');

    Route::post('/service/payment/withdrawn/balance', [EarningController::class, 'withdrawn_balance'])->name('withdrawn.balance');

    Route::post('/service/payment/withdrawn/request', [EarningController::class, 'withdrawn_request'])->name('withdrawn.request');
    Route::post('/service/payment/withdrawn/request/accept', [EarningController::class, 'withdrawn_request_accept'])->name('withdrawn.request.accept');
    Route::post('/service/payment/withdrawn/payment/withdraw/{id}', [EarningController::class, 'updatePaymentWithdraw'])->name('update.payment.withdraw');

    // notification
    Route::post('/notifications/mark-as-unread',  [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

});

require __DIR__.'/auth.php';

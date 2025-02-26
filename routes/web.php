<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\CommissionController;
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

Route::get('login', [LoginController::class,'view_login']);
//Route::post('login_data', [LoginController::class, 'login']);
Route::post('login_data', [LoginController::class, 'check_login']);


$router->group(['middleware' => 'admin'], function () use($router) {

    //logout
    $router->get('logout',[LoginController::class, 'logout']);

    // dashboard
    $router->get('dashboard', [DashboardController::class, 'view_dashboard']);

    //profile
    $router->get('profile', [ProfileController::class, 'profile']);
    $router->post('edit_profile', [ProfileController::class, 'edit_profile']);
    $router->post('edit_password', [ProfileController::class, 'edit_password']);

    //deals
    $router->match(array('GET','POST'), 'deals', [BidsController::class, 'deals']);

    //Earnings
    $router->match(array('GET','POST'), 'earnings', [EarningController::class, 'earnings']);

    //commission
    $router->get('commission', [CommissionController::class, 'commission']);
    $router->post('add_commission', [CommissionController::class, 'add_commission']);

    // seller
    $router->match(array('GET','POST'), 'all_seller', [SellerController::class, 'all_seller']);
    $router->match(array('GET','POST'), 'seller_detail/{id}', [SellerController::class, 'seller_detail']);
    $router->get('seller_req', [SellerController::class, 'seller_req']);
    $router->post('accept_seller_req', [SellerController::class, 'accept_seller_req']);
    $router->post('reject_seller_req', [SellerController::class, 'reject_seller_req']);
    $router->post('accept_seller_docs', [SellerController::class, 'accept_seller_docs']);
    $router->post('reject_seller_docs', [SellerController::class, 'reject_seller_docs']);
    
    $router->get('document_req', [SellerController::class, 'document_req']);
  

    //dealer
    $router->match(array('GET','POST'), 'all_dealer', [DealerController::class, 'all_dealer']);
    $router->match(array('GET','POST'), 'dealer_detail/{id}', [DealerController::class, 'dealer_detail']);

    
    //filter
    $router->get('general', [SettingController::class, 'general']);
    $router->post('add_filter', [SettingController::class, 'add_filter']);
    $router->post('add_type', [SettingController::class, 'add_type']);
    $router->post('edit_filter', [SettingController::class, 'edit_filter']);
    $router->post('edit_translation', [SettingController::class, 'edit_translation']);
    $router->get('translation_cars/{id}/{type}', [SettingController::class, 'translation_cars']);
    $router->post('show_translation', [SettingController::class, 'show_translation']);




    //Auctions
    $router->match(array('GET','POST'), 'all_auction', [AuctionController::class, 'all_auction']);
    $router->get('active_auction', [AuctionController::class, 'active_auction']);
    $router->get('sold_auction', [AuctionController::class, 'sold_auction']);
    $router->get('cancel_auction', [AuctionController::class, 'cancel_auction']);
    $router->match(array('GET','POST'), 'request_auction', [AuctionController::class, 'request_auction']);
    $router->post('accept_auc_req', [AuctionController::class, 'accept_auc_req']);
    $router->post('reject_auc_req', [AuctionController::class, 'reject_auc_req']);
    $router->get('auction_detail/{id}', [AuctionController::class, 'auction_detail']);
    $router->post('latest_offer', [AuctionController::class, 'latest_offer']);


    //bids
    $router->get('bids_auction', [BidsController::class, 'bids_auction']);
    $router->match(array('GET','POST'), 'all_bids_auction', [BidsController::class, 'all_bids_auction']);
    $router->match(array('GET','POST'),'bids_detail/{id}', [BidsController::class, 'bids_detail']);

    //make
    $router->get('make', [MakeController::class, 'makes']);
    $router->post('add_make', [MakeController::class, 'add_make']);
    $router->get('models/{id}', [MakeController::class, 'models']);
    $router->post('add_model', [MakeController::class, 'add_model']);
    $router->match(array('GET','POST'),'all_cars/{id}', [MakeController::class, 'all_cars']);
    $router->match(array('GET','POST'), 'cars_make/{id}',[MakeController::class, 'cars_by_make']);
    $router->post('show_make', [MakeController::class, 'show_make']);
    $router->post('show_model/{id}', [MakeController::class, 'show_model']);


    //banner
    $router->get('banner', [BannerController::class, 'banner']);
    $router->get('add_banner', [BannerController::class, 'add_banner']);
    $router->post('add_banner_submit', [BannerController::class, 'add_banner_submit']);
    $router->post('delete_banner', [BannerController::class, 'delete_banner']);
    $router->get('edit_banner/{id}', [BannerController::class, 'edit_banner_id']);
    $router->post('edit_banner', [BannerController::class, 'edit_banner']);
    $router->post('show_banner', [BannerController::class, 'show_banner']);
    
    //bid difference
    $router->get('bid_difference', [SettingController::class, 'bid_difference']);
    $router->post('add_bid_commission', [SettingController::class, 'add_bid_commission']);


});
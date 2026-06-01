<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\EditorController;
use App\Http\Controllers\Frontend\ImageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductPaginateController;
use App\Http\Controllers\Frontend\SeoController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\VouchersController;
use App\Http\Controllers\Frontend\SubscribersController;
use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Frontend\RagistationController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\fogotPasswordController;
use App\Http\Controllers\Frontend\notificationController;



//admin controller
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\WebLogoController;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\Admin\PoliciesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\AdminListController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\NotiseController;
use App\Http\Controllers\Admin\MediaLinksController;


use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\facebookController;


Route::get('/images/{filename}', [ImageController::class, 'show']);
/*Route::get('/', function () {
    return view('Frontend.index');
});*/
//ini

Route::get('/', function () {return view('Frontend.index'); });

//google login controller
Route::get('auth/google',[GoogleController::class,'googleLogin'])->name('auth.google');
Route::get('/google/login',[GoogleController::class,'googleAuthentication'])->name('google.login');

//google login controller
Route::get('auth/facebook',[facebookController::class,'facebookLogin'])->name('auth.facebook');
//Route::get('/facebook/login',[facebookController::class,'facebookAuthentication'])->name('facebook.login');
Route::get('/facebook/login', function () {return view('welcome'); });



//PDF route section

//Route::get('/check-php', function () {
  //  phpinfo();
//});
//ini


//all admin route section
use App\Http\Middleware\CheckAdmin;

Route::middleware([CheckAdmin::class])->group(function () {


  Route::get('/admin/dashboord/', [DashboardController::class,'dashboord'])->name('admin.dashboord');

  Route::get('/admin/user/', function () {return view('Admin.user.user'); });
  Route::get('/admin/order/', function () {return view('Admin.order.order'); });
  Route::get('/admin/order_items/', function () {return view('Admin.order.order_items'); });
  Route::get('/admin/Payment/', function () {return view('Admin.Payment'); });
  Route::get('/admin/Review/', function () {return view('Admin.Review'); });
  Route::get('/admin/cart/', function () {return view('Admin.cart'); });
  Route::get('/admin/Security/', function () {return view('Admin.Security'); });
  Route::get('/admin/genaler_setting/', function () {return view('Admin.genarel-setting.genarel_setting'); });
  Route::get('/admin/product', function () {return view('Admin.products.product');})->name('admin.product');
  Route::get('/admin/banner', function () {return view('Admin.banner');})->name('admin.banner');
  Route::get('/admin/edite_product', function () {return view('Admin.product_edit'); });
  Route::get('/admin/category', function () {return view('Admin.category-subcategory.category'); });
  Route::get('/admin/seo_satting', function () {return view('Admin.seo-setting.seo_setting'); });
  Route::get('123', function () {return view('admin.admin'); })->name('admin.123');
  //page route
  Route::get('/admin/comment', function () {return view('Admin.admin'); });
  Route::get('/admin/Brand', function () {return view('Admin.Brand'); });
  Route::get('/admin/Vouchers/', function () {return view('Admin.Voucher'); })->name('admin.Voucher');
  Route::get('/admin/Help/', function () {return view('Admin.Help'); })->name('admin.Help');
  Route::get('/admin/Policies/', function () {return view('Admin.Policies'); })->name('admin.Policies');
  Route::get('/admin/About/', function () {return view('Admin.about'); })->name('admin.About');


  //dashboard

  //admin list
  Route::post('/admin/FetchAdminList', [AdminListController::class, 'FetchAdminList'])->name('FetchAdminList');
  Route::post('/admin/AdminDelete', [AdminListController::class, 'AdminDelete'])->name('AdminDelete');
  Route::post('/admin/actionButton', [AdminListController::class, 'actionButton'])->name('actionButton');
  Route::post('/admin/accessControll', [AdminListController::class, 'accessControll'])->name('accessControll');
  Route::post('/admin/AdminDatilsAndAccess', [AdminListController::class, 'AdminDatilsAndAccess'])->name('AdminDatilsAndAccess');
  Route::post('/admin/update-last-seen-logout', [AdminListController::class, 'updatelastseenlogout'])->name('updatelastseenlogout');
  Route::post('/admin/AccessInAble', [AdminListController::class, 'AccessInAble'])->name('AccessInAble');
  Route::post('/admin/adminPage', [AccessController::class, 'adminInsertPage'])->name('adminPage');
  Route::post('/admin/FetchAdminPage', [AccessController::class, 'FetchAdminPage'])->name('FetchAdminPage');
  Route::post('/admin/statusUpadate', [AccessController::class, 'statusUpadate'])->name('statusUpadate');
  Route::post('/admin/deleteAdminPage', [AccessController::class, 'deleteAdminPage'])->name('deleteAdminPage');



  //security_setting
  Route::post('/admin/password_Policies_fetch', [SecurityController::class, 'password_Policies_fetch'])->name('password_Policies_fetch');
  Route::post('/admin/updatePasswordPolicies', [SecurityController::class, 'updatePasswordPolicies'])->name('updatePasswordPolicies');
  //processing OrderController
  Route::post('/admin/process_order', [DashboardController::class,'process_order'])->name('admin.process_order');
  Route::post('/admin/product/stok/limit', [DashboardController::class, 'productStokLimit'])->name('admin.product.stok.limit');
  Route::post('/admin/product/update/stok/limit', [DashboardController::class, 'updateStockLimit'])->name('admin.product.update.stok.limit');
  Route::post('/admin/NewOrder',[DashboardController::class,'Neworder'])->name('admin.Neworder');

  //ajax request
  Route::post('/admin/user/index', [AdminUserController::class,'index'])->name('admin.user.index');
  Route::post('/admin/useractiveUnactiv', [AdminUserController::class, 'useractiveUnactiv'])->name('useractiveUnactiv');
  Route::post('/admin/userdeteils', [AdminUserController::class,'delails'])->name('admin.user.details');
  Route::post('/admin/userorderItem', [AdminUserController::class, 'userorderItem'])->name('userorderItem');

  //payment section
  Route::post('/admin/payment/index', [PaymentController::class,'index'])->name('admin.payment.index');
  Route::post('/admin/Payment/details', [PaymentController::class,'details'])->name('admin..Payment.details');
  Route::post('/admin/PaymentOrderItem', [PaymentController::class, 'PaymentOrderItem'])->name('PaymentOrderItem');
  //review
  Route::post('/admin/review/index', [ReviewController::class, 'index'])->name('Fetch_Review');
  Route::post('/admin/Reviewdeteils', [ReviewController::class, 'Reviewdeteils'])->name('Reviewdeteils');
  Route::post('/admin/ReviewProduct', [ReviewController::class, 'ReviewProduct'])->name('ReviewProduct');
  Route::post('/admin/editReview', [ReviewController::class, 'editReview'])->name('editReview');
  Route::post('/admin/ReviewImgdelete', [ReviewController::class, 'ReviewImgdelete'])->name('ReviewImgdelete');
  //ajax request
  Route::post('/admin/order/index', [AdminOrderController::class, 'index'])->name('admin.order.index');
  Route::post('/admin/order/status/update', [AdminOrderController::class,'OrderStatusUpdate'])->name('admin.order.status.update');
  Route::post('/admin/order/deteils', [AdminOrderController::class,'OrderDeteils'])->name('admin.order.deteils');


  //admim CartController
  Route::post('/admin/cart/index', [AdminCartController::class, 'index'])->name('admin.cart.index');
  Route::post('/admin/cart/details', [AdminCartController::class, 'details'])->name('admin.cart.details');


  Route::get('/admin/admin-list/', [AdminListController::class, 'chackSoparAdmin']);

  Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
  //insert web logo
  Route::post('/admin/insertWebLogo', [WebLogoController::class, 'insertWebLogo'])->name('insertWebLogo');
  Route::post('/admin/fetchweblogo', [WebLogoController::class, 'fetchweblogo'])->name('fetchweblogo');
  //Route::match(['get', 'post'], '/Control-panel', [AdminController::class,'handle']);
   //insert admin
  Route::POST('/admin/insert_admin',[AdminController::class,'insert_admin'])->name('insert_admin');
  Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
 //Insert NewsletterController
  Route::post('/admin/newsletter/update', [NewsletterController::class, 'update'])->name('admin.newsletter.update');
  Route::post('/admin/newsletter/index', [NewsletterController::class,'index'])->name('admin.newsletter.index');
  //insert media links
  Route::post('/admin/insertMediaLinks', [MediaLinksController::class, 'insertMediaLinks'])->name('insertMediaLinks');
  Route::post('/admin/fetchMediaLinks', [MediaLinksController::class, 'fetchMediaLinks'])->name('fetchMediaLinks');

  //CategoryController route
  Route::POST('/admin/category/create',[CategoryController::class,'create'])->name('admin.category.create');
  Route::POST('/admin/category/update',[CategoryController::class,'update'])->name('admin.category.update');
  Route::POST('/admin/category/index',[CategoryController::class,'index'])->name('admin.category.index');
  Route::POST('/admin/category/delete',[CategoryController::class,'delete'])->name('admin.category.delete');
  Route::POST('/admin/category/featured/update',[CategoryController::class,'featuredUpdate'])->name('admin.category.featured.update');
  Route::POST('/admin/category/status/update',[CategoryController::class,'statusUpdate'])->name('admin.category.status.update');
  Route::POST('/admin/category/deteails',[CategoryController::class,'deteails'])->name('admin.category.deteails');

//subcategory route section

  Route::POST('/admin/subcategory/create',[SubcategoryController::class,'create'])->name('admin.subcategory.create');
  Route::POST('/admin/subcategory/index',[SubcategoryController::class,'index'])->name('admin.subcategory.index');
  Route::POST('/admin/subcategory/index/oldData',[SubcategoryController::class,'oldData'])->name('admin.subcategory.index.oldData');
  Route::POST('/admin/subcategory/update',[SubcategoryController::class,'update'])->name('admin.subcategory.update');
  Route::POST('/admin/subcategory/delete',[SubcategoryController::class,'delete'])->name('admin.subcategory.delete');
  Route::POST('/admin/subcategory/featured/update',[SubcategoryController::class,'featuredUpdate'])->name('admin.subcategory.featured.update');
  Route::POST('/admin/subcategory/status/update',[SubcategoryController::class,'statusUpdate'])->name('admin.subcategory.status.update');
  Route::POST('/admin/subcategory/deteails',[SubcategoryController::class,'deteails'])->name('admin.subcategory.deteails');
  // routes/web.php
  //seo-setting Route
  Route::POST('/admin/update_seo',[SeoController::class,'update_seo'])->name('update_seo');
  Route::POST('/admin/fetch_seo',[SeoController::class,'fetch_seo'])->name('fetch_seo');
  Route::POST('/admin/pageSEOinsert',[SeoController::class,'pageSEOinsert'])->name('pageSEOinsert');
  Route::POST('/admin/page_fetch_seo',[SeoController::class,'page_fetch_seo'])->name('page_fetch_seo');
  Route::POST('/admin/editpageSEOinsert',[SeoController::class,'editpageSEOinsert'])->name('editpageSEOinsert');
  Route::POST('/admin/deletepageSEO',[SeoController::class,'deletepageSEO'])->name('deletepageSEO');
  //Voucher section
  Route::POST('/admin/InsertVoucher',[VouchersController::class,'InsertVoucher'])->name('InsertVoucher');
  Route::get('/admin/Fetchvoucher',[VouchersController::class,'Fetchvoucher'])->name('Fetchvoucher');
  Route::POST('/admin/edite_voucher',[VouchersController::class,'edite_voucher'])->name('edite_voucher');
  Route::POST('/admin/deletevoucher',[VouchersController::class,'deletevoucher'])->name('deletevoucher');
  //UserController voucher
  //BrandController Route
  Route::POST('/admin/brand/create',[BrandController::class,'create'])->name('admin.brand.create');
  Route::POST('/admin/brand/index',[BrandController::class,'index'])->name('admin.brand.index');
  Route::POST('/admin/brand/update',[BrandController::class,'update'])->name('admin.brand.update');
  Route::POST('/admin/brand/delete',[BrandController::class,'delete'])->name('admin.brand.delete');
  Route::POST('/admin/brand/status/update',[BrandController::class,'statusUpdate'])->name('admin.brand.status.update');
  //banners Route
  Route::POST('/admin/insert_banners',[BannerController::class,'create'])->name('admin.insert_banners');
  Route::get('/admin/fetch_banner',[BannerController::class,'index'])->name('admin.fetch_banner');
  Route::POST('/admin/edite_banners',[BannerController::class,'update'])->name('admin.edite_banners');
  Route::POST('/admin/deleteservices',[BannerController::class,'deleteservices'])->name('deleteservices');
  //ganaral satting
  Route::POST('/admin/insertnoise',[NotiseController::class,'insertnoise'])->name('insertnoise');
  Route::POST('/admin/notisefetch',[NotiseController::class,'notisefetch'])->name('notisefetch');
  Route::POST('/admin/switchValue',[NotiseController::class,'switchValue'])->name('switchValue');
  Route::POST('/admin/pageswitch',[NotiseController::class,'pageswitch'])->name('pageswitch');
  Route::POST('/admin/fetchpageswitch',[NotiseController::class,'fetchpageswitch'])->name('fetchpageswitch');
  Route::POST('/admin/paymentpageswitch',[NotiseController::class,'paymentpageswitch'])->name('paymentpageswitch');
  Route::POST('/admin/fetchpaymentpageswitch',[NotiseController::class,'fetchpaymentpageswitch'])->name('fetchpaymentpageswitch');
  //admin OrderController
  Route::get('/admin/order/{slug}', function () {return view('admin_all_table'); });
  Route::POST('/admin/adminFetchorder',[OrderController::class,'adminFetchorder'])->name('admin.adminFetchorder');
  //prodect Route section
  Route::POST('/admin/product/create',[ProductController::class,'create'])->name('admin.product.create');
  Route::POST('/admin/product/index',[ProductController::class,'index'])->name('admin.product.index');
  Route::POST('/admin/product/status/update',[ProductController::class,'statusUpdate'])->name('admin.product.status.update');
  Route::POST('/admin/product/update',[ProductController::class,'update'])->name('admin.product.update');
  Route::POST('/admin/product/delete',[ProductController::class,'delete'])->name('admin.product.delete');
  Route::POST('/admin/product/add/img',[ProductController::class,'productAddImg'])->name('admin.product.add.img');
  Route::POST('/admin/product/images/index',[ProductController::class,'imgIndex'])->name('product_images_fetch');
  Route::POST('/admin/product/images/delete',[ProductController::class,'imagesDelete'])->name('admin.product.images.delete');
  Route::POST('/admin/product/show',[ProductController::class,'show'])->name('admin.product.show');
  Route::POST('admin/Fetch_subcategory_product',[ProductController::class,'Fetch_subcategory_product'])->name('Fetch_subcategory_product');
  //Insert Help
  Route::POST('/admin/help/store',[HelpController::class,'store'])->name('admin.help.store');
  Route::get('/admin/help/index',[HelpController::class,'index'])->name('admin.help.index');
  //Insert PoliciesController
  Route::POST('/admin/policie/store',[PoliciesController::class,'store'])->name('admin.policie.store');
  Route::get('/admin/policie/index',[PoliciesController::class,'index'])->name('admin.policie.index');
  //Insert AboutController
  Route::POST('/admin/about/store',[AboutController::class,'store'])->name('admin.about.store');
  Route::get('/admin/about/index',[AboutController::class,'index'])->name('admin.about.index');

});
Route::get('/Control-panel', function () {return view('Admin.admin.Control_panel');})->name('control.panel');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

//end admin route section

Route::get('Show', function () {return view('Show'); });


//UserController route section
Route::get('/category', function () {return view('Frontend.category'); });
Route::get('/prodect_detels', function () {return view('Frontend.prodect_direls'); });
Route::get('/shoping_info', function () {return view('Frontend.shoping_info'); });
Route::get('/return_police', function () {return view('Frontend.return_police'); });
Route::get('/contect', function () {return view('Frontend.contect'); });
Route::get('/policiesl', function () {return view('Frontend.policies'); });
Route::get('/feedback', function () {return view('Frontend.feedback'); });
Route::get('/payment-option', function () {return view('Frontend.PaymentOption'); });
Route::get('/affiliate', function () {return view('Frontend.affiliate'); });
Route::post('/feedback/index', [FeedbackController::class,'index'])->name('feedback.index');
Route::post('/user/subscribe', [SubscribersController::class,'subscribe'])->name('user.subscribe');

//set UserController middielwere

use App\Http\Middleware\CheckUserLogin;
Route::middleware([CheckUserLogin::class])->group(function () {
  Route::get('/home/chackout', function () {return view('Frontend.chackout'); });
   //insert UserController FeedbackController
  Route::post('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
  //User insert profile
  Route::post('/user/profile/create', [UserProfileController::class,'create'])->name('user.profile.create');
  Route::post('/profile_fetch', [UserProfileController::class,'profile_fetch'])->name('profile_fetch');
  Route::post('/emailinsert', [UserProfileController::class,'emailinsert'])->name('emailinsert');
  Route::post('/user/info/create', [UserProfileController::class,'createInfo'])->name('user.info.create');
  Route::post('/user/info/index', [UserProfileController::class,'indexInfo'])->name('user.info.index');
  Route::post('/chackpasswordforchang', [UserProfileController::class,'chackpasswordforchang'])->name('chackpasswordforchang');
  Route::post('/setnewpassword', [UserProfileController::class,'setnewpassword'])->name('setnewpassword');
  //User rating section
  Route::POST('/user/rating/create',[RatingController::class,'create'])->name('user.rating.create');
  //OrderController route section
  Route::POST('/order/create',[CartController::class,'orderCreate'])->name('order.create');
  Route::POST('/index/order/item',[OrderController::class,'fetchorderItem'])->name('index.order.item');
  Route::POST('/order/pless',[OrderController::class,'plassorder'])->name('order.plessr');
  Route::get('/chackout/payment-mathod', function () { return
  view('Frontend.chackout'); });
  Route::get('/chackout/payment/{slug}', function () { return view('Frontend.chackout'); });
  Route::POST('/order/index',[OrderController::class,'index'])->name('order.index');
  Route::POST('/cashondelivery',[OrderController::class,'cashondelivery'])->name('cashondelivery');
  Route::POST('/user/order/info',[OrderController::class,'userOrderInfo'])->name('user.order.info');
  Route::POST('/SearchController/OrderController',[OrderController::class,'SearchControllerOrderController'])->name('SearchControllerOrderController');
  //add to CartControllers section
  Route::POST('/chackout/index',[CartController::class,'chackoutIndex'])->name('chackout.index');
  //address section
  Route::POST('/user/address/create',[UserController::class,'createAddress'])->name('user.address.create');
  Route::POST('/user/address/index',[UserController::class,'indexAddress'])->name('user.address.index');
  Route::POST('/user/address/delete',[UserController::class,'deleteAddress'])->name('user.address.delete');
  //forgot password route section
  Route::POST('/notification/index',[notificationController::class,'index'])->name('notification.index');

});

//crat route section
  Route::POST('/cart/create',[CartController::class,'create'])->name('cart.create');
  Route::POST('/cart/index',[CartController::class,'index'])->name('cart.index');
  Route::POST('/carts/product/index',[CartController::class,'cartsProductIndex'])->name('carts.product.index');
  Route::POST('/cart/quantity',[CartController::class,'quantity'])->name('cart.quantity');
  Route::POST('/cart/delete',[CartController::class,'delete'])->name('cart.delete');






  Route::POST('/user/session/chack',[UserDashboardController::class,'UserSessionChack'])->name('dashbord.session.chack');

Route::POST('/insert/new/password',[fogotPasswordController::class,'insertnewpassword'])->name('insert.new.password');
Route::POST('/forgot/phonenumber/chack',[fogotPasswordController::class,'phonenumberChack'])->name('forgot.phonenumber.chack');
Route::post('/search/item',[SearchController::class,'search_item'])->name('search.item');
Route::get('/search',[SearchController::class,'send_search_input'])->name('search');
//AboutController
Route::get('/help', [HelpController::class, 'help']);
Route::get('/policies', [PoliciesController::class, 'policies']);
//HelpController show
Route::get('/about', [AboutController::class, 'about']);
//ProductPaginateController
Route::get('/Market-look', [ProductPaginateController::class, 'MarketLook']);
Route::get('/ALL-PRODUCTS', [ProductPaginateController::class, 'All_product']);
Route::get('/category/{Categoryname}/{slug}', [ProductPaginateController::class, 'subcategory']);
Route::get('/category/{slug}', [ProductPaginateController::class, 'category']);
Route::get('/product/{slug}', [ProductPaginateController::class, 'productdetels'])->name('product.details');
Route::get('/', [ProductPaginateController::class, 'home'])->name('home');
//chackVoucher
Route::POST('/chack/voucher',[VouchersController::class,'chack'])->name('chack.voucher');
//User ratting section
Route::get('/ratting/{slug}', [RatingController::class, 'productdetels']);
Route::POST('/user/rating/index',[RatingController::class,'index'])->name('user.rating.index');

Route::POST('/user/sinup',[RagistationController::class,'userSinup'])->name('user.sinup');
Route::POST('/otpchack',[RagistationController::class,'otpchack'])->name('/otpchack');
Route::POST('/userinfosend',[RagistationController::class,'userinfosend'])->name('/userinfosend');
Route::POST('/resendotp',[RagistationController::class,'resendotp'])->name('/resendotp');


//UserController function section
Route::POST('/user/login',[LoginController::class,'login'])->name('user.login');
Route::POST('/user/logout',[LoginController::class,'Logout'])->name('user.logout');


Route::get('/editor', [EditorController::class, 'index']);
//header CategoryController fetch
Route::get('/Fetch_category',[CategoryController::class,'Fetch_category'])->name('Fetch_category');
//header subCategoryController fetch
Route::POST('/Fetch_subcategory',[CategoryController::class,'Fetch_subcategory'])->name('Fetch_subcategory');
//fetch baner
Route::get('/fetchBannner',[BannerController::class,'index'])->name('fetchBannner');
// fetch notice
Route::POST('/notisefetch',[BannerController::class,'notisefetch'])->name('notisefetch');
Route::POST('/newsletter/index', [NewsletterController::class,'index'])->name('newsletter.index');


//Auth::routes();
//Route::get('/admin/home/', [App\Http\Controllers\HomeController::class, '__construct'])->name('home');


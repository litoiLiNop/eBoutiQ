<?php

use App\Http\Controllers\User\CompareController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\ShippingAreaController;


use App\Http\Middleware\RedirectIfAuthenticated;

use App\Http\Controllers\Backend\SubCategoryController;

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\SliderController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;


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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/', [IndexController::class, 'Index']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');


}); //Fin du Groupe Middleware


require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');




});

Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'VendorLogout'])->name('vendor.logout');

    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');

    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');

    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');

    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');


    // Vendor Add Product All Route
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');

        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');

        Route::post('/vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thumbnail', 'VendorUpdateProductThumbnail')->name('vendor.update.product.thumbnail');

        Route::post('/vendor/update/product/multiimage', 'VendorUpdateProductmultiImage')->name('vendor.update.product.multiimage');

        Route::get('/vendor/product/multiimg/delete/{id}', 'VendorMultiimgDelete')->name('vendor.product.multiimg.delete');

        Route::get('/vendor/product/inactive/{id}', 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}', 'VendorProductActive')->name('vendor.product.active');

        Route::get('/vendor/delete/product/{id}', 'VendorProductDelete')->name('vendor.delete.product');

        Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubCategory');


    });






});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
;

Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Brand All Route
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/update/brand', 'UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');

    });

    // Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');

    });



    // SubCategory All Route
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');

        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory')->name('delete.subcategory');

    });


    // Vendor Active and Inactive All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve', 'InActiveVendorApprove')->name('inactive.vendor.approve');

    });

    // Product All Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::post('/update/product/thumbnail', 'UpdateProductThumbnail')->name('update.product.thumbnail');
        Route::post('/update/product/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::get('/product/multiimg/delete/{id}', 'MulitImageDelete')->name('product.multiimg.delete');

        Route::get('/product/inactive/{id}', 'ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'ProductActive')->name('product.active');
        Route::get('/delete/product/{id}', 'ProductDelete')->name('delete.product');


    });

    // Slider All Route
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');

    });

    // Banner All Route
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');

    });

    // Coupon All Route
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon', 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');

    });


    // Shipping region All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/region', 'AllRegion')->name('all.region');
        Route::get('/add/region', 'AddRegion')->name('add.region');
        Route::post('/store/region', 'StoreRegion')->name('store.region');
        Route::get('/edit/region/{id}', 'EditRegion')->name('edit.region');
        Route::post('/update/region', 'UpdateRegion')->name('update.region');
        Route::get('/delete/region/{id}', 'DeleteRegion')->name('delete.region');

    });


    // Shipping Ville All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/ville', 'AllVille')->name('all.ville');
        Route::get('/add/ville', 'AddVille')->name('add.ville');
        Route::post('/store/ville', 'StoreVille')->name('store.ville');
        Route::get('/edit/ville/{id}', 'EditVille')->name('edit.ville');
        Route::post('/update/ville', 'UpdateVille')->name('update.ville');
        Route::get('/delete/ville/{id}', 'DeleteVille')->name('delete.ville');

    });

    // Shipping Quartier All Route
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/quartier', 'AllQuartier')->name('all.quartier');
        Route::get('/add/quartier', 'AddQuartier')->name('add.quartier');
        Route::post('/store/quartier', 'StoreQuartier')->name('store.quartier');
        Route::get('/edit/quartier/{id}', 'EditQuartier')->name('edit.quartier');
        Route::post('/update/quartier', 'UpdateQuartier')->name('update.quartier');

        Route::get('/delete/quartier/{id}', 'DeleteQuartier')->name('delete.quartier');
        Route::get('/ville/ajax/{region_id}', 'GetVille');

    });







}); // Admin End Middleware

/// Frontend Product Details All Route

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);

Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Product view Modal with Ajax

Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

//Add to cart store data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
// Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

// Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

// Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);

// Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);


Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);


Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);


Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);

/// Add to Compare
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

/// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Checkout Page Route
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');




//Start Group User Middleware

Route::middleware(['auth', 'role:user'])->group(function () {


    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishlistProduct');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');


    });

    // Compare All Route
    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'AllCompare')->name('compare');
        Route::get('/get-compare-product', 'GetCompareProduct');

        Route::get('/compare-remove/{id}', 'CompareRemove');
    });

    // Cart All Route
    Route::controller(CartController::class)->group(function () {
        Route::get('/mycart', 'MyCart')->name('mycart');
        Route::get('/get-cart-product', 'GetCartProduct');
        Route::get('/cart-remove/{rowId}', 'CartRemove');

        Route::get('/cart-decrement/{rowId}', 'CartDecrement');
        Route::get('/cart-increment/{rowId}', 'CartIncrement');




    });


}); //End Group User Middleware

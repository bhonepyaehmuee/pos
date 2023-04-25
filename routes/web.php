<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\User\UserController;


//login,register

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AdminController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AdminController::class,'registerPage'])->name('auth#registerPage');
});
//
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');


    // admin

    // first way to write the middleware instead of using as the attribute like 'middleware'=>'admin_auth';
    // Route::group(['middleware'=>'admin_auth'],function(){

    // });
// that's second way
    Route::middleware(['admin_auth'])->group(function () {
         // Category
        Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });
    // admin account
        Route::prefix('admin')->group(function(){
            // first get reach the password change page to change password.
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            // this post method direct to the change the new password when u type new password and click the related button
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            // Profile
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            // Profile Edit
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            // update
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            // adminlist
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            // admin list delete
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            // change role(show)
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            // update role
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');
            // change role with ajax (admin to user)
            Route::get('ajax/change/role',[AdminController::class,'ajaxChangeRole'])->name('admin#ajaxchangeRole');

            // Contact form list of the admin dashboard
            Route::get('contact/list',[AdminController::class,'contactList'])->name('admin#contactList');
            // contact form details
            Route::get('contact/details/{id}',[AdminController::class,'contactDetails'])->name('admin#contactDetails');

          });
        //   productList
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            // create pizza list
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            //post the data you enter to the other page
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            // delete the pizza
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            // edit the pizza list
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            // show the data to update the pizza info
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            // update the pizaa list info
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

        // products-----------
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            // sorting when click orderstatus
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#orderchangeStatus');
            // for status change
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            // click code code to show data
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
        });

        // user list( from the admin site)
        Route::prefix('user')->group(function(){
            Route::get('list',[UserController::class,'userList'])->name('admin#userList');
            // (user to admin change ajax)
            Route::get('ajax/change/role',[UserController::class,'ajaxUserChangeRole'])->name('admin#ajaxUserChange');
            Route::get('delete/{id}',[UserController::class,'UserDelete'])->name('admin#UserDelete');
            // edit
            Route::get('edit/{id}',[UserController::class,'UserEditPage'])->name('admin#UserEditPage');
            // update
            Route::post('update/{id}',[UserController::class,'UserUpdate'])->name('admin#UserUpdate');


        });

    });

    // End of the Admin DashBoard
// -----------------------------------------------------------------------------------------------------------------------------
    // user
    // home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        // Home Page for user
        Route::get('/homePage',[UserController::class,'home'])->name('user#home');
        Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');
        // history
        Route::get('/history',[UserController::class,'history'])->name('user#history');
        // contact
        Route::get('/contact',[UserController::class,'contactUsForm'])->name('user#contactUsForm');
        Route::post('/send/contact',[UserController::class,'sendContact'])->name('user#sendContact');


        // Pizza details
        Route::prefix('pizza')->group(function(){
        Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');

       });

        //    cart
       Route::prefix('cart')->group(function(){
        Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
       });

        // preifx, group  about user pw/ account
        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
        });
        // for account profile changepage and actual update acc
        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });



        // AJAX
        Route::prefix('ajax')->group(function(){
           Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
           Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
           Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
           Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            //to remove the cart data from the database(remove icon)
            Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            //view count
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });
    });


});









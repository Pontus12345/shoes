<?php

/**
*  Store Controller
*/

Route::get('/', 'StoreController@StoreAction');
Route::get('shoes.for.you.se//{createsubje}', 'StoreController@sublink');
Route::get('Blogg&{order}', 'StoreController@BloggView');
Route::get('Blogg/{post}', 'StoreController@BloggPostView');
Route::get('Terms-Condition', 'StoreController@Terms_ConditionView');
Route::get('/about-us', 'StoreController@aboutUsView');
Route::get('contact-us', 'StoreController@contactUsView');
Route::get('contact-us/email', 'StoreController@sendEmail');
Route::post('contact-us/email', 'StoreController@sendEmail');
Route::get('comment', 'StoreController@Comments');
Route::post('comment', 'StoreController@Comments');

/** 
* Categories & Brands
*/

Route::get('cat&{id}', 'StoreController@cat');
Route::get('Brand&{id}', 'StoreController@brand');

/** 
* Products Controller
*/

Route::get('Products&{order}', 'ProductsController@ProductsAction');
Route::get('Products/{pid}', 'ProductsController@ProductsPage');
Route::post('Products', 'ProductsController@ProductsAction');
Route::get('Search', 'ProductsController@Search');
Route::post('Search', 'ProductsController@Search');
Route::get('Shoes&{pid}', 'ProductsController@ShoesView');
Route::get('Accessories&{pid}', 'ProductsController@AccessoriesView');


/** 
* User Controller
*/

Route::get('Log-in', 'UserController@showLogIn');
Route::post('Log-in', 'UserController@showLogIn');
Route::post('makelogin', 'UserController@makeLogin');
Route::get('Logout', 'UserController@logout');
Route::post('reguser', 'UserController@reguser');
Route::get('Account', 'UserController@AccountView');
Route::post('Account/UpdateAcc', 'UserController@updateAcc');

/** 
* Left Bar
*/

Route::get('header', 'GlobalController@header');

/* 
* Cart
*/

Route::get('Shoppingcart', 'StoreController@CartView');
Route::post('Shoppingcart/addCart', 'StoreController@addCart');
Route::get('Shoppingcart/removeCartspro', 'StoreController@removeCartspro');
Route::post('Shoppingcart/addAll', 'StoreController@addTocartFromWishlist');

/* 
* Wishlist
*/

Route::get('Wishlist-{user}', 'StoreController@WishlistView');
Route::post('addWishlist', 'StoreController@addwishlist');
Route::get('Wishlist/remove-{mId}', 'StoreController@removeWishlist');

/** 
* PAYMENT
*/

Route::get('paypal_success', 'PaymentController@paypal_success');
Route::get('paypal_cancel', 'PaymentController@paypal_cancel');

/** 
* Forum
*/

Route::get('Forum', 'SubjectsController@ForumView');
Route::get('Forum/{id}', 'SubjectsController@showSubjectsID');
Route::get('Forum/create/Subjects', 'SubjectsController@createSubjectView');
Route::post('create/subject', 'SubjectsController@createSubject');
Route::get('Forum/sub/{id}', 'SubjectsController@postSubjectid');
Route::get('Forum/sub/remove/{oTable}&{v_oContent}&{vS_oContent}&{id}', 'SubjectsController@replyDestroy');
Route::get('Forum/reply/{id}', 'SubjectsController@replyView');
Route::post('Forum/reply/{id}', 'SubjectsController@replyView');
Route::post('reply', 'SubjectsController@reply');
Route::post('Forum/sub/reply/createReply', 'SubjectsController@createreply');
Route::get('Forum/Aktive/Aktuella-Subjects', 'SubjectsController@Aktuella_Subjects');
Route::get('Forum/user/Info-{username}', 'UserController@forumUserView');

/** 
* Api
*/

Route::post('Blogg/Post/Comments', 'ApiController@iCommentsRequest');
Route::get('Blogg/Post/Comments', 'ApiController@iCommentsRequest');
Route::post('products/Comments', 'ApiController@sCommentsrate');
Route::get('products/Comments', 'ApiController@sCommentsrate');

/**  
* Render Var On all Views
*/

View::composer('Runningshoes.includes.header', 'App\Composers\HeaderComposer');
View::composer('Runningshoes.includes.head', 'App\Composers\HeaderComposer');
View::composer('Runningshoes.includes.aside', 'App\Composers\AsideComposer');
View::composer('Runningshoes.includes.footer', 'App\Composers\FooterComposer');
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
//'middleware' => ['auth'],

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
    //Clientes

    Route::get('/client/register', 'ClientController@clientsRegister')->name('clients.register');

    Route::post('/client/register', 'ClientController@clientsCreate')->name('clients.create');

    Route::get('/client/search', 'ClientController@clientsGet')->name('clients.search');

    Route::get('/client/edit/{id}', 'ClientController@clientsEdit')->name('clients.edit');

    Route::get('/client/update/{id}', 'ClientController@clientsUpdate')->name('clients.update');

    Route::get('/client/destroy/{id}', 'ClientController@clientsDestroy')->name('clients.destroy');

    //fornecedoresv
    
    Route::get('/provider/register', 'ProviderController@providersRegister')->name('providers.register');

    Route::post('/provider/register', 'ProviderController@providersCreate')->name('providers.create');

    Route::get('/provider/search', 'ProviderController@providersGet')->name('providers.search');

    Route::get('/provider/edit/{id}', 'ProviderController@providersEdit')->name('providers.edit');

    Route::get('/provider/update/{id}', 'ProviderController@providersUpdate')->name('providers.update');

    Route::get('/provider/destroy/{id}', 'ProviderController@providersDestroy')->name('providers.destroy');
    
    //Formas de pagamento

    Route::get('/paymentmethod/register', 'PaymentMethodController@paymentmethodsRegister')->name('paymentmethods.register');

    Route::post('/paymentmethod/register', 'PaymentMethodController@paymentmethodsCreate')->name('paymentmethods.create');

    Route::get('/paymentmethod/search', 'PaymentMethodController@paymentmethodsGet')->name('paymentmethods.search');

    Route::get('/paymentmethod/edit/{id}', 'PaymentMethodController@paymentmethodsEdit')->name('paymentmethods.edit');

    Route::get('/paymentmethod/update/{id}', 'PaymentMethodController@paymentmethodsUpdate')->name('paymentmethods.update');

    Route::get('/paymentmethod/destroy/{id}', 'PaymentMethodController@paymentmethodsDestroy')->name('paymentmethods.destroy');



    //Notas

    Route::get('/record/register', 'ClientRecordController@recordsRegister')->name('records.register');

    Route::post('/record/register', 'ClientRecordController@recordsCreate')->name('records.create');

    Route::get('/record/search', 'ClientRecordController@recordsGet')->name('records.search');

    Route::get('/record/edit/{id}', 'ClientRecordController@recordsEdit')->name('records.edit');

    Route::get('/record/update/{id}', 'ClientRecordController@recordsUpdate')->name('records.update');

    Route::get('/record/destroy/{id}', 'ClientRecordController@recordsDestroy')->name('records.destroy');


    //Conteudo Notas
    Route::get('/recorditem/register', 'ClientRecordController@recorditemsRegister')->name('recorditems.register');
    //Itens Notas
    Route::post('/recorditem/register', 'ClientRecordController@recorditemsCreate')->name('recorditems.create');
    //Serviços Notas
    Route::post('/recordservice/register', 'ClientRecordController@recordservicesCreate')->name('recordservices.create');

    //itens

    Route::get('/home', 'ItemController@index')->name('items.home');

    Route::get('/item/register', 'ItemController@itemsRegister')->name('items.register');

    Route::post('/item/register', 'ItemController@itemsCreate')->name('items.create');

    Route::get('/item/search', 'ItemController@itemsGet')->name('items.search');

    Route::get('/item/edit/{id}', 'ItemController@itemsEdit')->name('items.edit');

    Route::get('/item/update/{id}', 'ItemController@itemsUpdate')->name('items.update');

    Route::get('/item/destroy/{id}', 'ItemController@itemsDestroy')->name('items.destroy');

    //servicos

    Route::get('/service/register', 'ServiceController@servicesRegister')->name('services.register');

    Route::post('/service/register', 'ServiceController@servicesCreate')->name('services.create');

    Route::get('/service/search', 'ServiceController@servicesGet')->name('services.search');

    Route::get('/service/edit/{id}', 'ServiceController@servicesEdit')->name('services.edit');

    Route::get('/service/update/{id}', 'ServiceController@servicesUpdate')->name('services.update');

    Route::get('/service/destroy/{id}', 'ServiceController@servicesDestroy')->name('services.destroy');

    //marcas

    Route::get('/brand/register', 'BrandController@brandsRegister')->name('brands.register');

    Route::post('/brand/register', 'BrandController@brandsCreate')->name('brands.create');

    Route::get('/brand/search', 'BrandController@brandsGet')->name('brands.search');

    Route::get('/brand/edit/{id}', 'BrandController@brandsEdit')->name('brands.edit');   

    Route::get('/brand/update/{id}', 'BrandController@brandsUpdate')->name('brands.update');

    Route::get('/brand/destroy/{id}', 'BrandController@brandsDestroy')->name('brands.destroy');
    

    //categorias

    Route::get('/category/register', 'CategoryController@categoriesRegister')->name('categories.register');

    Route::post('/category/register', 'CategoryController@categoriesCreate')->name('categories.create');

    Route::get('/category/search', 'CategoryController@categoriesGet')->name('categories.search');

    Route::get('/category/edit/{id}', 'CategoryController@categoriesEdit')->name('categories.edit');   

    Route::get('/category/update/{id}', 'CategoryController@categoriesUpdate')->name('categories.update');

    Route::get('/category/destroy/{id}', 'CategoryController@categoriesDestroy')->name('categories.destroy');

    //relatorios

    Route::get('/report/bs', 'ReportController@bestsellerReport')->name('reports.bs');
    Route::get('/report/bc', 'ReportController@bestclientReport')->name('reports.bc');
    
});


//testes

Route::get('/invoice', 'HomeController@invoice');

Route::get('/teste', function () {
    // Simply shows the blade view resources/home.blade.php
    return view('admin.site.teste');
});

Route::post('/justapage', function() {

    // This is the message that will show in the sweetalert-popup:
    alert()->success('It worked!', 'The form was submitted');

    // Redirect back to the page you were looking at
    return back();
});



/*
Route::group(['namespace' => 'Site', 'prefix' => 'home'], function()
{
    Route::get('/', 'SiteController@index')->name('site.home');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

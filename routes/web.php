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

$this->group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
    //Clientes

    $this->get('/client/register', 'ClientController@clientsRegister')->name('clients.register');

    $this->post('/client/register', 'ClientController@clientsCreate')->name('clients.create');

    $this->get('/client/search', 'ClientController@clientsGet')->name('clients.search');

    $this->get('/client/edit/{id}', 'ClientController@clientsEdit')->name('clients.edit');//falta resolver

    $this->get('/brand/update/{id}', 'ClientController@clientsUpdate')->name('clients.update');//falta resolver

    $this->get('/client/destroy/{id}', 'ClientController@clientsDestroy')->name('clients.destroy');//falta resolver
    

    //item

    $this->get('/home', 'ItemController@index')->name('items.home');

    $this->get('/item/register', 'ItemController@itemsRegister')->name('items.register');

    $this->post('/item/register', 'ItemController@itemsCreate')->name('items.create');

    $this->get('/item/search', 'ItemController@itemsGet')->name('items.search');

    $this->get('/item/edit/{id}', 'ItemController@itemsEdit')->name('items.edit');//falta resolver

    $this->get('/brand/update/{id}', 'BrandController@brandsUpdate')->name('brands.update');//falta resolver

    $this->get('/item/destroy/{id}', 'ItemController@itemsDestroy')->name('items.destroy');//falta resolver

    //servicos

    $this->get('/service/register', 'ServiceController@servicesRegister')->name('services.register');

    $this->post('/service/register', 'ServiceController@servicesCreate')->name('services.create');

    $this->get('/service/search', 'ServiceController@servicesGet')->name('services.search');

    $this->get('/service/edit/{id}', 'ServiceController@servicesEdit')->name('services.edit');//falta resolver

    $this->get('/service/update/{id}', 'ServiceController@servicesUpdate')->name('services.update');//falta resolver

    $this->get('/service/destroy/{id}', 'ServiceController@servicesDestroy')->name('services.destroy');//falta resolver

    //marca

    $this->get('/brand/register', 'BrandController@brandsRegister')->name('brands.register');

    $this->post('/brand/register', 'BrandController@brandsCreate')->name('brands.create');

    $this->get('/brand/search', 'BrandController@brandsGet')->name('brands.search');

    $this->get('/brand/edit/{id}', 'BrandController@brandsEdit')->name('brands.edit');   

    $this->get('/brand/update/{id}', 'BrandController@brandsUpdate')->name('brands.update');

    $this->get('/brand/destroy/{id}', 'BrandController@brandsDestroy')->name('brands.destroy');
    

    //categoria

    $this->get('/category/register', 'CategoryController@categoriesRegister')->name('categories.register');

    $this->post('/category/register', 'CategoryController@categoriesCreate')->name('categories.create');

    $this->get('/category/search', 'CategoryController@categoriesGet')->name('categories.search');

    $this->get('/category/edit/{id}', 'CategoryController@categoriesEdit')->name('categories.edit');   

    $this->get('/category/update/{id}', 'CategoryController@categoriesUpdate')->name('categories.update');

    $this->get('/category/destroy/{id}', 'CategoryController@categoriesDestroy')->name('categories.destroy');

    
});




/*
$this->group(['namespace' => 'Site', 'prefix' => 'home'], function()
{
    $this->get('/', 'SiteController@index')->name('site.home');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

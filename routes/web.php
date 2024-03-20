<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/details/{slug}', [App\Http\Controllers\FrontController::class, 'index'])->name('property-details');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/get-states-by-country', [App\Http\Controllers\HomeController::class, 'get_states_by_country'])->name('get-states-by-country');
Route::post('/get-cities-by-state', [App\Http\Controllers\HomeController::class, 'get_cities_by_state'])->name('get-cities-by-state');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('/users-list', [App\Http\Controllers\HomeController::class, 'usersList'])->name('usersList');
Route::post('/storeStudent', [App\Http\Controllers\HomeController::class, 'storeStudent'])->name('storeStudent');
Route::get('/userdata', [App\Http\Controllers\HomeController::class, 'userdata'])->name('users.userdata');
Route::get('/property-list', [App\Http\Controllers\HomeController::class, 'properties'])->name('users.property-list');
Route::get('/getproperty_data', [App\Http\Controllers\HomeController::class, 'property_data'])->name('property.data');

Route::get('/add-property', [App\Http\Controllers\HomeController::class, 'add_property'])->name('property.add');
Route::get('/edit-property/{id}', [App\Http\Controllers\HomeController::class, 'edit_property'])->name('property.edit_property');
Route::get('/delete-property/{id}', [App\Http\Controllers\HomeController::class, 'delete_property'])->name('property.delete_property');
Route::post('/update-property/{id}', [App\Http\Controllers\HomeController::class, 'update_property'])->name('property.update_property');
Route::post('/store-property', [App\Http\Controllers\HomeController::class, 'store_property'])->name('property.store-property');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('users.logout');
Route::get('/rent-agreement', [App\Http\Controllers\HomeController::class, 'rent_agreement'])->name('users.rent-agreement');
Route::post('/get-properties-by-property-type', [App\Http\Controllers\HomeController::class, 'property_by_type'])->name('users.get-properties-by-property-type');
Route::post('/get-property-data', [App\Http\Controllers\HomeController::class, 'getproperty_data'])->name('users.get-property-data');
Route::post('/store-agreement', [App\Http\Controllers\HomeController::class, 'store_agreement'])->name('users.store-agreement');
Route::post('/update-agreement', [App\Http\Controllers\HomeController::class, 'update_agreement'])->name('users.update-agreement');
Route::get('/rent-agreement-list', [App\Http\Controllers\HomeController::class, 'agreements'])->name('users.rent-agreement-list');
Route::get('/agreement-data', [App\Http\Controllers\HomeController::class, 'agreement_data'])->name('property.agreement-data');
Route::get('/edit-agreement/{id}', [App\Http\Controllers\HomeController::class, 'edit_agreement'])->name('property.edit-agreement');
Route::get('/delete-agreement/{id}', [App\Http\Controllers\HomeController::class, 'delete_agreement'])->name('property.delete-agreement');




 
 Route::get('/amenities', [App\Http\Controllers\HomeController::class, 'amenities'])->name('masters.amenities-list');
 Route::get('/delete-amenity/{id}', [App\Http\Controllers\HomeController::class, 'delete_amenity'])->name('masters.delete-amenity');
 Route::get('/edit-amenity/{id}', [App\Http\Controllers\HomeController::class, 'edit_amenity'])->name('masters.edit-amenity');
 Route::get('/amenities-data', [App\Http\Controllers\HomeController::class, 'amenities_data'])->name('masters.amenities');
 Route::post('/storeAmenity', [App\Http\Controllers\HomeController::class, 'storeAmenity'])->name('masters.storeAmenity');
 Route::post('/updateAmenity', [App\Http\Controllers\HomeController::class, 'updateAmenity'])->name('masters.updateAmenity');


 Route::get('/facilities', [App\Http\Controllers\HomeController::class, 'facilities'])->name('facilities');
 Route::post('/storeFacility', [App\Http\Controllers\HomeController::class, 'storeFacility'])->name('masters.storeFacility');
 Route::get('/facilities-data', [App\Http\Controllers\HomeController::class, 'facilities_data'])->name('masters.facilities');
 Route::get('/edit-facility/{id}', [App\Http\Controllers\HomeController::class, 'edit_facility'])->name('masters.edit-facility');
 Route::post('/updateFacility', [App\Http\Controllers\HomeController::class, 'updateFacility'])->name('masters.updateFacility');
 Route::get('/delete-facility/{id}', [App\Http\Controllers\HomeController::class, 'delete_facility'])->name('masters.delete-facility');
 
 Route::get('/property-type', [App\Http\Controllers\HomeController::class, 'property_type'])->name('property-type');
 Route::get('/propertype-list', [App\Http\Controllers\HomeController::class, 'propertype_list'])->name('masters.propertype-list');
 Route::post('/storePropertyType', [App\Http\Controllers\HomeController::class, 'storePropertyType'])->name('masters.storePropertyType');
 Route::post('/updatePropertyType', [App\Http\Controllers\HomeController::class, 'updatePropertyType'])->name('masters.updatePropertyType');
  Route::get('/edit-property-type/{id}', [App\Http\Controllers\HomeController::class, 'edit_property_type'])->name('masters.edit-property-type');
  Route::get('/delete-property-type/{id}', [App\Http\Controllers\HomeController::class, 'delete_property_type'])->name('masters.delete-property-type');
 
 
 Route::post('/storeFacility', [App\Http\Controllers\HomeController::class, 'storeFacility'])->name('masters.storeFacility');
 Route::post('/get-property-no', [App\Http\Controllers\HomeController::class, 'get_property_no'])->name('masters.get-property-no');
 Route::get('/facilities-data', [App\Http\Controllers\HomeController::class, 'facilities_data'])->name('masters.facilities');
 Route::get('/edit-facility/{id}', [App\Http\Controllers\HomeController::class, 'edit_facility'])->name('masters.edit-facility');
 Route::post('/updateFacility', [App\Http\Controllers\HomeController::class, 'updateFacility'])->name('masters.updateFacility');
 Route::get('/delete-facility/{id}', [App\Http\Controllers\HomeController::class, 'delete_facility'])->name('masters.delete-facility');
 
 Route::get('/responsibility', [App\Http\Controllers\HomeController::class, 'responsibility'])->name('masters.responsibility');

 
 
  Route::post('/storeResponsibility', [App\Http\Controllers\HomeController::class, 'storeResponsibility'])->name('masters.storeResponsibility');
  Route::get('/responsibilities-list', [App\Http\Controllers\HomeController::class, 'responsibilities_list'])->name('masters.responsibilities-list');
  Route::get('/edit-responsibility/{id}', [App\Http\Controllers\HomeController::class, 'edit_responsibility'])->name('masters.edit-responsibility');
   Route::get('/delete-responsibility/{id}', [App\Http\Controllers\HomeController::class, 'delete_responsibility'])->name('masters.delete-responsibility');
 Route::post('/updateResponsibility', [App\Http\Controllers\HomeController::class, 'updateResponsibility'])->name('masters.updateResponsibility');

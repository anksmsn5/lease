<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FrontController extends Controller
{
   public function index($slug)
   {
	  $property=DB::table('properties')
					->select('properties.*','property_types.property_type as propertytype','countries.country as countryname','states.state as statename','cities.city as cityname')
					->leftjoin('property_types','property_types.id','=','properties.property_type')
					->leftjoin('countries','countries.id','=','properties.country')
					->leftjoin('states','states.id','=','properties.state')
					->leftjoin('cities','cities.id','=','properties.city')
					->where('properties.slug',$slug)
					->first();
 
	 return view("admin.property.details",["property"=>$property]);  
   }
}

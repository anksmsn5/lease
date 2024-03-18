<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Property;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\RentAgreement;
use App\Models\Tenant;
use App\Models\Amenity;
use App\Models\Facility;
use App\Models\PropertyType;
use App\Models\Responsibility;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
	
	public function property_type()
	 {
		
		return view("master.propertytype");
	}
	
	public function propertype_list(Request $request)
	{
		 if ($request->ajax()) {
            $data = PropertyType::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('edit-property/'.$row['id']).'" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a>
					<a href="'.url('delete-property/'.$row['id']).'" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
		
	
	}
	
	
	
	
	
	
	
	public function storePropertyType(Request $request)
	{
		$pt=new PropertyType();
		$pt->property_type=$request->property_type;
		$pt->save();
		
		return redirect()->back()->with("success","Prperty Type Added successfully.");
		
		
	}

    public function users()
    {
        return view("admin.users.users");
    }

    public function storeStudent(Request $request)
    {

        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'mobile' => 'required|string|unique:users|max:255',
        'password' => 'required|string|min:8',
    ]);

      $user=new User();
      $user->name=$request->name;
      $user->email=$request->email;
      $user->mobile=$request->mobile;
      $user->password=$request->password;
      $user->save();

      return redirect()->back()->with("success","User added successfully.");
    }


    public function usersList(Request $request)
    {
            return view("admin.users.userlist");
    }

    public function logout()
    {

        Auth::logout();

        return redirect("/");
    }

    public function userdata(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('type','!=','0')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function properties()
    {
       return view("admin.property.index");
    }

    public function property_data(Request $request)
    {
		
if ($request->ajax()) {
	 
            $data = Property::join('property_types', function($join) {
      $join->on('property_types.id', '=', 'properties.property_type');
    })->select("properties.*","property_types.property_type")->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
					if($row['availability_status']=='Available')
					{
						 $actionBtn ='<button type="button" class="btn btn-success">Available</button>';
					}
					else
					{
						 $actionBtn ='<button type="button" class="btn btn-danger">Not Available</button>';
					}
                    $actionBtn .= '<a href="'.url('edit-property_type/'.$row['id']).'" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a> 
					<a href="'.url('delete-property_type/'.$row['id']).'" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function add_property()
    {
        $countries=Country::orderBy('country','asc')->get();
		$amenities=Amenity::orderBy("amenity","asc")->get();
		$facilities=Facility::orderBy("facility","asc")->get();
		$type=PropertyType::orderBy("property_type","asc")->get();
        return view("admin.property.add",["countries"=>$countries,"amenities"=>$amenities,"facilities"=>$facilities,"type"=>$type]);
    }

    public function store_property(Request $request)
    {
	 
        
        $mid=Property::max("id");
        $property_id=str_pad(($mid+1),6,"0",STR_PAD_LEFT);
        $pr=new Property();
        $pr->property_id=$property_id;
        $pr->property_type=$request->property_type;
        $pr->property_name=$request->property_name;
        $pr->address=$request->address;
         
        $pr->property_size=$request->property_size;
        $pr->price_rent=$request->price_rent;
        $pr->description=$request->description;
        $pr->amenities=implode(",",$request->amenities); 
        
        
        $pr->email=$request->owner_email;
        $pr->type=$request->type;
        $pr->security_deposit=$request->security_deposit;
        $pr->availability_status=$request->availability_status;
       
        $pr->facilities=implode(",",$request->facilities);
        $pr->furnishing=$request->furnishing_status;
      
        $pr->tenant_criteria=$request->tenant_criteria;
        
        $pr->save();

        return redirect()->back()->with("success","Property Added Succesfully.");
    }
    public function update_property(Request $request,$id)
    {
        
       
        $pr=Property::find($id);
       $pr->property_type=$request->property_type;
        $pr->property_name=$request->property_name;
        $pr->address=$request->address;
         
        $pr->property_size=$request->property_size;
        $pr->price_rent=$request->price_rent;
        $pr->description=$request->description;
        $pr->amenities=implode(",",$request->amenities); 
        
        
        $pr->email=$request->owner_email;
        $pr->type=$request->type;
        $pr->security_deposit=$request->security_deposit;
        $pr->availability_status=$request->availability_status;
       
        $pr->facilities=implode(",",$request->facilities);
        $pr->furnishing=$request->furnishing_status;
      
        $pr->tenant_criteria=$request->tenant_criteria;
        $pr->save();

        return redirect("property-list")->with("success","Property Updated Succesfully.");
    }

    public function get_states_by_country(Request $request)
    {
        $html='<option value="">Select</option>';
        $states=State::where('country_id',$request->id)->get();

        foreach($states as $st)
        {
            $html.='<option value="'.$st->id.'">'.$st->state.'</option>';
        }
        return $html;

    }

    public function get_cities_by_state(Request $request)
    {
        $html='<option value="">Select</option>';
        $states=City::where('state_id',$request->id)->get();

        foreach($states as $st)
        {
            $html.='<option value="'.$st->id.'">'.$st->city.'</option>';
        }
        return $html;

    }

    public function edit_property($id)
    {
        $property=Property::find($id);
		 
        $amenities=Amenity::orderBy("amenity","asc")->get();
		$facilities=Facility::orderBy("facility","asc")->get();
		$type=PropertyType::orderBy("property_type","asc")->get();
        return view("admin.property.edit",["property"=>$property,"amenities"=>$amenities,"facilities"=>$facilities,"type"=>$type]);
    }

    public function delete_property($id)
    {
        $property=Property::find($id)->delete();
       return redirect()->back()->with("success","Property Deleted Successfully.");
       
    }
	
	
	
	
	

    public function rent_agreement()
    {
		$type=PropertyType::orderBy("property_type","asc")->get();
         $countries=Country::orderBy('country','asc')->get();
        return view("admin.property.rent_agreement",["countries"=>$countries,"type"=>$type]);
    }

    public function property_by_type(Request $request)
    {
        $html='<option value="">Select</option>';
        $property=Property::where("property_type",$request->id)->get();

        foreach($property as $prop)
        {
            $html.='<option value="'.$prop->id.'">( '.$prop->property_id.' )'.$prop->property_name.', '.$prop->address.'</option>';
        }

        return $html;
    } 

    public function getproperty_data(Request $request)
    {
        $html='';
       
    $data= DB::table('properties')
    ->select('properties.*','countries.country as countryname','states.state as statename','cities.city as cityname')
    ->join('countries','countries.id','=','properties.country')
    ->join('states','states.id','=','properties.state')
    ->join('cities','cities.id','=','properties.city')
    ->where('properties.id',$request->id)
    ->first();
        $html='
        <table class="table">
            <tr>
                <td><b>Property Id :</b> '.$data->property_id.'</td>
                <td><b>Property Type :</b> '.$data->property_type.'</td>
                <td><b>Property Area :</b> '.$data->property_size.'</td>
                <td><b>Property Age : </b>'.$data->property_age.'</td>
            </tr>

             <tr>
                <td><b>Address :</b> '.$data->address.'</td>
                <td><b>City :</b>'.$data->cityname.'</td>
                <td><b>State :</b> '.$data->statename.'</td>
                <td><b>Country :</b> '.$data->countryname.'</td>
            </tr>

             <tr>
                <td><b>Property For  :</b> '.$data->type.'</td>
                <td><b>Owner Name  :</b> '.$data->owner_name.'</td>
                <td><b>Owner Email  :</b> '.$data->email.'</td>
                <td><b>Owner Phone  :</b> '.$data->phone_no.'</td>
                
            </tr>
            <tr>
                <td><b>Rent/Price  :</b> '.$data->price_rent.'</td>
                <td><b>Furnishing Status  :</b> '.$data->furnishing.'</td>
                <td><b>Security Deposit  :</b> '.$data->security_deposit.'</td>
                <td><b>Property Age  :</b> '.$data->property_age.' Years</td>
                
            </tr>
            <tr>
                <td colspan="4"><a href="">Read More....</a></td>
            </tr>
        </table>
        ';
return $html;
    }

    public function store_agreement(Request $request)
    {

        $ten=new Tenant();
        $ten->tenant_name=$request->tenant_name;
        $ten->tenant_email=$request->tenant_email;
        $ten->tenant_mobile=$request->tenant_mobile;
        $ten->country=$request->country;
        $ten->state=$request->state;
        $ten->city=$request->city;
        $ten->address=$request->address;
        $ten->save();

        $mid=RentAgreement::max("id");
        $agreement_id="AG".str_pad(($mid+1),6,"0",STR_PAD_LEFT);
        $rag=new RentAgreement();
        $rag->tenant_id=$ten->id;
        $rag->agreement_id=$agreement_id;
        $rag->property_id=$request->property;
        $rag->property_type=$request->property_type;
        $rag->rental_terms=$request->rental_terms;
        $rag->start_date=$request->start_date;
        $rag->end_date=$request->end_date;
        $rag->rent_duration=$request->rent_duration;
        $rag->rent_amount=$request->rent_amount;
        $rag->rent_start_date=$request->rent_start_date;
        $rag->security_amount=$request->security_amount;
        $rag->security_return_terms=$request->security_return_terms;
        $rag->tenant_responsibility=$request->tenant_responsibility;
        $rag->owner_responsibility=$request->owner_responsibility;
        $rag->termination_clause=$request->termination_clause;
        $rag->date=$request->date;
        $rag->save();

        return redirect()->back()->with("success","Agreement Created Successfully.");
    }

    public function agreements()
    {
        return view("admin.property.agreementlist");
    }

    public function agreement_data(Request $request)
    {
        if ($request->ajax()) {
            $data =  DB::table('rent_agreements')
                    ->select('rent_agreements.*','tenants.tenant_name','properties.property_id','properties.address','properties.owner_name')
                    ->join('tenants','tenants.id','=','rent_agreements.tenant_id')
                    ->join('properties','properties.id','=','rent_agreements.property_id')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('edit-property/'.$row->id).'" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a> <a href="'.url('delete-property/'.$row->id).'" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
	

	
	
	
	
	
	
	 public function amenities()
    {
        return view("master.amenities");
    }
	
	public function amenities_data(Request $request)
	{
		 if ($request->ajax()) {
            $data =  DB::table('amenities')
                    
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('edit-amenity/'.$row->id).'" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= '<a href="'.url('delete-amenity/'.$row->id).'" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
		
	}
	
	public function storeAmenity(Request $request)
	{
		$am=new Amenity();
		$am->amenity=$request->amenity;
		$am->save();
		
		return redirect()->back()->with("success","Amenity Added Succesfully");
		
	}
	
	public function updateAmenity(Request $request)
	{
		$am=Amenity::find($request->id);
		$am->amenity=$request->amenity;
		$am->save();
		
		return redirect("amenities")->with("success","Amenity Updated Succesfully");
		
	}
	
	public function edit_amenity($id)
	{
		$amenity=Amenity::find($id);
		return view("master.edit_amenity",["amenity"=>$amenity]);
	}
	
	public function  delete_amenity($id)
	{
		Amenity::find($id)->delete();
		
		return redirect()->back()->with("success","Amenity Deleted Succesfully");
	}
	
	 public function facilities()
    {
        return view("master.facilities");
    }
	
	public function facilities_data(Request $request)
	{
		 if ($request->ajax()) {
            $data =  DB::table('facilities')
                    ->orderBy('id','desc')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('edit-facility/'.$row->id).'" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= '<a href="'.url('delete-facility/'.$row->id).'" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
		
	}
	
	public function storeFacility(Request $request)
	{
		$fac=new Facility();
		$fac->facility=$request->facility;
		$fac->save();
		
		return redirect()->back()->with("success","Facility Added Succesfully");
		
	}

         public function updateFacility(Request $request)
	{
		$fac=Facility::find($request->id);
		$fac->facility=$request->facility;
		$fac->save();
		
		return redirect("facilities")->with("success","Facility Updated Succesfully");
		
	}
	
	  public function edit_facility($id)
	{
		$facility=Facility::find($id);
		return view("master.edit_facility",["facility"=>$facility]);
	}
	
	  public function  delete_facility($id)
	{
		Facility::find($id)->delete();
		
		return redirect()->back()->with("success","Facility Deleted Succesfully");
	}
	 
	  public function responsibility()
    {
        return view("master.responsibility");
    }
	
	public function storeResponsibility (Request $request)
	{
		$res=new Responsibility();
		$res->responsibility=$request->responsibility;
		$res->save();
		
		return redirect()->back()->with("success","Responsibility Added Succesfully");
		
	}
	
	public function responsibilities_list(Request $request){
		 if ($request->ajax()) {
            $data =  DB::table('responsibilities')
                    ->orderBy('id','desc')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('edit-responsibility/'.$row->id).'" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= '<a href="'.url('delete-responsibility/'.$row->id).'" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
	}
	
	public function edit_responsibility($id)
	{
		$responsibility=Responsibility::find($id);
		return view("master.edit_responsibility",["responsibility"=>$responsibility]);
	}
	
	 public function updateResponsibility(Request $request)
	{
		$fac=Responsibility::find($request->id);
		$fac->responsibility=$request->responsibility;
		$fac->save();
		
		return redirect("responsibility")->with("success","Responsibility Updated Succesfully");
		
	}
	
	 public function  delete_responsibility($id)
	{
		Responsibility::find($id)->delete();
		
		return redirect()->back()->with("success","Responsibility Deleted Succesfully");
	}
	 
	
	 
}

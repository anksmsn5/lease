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
use App\Models\Rent;
use App\Models\Responsibility;
use App\Models\Payment;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use PDF;

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
        $properties = Property::count();
        $duerent = Rent::where('status', 'UnPaid')->sum("amount");
        $rent = Payment::sum("paying");
        $agreements = RentAgreement::count();
        return view('home', ["properties" => $properties, "duerent" => $duerent, "rent" => $rent, "agreements" => $agreements]);
    }
    public function template_one($id)
    {
        return view("admin.property.template_one");
    }
    public function template_two($id)
    {
        echo $id;
    }
    public function template_three($id)
    {
        echo $id;
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
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('edit-property-type/' . $row['id']) . '" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a>
					<a href="' . url('delete-property-type/' . $row['id']) . '" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit_property_type($id)
    {
        $propertytype = PropertyType::find($id);

        return view("master.edit_property_type", ["propertytype" => $propertytype]);
    }







    public function storePropertyType(Request $request)
    {
        $validated = $request->validate([
            'property_type' => 'required|unique:property_types|max:255',
            'property_no' => 'required',
        ]);

        $pt = new PropertyType();
        $pt->property_type = $request->property_type;
        $pt->property_no = $request->property_no;
        $pt->save();

        return redirect()->back()->with("success", "Property Type Added successfully.");
    }

    public function get_property_no(Request $request)
    {
        $query = PropertyType::find($request->id);
        return $query->property_no;
    }

    public function delete_property_type($id)
    {
        PropertyType::find($id)->delete();
        return redirect()->back()->with("success", "Property Type Deleted successfully.");
    }
    public function updatePropertyType(Request $request)
    {
        $pt = PropertyType::find($request->id);
        $pt->property_type = $request->property_type;
        $pt->property_no = $request->property_no;
        $pt->save();

        return redirect("property-type")->with("success", "Property Type Added successfully.");
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

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->with("success", "User added successfully.");
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
            $data = User::where('type', '!=', '0')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
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

            $data = Property::join('property_types', function ($join) {
                $join->on('property_types.id', '=', 'properties.property_type');
            })->select("properties.*", "property_types.property_type")->orderBy('properties.id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('statusBtn', function ($row) {
                    if ($row['availability_status'] == 'Available') {
                        $statusBtn = '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>';
                    } else {
                        $statusBtn = '<button type="button" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i></button>';
                    }

                    return $statusBtn;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('details/' . $row['slug']) . '" target="_blank" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i></a> 
					 ';
                    $actionBtn .= '<a href="' . url('edit-property/' . $row['id']) . '" onclick="return actionconfirm()" class="edit btn btn-success btn-sm"><i class="fa fa-edit"></i></a> 
					<a href="' . url('delete-property/' . $row['id']) . '" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'statusBtn'])
                ->make(true);
        }
    }


    public function add_property()
    {
        $countries = Country::orderBy('country', 'asc')->get();
        $amenities = Amenity::orderBy("amenity", "asc")->get();
        $facilities = Facility::orderBy("facility", "asc")->get();
        $type = PropertyType::orderBy("property_type", "asc")->get();
        return view("admin.property.add", ["countries" => $countries, "amenities" => $amenities, "facilities" => $facilities, "type" => $type]);
    }

    public function store_property(Request $request)
    {


        $mid = Property::max("id");
        $property_id = "P" . str_pad(($mid + 1), 6, "0", STR_PAD_LEFT);
        $pr = new Property();
        $pr->property_id = $property_id;
        $pr->property_type = $request->property_type;
        $pr->property_name = $request->property_name;
        $pr->address = $request->address;
        $pr->owner_name = $request->owner_name;
        $pr->carpet_area = $request->carpet_area;

        $pr->property_size = $request->property_size;
        $pr->price_rent = $request->price_rent;

        $pr->description = $request->description;
        $pr->amenities = implode(",", $request->amenities);


        $pr->email = $request->owner_email;
        $pr->type = $request->type;
        $pr->security_deposit = $request->security_deposit;
        $pr->availability_status = $request->availability_status;

        $pr->facilities = implode(",", $request->facilities);
        $pr->furnishing = $request->furnishing_status;
        $pr->property_no = $request->property_no;
        $pr->owner_mobile_no = $request->owner_mobile_no;
        $pr->owner_email = $request->owner_email;
        $pr->car_parking = $request->car_parking;
        $pr->facing_direction = $request->facing_direction;
        $pr->maintenance_charge = $request->maintenance_charge;
        $pr->water_availability = $request->water_availability;
        $pr->status_of_electricity = $request->status_of_electricity;
        $pr->property_no = $request->property_no;
        $pr->floor = $request->floor;
        $pr->landmark = $request->landmark;
        $pr->country = $request->country;
        $pr->state = $request->state;
        $pr->city = $request->city;
        $pr->slug = strtolower(implode("-", explode(" ", $request->property_name))) . $property_id;



        $pr->save();

        return redirect()->back()->with("success", "Property Added Succesfully.");
    }
    public function update_property(Request $request, $id)
    {


        $pr = Property::find($id);
        $pr->property_type = $request->property_type;
        $pr->property_name = $request->property_name;
        $pr->address = $request->address;
        $pr->owner_name = $request->owner_name;
        $pr->carpet_area = $request->carpet_area;

        $pr->property_size = $request->property_size;
        $pr->price_rent = $request->price_rent;

        $pr->description = $request->description;
        $pr->amenities = implode(",", $request->amenities);


        $pr->email = $request->owner_email;
        $pr->type = $request->type;
        $pr->security_deposit = $request->security_deposit;
        $pr->availability_status = $request->availability_status;

        $pr->facilities = implode(",", $request->facilities);
        $pr->furnishing = $request->furnishing_status;
        $pr->property_no = $request->property_no;
        $pr->owner_mobile_no = $request->owner_mobile_no;
        $pr->owner_email = $request->owner_email;
        $pr->car_parking = $request->car_parking;
        $pr->facing_direction = $request->facing_direction;
        $pr->maintenance_charge = $request->maintenance_charge;
        $pr->water_availability = $request->water_availability;
        $pr->status_of_electricity = $request->status_of_electricity;
        $pr->property_no = $request->property_no;
        $pr->floor = $request->floor;
        $pr->landmark = $request->landmark;
        $pr->country = $request->country;
        $pr->state = $request->state;
        $pr->city = $request->city;
        $pr->save();

        return redirect("property-list")->with("success", "Property Updated Succesfully.");
    }

    public function get_states_by_country(Request $request)
    {
        $html = '<option value="">Select</option>';
        $states = State::where('country_id', $request->id)->get();

        foreach ($states as $st) {
            $html .= '<option value="' . $st->id . '">' . $st->state . '</option>';
        }
        return $html;
    }

    public function get_cities_by_state(Request $request)
    {
        $html = '<option value="">Select</option>';
        $states = City::where('state_id', $request->id)->get();

        foreach ($states as $st) {
            $html .= '<option value="' . $st->id . '">' . $st->city . '</option>';
        }
        return $html;
    }

    public function edit_property($id)
    {
        $property = Property::find($id);
        $countries = Country::orderBy('country', 'asc')->get();
        $states = State::where('country_id', $property->country)->orderBy('state', 'asc')->get();
        $cities = City::where('state_id', $property->state)->orderBy('city', 'asc')->get();
        $amenities = Amenity::orderBy("amenity", "asc")->get();
        $facilities = Facility::orderBy("facility", "asc")->get();
        $type = PropertyType::orderBy("property_type", "asc")->get();
        return view("admin.property.edit", ["property" => $property, "amenities" => $amenities, "facilities" => $facilities, "type" => $type, "countries" => $countries, "states" => $states, "cities" => $cities]);
    }

    public function delete_property($id)
    {
        $property = Property::find($id)->delete();
        return redirect()->back()->with("success", "Property Deleted Successfully.");
    }






    public function rent_agreement()
    {
        $type = PropertyType::orderBy("property_type", "asc")->get();
        $countries = Country::orderBy('country', 'asc')->get();
        $responsibilities = Responsibility::all();
        return view("admin.property.rent_agreement", ["countries" => $countries, "type" => $type, "responsibilities" => $responsibilities]);
    }

    public function edit_agreement($id)
    {
        $type = PropertyType::orderBy("property_type", "asc")->get();
        $countries = Country::orderBy('country', 'asc')->get();
        $responsibilities = Responsibility::all();
        $agreement = RentAgreement::find($id);
        $properties = Property::where("property_type", $agreement->property_id)->get();

        $property = DB::table('properties')
            ->select('properties.*', 'countries.country as countryname', 'states.state as statename', 'cities.city as cityname', 'property_types.property_type as ptype')
            ->join('countries', 'countries.id', '=', 'properties.country')
            ->join('states', 'states.id', '=', 'properties.state')
            ->join('cities', 'cities.id', '=', 'properties.city')
            ->join('property_types', 'property_types.id', '=', 'properties.property_type')
            ->where('properties.id', $agreement->property_id)
            ->first();
        $tenant = Tenant::find($agreement->tenant_id);
        $states = State::where("country_id", $tenant->country)->get();
        $cities = City::where("state_id", $tenant->state)->get();
        return view("admin.property.edit_rent_agreement", ["countries" => $countries, "type" => $type, "responsibilities" => $responsibilities, "agreement" => $agreement, "properties" => $properties, "property" => $property, "tenant" => $tenant, "states" => $states, "cities" => $cities]);
    }

    public function property_by_type(Request $request)
    {
        $html = '<option value="">Select</option>';
        $property = Property::where("property_type", $request->id)->where('availability_status', 'Available')->get();

        foreach ($property as $prop) {
            $html .= '<option value="' . $prop->id . '">( ' . $prop->property_id . ' )' . $prop->property_name . ', ' . $prop->address . '</option>';
        }

        return $html;
    }

    public function getproperty_data(Request $request)
    {
        $html = '';

        $data = DB::table('properties')
            ->select('properties.*', 'countries.country as countryname', 'states.state as statename', 'cities.city as cityname', 'property_types.property_type as ptype')
            ->join('countries', 'countries.id', '=', 'properties.country')
            ->join('states', 'states.id', '=', 'properties.state')
            ->join('cities', 'cities.id', '=', 'properties.city')
            ->join('property_types', 'property_types.id', '=', 'properties.property_type')
            ->where('properties.id', $request->id)
            ->first();
        $html = '
        <table class="table">
            <tr>
                <td><b>Property Id :</b> ' . $data->property_id . '</td>
                <td><b>Property Type :</b> ' . $data->ptype . '</td>
                <td><b>Saleable Area :</b> ' . $data->property_size . '</td>
                <td><b>Carpet Area :</b> ' . $data->carpet_area . '</td>
            </tr>

             <tr>
                <td><b>Address :</b> ' . $data->address . '</td>
                <td><b>City :</b>' . $data->cityname . '</td>
                <td><b>State :</b> ' . $data->statename . '</td>
                <td><b>Country :</b> ' . $data->countryname . '</td>
            </tr>

             <tr>
                <td><b>Property For  :</b> ' . $data->type . '</td>
                <td><b>Owner Name  :</b> ' . $data->owner_name . '</td>
                <td><b>Owner Email  :</b> ' . $data->owner_email . '</td>
                <td><b>Owner Phone  :</b> ' . $data->owner_mobile_no . '</td>
                
            </tr>
            <tr>
                <td><b>Basic Rent  :</b> ' . $data->price_rent . '</td>
                <td><b>Furnishing Status  :</b> ' . $data->furnishing . '</td>
                <td><b>Security Deposit  :</b> ' . $data->security_deposit . '</td>
                <td></td>
                
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

        $ten = new Tenant();
        $ten->tenant_name = $request->tenant_name;
        $ten->tenant_email = $request->tenant_email;
        $ten->tenant_mobile = $request->tenant_mobile;
        $ten->country = $request->country;
        $ten->state = $request->state;
        $ten->city = $request->city;
        $ten->address = $request->address;
        $ten->pan = $request->pan;
        $ten->aadhar = $request->aadhar;
        $ten->tds_no = $request->tds;
        $ten->gstno = $request->gst_no;
        $ten->save();

        $ownersign = $request->file('ownersign');
        $destinationPath = 'uploads';
        $filename1 = time() . '.' . $ownersign->getClientOriginalExtension();
        $ownersign->move($destinationPath, $filename1);

        $tenantsign = $request->file('tenantsign');
        $filename2 = time() . 'ts.' . $tenantsign->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $tenantsign->move($destinationPath, time() . 'ts.' . $filename2);



        $mid = RentAgreement::max("id");
        $agreement_id = "AG" . str_pad(($mid + 1), 6, "0", STR_PAD_LEFT);
        $rag = new RentAgreement();
        $rag->tenant_id = $ten->id;
        $rag->agreement_id = $agreement_id;
        $rag->property_id = $request->property;
        $rag->property_type = $request->property_type;
        $rag->rental_terms = $request->rental_terms;
        $rag->start_date = $request->start_date;
        $rag->end_date = $request->end_date;
        $rag->agreement_tenure = $request->rent_duration;
        $rag->rent_amount = $request->rent_amount;
        $rag->maintenance_amount = $request->maintenance_amount;
        $rag->security_amount = $request->security_amount;
        $rag->fit_out = $request->fit_out;
        $rag->escalation = $request->escalation;
        $rag->tds_perc = $request->tds_perc;
        $rag->lockin = $request->lockin;
        $rag->gst = $request->gst;
        $rag->notice_period = $request->notice_period;
        $rag->agreement_start = $request->agreement_start;
        $rag->agreement_end = $request->agreement_end;
        $rag->security_return_terms = $request->security_return_terms;
        $rag->tenant_responsibility = implode(", ", $request->tenant_responsibility);
        $rag->owner_responsibility = implode(", ", $request->owner_responsibility);
        $rag->termination_clause = $request->termination_clause;
        $rag->contact_name = $request->contact_name;
        $rag->contact_email = $request->contact_email;
        $rag->contact_mobile = $request->contact_mobile;
        $rag->stamp_duty_paid = $request->stamp_duty_paid;
        $rag->escalation_tenure = $request->escalation_tenure;
        $rag->date = $request->date;
        $rag->ownersign = $filename1;
        $rag->tenantsign = $filename2;
        $rag->save();



        $frent = $request->rent_amount + $request->maintenance_amount;
        $tds = $request->tds_perc;
        $duration = ($request->rent_duration - 1);

        $gstonrent = ($frent * $request->gst) / 100;
        $tdsonrent = ($frent * $tds) / 100;
        $netfmonthlyrent = $frent - $tdsonrent + $gstonrent;




        $firstduedate = date('Y-m-d', strtotime($request->agreement_start . ' + ' . $request->fit_out . ' days'));
        $firstrent = new Rent();
        $firstrent->agreement_id = $rag->agreement_id;
        $firstrent->tenant_id = $ten->id;
        $firstrent->amount = $netfmonthlyrent;
        $firstrent->due_date = $firstduedate;
        $firstrent->basic = $request->rent_amount;
        $firstrent->maintenance = $request->maintenance_amount;
        $firstrent->security = $request->security_amount;

        $firstrent->tds = $tdsonrent;
        $firstrent->gst = $gstonrent;
        $firstrent->gst_perc = $request->gst;
        $firstrent->status = 'UnPaid';
        $firstrent->rent_no = '1';
        $firstrent->save();

        for ($i = 2; $i <= $duration; $i++) {

            $count = Rent::where('tenant_id', $ten->id)->where('agreement_id', $rag->agreement_id)->count();

            $duedate = date('Y-m-d', strtotime($firstduedate . ' + ' . ($i - 1) . ' months'));


            if ($count >= $request->escalation_tenure) {
                if ($i % $request->escalation_tenure == 1) {

                    $newrent = Rent::where('tenant_id', $ten->id)->where('agreement_id', $rag->agreement_id)->orderBy('id', 'DESC')->first();

                    $escalation = ($newrent->basic * $request->escalation) / 100;
                    $rent = $newrent->basic + $request->maintenance_amount + $escalation;
                    $gstonrent = ($rent * $request->gst) / 100;
                    $tdsonrent = ($rent * $tds) / 100;
                    $basic = $newrent->basic + $escalation;
                    $netmonthlyrent = $rent - $tdsonrent + $gstonrent;
                } else {

                    $newrent = Rent::where('tenant_id', $ten->id)->where('agreement_id', $rag->agreement_id)->orderBy('id', 'DESC')->first();

                    $basic = $newrent->basic;
                    $netmonthlyrent = $newrent->amount;
                    $gstonrent = $newrent->tds;
                    $gstonrent = $newrent->gst;
                }
            } else {

                $rent = $request->rent_amount + $request->maintenance_amount;
                $gstonrent = ($rent * $request->gst) / 100;
                $tdsonrent = ($rent * $tds) / 100;

                $netmonthlyrent = $rent - $tdsonrent + $gstonrent;
                $basic = $request->rent_amount;
            }

            $firstrent = new Rent();
            $firstrent->agreement_id = $rag->agreement_id;
            $firstrent->tenant_id = $ten->id;
            $firstrent->basic = $basic;
            $firstrent->tds = $tdsonrent;
            $firstrent->gst = $gstonrent;
            $firstrent->gst_perc = $request->gst;
            $firstrent->maintenance = $request->maintenance_amount;

            $firstrent->amount = $netmonthlyrent;
            $firstrent->due_date = $duedate;
            $firstrent->status = 'UnPaid';
            $firstrent->rent_no = $i;
            $firstrent->save();
        }


        $property = Property::find($request->property);
        $property->availability_status = 'Not Available';
        $property->save();
        return redirect()->back()->with("success", "Agreement Created Successfully.");
    }

    public function update_agreement(Request $request)
    {

        $ten = Tenant::find($request->tenant_id);
        $ten->tenant_name = $request->tenant_name;
        $ten->tenant_email = $request->tenant_email;
        $ten->tenant_mobile = $request->tenant_mobile;
        $ten->country = $request->country;
        $ten->state = $request->state;
        $ten->city = $request->city;
        $ten->address = $request->address;
        $ten->pan = $request->pan;
        $ten->aadhar = $request->aadhar;
        $ten->tds_no = $request->tds;
        $ten->gstno = $request->gst_no;
        $ten->save();
        if ($request->file('ownersign')) {
            $ownersign = $request->file('ownersign');
            $destinationPath = 'uploads';
            $filename1 = time() . '.' . $ownersign->getClientOriginalExtension();
            $ownersign->move($destinationPath, $filename1);
        }
        if ($request->file('tenantsign')) {

            $tenantsign = $request->file('tenantsign');
            $filename2 = time() . 'ts.' . $tenantsign->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $tenantsign->move($destinationPath, time() . 'ts.' . $filename2);
        }



        $rag = RentAgreement::find($request->id);
        $rag->tenant_id = $ten->id;

        $rag->property_id = $request->property;
        $rag->property_type = $request->property_type;
        $rag->rental_terms = $request->rental_terms;
        $rag->start_date = $request->start_date;
        $rag->end_date = $request->end_date;
        $rag->agreement_tenure = $request->rent_duration;
        $rag->rent_amount = $request->rent_amount;
        $rag->maintenance_amount = $request->maintenance_amount;
        $rag->security_amount = $request->security_amount;
        $rag->fit_out = $request->fit_out;
        $rag->escalation = $request->escalation;
        $rag->lockin = $request->lockin;
        $rag->gst = $request->gst;
        $rag->notice_period = $request->notice_period;
        $rag->agreement_start = $request->agreement_start;
        $rag->agreement_end = $request->agreement_end;
        $rag->security_return_terms = $request->security_return_terms;
        $rag->tenant_responsibility = implode(", ", $request->tenant_responsibility);
        $rag->owner_responsibility = implode(", ", $request->owner_responsibility);
        $rag->termination_clause = $request->termination_clause;
        $rag->contact_name = $request->contact_name;
        $rag->contact_email = $request->contact_email;
        $rag->contact_mobile = $request->contact_mobile;
        $rag->stamp_duty_paid = $request->stamp_duty_paid;
        $rag->escalation_tenure = $request->escalation_tenure;
        $rag->date = $request->date;
        if ($request->file('ownersign')) {
            $rag->ownersign = $filename1;
        }
        if ($request->file('tenantsign')) {
            $rag->tenantsign = $filename2;
        }
        $rag->save();





        return redirect("rent-agreement-list")->with("success", "Agreement Updated Successfully.");
    }

    public function delete_agreement($id)
    {
        $query = RentAgreement::find($id);
        $prop = Property::find($query->property_id);
        $prop->availability_status = 'Available';
        $prop->save();
        $query->delete();
        return redirect("rent-agreement-list")->with("success", "Agreement Updated Successfully.");
    }

    public function agreements()
    {
        return view("admin.property.agreementlist");
    }

    public function agreement_data(Request $request)
    {
        if ($request->ajax()) {
            $data =  DB::table('rent_agreements')
                ->select('rent_agreements.*', 'tenants.tenant_name', 'tenants.tenant_mobile', 'properties.property_name', 'properties.address', 'properties.owner_name')
                ->join('tenants', 'tenants.id', '=', 'rent_agreements.tenant_id')
                ->join('properties', 'properties.id', '=', 'rent_agreements.property_id')
                ->orderBy('rent_agreements.id', 'desc')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)"   class="edit btn btn-primary btn-sm" onclick="downLoadAgreemtn(' . $row->id . ')"><i class="fa fa-file"></i></a>
					<a href="' . url('edit-agreement/' . $row->id) . '" onclick="return actionconfirm()" class="edit btn btn-success btn-sm"><i class="fa fa-edit"></i></a> <a href="' . url('delete-agreement/' . $row->id) . '" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
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
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('edit-amenity/' . $row->id) . '" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= '<a href="' . url('delete-amenity/' . $row->id) . '" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function storeAmenity(Request $request)
    {
        $am = new Amenity();
        $am->amenity = $request->amenity;
        $am->save();

        return redirect()->back()->with("success", "Amenity Added Succesfully");
    }

    public function updateAmenity(Request $request)
    {
        $am = Amenity::find($request->id);
        $am->amenity = $request->amenity;
        $am->save();

        return redirect("amenities")->with("success", "Amenity Updated Succesfully");
    }

    public function edit_amenity($id)
    {
        $amenity = Amenity::find($id);
        return view("master.edit_amenity", ["amenity" => $amenity]);
    }

    public function  delete_amenity($id)
    {
        Amenity::find($id)->delete();

        return redirect()->back()->with("success", "Amenity Deleted Succesfully");
    }

    public function facilities()
    {
        return view("master.facilities");
    }

    public function facilities_data(Request $request)
    {
        if ($request->ajax()) {
            $data =  DB::table('facilities')
                ->orderBy('id', 'desc')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('edit-facility/' . $row->id) . '" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= '<a href="' . url('delete-facility/' . $row->id) . '" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function storeFacility(Request $request)
    {
        $fac = new Facility();
        $fac->facility = $request->facility;
        $fac->save();

        return redirect()->back()->with("success", "Facility Added Succesfully");
    }

    public function updateFacility(Request $request)
    {
        $fac = Facility::find($request->id);
        $fac->facility = $request->facility;
        $fac->save();

        return redirect("facilities")->with("success", "Facility Updated Succesfully");
    }

    public function edit_facility($id)
    {
        $facility = Facility::find($id);
        return view("master.edit_facility", ["facility" => $facility]);
    }

    public function  delete_facility($id)
    {
        Facility::find($id)->delete();

        return redirect()->back()->with("success", "Facility Deleted Succesfully");
    }

    public function responsibility()
    {
        return view("master.responsibility");
    }

    public function storeResponsibility(Request $request)
    {
        $res = new Responsibility();
        $res->responsibility = $request->responsibility;
        $res->save();

        return redirect()->back()->with("success", "Responsibility Added Succesfully");
    }

    public function responsibilities_list(Request $request)
    {
        if ($request->ajax()) {
            $data =  DB::table('responsibilities')
                ->orderBy('id', 'desc')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('edit-responsibility/' . $row->id) . '" onclick="return actionconfirm()" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= '<a href="' . url('delete-responsibility/' . $row->id) . '" onclick="return actionconfirm()" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit_responsibility($id)
    {
        $responsibility = Responsibility::find($id);
        return view("master.edit_responsibility", ["responsibility" => $responsibility]);
    }

    public function updateResponsibility(Request $request)
    {
        $fac = Responsibility::find($request->id);
        $fac->responsibility = $request->responsibility;
        $fac->save();

        return redirect("responsibility")->with("success", "Responsibility Updated Succesfully");
    }

    public function  delete_responsibility($id)
    {
        Responsibility::find($id)->delete();

        return redirect()->back()->with("success", "Responsibility Deleted Succesfully");
    }
}

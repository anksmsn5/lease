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
use DB;
use DataTables;

class RentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view("admin.rent.index");
    }

    public function collect()
    {
        $data = DB::table('rent_agreements')
            ->select('rent_agreements.agreement_id', 'properties.property_id', 'tenants.tenant_mobile', 'tenants.tenant_name')
            ->join('tenants', 'tenants.id', '=', 'rent_agreements.tenant_id')
            ->join('properties', 'properties.id', '=', 'rent_agreements.property_id')
            ->get();
        return view("admin.rent.collect", ["data" => $data]);
    }

    public function collect_rent(Request $request)
    {
        $rent = Rent::where('agreement_id', $request->keyword)->where('status', 'UnPaid')->orWhere('deposit_status', 'UnPaid')->get();
        $previousbalance = Payment::where('agreement_id', $request->keyword)->orderBy('id', 'DESC')->first();
        if (count($rent)) {
            $data = DB::table('rents')
                ->select('rents.*', 'properties.property_id', 'tenants.tenant_mobile', 'tenants.tenant_name')
                ->join('tenants', 'tenants.id', '=', 'rents.tenant_id')
                ->join('rent_agreements', 'rent_agreements.agreement_id', '=', 'rents.agreement_id')
                ->join('properties', 'properties.id', '=', 'rent_agreements.property_id')
                ->where('rents.agreement_id', $request->keyword)
                ->where('rents.status', 'UnPaid')
                ->get();
            $deposit = DB::table('rents')
                ->select('rents.*', 'properties.property_id', 'tenants.tenant_mobile', 'tenants.tenant_name')
                ->join('tenants', 'tenants.id', '=', 'rents.tenant_id')
                ->join('rent_agreements', 'rent_agreements.agreement_id', '=', 'rents.agreement_id')
                ->join('properties', 'properties.id', '=', 'rent_agreements.property_id')
                ->where('rents.agreement_id', $request->keyword)
                ->where('rents.deposit_status', 'UnPaid')
                ->get();

            return view("admin.rent.collection", ["rent" => $rent, "data" => $data, "deposit" => $deposit, "previousbalance" => $previousbalance]);
        } else {
            return redirect()->back()->with("success", "No Dues Found!");
        }
    }

    public function make_payment(Request $request)
    {

        $array = explode(",", $request->rent_for);

        if ($request->security) {
            $sstatus = 'Paid';
            $sarray = explode("~", $request->security);
        } else {
            $sstatus = 'UnPaid';
        }
        $rentfor = "Month(s) " . implode(" , ", $array);

        $mid = Payment::max('id');


        $rcid = "RC" . str_pad(($mid + 1), 6, "0", STR_PAD_LEFT);
        $pay = new Payment();
        $pay->receipt_id = $rcid;
        $pay->agreement_id = $request->agreement_id;
        $pay->tenant_id = $request->tenant_id;
        $pay->gst = $request->netgst;
        $pay->tds = $request->nettds;
        $pay->total = $request->total;
        $pay->paying = $request->paying;
        $pay->balance = $request->balance;
        $pay->previous_balance = $request->previous_balance;
        $pay->remarks = $request->remarks;
        $pay->pmode = $request->pmode;
        $pay->reference_id = $request->reference_id;
        $pay->chno = $request->chno;
        $pay->rent_for = $rentfor;
        $pay->remarks = $request->remarks;
        $pay->chdate = $request->chdate;
        $pay->bank = $request->bank;

        $pay->save();

        foreach ($array as $ar) {
            Rent::where('agreement_id', $request->agreement_id)->where('tenant_id', $request->tenant_id)->where('rent_no', $ar)

                ->update(array('status' => 'Paid'));
        }

        if ($request->security) {
            $sec = Rent::find($sarray[2]);
            $sec->deposit_status = 'Paid';
            $sec->save();
        }
        return redirect("collect-rent")->with("success", "Rent Recieved Successfully. <a target='_blank' href='" . url("receipt/" . $rcid) . "'>Click to Print</a>");
    }

    public function receipt($slug)
    {
        $payment =
            DB::table('payments')
            ->select('payments.*', 'tenants.tenant_mobile', 'tenants.tenant_name', 'rent_agreements.agreement_id', 'properties.property_name', 'properties.property_id', 'rent_agreements.gst', 'rent_agreements.tds_perc', 'payments.gst as netgst')
            ->join('tenants', 'tenants.id', '=', 'payments.tenant_id')
            ->join('rent_agreements', 'rent_agreements.agreement_id', '=', 'payments.agreement_id')
            ->join('properties', 'properties.id', '=', 'rent_agreements.property_id')
            ->where('payments.receipt_id', $slug)
            ->first();
        $tenant = Tenant::find($payment->tenant_id);
        return view("admin.rent.receipt", ["payment" => $payment, "tenant" => $tenant]);
    }

    public function receipt_list(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('payments')
                ->select('payments.*', 'tenants.tenant_mobile', 'tenants.tenant_name')
                ->join('tenants', 'tenants.id', '=', 'payments.tenant_id')

                ->get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $actionBtn = '
					<a href="' . url('receipt/' . $row->receipt_id) . '"  class="delete btn btn-danger btn-sm" target="_blank"><i class="fa fa-print"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'statusBtn'])
                ->make(true);
        }
    }
}

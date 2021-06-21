<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\CmsHelper as CmsHelper;
use DB;
use Auth;
use App\Users;
use App\Position;
use App\Customer;
use App\Customer_contract;
use App\Customer_type;
use App\Machine_copy;
use Carbon\Carbon;


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


// -------------------- CUSTOMER.* --------------------

    public function customer(Request $request)
    {
      $table_customer = Customer::all();

      // $edit = Customer::where('id', $request->id)->first();


      // dd($saleman);

      return view('customer.customer',[
        'table_customer'  =>  $table_customer,
      ]);
    }


    public function customer_create(Request $request)
    {

      $customer = Customer::all();

      $customer_type = Customer_type::all();

      $region = DB::table('ref_region')->get();

      // dd(Auth::user()->id);


      return view('customer.customer_create',[
        'customer'        =>  $customer,
        'customer_type'   =>  $customer_type,
        'region'          =>  $region,
        'ref_province'    =>  $this->arr_ref_province(),
        'ref_district'    =>  $this->arr_ref_district(),
        'ref_sub_district' =>  $this->arr_ref_sub_district(),
      ]);
    }



    public function customer_insert(Request $request)
    {

      $data_customer = [
        "customer_code"  =>  $request->customer_code,
        "customer_name"  =>  $request->customer_name,
        "customer_type"  =>  $request->customer_type,
        "credit_term"    =>  $request->credit_term,
        "telephone"      =>  $request->telephone,
        "customer_email" =>  $request->customer_email,
        "area_zone"      =>  $request->area_zone,
        "address"        =>  $request->address,
        "province_id"    =>  $request->province_id,
        "district_id"    =>  $request->district_id,
        "sub_district_id" =>  $request->sub_district_id,
        "zip_code"       =>  $request->zip_code,
        "contact"        =>  $request->contact,
        "billing_date"   =>  $request->billing_date,
        "billing_date_2" =>  $request->billing_date_2,
        "check_date"     =>  $request->check_date,
        "create_by"      =>  Auth::user()->id,
        "created_at"     =>  Carbon::now(),
      ];
      // dd($data_post);

      $insert = Customer::insertGetId($data_customer);

        if($insert){
          session()->put('messages', 'okkkkkayyyyy');
          return redirect()->route('customer.index', $request->id)->with('Okayyyyy');
        }else{
          return redirect()->back()->with('Errorrr');
        }
    }


    public function customer_edit(Request $request)
    {

      $customer = Customer::all();

        return view('customer.customer_edit');
    }




    public function customer_contract(Request $request)
    {

      $customer_contract = DB::table('contract_rental')
                              ->join('customer', 'contract_rental.customer_id', '=', 'customer.id')
                              ->select('customer.id',
                                       'customer.customer_name',
                                       'customer.customer_code',
                                       'contract_rental.customer_id',
                                       'contract_rental.contract_number',
                                       'contract_rental.contract_type',
                                       'contract_rental.carry_contract',
                                       'contract_rental.start_contract',
                                       'contract_rental.end_contract',
                                       'contract_rental.contract_type',
                                       'contract_rental.create_by',
                                       'contract_rental.created_at',
                                      )
                              // ->groupby('customer.id', $request->id)
                              ->get();
                  // dd($customer_contract);

      $contract_type = [ 1 => 'LEASING',
                         2 => 'PURCHURE',
                         3 => 'RENTAL',
                         4 => 'Payment By Installments',
                       ];

        return view('customer.customer_contract',[
          'customer_contract' => $customer_contract,
          'contract_type'     => $contract_type
        ]);
    }


    public function customer_contract_create(Request $request)
    {

      $data = Customer::where('id' , $request->id)->first();

      $saleman = Users::where('departments', 1)->get();

      $contract_types = [ 1 => 'LEASING',
                         2 => 'PURCHURE',
                         3 => 'RENTAL',
                         4 => 'Payment By Installments',
                       ];


      return view('customer.customer_contract_create',[
        'data'            =>  $data,
        'saleman'            =>  $saleman,
        'contract_types'  => $contract_types
      ]);
    }


    public function customer_contract_insert(Request $request)
    {

      $data_contract = [
        "customer_id"        =>  $request->id, //from CUSTOMER table
        "salesman_id"        =>  $request->salesman_id, //from USERS table
        "contract_number"    =>  $request->contract_number,
        "carry_contract"     =>  $request->carry_contract,
        "start_contract"     =>  $request->start_contract,
        "end_contract"       =>  $request->end_contract,
        "contract_type"      =>  $request->contract_type,
        "cycle_meter_date_1" =>  $request->cycle_meter_date_1,
        "cycle_meter_date_2" =>  $request->cycle_meter_date_2,
        "create_by"          =>  Auth::user()->id,
        "created_at"         =>  Carbon::now(),
      ];
      // dd($data_contract);

      $insert = Customer_contract::insertGetId($data_contract);

        if($insert){
          session()->put('contract', 'okkkkkayyyyy');
          return redirect()->route('customer.contract', $request->id)->with('Okayyyyy');
        }else{
          return redirect()->back()->with('Errorrr');
        }
    }


    public function customer_contract_edit(Request $request)
    {

        $customer = Customer_contract::first();

        return view('customer.customer_contract_edit');
    }






// -------------------- OUR.* --------------------

// --- EMPLOYEE ---
    public function index()
    {

      $data = Users::all();

      return view('employee.employee',[
        'data'  =>  $data
      ]);
    }
    public function employee_create()
    {

      return view('employee.employee_create',[
        // 'data'  =>  $data
      ]);
    }
// --- END EMPLOYEE ---



// --- MACHINE ---
    public function machine_copy()
    {
      $data_machine = Machine_copy::all();

      return view('employee.machine_copy',[
        'data_machine'  =>  $data_machine
      ]);
    }
    public function machine_copy_create()
    {

      return view('employee.machine_copy_create',[
        // 'data'  =>  $data
      ]);
    }
// --- END MACHINE ---



// --- PRICE_RATE ---
    public function price_rate()
    {

      return view('employee.price_rate',[
        // 'data'  =>  $data
      ]);
    }
    // --- END PRICE_RATE ---



    public function arr_ref_province()
    {  //ทำข้อมูล query ให้เป็น enum
      $query=DB::table('ref_province')
                  ->select('province_id','province_name')
                  ->orderby('province_name')
                  ->get();
      foreach($query as $val)
      {
        $ref_province[$val->province_id]=trim($val->province_name);
      }
      return $ref_province;
    }

    public function arr_ref_district()
    { //ทำข้อมูล query ให้เป็น enum
      $query=DB::table('ref_district')
                ->select('district_id','district_name')
                ->orderby('district_name')
                ->get();
      foreach($query as $val)
      {
        $ref_district[$val->district_id]=trim($val->district_name);
      }
      return $ref_district;
    }

    public function arr_ref_sub_district()
    {  //ทำข้อมูล query ให้เป็น enum
      $query=DB::table('ref_sub_district')
                ->select('sub_district_id','sub_district_name')
                ->orderby('sub_district_name')
                ->get();
      foreach($query as $val)
      {
        $ref_sub_district[trim($val->sub_district_id)]=trim($val->sub_district_name);
      }
      return $ref_sub_district;
    }


    public function findDistrict(Request $request){
      //query distric casecade from provine
      $ref_district=DB::table('ref_district')->select('district_id','district_name')->where('province_id',$request->province_id) ->get();
      return response()->json($ref_district);
    }
    public function findSubDistrict(Request $request){
      //query sub distric casecade from distric
      $ref_sub_district=DB::table('ref_sub_district')->select('sub_district_id','sub_district_name')->where('district_id',$request->district_id) ->get();
      return response()->json($ref_sub_district);
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\CmsHelper as CmsHelper;
use App\Exceptions\Handler;
use Storage;
use File;
use DB;
use Auth;
use App\Users;
use App\Position;
use App\Customer;
use App\Province;
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

      $province = Province::all();
      // dd($province);


      // $edit = Customer::where('id', $request->id)->first();


      // dd($saleman);

      return view('customer.customer',[
        'table_customer'  =>  $table_customer,
        'province'        =>  $province,
      ]);
    }


    public function customer_create(Request $request)
    {

      $customer = Customer::all();

      $customer_type = Customer_type::all();

      $region = DB::table('ref_region')->get();

      $monthly = DB::table('ref_monthly')->get();
      // dd($monthly);


      return view('customer.customer_create',[
        'customer'        =>  $customer,
        'customer_type'   =>  $customer_type,
        'region'          =>  $region,
        'monthly'         =>  $monthly,
        'ref_province'    =>  $this->arr_ref_province(),
        'ref_district'    =>  $this->arr_ref_district(),
        'ref_sub_district' =>  $this->arr_ref_sub_district(),
      ]);
    }



    public function customer_insert(Request $request)
    {

      $data_customer = [
        "customer_code"   =>  $request->customer_code,
        "customer_name"   =>  $request->customer_name,
        "customer_type"   =>  $request->customer_type,
        "tax_identify"    =>  $request->tax_identify,
        "credit_term"     =>  $request->credit_term,
        "area_zone"        =>  $request->area_zone,
        "address"         =>  $request->address,
        "province_id"     =>  $request->province_id,
        "district_id"     =>  $request->district_id,
        "sub_district_id" =>  $request->sub_district_id,
        "zip_code"        =>  $request->zip_code,
// ---------------------------------------------------------
        "telephone"       =>  $request->telephone,
        "telephone_2"     =>  $request->telephone_2,
        "telephone_3"      =>  $request->telephone_3,
        "customer_email"  =>  $request->customer_email,
        "customer_email_2" =>  $request->customer_email_2,
        "customer_email_3" =>  $request->customer_email_3,
        "line"             =>  $request->line,
        "line_2"           =>  $request->line_2,
        "line_3"           =>  $request->line_3,
        "contact"          =>  $request->contact,
        "contact_2"        =>  $request->contact_2,
        "contact_3"        =>  $request->contact_3,
// ---------------------------------------------------------
        "location_billing"        =>  $request->location_billing,
        "location_branch_billing" =>  $request->location_branch_billing,
        "weekly_billing"   =>  $request->weekly_billing,
        "monthly_billing"  =>  $request->monthly_billing,
        "fixdate_billing_1"  =>  $request->fixdate_billing_1,
        "fixdate_billing_2"  =>  $request->fixdate_billing_2,
        "billing_date"     =>  $request->billing_date,
        "billing_date_2"   =>  $request->billing_date_2,
// ---------------------------------------------------------
        "location_check"          =>  $request->location_check,
        "location_branch_check"   =>  $request->location_branch_check,
        "weekly_check"     =>  $request->weekly_check,
        "monthly_check"    =>  $request->monthly_check,
        "fixdate_check_1"  =>  $request->fixdate_check_1,
        "fixdate_check_2"  =>  $request->fixdate_check_2,
        "check_date"       =>  $request->check_date,
        "check_date_2"     =>  $request->check_date_2,
// ---------------------------------------------------------
        "remark"          =>  $request->remark,
        "files"           =>  $request->files,
        "create_by"       =>  Auth::user()->id,
        "created_at"      =>  date('Y-m-d H:i:s')
      ];
      // dd($data_customer);

      //  --  UPLOAD FILE  --
    if ($request->file('files')->isValid()) {
          //TAG input [type=file] ดึงมาพักไว้ในตัวแปรที่ชื่อ files
        $file=$request->file('files');
          //ตั้งชื่อตัวแปร $file_name เพื่อเปลี่ยนชื่อ + นามสกุลไฟล์
        $name='file_'.date('dmY_His');
        $file_name = $name.'.'.$file->getClientOriginalExtension();
          // upload file ไปที่ PATH : public/file_upload
        $path = $file->storeAs('public/file_upload',$file_name);
        $data_customer['files'] = $file_name;
    }


      $output = Customer::insert($data_customer);

        if($output){
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

      $monthly = DB::table('ref_monthly')->get();



      return view('customer.customer_contract_create',[
        'data'            =>  $data,
        'saleman'         =>  $saleman,
        'contract_types'  =>  $contract_types,
        'monthly'         =>  $monthly,
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
      $dno_status = [ 1 => 'RPE',
                      2 => 'RRP'
                    ];

      $brands = [ 1 => 'Canon',
                  2 => 'HP',
                  3 => 'EPSON',
                  4 => 'Kyocera',
                  5 => 'BROTHER',
                ];

      $type_of_machine = [ 1 => 'new',
                           2 => 'demo',
                           3 => 'referbish',
                         ];



      return view('employee.machine_copy_create',[
        'dno_status'  =>  $dno_status,
        'brands'      =>  $brands,
        'type_of_machine'  =>  $type_of_machine,
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




    //  -- DOWNLOAD --
    public function DownloadFile(Request $request){
      $query = DB::table('customer')
                    ->select('id', 'files')
                    ->where('id', $request->id)
                    ->first();

      if(!$query){
        return view('error-page.error404');
      }

      $path = $query->files;

      // return Storage::disk('research')->download($path);

      if(Storage::disk('billing_data')->exists($path)) {
        return Storage::disk('billing_data')->download($path);
      }else {
        return view('error-page.error405');
      }

    }
    //  -- END DOWNLOAD --



}

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
use App\Contract_x_machine;
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
        "area_zone"       =>  $request->area_zone,
        "address"         =>  $request->address,
        "province_id"     =>  $request->province_id,
        "district_id"     =>  $request->district_id,
        "sub_district_id" =>  $request->sub_district_id,
        "zip_code"        =>  $request->zip_code,
// ---------------------------------------------------------
        "contact"          =>  $request->contact,
        "contact_2"        =>  $request->contact_2,
        "contact_3"        =>  $request->contact_3,
        "telephone"        =>  $request->telephone,
        "telephone_2"      =>  $request->telephone_2,
        "telephone_3"      =>  $request->telephone_3,
        "customer_email"   =>  $request->customer_email,
        "customer_email_2" =>  $request->customer_email_2,
        "customer_email_3" =>  $request->customer_email_3,
        "line"             =>  $request->line,
        "line_2"           =>  $request->line_2,
        "line_3"           =>  $request->line_3,
// ---------------------------------------------------------
        "location_billing"        =>  $request->location_billing,
        "location_branch_billing" =>  $request->location_branch_billing,
        "weekly_billing"     =>  $request->weekly_billing,
        "monthly_billing"    =>  $request->monthly_billing,
        "fixdate_billing_1"  =>  $request->fixdate_billing_1,
        "fixdate_billing_2"  =>  $request->fixdate_billing_2,
        "fixdate_billing_3"  =>  $request->fixdate_billing_3,
        "fixdate_billing_4"  =>  $request->fixdate_billing_4,
        "billing_date"       =>  $request->billing_date,
        "billing_date_2"     =>  $request->billing_date_2,
// ---------------------------------------------------------
        "location_check"          =>  $request->location_check,
        "location_branch_check"   =>  $request->location_branch_check,
        "weekly_check"     =>  $request->weekly_check,
        "monthly_check"    =>  $request->monthly_check,
        "fixdate_check_1"  =>  $request->fixdate_check_1,
        "fixdate_check_2"  =>  $request->fixdate_check_2,
        "fixdate_check_3"  =>  $request->fixdate_check_3,
        "fixdate_check_4"  =>  $request->fixdate_check_4,
        "check_date"       =>  $request->check_date,
        "check_date_2"     =>  $request->check_date_2,
// ---------------------------------------------------------
        "remark"          =>  $request->remark,
        "files"           =>  $request->files,
        "files_2"         =>  $request->files_2,
        "files_3"         =>  $request->files_3,
        "create_by"       =>  Auth::user()->id,
        "created_at"      =>  date('Y-m-d H:i:s')
      ];
      // dd($data_customer);

       // --  UPLOAD FILE  --
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
    if ($request->file('files_2')->isValid()) {
          //TAG input [type=file] ดึงมาพักไว้ในตัวแปรที่ชื่อ files
        $file=$request->file('files_2');
          //ตั้งชื่อตัวแปร $file_name เพื่อเปลี่ยนชื่อ + นามสกุลไฟล์
        $name='file_'.date('dmY_His');
        $file_name = $name.'.'.$file->getClientOriginalExtension();
          // upload file ไปที่ PATH : public/file_upload
        $path = $file->storeAs('public/file_upload',$file_name);
        $data_customer['files_2'] = $file_name;
    }
    if ($request->file('files_3')->isValid()) {
          //TAG input [type=file] ดึงมาพักไว้ในตัวแปรที่ชื่อ files
        $file=$request->file('files_3');
          //ตั้งชื่อตัวแปร $file_name เพื่อเปลี่ยนชื่อ + นามสกุลไฟล์
        $name='file_'.date('dmY_His');
        $file_name = $name.'.'.$file->getClientOriginalExtension();
          // upload file ไปที่ PATH : public/file_upload
        $path = $file->storeAs('public/file_upload',$file_name);
        $data_customer['files_3'] = $file_name;
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
      $edit_customer = Customer::where('id', $request->id)->first();

      $credit_term = [ '7'   => '7',
                       '15'  => '15',
                       '30'  => '30',
                       '45'  => '45',
                       '60'  => '60',
                       '90'  => '90',
                       '120' => '120',
                     ];

      $customer_type = Customer_type::all();

      $region = DB::table('ref_region')->get();

      $monthly = DB::table('ref_monthly')->get();

      $ref_district = DB::table('ref_district')->get();

      $ref_sub_district = DB::table('ref_sub_district')->get();

      $location = [ 'สำนักงานใหญ่' => 'สำนักงานใหญ่',
                    'สาขา'       => 'สาขา',
                 ];

      $weekly = [ ''        => '- เลือกวันที่ -',
                 'วันอาทิตย์'  => 'วันอาทิตย์',
                 'วันจันทร์'   => 'วันจันทร์',
                 'วันอังคาร'   => 'วันอังคาร',
                 'วันพุธ'     => 'วันพุธ',
                 'วันพฤหัสบดี' => 'วันพฤหัสบดี',
                 'วันศุกร์'     => 'วันศุกร์',
                 'วันเสาร์'    => 'วันเสาร์',
               ];

        return view('customer.customer_edit',[
          'edit_customer'    =>  $edit_customer,
          'credit_term'      =>  $credit_term,
          'customer_type'    =>  $customer_type,
          'region'           =>  $region,
          'monthly'          =>  $monthly,
          'ref_district'     =>  $ref_district,
          'ref_sub_district' =>  $ref_sub_district,
          'location'         =>  $location,
          'weekly'           =>  $weekly,
          'ref_province'     =>  $this->arr_ref_province(),
          'ref_district'     =>  $this->arr_ref_district(),
          'ref_sub_district' =>  $this->arr_ref_sub_district(),
        ]);
    }



    public function save_customer_edit(Request $request)
    {
      $update = DB::table('customer')
                  ->where('id', $request->id)
                  ->update([
                            "customer_code"   =>  $request->customer_code,
                            "customer_name"   =>  $request->customer_name,
                            "customer_type"   =>  $request->customer_type,
                            "tax_identify"    =>  $request->tax_identify,
                            "credit_term"     =>  $request->credit_term,
                            "area_zone"       =>  $request->area_zone,
                            "address"         =>  $request->address,
                            "province_id"     =>  $request->province_id,
                            "district_id"     =>  $request->district_id,
                            "sub_district_id" =>  $request->sub_district_id,
                            "zip_code"        =>  $request->zip_code,
                    // ---------------------------------------------------------
                            "contact"          =>  $request->contact,
                            "contact_2"        =>  $request->contact_2,
                            "contact_3"        =>  $request->contact_3,
                            "telephone"        =>  $request->telephone,
                            "telephone_2"      =>  $request->telephone_2,
                            "telephone_3"      =>  $request->telephone_3,
                            "customer_email"   =>  $request->customer_email,
                            "customer_email_2" =>  $request->customer_email_2,
                            "customer_email_3" =>  $request->customer_email_3,
                            "line"             =>  $request->line,
                            "line_2"           =>  $request->line_2,
                            "line_3"           =>  $request->line_3,
                    // ---------------------------------------------------------
                            "location_billing"        =>  $request->location_billing,
                            "location_branch_billing" =>  $request->location_branch_billing,
                            "weekly_billing"     =>  $request->weekly_billing,
                            "monthly_billing"    =>  $request->monthly_billing,
                            "fixdate_billing_1"  =>  $request->fixdate_billing_1,
                            "fixdate_billing_2"  =>  $request->fixdate_billing_2,
                            "fixdate_billing_3"  =>  $request->fixdate_billing_3,
                            "fixdate_billing_4"  =>  $request->fixdate_billing_4,
                            "billing_date"       =>  $request->billing_date,
                            "billing_date_2"     =>  $request->billing_date_2,
                    // ---------------------------------------------------------
                            "location_check"          =>  $request->location_check,
                            "location_branch_check"   =>  $request->location_branch_check,
                            "weekly_check"     =>  $request->weekly_check,
                            "monthly_check"    =>  $request->monthly_check,
                            "fixdate_check_1"  =>  $request->fixdate_check_1,
                            "fixdate_check_2"  =>  $request->fixdate_check_2,
                            "fixdate_check_3"  =>  $request->fixdate_check_3,
                            "fixdate_check_4"  =>  $request->fixdate_check_4,
                            "check_date"       =>  $request->check_date,
                            "check_date_2"     =>  $request->check_date_2,
                    // ---------------------------------------------------------
                            "remark"          =>  $request->remark,
                          ]);

      if($update){
        session()->put('savecustomer', 'okkkkkayyyyy');
        return redirect()->route('customer.index')->with('Okayyyyy');
      }else{
        return redirect()->back()->with('Errorrr');
      }

    }





    public function customer_contract(Request $request)
    {

      $customer_contract = DB::table('contract_rental')
                              ->join('customer', 'contract_rental.customer_id', '=', 'customer.id')
                              ->select(
                                       'customer.customer_name',
                                       'customer.customer_code',
                                    //--------------------------------------
                                       'contract_rental.id',
                                       'contract_rental.customer_id',
                                       'contract_rental.contract_number',
                                       'contract_rental.contract_type',
                                       'contract_rental.number_of_machine',
                                       'contract_rental.salesman_id',
                                       'contract_rental.carry_contract',
                                       'contract_rental.start_contract',
                                       'contract_rental.end_contract',
                                       'contract_rental.cycle_meter_date_1',
                                       'contract_rental.cycle_meter_date_2',
                                       'contract_rental.rental_cost',
                                       'contract_rental.utility_1',
                                       'contract_rental.utility_2',
                                       'contract_rental.a4_bk_service',
                                       'contract_rental.a4_color_service',
                                       'contract_rental.a3_bk_service',
                                       'contract_rental.a3_color_service',
                                       'contract_rental.benefit_cost',
                                       'contract_rental.insurance_cost',
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

      $data = Customer::where('id' , $request->customer_id)->first();

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



    // -- Select2 --
    public function List_Serial_Machine(Request $request){

      $result = Machine_copy::query();

      //search
      if(isset($request->searchTerm)){
        $result = $result->select('machine_copy.id','machine_copy.serial_no');
        $result = $result->where('machine_copy.serial_no', 'like', '%' . $request->searchTerm . '%');
        $result = $result->orderby('machine_copy.id','ASC');
        $result = $result->get();
      //dropdown
      }else {
        $result = $result->select('machine_copy.id','machine_copy.serial_no');
        $result = $result->orderby('machine_copy.id','ASC');
        $result = $result->get();
      }

      $datas = array();
      foreach($result as $data){
        $json_datas[] = array("id"=>$data->id, "text"=>$data->serial_no);
      }
      //FIX System-Error-Logs by [if]
      if(count($result)>0){
        return response()->json($json_datas);
      }
    }
    // -- END  --



    public function customer_contract_insert(Request $request)
    {
      $i = 0; //Index of S/N

          $data_contract = [
            "customer_id"        =>  $request->id, //from CUSTOMER table
            "salesman_id"        =>  $request->salesman_id, //from USERS table
            "contract_number"    =>  $request->contract_number,
            "number_of_machine"  =>  $request->number_of_machine,
            "contract_type"      =>  $request->contract_type,
            "install_site"       =>  $request->install_site,
        //----------------------------------------------------------
            "carry_contract"     =>  $request->carry_contract,
            "start_contract"     =>  $request->start_contract,
            "end_contract"       =>  $request->end_contract,
            "cycle_meter_date_1" =>  $request->cycle_meter_date_1,
            "cycle_meter_date_2" =>  $request->cycle_meter_date_2,
        //----------------------------------------------------------
            "rental_cost"        =>  $request->rental_cost,
            "utility_1"          =>  $request->utility_1,
            "utility_2"          =>  $request->utility_2,
            "a4_bk_service"      =>  $request->a4_bk_service,
            "a4_color_service"   =>  $request->a4_color_service,
            "a3_bk_service"      =>  $request->a3_bk_service,
            "a3_color_service"   =>  $request->a3_color_service,
            "benefit_cost"       =>  $request->benefit_cost,
            "insurance_cost"     =>  $request->insurance_cost,
            "create_by"          =>  Auth::user()->id,
            "created_at"         =>  Carbon::now(),
          ];

          $insert = Customer_contract::insertGetId($data_contract);


        foreach($request->machine_dno_id as $value){

          $contract_x_machine[] = [
            "contract_id"   =>  $insert,
            "customer_id"   =>  $request->id,
            "machine_id"    =>  $request->machine_dno_id[$i],
          ];


        //If $insert Succuss is UPDATE machine_copy
        DB::table('machine_copy')
          ->where('id', $request->machine_dno_id[$i])
          ->update(['status' => "1"]);

      $i = $i+1;

    }

      if($insert){

          Contract_x_machine::insert($contract_x_machine);

        session()->put('contract', 'okkkkkayyyyy');
        return redirect()->route('customer.contract')->with('Okayyyyy');
      }else{
        return redirect()->back()->with('Errorrr');
      }
    }




    public function customer_contract_edit(Request $request)
    {

      $edit_contract = DB::table('customer')
                        ->join('contract_rental', 'customer.id','=','contract_rental.customer_id')
                        ->where('contract_rental.id' ,$request->id)
                        ->first();
            // dd($edit_contract);

      $contract_types = [ 1 => 'LEASING',
                         2 => 'PURCHURE',
                         3 => 'RENTAL',
                         4 => 'Payment By Installments',
                       ];

      $saleman = Users::where('departments', 1)->get();

      $monthly = DB::table('ref_monthly')->get();

      $data_other = [
                      'ต้นเดือน'   => 'ต้นเดือน',
                      'กลางเดือน' => 'กลางเดือน',
                      'ปลายเดือน' => 'ปลายเดือน',
                   ];

        return view('customer.customer_contract_edit',[
          'edit_contract'   =>  $edit_contract,
          'contract_types'  =>  $contract_types,
          'saleman'         =>  $saleman,
          'monthly'         =>  $monthly,
          'data_other'      =>  $data_other
        ]);
    }




    public function save_customer_contract_edit(Request $request)
    {
      $i = 0; //index

      $update_contract = DB::table('contract_rental')
                            ->where('id', $request->id)
                            ->update([
                                      "contract_number"     =>  $request->contract_number,
                                      "contract_type"       =>  $request->contract_type,
                                      "number_of_machine"   =>  $request->number_of_machine,
                                      "salesman_id"         =>  $request->salesman_id,
                                      "install_site"        =>  $request->install_site,
                                      "carry_contract"      =>  $request->carry_contract,
                                      "start_contract"      =>  $request->start_contract,
                                      "end_contract"        =>  $request->end_contract,
                                      "cycle_meter_date_1"  =>  $request->cycle_meter_date_1,
                                      "cycle_meter_date_2"  =>  $request->cycle_meter_date_2,
                                      "rental_cost"         =>  $request->rental_cost,
                                      "utility_1"           =>  $request->utility_1,
                                      "utility_2"           =>  $request->utility_2,
                                      "a4_bk_service"       =>  $request->a4_bk_service,
                                      "a4_color_service"    =>  $request->a4_color_service,
                                      "a3_bk_service"       =>  $request->a3_bk_service,
                                      "a3_color_service"    =>  $request->a3_color_service,
                                      "benefit_cost"        =>  $request->benefit_cost,
                                      "insurance_cost"      =>  $request->insurance_cost,
                                    ]);

                // dd($update_contract);

        if($update_contract){

          session()->put('savecontract', 'okkkkkayyyyy');
          return redirect()->route('customer.contract')->with('Okayyyyy');
        }else{
          return redirect()->back()->with('Errorrr');
        }
    }





// -------------------- Function GET Province -----------------------
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

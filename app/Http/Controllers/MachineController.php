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


class MachineController extends Controller
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


// -------------------- MACHINE-COPY --------------------

    public function machine_copy()
    {

      $data_tbl1_machine = Machine_copy::whereNull('status')
                                       ->whereNull('deleted_at')
                                       ->get();

      $data_tbl2_machine = DB::table('customer_x_machine')
                          ->join('machine_copy', 'customer_x_machine.machine_id', '=', 'machine_copy.id')
                          ->join('customer', 'customer_x_machine.customer_id', '=', 'customer.id')
                          ->join('contract_rental', 'customer_x_machine.contract_id', '=', 'contract_rental.id')
                          ->select('machine_copy.id',
                                  // 'machine_copy.customer_code',
                                  'machine_copy.brands',
                                  'machine_copy.model',
                                  'machine_copy.serial_no',
                                  'machine_copy.dno_number',
                                  'machine_copy.segment',
                                  'machine_copy.type_color_x_bk',
                                  'machine_copy.type_of_machine',
                                  'machine_copy.remark',
                                  'machine_copy.status',
                              //--------------------------------------
                                  // 'customer.id',
                                  'customer.customer_name',
                                  'customer.customer_code',
                              //--------------------------------------
                                  'contract_rental.id',
                                  'contract_rental.contract_number',
                                  'contract_rental.start_contract',
                                  'contract_rental.end_contract',
                                  'contract_rental.create_by',
                              //--------------------------------------
                                  'customer_x_machine.customer_id',
                                  'customer_x_machine.contract_id',
                                  'customer_x_machine.machine_id',
                                 )
                          ->get();

      $brands = [ 1 => 'CANON',
                  2 => 'EPSON',
                  3 => 'HP',
                  4 => 'KYOCERA',
                  5 => 'SAMSUNG',
                  6 => 'OTHERS',
                ];

      $type_of_machine = [ 1 => 'new',
                           2 => 'demo',
                           3 => 'referbish',
                         ];

      return view('employee.machine_copy',[
        'data_tbl1_machine' => $data_tbl1_machine,
        'data_tbl2_machine' => $data_tbl2_machine,
        'brands'           =>  $brands,
        'type_of_machine'  =>  $type_of_machine,

      ]);
    }



    public function machine_copy_create()
    {

      $brands = DB::table('ref_brands')->get();

      $segment = DB::table('ref_segment')->get();

      $type_of_machine = [ 1 => 'new',
                           2 => 'demo',
                           3 => 'referbish',
                         ];

      return view('employee.machine_copy_create',[
        'brands'      =>  $brands,
        'segment'     =>  $segment,
        'type_of_machine'  =>  $type_of_machine,
      ]);
    }




    public function machine_insert(Request $request)
    {

      $data_machine = [
        "brands"        =>  $request->brands,
        "model"         =>  $request->model,
        "serial_no"     =>  $request->serial_no,
        "dno_number"    =>  $request->dno_number,
        "segment"       =>  $request->segment,
        "type_of_machine"  =>  $request->type_of_machine,
        "type_color_x_bk"  =>  $request->type_color_x_bk,
        "remark"        =>  $request->remark,
        // "files"         =>  $request->files,
        "create_by"     =>  Auth::user()->id,
        "created_at"    =>  date('Y-m-d H:i:s')
      ];
      // dd($data_machine);

      //  --  UPLOAD FILE  --
    // if ($request->file('files')->isValid()) {
    //       //TAG input [type=file] ดึงมาพักไว้ในตัวแปรที่ชื่อ files
    //     $file=$request->file('files');
    //       //ตั้งชื่อตัวแปร $file_name เพื่อเปลี่ยนชื่อ + นามสกุลไฟล์
    //     $name='file_'.date('dmY_His');
    //     $file_name = $name.'.'.$file->getClientOriginalExtension();
    //       // upload file ไปที่ PATH : public/file_upload
    //     $path = $file->storeAs('public/file_upload',$file_name);
    //     $data_machine['files'] = $file_name;
    // }

      $insert = Machine_copy::insert($data_machine);

        if($insert){
          session()->put('machines', 'okkkkkayyyyy');
          return redirect()->route('customer.machine_copy', $request->id)->with('Okayyyyy');
        }else{
          return redirect()->back()->with('Errorrr');
        }
    }



    public function machine_edit(Request $request)
    {
      $edit_machine = Machine_copy::where('id', $request->id)->first();
      // dd($edit_machine);

      $brands = DB::table('ref_brands')->get();

      $segment = DB::table('ref_segment')->get();

      $type_of_machine = [ 1 => 'new',
                           2 => 'demo',
                           3 => 'referbish',
                         ];

      $type_color_x_bk = [ 'B&W'    => 'B&W',
                           'Colour' => 'Colour',
                         ];

      return view('employee.machine_edit',[
        'edit_machine'    =>  $edit_machine,
        'brands'          =>  $brands,
        'segment'         =>  $segment,
        'type_of_machine' =>  $type_of_machine,
        'type_color_x_bk' =>  $type_color_x_bk,
      ]);

    }



    public function save_machine_edit(Request $request)
    {
      $update = DB::table('machine_copy')
                  ->where('id', $request->id)
                  ->update([
                            "brands"      =>  $request->brands,
                            "model"       =>  $request->model,
                            "serial_no"   =>  $request->serial_no,
                            "dno_number"  =>  $request->dno_number,
                            "segment"     =>  $request->segment,
                            "type_color_x_bk"  =>  $request->type_color_x_bk,
                            "type_of_machine"  =>  $request->type_of_machine,
                            "remark"      =>  $request->remark,
                          ]);
                // dd($update);

      if($update){
        session()->put('savemachines', 'okkkkkayyyyy');
        return redirect()->route('customer.machine_copy')->with('Okayyyyy');
      }else{
        return redirect()->back()->with('Errorrr');
      }

    }



}

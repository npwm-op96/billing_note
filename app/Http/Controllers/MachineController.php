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
      $data_machine = Machine_copy::all();

      $type_of_machine = [ 1 => 'new',
                           2 => 'demo',
                           3 => 'referbish',
                         ];

      return view('employee.machine_copy',[
        'data_machine'  =>  $data_machine,
        'type_of_machine'  =>  $type_of_machine
      ]);
    }



    public function machine_copy_create()
    {
      $dno_status = [ 1 => 'RPE',
                      2 => 'RRP'
                    ];

      $brands = DB::table('ref_brands')->get();

      $segment = DB::table('ref_segment')->get();

      $type_of_machine = [ 1 => 'new',
                           2 => 'demo',
                           3 => 'referbish',
                         ];

      return view('employee.machine_copy_create',[
        'dno_status'  =>  $dno_status,
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
        "dno_status"    =>  $request->dno_status,
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
          return redirect()->route('our.machine_copy', $request->id)->with('Okayyyyy');
        }else{
          return redirect()->back()->with('Errorrr');
        }
    }


    public function machine_edit(Request $request)
    {

      return view('employee.machine_edit',[

      ]);

    }





}

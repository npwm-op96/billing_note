<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\CmsHelper as CmsHelper;
use DB;
use App\Users;
use App\Position;
use App\Customer;
use App\Customer_type;
use App\Machine_copy;
// use Carbon\Carbon;



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

    public function customer()
    {
      $customer = Customer::all();

      // $status_customer = [ 1 => 'ACTIVE',
      //                      2 => 'INACTIVE'
      //                    ];

      // $type = [ 1 => 'Commercial',
      //           2 => 'Company Limited'
      //         ];

      return view('customer',[
        'customer'        =>  $customer,
        // 'status_customer' =>  $status_customer
      ]);
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
                                       'contract_rental.start_contract',
                                       'contract_rental.end_contract',
                                      'contract_rental.contract_type'
                                        )
                              ->get();
                              // dd($customer_contract);

      $contract_type = [ 1 => 'LEASING',
                         2 => 'PURCHURE',
                         3 => 'RENTAL',
                         4 => 'Payment By Installments',
                       ];

        return view('customer_contract',[
          'customer_contract' => $customer_contract,
          'contract_type'     => $contract_type
        ]);
    }



    public function customer_create(Request $request)
    {

      $customer = Customer::all();

        return view('customer_create');
    }



// -------------------- OUR.* --------------------

// --- EMPLOYEE ---
    public function index()
    {

      $data = Users::all();

      return view('employee',[
        'data'  =>  $data
      ]);
    }
    public function employee_create()
    {

      return view('employee_create',[
        // 'data'  =>  $data
      ]);
    }
// --- END EMPLOYEE ---



// --- MACHINE ---
    public function machine_copy()
    {
      $data_machine = Machine_copy::all();

      return view('machine_copy',[
        'data_machine'  =>  $data_machine
      ]);
    }
    public function machine_copy_create()
    {

      return view('machine_copy_create',[
        // 'data'  =>  $data
      ]);
    }
// --- END MACHINE ---



// --- PRICE_RATE ---
    public function price_rate()
    {

      return view('price_rate',[
        // 'data'  =>  $data
      ]);
    }
    // --- END PRICE_RATE ---



}

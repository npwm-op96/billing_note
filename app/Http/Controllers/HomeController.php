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

    public function index()
    {

      $data = Users::all();

      return view('index',[
        'data'  =>  $data
      ]);
    }

    public function customer()
    {
      $customer = Customer::all();

      $type = [ 1 => 'Commercial',
                2 =>  'Company Limited'
              ];

      return view('customer',[
        'customer'  =>  $customer,
        'type'  =>  $type,
      ]);
    }


    public function customer_create(Request $request)
    {

      $customer = Customer::all();

        return view('customer_create');
    }

}

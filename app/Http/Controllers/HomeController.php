<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Recharge;
use App\Country;
use App\Operator;
use App\product;
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

    public function phoneNumber(Request $r){

      $validator = Validator::make($r->all(), [
        'number' => 'phone:LENIENT,BD',
      ]);

      if ($validator->fails()) {
          return 'fails';
      }

    }

    public function test(){
      $allcountry=Country::all();
      return view('recharge/test')->with('allcountry',$allcountry);
    }

    public function dolorphonetest(){
      return view('dolorphone/test');
    }


    // add oprator
    public function insertOprator(Request $r){
      $operatorid=explode(",",$r->operatorid);
      $operators_name=explode(",",$r->operator);
      $data=Operator::where('country_id',$r->countryid)->count();
      if($data!=count($operatorid)){
        for ($i=0; $i < count($operatorid); $i++) { 
            $operator=new Operator();
            $operator->country_id=$r->countryid;
            $operator->operators_id=$operatorid[$i];
            $operator->operators_name=$operators_name[$i];
            $operator->save();
        }
        return redirect()->back()->with('success', 'country inserted');  
      }else{
        return redirect()->back()->with('success', 'country already inserted');  
      }

    }

    // operator

    public function operator(){
      $allcountry=Operator::all();
      return view('recharge/operators')->with('allcountry',$allcountry);
    }
    

    public function insertproduct(Request $r){

      $product_list=explode(",",$r->product_list);
      $retail_price_list=explode(",",$r->retail_price_list);
      $wholesale_price_list=explode(",",$r->wholesale_price_list);

      for ($i=0; $i < count($product_list); $i++) { 

        // $data=product::where('operators_id',$operatorid[$i])->get();
          $operator=new product();
          
          $operator->countryid=$r->countryid;
          $operator->operatorid=$r->operatorid;
          $operator->destination_currency=$r->destination_currency;
          $operator->product_list=$product_list[$i];
          $operator->retail_price_list=$retail_price_list[$i];
          $operator->wholesale_price_list=$wholesale_price_list[$i];

          $operator->save();



      }

      return redirect()->back();

    }
}

<?php

namespace App\Http\Controllers;

use App\Recharge;
use App\Country;
use App\Operator;
use App\product;
use Illuminate\Http\Request;
use Auth;
use GuzzleHttp\Client;
class RechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recharge/index');
    }

    public function rechargeconfirms()
    {
      $data=session()->get('tests');
      $destination_msisdn=$data['destination_msisdn'];
      $msisdn=$data['destination_msisdn'];
      $login="guerrarecharge";
      $token="606238981457";
      //  MD5 calculation
      $key=time();
      $md5=md5($login.$token.$key);
      $client = new Client();
      $URI = 'https://airtime.transferto.com/cgi-bin/shop/topup';
      $params['form_params'] = array('login' => $login, 'key' => $key, 'md5' => $md5, 'destination_msisdn' => $destination_msisdn,'return_service_fee'=>'0','operatorid'=>$data['operators_id'],'return_promo'=>1,'msisdn'=>$msisdn,'product'=>$data['selectedproduct'],'action'=>'topup');
      $response = $client->post($URI, $params);
      $user=Auth::user();
      $user->balance=$user->balance-$data['selectedproductprice'];
      $user->save();
      return redirect('/')->with('success',"Mobile recharge successfully");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {   

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recharge  $recharge
     * @return \Illuminate\Http\Response
     */
    public function show($id,$data)
    {
      return view('recharge/confirm')->with('data',$data,$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recharge  $recharge
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $recharge)
    { 
      $recharge->session()->put('tests', $recharge->all());
      return response('success');
    }

    public function edits()
    { 
      return view('recharge/confirm');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recharge  $recharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recharge $recharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recharge  $recharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recharge $recharge)
    {
        //
    }


    public function getallcuntry(){

      

      $country=Country::all();
      return $country;
    }

    public function getallalloperators($r){
      $operators=Operator::firstOrFail()->where('country_id', $r)->get();
      return $operators;
    }

    public function getcuntry($r){
      $operators=Country::firstOrFail()->where('apicontryid', $r)->get();
      return $operators;
    }
}

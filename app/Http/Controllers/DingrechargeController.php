<?php
namespace App\Http\Controllers;
use App\Dingrecharge;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Auth;
use Cart;
class DingrechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
      return view('dingrecharge/index');
    }
    
    public function allcountry()
    {   
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://edts.ezedistributor.com/api/EdtsV3/GetCountries');
        return $response->getBody();
    }

    public function dingrecharges(Request $request)
    {
      $data=$request->all();

      Cart::add(['id' => $request->AccountNumber,'name'=>'product name','price'=>$request->SendValue,'qty'=>1,'options' => ['SkuCode' => $request->SkuCode,'SendValue' => $request->SendValue,'SendCurrencyIso' => $request->SendCurrencyIso, 'AccountNumber' =>  $request->AccountNumber,'DistributorRef' => '1212qsad','ValidateOnly'=>true]]);
       return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dingrecharge  $dingrecharge
     * @return \Illuminate\Http\Response
     */
    public function show(Dingrecharge $dingrecharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dingrecharge  $dingrecharge
     * @return \Illuminate\Http\Response
     */
    public function edit(Dingrecharge $dingrecharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dingrecharge  $dingrecharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dingrecharge $dingrecharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dingrecharge  $dingrecharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dingrecharge $dingrecharge)
    {
        //
    }
}

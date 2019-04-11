<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use GuzzleHttp\Client;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Cart::destroy();
      return view('cart.index');
    }

    public function send()
    { 
      $user = '9CCAACB01E764FA4A83C94D7408DA2A4';
      $password = '5G4G8EV53HDVYC95ARS5USHN62636UT8';

      $cart=Cart::content();
      $abc=[];
      foreach ($cart as $v) {
        $abc=[
          "SkuCode" => $v->options['SkuCode'],
          "SendValue" => $v->options['SendValue']*$v->qty,
          "SendCurrencyIso" =>$v->options['SendCurrencyIso'],
          "AccountNumber" => $v->options['AccountNumber'],
          "DistributorRef" => $v->options['DistributorRef'],
          "ValidateOnly"=> true
        ];

        dump($abc);

        $abc1=[
          "SkuCode" => "string",
          "SendValue" => 0,
          "SendCurrencyIso" =>"string",
          "AccountNumber" => "string",
          "DistributorRef" => "string",
          "ValidateOnly"=> true
        ];
          $curl = curl_init();
          curl_setopt_array($curl, array(
              CURLOPT_URL => "https://edts.ezedistributor.com/api/EdtsV3/SendTransfer",
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode($abc1),
              CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
              ),
          ));
          curl_setopt($curl, CURLOPT_USERPWD, $user . ":" . $password);
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          curl_close($curl);
          
          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            print_r(json_decode($response));
          }
      }
    }

    public function remove($rowId)
    {
      Cart::remove($rowId);
      return redirect()->back();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      Cart::destroy();
      return redirect()->back();
    }
}

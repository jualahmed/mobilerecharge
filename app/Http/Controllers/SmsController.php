<?php

namespace App\Http\Controllers;

use App\sms;
use Illuminate\Http\Request;
use Twilio;
use Auth;

class SmsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('twlliosms/index');
  }

  public function addwallet()
  {
    return view('auth/addwallet');
  }

  public function sendmessage(Request $r)
  {
    $auth=Auth::user();
    if ($auth->balance>1) {
      Twilio::message($r->number,$r->message);
      $auth->balance=$auth->balance-.50;
      $auth->save();
      $sen['success'] = true;
    }else{
      $sen['success'] = false;
    }
    return response($sen);
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
    // Twilio::message('+8801784622362',   'how are yo?');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\sms  $sms
   * @return \Illuminate\Http\Response
   */
  public function show(sms $sms)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\sms  $sms
   * @return \Illuminate\Http\Response
   */
  public function edit(sms $sms)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\sms  $sms
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, sms $sms)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\sms  $sms
   * @return \Illuminate\Http\Response
   */
  public function destroy(sms $sms)
  {
      //
  }
}

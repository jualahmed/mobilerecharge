@extends('layouts.app')
@section('content')

<?php
    $login="guerrarecharge";
    $token  ="606238981457";
    //  MD5 calculation
    $key=time();
    $md5=md5($login.$token.$key);
?>
  <section id="recharge">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="w-75 m-auto">
                  <h2 class="header-index-title py-5">Recharge phone credit directly &amp; safely worldwide</h2>
                </div>
                <select-country login="<?php  echo  $login  ?>" keyss="<?php  echo  $key  ?>" md5="<?php  echo  $md5  ?>" token="{{ csrf_token() }}">
                </select-country>
            </div>
          </div>
      </div>
  </section>

@endsection

@extends('layouts.app')

@section('content')

<?php

    $login="guerrarecharge";
    
    $token  ="606238981457";

    //  MD5 calculation
    $key=time();

    $md5=md5($login.$token.$key);
?>

  <select-country login="<?php  echo  $login  ?>" keyss="<?php  echo  $key  ?>" md5="<?php  echo  $md5  ?>" token="{{ csrf_token() }}"></select-country>

  

 
@endsection

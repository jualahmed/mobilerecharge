@extends('layouts.app')

@section('content')  

<section id="sms" class="p-5 m-5">
  <div class="container">
    <div class="row">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Number</th>
                  <th>Currency</th>
                  <th>Price</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach(Cart::content() as $row) :?>
              <tr>
                  <td><p><strong>+<?php echo $row->id; ?></strong></p></td>
                  <td><?php echo $row->options->SendCurrencyIso; ?></td>
                  <td>$<?php echo $row->price; ?></td>
                  <td><a href="/cart/remove/<?php echo $row->rowId ; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Remove</a></td>
              </tr>
            <?php endforeach;?>

          </tbody>
          
          <tfoot>
            <tr>
              <td>&nbsp;</td>
              <td>Total </td>
              <td><?php echo Cart::subtotal(); ?></td>
            </tr>
          </tfoot>
      </table>
        <div class="col-md-11 text-right">
          <a href="/cart/destroy" class="btn btn-danger btn-lg"><i class="fa fa-trash"></i> remove all</a>
        </div>
      @if(Auth::check())
        <div class="col-md-1 text-right">
          <a href="/cart/send" class="btn btn-lg btn-success">Send</a>
        </div>
      @else
        <div class="col-md-1 text-right">
          <a data-toggle="modal" data-target="#exampleModalLong" class="btn btn-lg btn-success" href="{{ route('login') }}">{{ __('Login') }}</a>
        </div>
      @endif

    </div>
  </div>
</section>

@endsection


<script src="https://cdn.jsdelivr.net/npm/vue@2.5.22/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
  $login="guerrarecharge";
  $token="606238981457";
  $key=time();
  $md5=md5($login.$token.$key);
  $url='https://airtime.transferto.com/cgi-bin/shop/topup';
?>

<div id="apps">
  <section id="rechargeSelect" style="padding: 30px" >
    <div class="container">
      <div class="index-header-content">

          <form name="recipient"  method="post" action="<?php echo  $url  ?>" >
            <input  type="hidden" name="login"  value="<?php  echo  $login  ?>" >
            <input  type="hidden" id="key" name="key"  value="<?php  echo  $key  ?>" >
            <input  type="hidden" id="md5" name="md5"  value="<?php  echo  $md5  ?>" >
            <input  type="hidden" name="action" value="msisdn_info" >
          </form> 

          <select name="" id="" @change="onChange($event)">
            <option>Select a country</option>
            @foreach($allcountry as $a)
              <option value="{{ $a['apicontryid'] }}" >{{ $a['name'] }} {{ $a['id'] }}</option>
            @endforeach
          </select>

          <br>
          <br>

          <form action="{{ route('instoperators') }}" method="POST">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="">operator</label>
            <textarea v-model='resoperator' name="operator" id="" cols="180" rows="10"></textarea>
            <label for="">operatorid</label>
            <textarea id="" name="operatorid" cols="180" rows="10"></textarea>
            <br>
            <br>
            <label for="">countryid</label>
            <input type="text" name="countryid">

            <input type="submit" value="submit">
          </form>
       
      </div>

      @if (\Session::has('success'))
          <div class="alert alert-success">
              <ul>
                  <li>{!! \Session::get('success') !!}</li>
              </ul>
          </div>
      @endif

    </div>
  </section>
</div>

<script>
  
  new Vue({
    el:'#apps',
    data:{
      login:"guerrarecharge",
      key:document.getElementById('key').value,
      md5:document.getElementById('md5').value,
      info_type:'country',
      content:'',
      action:'pricelist',
      api_url: 'https://cors-anywhere.herokuapp.com/https://airtime.transferto.com/cgi-bin/shop/topup',
      resoperator:'',
    },
    methods:{
      onChange(event) {
        var self = this;
        $.ajax({
          url: this.api_url,
          type: 'POST',
          data: {login: this.login,key:this.key,md5:this.md5,info_type:this.info_type,content:event.target.value,action:this.action},
        })
        .done(function(re) {
          self.resoperator=re;
        })
        .fail(function() {
          console.log("error");
        })

      },
    }
  })

</script>
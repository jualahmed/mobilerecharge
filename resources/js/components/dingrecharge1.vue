<template>
<div id="app">
    <!-- country section  -->
    <div class="bg-white">
      <multiselect 
        v-model="value"
        placeholder="Select a country"
        @select="countrys($event)"
        label="CountryIso"
        track-by="CountryName"
        :options="country"
        :searchable="true">
        <template slot="singleLabel" slot-scope="props">
          <img v-if="props.option.CountryIso" class="option__image" :src="country_logo_url+props.option.CountryIso+'.svg'" width="30px;">
          <img v-else class="option__image" :src="props.option.img" width="30px;">
          <span class="option__desc">
            <span class="option__title">{{ props.option.CountryName }}</span>
          </span>
        </template>
        <template slot="option" slot-scope="props">
          <div class="option__desc">
            <img class="option__image" :src="country_logo_url+props.option.CountryIso+'.svg'" alt="No Man’s Sky" width="30px;">
            <span class="option__title">{{ props.option.CountryName }}</span>
          </div>
        </template>
      </multiselect>
      <!-- <pre class="language-json"><code>{{ value  }}</code></pre> -->
    
      <p class="text-danger font-weight-bold p-1" v-if="iscountryselected">
        <span v-if="!product.length>0">This country do not have a product</span>
      </p>
      <hr>
    </div>

    <ul class="list-group" v-if="!iscountryselected">
      <li class="list-group-item w-100 border-0"><i class="fas fa-check"></i> Fast & secure top up service</li>
      <li class="list-group-item w-100 border-0"><i class="fas fa-check"></i> Send credit in over 140 countries</li>
      <li class="list-group-item w-100 border-0"><i class="fas fa-check"></i> Refill minutes & data in 3 easy steps</li>
      <li class="list-group-item w-100 border-0"><i class="fas fa-check"></i> Great offers for instant top ups</li>
      <li class="list-group-item w-100 border-0"><i class="fas fa-check"></i> Stay in touch with family & friends</li>
    </ul>

    <div v-if="iscountryselected">
      <div class="default pt-3"><h3>Select product</h3></div>
      <br>
      <div class="row">
        <div class="col-md-4 text-center" :data-value="c.ProviderCode" v-bind:key="c.ProviderCode" v-for="c in product">
          <input :id="c.ProviderCode" type="radio" :getoperatorsid="c.ProviderCode"  @change="products($event)" v-model="operatorid" :value="c.ProviderCode">
            <label :for="c.ProviderCode">
            <img class="ui mini avatar image" :src="oprator_logo_url+c.ProviderCode.substring(0, 2)+'/'+c.CountryIso+'.svg'" style="width: 40px!important;"><br>
            {{  c.Name }}
          </label>
        </div>
      </div>
      
      <div class="default pt-5 pb-3"><h3>Enter phone number</h3></div>
      <div class="form-group">
        <vue-tel-input v-model="AccountNumber"
                    @onInput="onInput"
                    :onlyCountries="[countrycode]"
                    :required="true"
                              >
                  </vue-tel-input>
      </div>

      <h4 v-for="a in SendTransferss">You can send {{ a.DefaultDisplayText }} </h4>
      <input @onInput="onInput" type="number" placeholder="Enter SendValue" class="form-control" v-model="SendValue">
      <p v-for="a in SendTransferss" v-if="a.Minimum.ReceiveValue>SendValue || a.Maximum.ReceiveValue<SendValue">you can not </p>

      <div class="dn-middle-content dn-big dn-no-mobile-padding dn-margin dn-padding mt-5">
          <table class="table">
              <thead>
                <tr class="dn-mobile-hide">
                  <th>Recipient</th>
                  <th>Operator</th>
                  <th>Receive SendValue</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ AccountNumber }}</td>
                  <td> Grameenphone </td>
                  <td v-for="i in SendTransferss">  {{ i.Minimum.ReceiveCurrencyIso }} {{ SendValue }}</td>
                  <td v-for="i in SendTransferss"> {{ (SendValue*i.Minimum.SendValue)/i.Minimum.ReceiveValue }} USD </td>
                  <input type="hidden" id="maindata" v-for="i in SendTransferss" :value="((SendValue*i.Minimum.SendValue)/i.Minimum.ReceiveValue)">
                </tr>
              </tbody>
          </table>
          <button class="btn btn-lg btn-primary btn-block text-uppercase" @click="donerecharge" v-for="a in SendTransferss" v-if="everythingisokay && !(a.Minimum.ReceiveValue>SendValue || a.Maximum.ReceiveValue<SendValue)">SEND</button>
          <button class="btn btn-lg btn-primary btn-block text-uppercase" style="opacity: .5;cursor: not-allowed;" v-else>SEND</button>
          <h3 class="text-danger" v-if="error" v-html="error"></h3>
      </div>
    </div>
</div>
</template>

<script>
  import Vue from 'vue';
  import VueTelInput from 'vue-tel-input'
  import Multiselect from 'vue-multiselect'
  import VueSweetalert2 from 'vue-sweetalert2';
  import 'vue-tel-input/dist/vue-tel-input.css';
  Vue.use(VueSweetalert2);
  Vue.use(VueTelInput)
  export default {
    data(){
      return{
        value: {img:"/images/logo.png",CountryName:"Select a country"},
        everythingisokay:false,
        operatorid:'',
        finanaccounthit:'',
        SkuCode:'',
        SendValue:0,
        SendCurrencyIso:'USD',
        AccountNumber:'',
        isvalid:false,
        Prefixs:0,
        MinimumLength:0,
        country:[],
        product:[],
        phone: '',
        countrycode:'US',
        SendTransferss:[],
        country_logo_url:"https://imagerepo.ding.com/flag/",
        oprator_logo_url:"https://imagerepo.ding.com/logo/",
        error:'',
        iscountryselected:false,
      }
    },
    components: {
      Multiselect
    },
    methods: {
      customLabel ({ title, desc }) {
        return `${title} – ${desc}`
      },
      donerecharge(){
        this.finanaccounthit=document.getElementById('maindata').value;
        var CSRF_TOKEN=document.getElementById('csrftoken').value;
        var applocal=document.getElementById('applocal').value;
        var self = this;
        $.ajax({
          url:'/rechargefin/dingrecharges',
          data: {_token:CSRF_TOKEN,SkuCode: this.SkuCode,SendValue:this.finanaccounthit,SendCurrencyIso:"USD",AccountNumber:this.AccountNumber.slice(1),DistributorRef:"1212qsad",ValidateOnly:true},
          success: function (data) {
            self.$swal({
              title:'Add to cart successfully',
              position: 'top-end',
              timer: 1500
            });
            window.location.href="/cart";
          }
        });

      },
      onChangeOprator(event){
        this.getoperatorsid=event.currentTarget.getAttribute('getoperatorsid');
        this.operators_name=event.currentTarget.getAttribute('id');
        var self = this;
        this.product='';
        axios.get('/product/'+event.target.value)
        .then(function (response) {
          self.product = response.data;
          self.destination_currency=response.data[0].destination_currency;
        })
        .catch(function (error) {
          console.log(error);
        })
      },
      countrys:function(event){
        var id=event.CountryIso;
        // this.Prefixs=event.InternationalDialingInformation[0].Prefix;
        // this.MinimumLength=event.InternationalDialingInformation[0].MaximumLength
        this.countrycode=event.CountryIso;
        var self = this;
        $.ajax({
          url: 'https://api.dingconnect.com/api/V1/GetProviders?regionCodes='+event.CountryIso,
          headers: {
            "api_key":"BDy98kvZSX16jBQWAvp3M5",
          }
        })
        .done(function(re) {
          self.iscountryselected=true;
          self.product=re.Items;
        })
        .fail(function() {
          console.log("error");
        })  
      },
      products:function(event){
        var self = this;
        $.ajax({
          url: 'https://api.dingconnect.com/api/V1/GetProducts?providerCodes='+event.target.value,
          headers: {
            "api_key":"BDy98kvZSX16jBQWAvp3M5",
          }
        })
        .done(function(re) {
          self.SendTransferss=re.Items;
          self.SkuCode=re.Items[0].SkuCode;
        })
        .fail(function() {
          console.log("error");
        })
      },
      onInput({ number, isValid, country }) {
       if (isValid) {
         console.log(number, isValid, country);
         this.AccountNumber=number;
         this.isvalid=true;
         this.everythingisokay=true;
       }else{
         this.everythingisokay=false;
       }
      },
    },
    mounted() {
      var self = this;
      $.ajax({
        url: '/allcountry',
      })
      .done(function(re) {
        var re = JSON.parse(re);
        self.country=re.Items;
      })
      .fail(function() {
        console.log("error");
      })
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

  .this-btn{
    padding: 12px 40px;
    font-size: 25px;
    color: #fff!important;
  }
  .price{
        background: white;
    margin-top: 24px!important;
  }
  #recharge{
    text-align: center;
    padding: 50px;
  }
  .list-group-item{
    width: 250px;
    display: inline-block;
  }
  .oprator-form{
    display: flex;
  }
  label {
    display: inline-block;
    width: 100%;
    height: 100%;
    border: 1px solid;
  }

  input[type="radio"] {
    display: none;
  }

  input[type="radio"]:checked + label {
    border: solid 5px #239ccf;
        box-shadow: 0 1px 9px rgba(15,18,18,.35);
  }
  label{
    height: 80px!important;
    background: white;
    padding: 0px!important;
  }
  .vue-tel-input[data-v-dda77e96]{
    width: 100%!important;
  }
</style>
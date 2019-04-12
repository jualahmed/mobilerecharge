<template>
  <div class="main w-75 m-auto">
    <multiselect 
            v-model="value"
            placeholder="Select a country"
            @select="onChange($event)"
            label="iso2"
            track-by="name"
            :options="allcountry"
            :searchable="true">
            <template slot="singleLabel" slot-scope="props">
              <img v-if="props.option.iso2" class="option__image" :src="country_logo_url+props.option.iso2+'.svg'" width="30px;">
              <img v-else class="option__image" :src="props.option.img" width="30px;">
              <span class="option__desc">
                <span class="option__title">{{ props.option.name }}</span>
              </span>
            </template>
            <template slot="option" slot-scope="props">
              <div class="option__desc">
                <img class="option__image" :src="country_logo_url+props.option.iso2+'.svg'" width="30px;">
                <span class="option__title">{{ props.option.name }}</span>
              </div>
            </template>
    </multiselect>

    <!-- <div class="row">
      <div class="col-md-4 offset-md-4">
        <form action="">
          <select id="test" class="form-control this-d-form" @change="onChange($event)">
            <option value="">
              Select a country
            </option>
            <option v-for="v in allcountry" :value="v.apicontryid" v-bind:key="v.apicontryid">
              {{ v.name }}
            </option>
          </select>
        </form>
      </div>
    </div>
    <br><br> -->
      
    <div class="row" v-if="alloperators.length>0">
      <div class="col-md-12">
        <h2 class="p-5">Operator:</h2>
      </div>
    </div>  

    <div class="row">
      <div v-for="i in alloperators" class="col-md-2 mt-2 imagebox" v-bind:key="i.operators_name">
        <input :id="i.operators_name" :getoperatorsid="i.operators_id" type="radio" v-model="operatorid" :value="i.operators_id" name="allporator" @click="onChangeOprator($event)">
        <label :for="i.operators_name">
          <img :src="operator_logo_url+i.operators_id+'-1.png'" class="img-thumbnail" alt="" width="100%">
        </label>
      </div>
    </div>

    <div class="row" v-if="selectedCountry.length>0">
      <div class="col-md-12">
          <h2 class="py-5">Phone number:</h2>
      
          {{ selectedCountry }}  <input type="number" name="phonenumber" v-model="phonenumber">
      </div>
    </div>  
    
    <div class="row" v-if="product.length>0">
      <div class="col-md-12">
        <h2 class="py-5">Amoount:</h2>
      </div>
    </div>  
        
    <div class="row">
      <div v-for="p in product" class="col-md-2 mt-3" v-bind:key="p.id">
        
        <input :id="p.id" type="radio" v-model="selectedproduct" :value="p.product_list" name="allproduct">

        <label :for="p.id" :data="p.retail_price_list" @click="changedata($event)" >
          {{ p.retail_price_list }} $
        </label>

      </div>
    </div>
    
    <div class="row" v-if="product.length>0">
      <div class="col-md-12">
        <div class="p-5 w-25 m-auto price">
          {{ selectedproduct }} {{ destination_currency }}
        </div>
      </div>
    </div>
    
    <div class="m-4" v-if="product.length>0">
      <a class="btn btn-primary btn-lg this-btn" @click="searchResult" v-if="phonenumber">Continue</a>
      <a class="btn btn-primary btn-lg this-btn" v-else style="opacity: 0.5; pointer-events: none;cursor: default;">Continue</a>
    </div>
</div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
      props: ['login','keyss','md5','token'],
      data(){
        return {
          country_logo_url:"https://imagerepo.ding.com/flag/",
          oprator_logo_url:"https://imagerepo.ding.com/logo/",
          value: {img:"/images/logo.png",name:"Select a country"},
          allcountry:[],
          alloperators:[],
          operator_logo_url:"https://operator-logo.transferto.com/logo-",
          api_url: 'https://cors-anywhere.herokuapp.com/https://airtime.transferto.com/cgi-bin/shop/topup',
          selectedCountry:'',
          operatorid:'',
          product:'',
          selectedproduct:'',
          selectedproductprice:'',
          destination_currency:'',
          searchData:'sdf',
          phonenumber:'',
          operators_name:'',
          getoperatorsid:'',
        }
      },
      components: {
        Multiselect
      },
      created() {
        var self=this;
        $.ajax({
          url: '/allcountrys',
        })
        .done(function(re) {
          for (const key in re) {
             self.allcountry.push(re[key]);
          }
        })
        .fail(function() {
          console.log("error");
        })
      },
      watch: {
        phonenumber: function (value) {
          console.log(value) // log it BEFORE model is changed
        }
      },
      methods: {
        changedata(event){
          this.selectedproductprice=event.currentTarget.getAttribute('data');
        },
        searchResult() {
        var local=document.getElementById('applocal').value;

        $.ajax({
          url: '/'+local+'/recharge/confirms',
          type: 'POST',
          data: {operators_id:this.getoperatorsid,operators_name:this.operators_name,destination_currency:this.destination_currency,destination_msisdn: this.selectedCountry+this.phonenumber,selectedproductprice:this.selectedproductprice,selectedproduct:this.selectedproduct,_token:this.token},
        })
        .done(function(re) {
          console.log(re);
        })
        .fail(function() {
          console.log("error");
        })
          window.location.href = '/recharge/confirm';
        },
        onChange(event) {
          var self = this;
          var id=event.apicontryid;
          axios.get('/alloperators/'+id)
          .then(function (response) {
            self.alloperators=[];
            self.alloperators = response.data;
          })
          .catch(function (error) {
            console.log(error);
          })

          axios.get('/country/'+id)
          .then(function (response) {
            self.selectedCountry=[];
            self.product=[];
            self.destination_currency='';
            self.selectedCountry = response.data[0].countrycode;
          })
          .catch(function (error) {
            console.log(error);
          })

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
        }
      }
    }
</script>

<style>
  .main{
    box-shadow: 0 1px 6px rgba(57, 73, 76, 0.35);
    padding: 40px;
  }
  .imagebox{
    margin: 13px;
    border: 1px solid #239ccf;
    padding: 0px;
  }
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
  }

  input[type="radio"] {
    display: none;
  }

  input[type="radio"]:checked + label {
    border: solid 5px #239ccf;
    box-shadow: 0 1px 6px rgba(57, 73, 76, 0.35);

  }
  label{
    background: white;
    padding: 28px;
  }

</style>

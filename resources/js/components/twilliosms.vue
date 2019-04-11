<template>
  <div class="p-5 bg-white">
      <div class="form-group">
        <label class="p-0">Number with country code</label>
        <input type="number" class="form-control" placeholder="Number" v-model="number">
      </div>
      <div class="form-group">
        <label class="p-0">Type you message</label>
        <textarea name="" id="" cols="60"  class="form-control" rows="5" v-model="message"></textarea>
      </div>
      <div class="form-group text-right">
        <input type="submit" @click="sendmessage" class="btn btn-primary btn btn-lg btn-primary btn-block text-uppercase" value="Send">
      </div>
      <h2 class="text-danger" v-if="msg" v-html="msg"></h2>
  </div>
</template>

<script>

  export default {
     data(){
       return{
          message:'',
          number:'',
          msg:'',
       }
     },
     methods:{
      sendmessage(){
         if(this.message.length==0){
           this.msg="Message can not be empty";
         }else if(this.number.length==0){
           this.msg="Number can not be empty";
         }else{
           var self=this;
           var applocal=document.getElementById('applocal').value;
           $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
           });
           $.ajax({
             url: '/'+applocal+'/sendmessage',
             type: 'POST',
             dataType: 'json',
             data: {number:this.number,message:this.message},
           })
           .done(function(re) {
             if (re.success==false) {
               console.log('asdasd');
               self.msg="Your balance is empty<a href='/addwallet' class='btn btn-success pl-3 ml-4'>Ad wallet<a>";
             }else{
               self.msg="Message send successfully";
             }
           })
           .fail(function() {
             console.log("error");
           })
        }
      }
    }
  }

</script>

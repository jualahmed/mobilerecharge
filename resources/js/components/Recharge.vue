<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body"> {{ allcountry }}
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  
  var data=[];

  var urlass;
  var token;

    export default {
        props: ['login','keyss','md5','info_type','content','action','urlse','token'],
        computed:{
          allcountry:function(){

            urlass=this.urlse;
            token=this.token;

            $.ajax({
              url: 'https://cors-anywhere.herokuapp.com/https://airtime.transferto.com/cgi-bin/shop/topup',
              type: 'POST',
              data: {login:this.login,key:this.keyss,md5:this.md5,info_type:this.info_type,content:this.content,action:this.action},
            })
            .done(function(re) {

              console.log(re);

             $.ajax({
               url: '/operators',
               type: 'POST',
               data: {res: re, _token: token },

             })
             .done(function(ddd) {
               console.log(ddd);
             })
             .fail(function() {
               console.log("error");
             })
             .always(function() {
               console.log("complete");
             });
             



            })
            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });

          }
        }
    }
</script>

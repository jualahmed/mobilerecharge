<template>
    <div style="padding: 2rem 3rem; text-align: left;">
        <div class="field">
            <label class="label">Country</label>
            <div class="control" style="position: absolute;z-index: 100000;width: 50%">
              <div class="ui fluid selection dropdown">
                <input type="hidden" name="user" v-model="form.country">
                <i class="dropdown icon"></i>
                <div class="default text">Select Friend</div>
                <div class="menu">
                  <div class="item" data-value="jenny">
                    <img class="ui mini avatar image" src="/images/avatar/small/jenny.jpg">
                    Jenny Hess
                  </div>
                  <div class="item" data-value="elliot">
                    <img class="ui mini avatar image" src="/images/avatar/small/elliot.jpg">
                    Elliot Fu
                  </div>
                  <div class="item" data-value="stevie">
                    <img class="ui mini avatar image" src="/images/avatar/small/stevie.jpg">
                    Stevie Feliciano
                  </div>
                  <div class="item" data-value="christian">
                    <img class="ui mini avatar image" src="/images/avatar/small/christian.jpg">
                    Christian
                  </div>
                  <div class="item" data-value="matt">
                    <img class="ui mini avatar image" src="/images/avatar/small/matt.jpg">
                    Matt
                  </div>
                  <div class="item" data-value="justen">
                    <img class="ui mini avatar image" src="/images/avatar/small/justen.jpg">
                    Justen Kitsune
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, email} from 'vuelidate/lib/validators'
    export default {
        props: ['clickedNext', 'currentStep'],
        mixins: [validationMixin],
        data() {
            return {
              form: {
                 country: 'sdfs',
              }
            }
        },
      
       
    }
</script>
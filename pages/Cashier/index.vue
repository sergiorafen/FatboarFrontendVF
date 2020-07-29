          
<template>
   <div class="col-12 col-md-8 col-lg-6 pb-5 formLogin">
                    <div class="row justify-content-center">
                        <div class="card-body">

                            <Notification :message="error" v-if="error"/>
                            <!-- Form register -->

                            <form method="post" @submit.prevent="putDataGain">
                                <h2 class="text-center font-up font-bold deep-orange-text py-4">Verification de ticket</h2>
                                <div class="md-form">
                                    <input type="text" id="orangeForm-email3"  placeholder="NUMERO DE TICKET"  class="form-control" name="numticket">
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit"  class="btn btn-deep-orange">Verifier<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
                                </div>
                            </form>
                            <!-- Form register -->
                        </div>
                    </div>
                </div>
</template>

    <script>
    import { mapGetters } from 'vuex'
    import axios from 'axios';
    export default {
        computed: {
            middleware: 'auth',
            ...mapGetters(['loggedInUser'])
        },
        data() {
            return {numticket: '2'}
        },
        methods:{
             putDataGain() {
                const config={ headers: {'Content-Type': 'application/json',"Content-type": "application/json"} };
                return axios.put(`http://127.0.0.1:8000/api/gains/1`, {"etat": 'RECU'},config).then(response=>{console.log(response)})
            }
        }
    }

    </script>

<style scoped>

@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
@import url(https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/css/mdb.min.css);

.formLogin{
    margin-left: auto;
    margin-right: auto;
}
.hm-gradient {
    background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);
}
.darken-grey-text {
    color: #2E2E2E;
}
.danger-text {
    color: #ff3547; }
.default-text {
    color: #2BBBAD; 
}
.info-text {
    color: #33b5e5; 
}
.form-white .md-form label {
  color: #fff; 
}
.form-white input[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid #fff;
    -webkit-box-shadow: 0 1px 0 0 #fff;
    box-shadow: 0 1px 0 0 #fff; 
}
.form-white input[type=text]:focus:not([readonly]) + label {
    color: #fff; 
}
.form-white input[type=password]:focus:not([readonly]) {
    border-bottom: 1px solid #fff;
    -webkit-box-shadow: 0 1px 0 0 #fff;
    box-shadow: 0 1px 0 0 #fff; 
}
.form-white input[type=password]:focus:not([readonly]) + label {
    color: #fff; 
}
.form-white input[type=password], .form-white input[type=text] {
    border-bottom: 1px solid #fff; 
}
.form-white .form-control:focus {
    color: #fff;
}
.form-white .form-control {
    color: #fff;
}
.form-white textarea.md-textarea:focus:not([readonly]) {
    border-bottom: 1px solid #fff;
    box-shadow: 0 1px 0 0 #fff;
    color: #fff; 
}
.form-white textarea.md-textarea  {
    border-bottom: 1px solid #fff;
    color: #fff;
}
.form-white textarea.md-textarea:focus:not([readonly])+label {
    color: #fff;
}
.ripe-malinka-gradient {
    background-image: linear-gradient(120deg, #f093fb 0%, #f5576c 100%);
}
.near-moon-gradient {
    background-image: linear-gradient(to bottom, #5ee7df 0%, #b490ca 100%);
}

</style>
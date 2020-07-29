<template>
<div>
<section class="bg-1 h-700x main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white">
                        </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
        </div><!-- container -->
</section>

   <div class="col-12 col-md-8 col-lg-6 pb-5 formLogin">
                    <div class="row justify-content-center">
                        <div class="card-body">
                            <Notification :message="error" v-if="error"/>
                            <!-- Form register -->
                            <facebook-login class="button"
                                appId="1060290161021024"
                                @login="getUserData"
                                @logout="onLogout"
                                @get-initial-status="sdkLoaded">
                            </facebook-login>

                            <form method="post" @submit.prevent="register">
                                <h2 class="text-center font font-bold deep-orange-text py-4">Remplissez le formulaire pour participer</h2>
                                <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <input type="email" id="orangeForm-email3"  placeholder="Email"  class="form-control" name="username" v-model="username" required>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-lock prefix grey-text"></i>
                                    <input type="password" id="orangeForm-pass3"  placeholder="*******" class="input" name="password" v-model="password">
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-lock prefix grey-text"></i>
                                    <input type="password" id="orangeForm-pass3"  placeholder="*******" class="input" name="password_confirm"
                                         v-model="password_confirm">
                                </div>
                                <div class="md-form">
                                    <input type="checkbox" name="cgvcgu" v-model="cgvcgu"  required>
                                   J'ai lu et j'accepte <nuxt-link to="/CGU">les Conditions générales d'utilisation</nuxt-link> 
                                </div>
                                <div class="md-form">
                                    <input type="checkbox" name="newsletter" v-model="newsletter"  required>
                                   En cliquant sur ce bouton j'accepte de recevoir les newsletter de Fatboat
                                </div>
                                 <div class="md-form">
                                    <input type="checkbox" name="majeur" v-model="majeur"  required>
                                   En cliquant ici vous justifier que vous êtes majeur ou vous avez l'accord parental
                                </div>
                                <div class="md-form">
                                   <p>Déjà inscrit? <nuxt-link to="/login">Se connecter</nuxt-link> </p></div>
                                
                                <div class="text-center">
                                    <button type="submit"  class="btn btn-deep-orange">Valider mon inscription<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
</div>
</template>

<script>
import qs from 'qs';
import Vue from 'vue';
import { mapGetters } from 'vuex'
import axios from 'axios'
import facebookLogin from 'facebook-login-vuejs';
import Notification from '~/components/Notification'
export default {
    components: {
            middleware: 'guest',
            Notification,
            facebookLogin
        },
    data(){
        return{
            cgvcgu:false,
            newsletter:false,
            username:'',
            password:'',
            password_confirm:'',
            majeur:false,
            error:'',
        }
    },
    methods: {
        async register() {
            if(this.password===this.password_confirm){
                try {
                      await this.$axios.post('http://127.0.0.1:8000/register',
                     qs.stringify({
                            username: this.username,
                            password: this.password,
                            cgvcgu: this.cgvcgu,
                            newsletter:this.newsletter,
                            majeur:this.majeur
                        }),
                        {headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'}})
                        .then(response=>{console.log(response.data)});
                    this.$router.push('/Login')             
                    } catch (e) {
                        this.error = e.response.data.message
                    }
            }else{
                console.log('bad password');
            }
        },
        getUserData(){  
                FB.api('/me', {fields: 'id,name,email,hometown,birthday'}, function(response) 
                {console.log(response);});
            this.$router.push('/profile')
        },
        sdkLoaded(payload){
            this.isConnected=payload.isConnected
            this.FB=payload.FB
            if(this.isConnected)this.getUserData()
        },
        onLogin() {
            this.isConnected = true
            this.getUserData()
        },
        onLogout() {
            this.isConnected = false;
        }
    }
    
}
</script>
<style scoped>

@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
@import url(https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/css/mdb.min.css);

.bg-1 { background: url(img/banderole.png) no-repeat center; background-size: cover; }
.h-700x {
    height: 900px !important;
}
.pos-relative {
    position: relative;
    z-index: 1;
}
*, ::after, ::before {
    box-sizing: border-box;
}

.main-slider{ position: relative; z-index: 1; }

.main-slider:after{content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: -1; }

.triangle-bottom{
        position: relative;
}

.triangle-bottom:after {
        content: '';
        height: 10px;
        position: absolute;
        top: 0px;
        left: 0;
        right: 0;
        background-size: 26px 10px;
        transform: rotate(180deg); -webkit-transform: rotate(180deg);
}

.triangle-up:after {
        content: '';
        height: 10px;
        position: absolute;
        bottom: 0px;
        left: 0;
        right: 0;
        background-size: 26px 10px;
}
.pos-top{ position: absolute; top: 0; left: 0; right: 0;  }
.pos-bottom{ position: absolute; bottom: 0; left: 0; right: 0; }

.color-white {
    color: #fff !important;
}
.center-text {
    text-align: center!important;
}
.dplay-tbl-cell {
    display: table-cell;
    vertical-align: middle;
}

.mt-30 {
    margin-top: 30px !important;
}
.mb-15 {
    margin-bottom: 15px !important;
}
h1 {
    font-size: 7.5em;
    line-height: 1.4;
}

.plr-25 {
    padding-left: 25px !important;
    padding-right: 25px !important;
}
.btn-primaryc {
    position: relative;
    text-align: center;
    height: 55px;
    line-height: 50px;
    background: #8c281f;
    color: #fff;
    border-radius: 3px;
    z-index: 1;
}
a, button {
    display: inline-block;
    text-decoration: none;
    color: inherit;
    line-height: 1.3;
    -webkit-transition: all .25s ease-in-out;
    transition: all .25s ease-in-out;
}
h1, h2, h3, .font-beyond {
    font-family: 'beyond_the_mountainsregular', sans-serif;
}
ul.selecton {
    text-align: center;
    font-size: 1.2em;
}
.mb-70 {
    margin-bottom: 70px !important;
}
.brdr-b-primary {
    border-bottom: 2px solid #8c281f;
}

li {
    list-style: none;
    display: inline-block;
    line-height: 1.6;
    font-size: .9em;
}

ul.selecton li:hover a, ul.selecton li a.active {
    border-radius: 3px 3px 0 0;
    background: #8c281f;
    color: #FFFFFF;
}
ul.selecton li > a {
    padding: 15px 30px;
}
a, button {
    display: inline-block;
    text-decoration: none;
    color: inherit;
    line-height: 1.3;
    -webkit-transition: all .25s ease-in-out;
    transition: all .25s ease-in-out;
}

.sided-90x .s-left {
    position: absolute;
    top: 0;
    left: 0;
    height: 90px;
    width: 90px;}

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


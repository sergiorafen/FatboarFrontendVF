<template>
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

                            <form method="post" @submit.prevent="login">
                                <h2 class="text-center font-up font-bold deep-orange-text py-4">Connexion</h2>
                                <div class="md-form">
                                    <i class="fa fa-user prefix grey-text"></i>
                                    <input type="email" id="orangeForm-email3" placeholder="Email"  class="input" name="email"
                  v-model="email"
                  required>
                                </div>
                               
                                <div class="md-form">
                                    <i class="fa fa-lock prefix grey-text"></i>
                                    <input type="password" id="orangeForm-pass3"  placeholder="*******" class="input" name="password"
                  v-model="password">
                                </div>
                                <div class="md-form">
                                   <p >Vous n'avez pas encore de compte? <nuxt-link to="/register">S'incrire</nuxt-link> </p>
                                </div>
                                <div class="text-center">
                                    <button type="submit"  class="btn btn-deep-orange">Se connecter<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
                                </div>
                            </form>
                            <!-- Form register -->
                        </div>
                    </div>
                </div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios'
import facebookLogin from 'facebook-login-vuejs';
import Notification from '~/components/Notification'

const Cookie = process.client ? require('js-cookie') : undefined
  export default {
        components: {
            middleware: 'guest',
            Notification,
            facebookLogin
        },
    data() {
      return {
            email: '',
            password: '',
            error: null
      }
    },
    methods: {
        //Fonction qui marche mais génère un jwt de merde à undefined
        // this.$axios.post('/token', {
        //   email: this.email,
        //   password: this.password
        // }).then((resp) => {
        //   this.$auth.setToken('local', 'Bearer ' + resp.data.access_token)
        //   this.$auth.setRefreshToken('local', resp.data.refresh_token)
        //   this.$axios.setHeader('Authorization', 'Bearer ' + resp.data.access_token)
        //   this.$auth.ctx.app.$axios.setHeader('Authorization', 'Bearer ' + resp.data.access_token)
        //   this.$axios.get('/users/me').then((resp) => { this.$auth.setUser(resp.data); this.$router.push('/') })
        // })
        async login() {
            try {
                await this.$auth.loginWith('local', 
                {data: {email: this.email,password: this.password}})
                this.$router.push('/profile')
            } catch (e) {
                this.error = e.response.data.message
            }
        },
        getUserData(){  
                FB.api('/me', {fields: 'id,name,email,hometown,birthday'}, function(response) {console.log(response);});
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
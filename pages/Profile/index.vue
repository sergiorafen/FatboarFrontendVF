<template>
 <div>
  <b-card title="Card Title" no-body>
    <b-card-header header-tag="nav">
      <b-nav card-header tabs>
        <b-nav-item active href="/../profile" >Mes informations</b-nav-item>
        <b-nav-item  href="/profile/tickets">Mes tickets</b-nav-item>
        <b-nav-item   href="/profile/meslots">Ce que j'ai gagné</b-nav-item>
      </b-nav>
    </b-card-header>

    <b-card-body class="text-justify">
      <b-card-text>
       Email
      </b-card-text>
       <b-card-text>
         {{loggedInUser.email}}
      </b-card-text>
    </b-card-body>
  </b-card>
</div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import axios from 'axios';
    export default {
        middleware: 'authenticated',
        computed: {
              ...mapGetters(['loggedInUser'])
        },
        items(){
          return this.$store.state.auth.user.username
        },
        // async asyncData({params}){
        //     const { data } = await axios.get(`http://127.0.0.1:8000/api/fatboar/tickets`)
        //     return {test:data}
        // },
         methods: {
                  async apiTickets () {
                    this.message = ''
                    this.type = ''
                    try {
                      const {res} = await this.$axios.get('http://127.0.0.1:8000/api/fatboar/tickets', {
                        headers: { Authorization: `${this.$auth.getToken('local')}` }
                      })
                      return {test:res}
                    } catch (e) {
                      console.log(e)
                      // return { todos: [] };
                    }
                  }
                },
        async getUserDataFB(){  
            const {dataFB} = await FB.api('/me', {fields: 'id,name,email,hometown,birthday'}, function(response){
             console.log(response);
            })
            return{testFB:dataFB}
        },
        async logout() {
          await this.$auth.logout();
        } 
    }
</script>
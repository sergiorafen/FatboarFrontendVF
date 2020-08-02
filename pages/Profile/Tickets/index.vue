<template>
  <div>
  <b-card title="Card Title" no-body>
    <b-card-header header-tag="nav">
      <b-nav card-header tabs>
        <b-nav-item href="/../profile" >Mes informations</b-nav-item>
        <b-nav-item active href="#">Mes tickets</b-nav-item>
        <b-nav-item href="./mesLots">Ce que j'ai gagné</b-nav-item>
      </b-nav>
    </b-card-header>
    <b-card-body class="text-center">
      <b-card-text>
       Vous trouverez ci-dessous tous vos tickets.
      </b-card-text>
      <div class="chart"><b-table striped hover :items="items" :fields="fields"></b-table></div>
      <form method="post" @submit.prevent="postNewTicket">
                <b-card-text>
              Vous voulez saisir un nouveau ticket de caisse?
              Si vous avez plus de 18 € d'achat tentez de gagner la nouvelle Range Rover Evoque et plein d'autres lots
              </b-card-text>
              <input type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" name="ticketdecaisse" v-model="numoticket" placeholder="Saisir le numero de  ticket de caisse à 10 chiffres" required>
              <input type="number" min="18" max="1000" name="totalprice" v-model="totalprice" placeholder="Saisir le montant du ticket en €" required>
              <button type="submit"  class="btn btn-success">Valider<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
      </form>
    </b-card-body>
  </b-card>
</div>
</template>
<script>
import axios from 'axios'
import Vue from 'vue'
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'
import { mapGetters } from 'vuex'

Vue.use(Chartkick.use(Chart))
  export default {
    middleware:'authenticated',
    computed:{...mapGetters(['loggedInUser'])},
    data() {
      return {
        numoticket:0,
        username:'',
        totalprice:50,
        gain:'',
        items: [],
        fields: [
          {key: 'numoticket', label: 'Ticket de caisse', sortable: true},
          {key: 'datepublished', label: 'date', sortable: true},
          {key: 'totalprice', label: 'Prix', sortable: true},
          {key: 'etat', label: 'Etat', sortable: true}
        ]
      }
    },
    // asyncData (context) {
      
    //   const config={ headers: {'Content-Type': 'application/json',"Content-type": "application/json",Authorization:`Bearer ${context.app.$auth.getToken('local')}`}};
    //   let response= axios.get(`http://127.0.0.1:8000/api/fatboar/tickets`,config
    //   )
    //   .then((res) => {
    //     console.log(response.data['hydra:member'])
    //       return { items: response.data['hydra:member']}
    //   })
    // },
    async mounted() {
      const config={ headers: {'Content-Type': 'application/json',"Content-type": "application/json",Authorization: `${this.$auth.getToken('local')}`}};
      const response = await axios.get(
        "http://127.0.0.1:8000/api/fatboar/tickets",config
      );
      this.items = response.data['hydra:member']
    },
     methods:{
      //  async apiTickets () {
      //               try {
      //                 const {resp} = await this.$axios.get('http://127.0.0.1:8000/api/fatboar/tickets', {
      //                   headers: { Authorization: `${this.$auth.getToken('local')}` }
      //                 }).then((res)=>{
      //                     return {items:res.data['hydra:members']}
      //                 })
      //               } catch (e) {
      //                 console.log(e)
      //               }
      //             },
             postNewTicket() {
                const config={ headers: {'Content-Type': 'application/json',"Content-type": "application/json",Authorization: `${this.$auth.getToken('local')}`} };

                console.log(`${this.$auth.getToken('local')}`)
                return axios.post(`http://127.0.0.1:8000/api/fatboar/tickets`, 
                {numoticket: parseInt(this.numoticket,10) ,datepublished:'2020-02-06',totalprice:parseInt(this.totalprice,10),etat:'DISPONIBLE',ticketlot:'/api/fatboar/lots/1'},
                config).then(response=>{console.log(response)})
            }
        }
  }
</script>
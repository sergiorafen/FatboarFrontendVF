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
              <input type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" name="ticketdecaisse" v-model="ticketdecaisse" placeholder="Saisir le numero de  ticket de caisse à 10 chiffres" required>
              <input type="number" min="18" max="1000" name="priceTicket" v-model="priceTicket" placeholder="Saisir le montant du ticket en €" required>
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
        ticketdecaisse:'',
        username:'',
        price:'',
        gain:'',
        items: [],
        fields: [
          {key: 'username', label: 'Email', sortable: true},
          {key: 'gain', label: 'gain', sortable: true},
          {key: 'price', label: 'Prix', sortable: true},
          {key: 'ticketdecaisse', label: 'Ticket de caisse', sortable: true}
        ]
      }
    },
    asyncData ({ params }) {
      return axios.get(`http://127.0.0.1:8000/api/tickets`
      )
      .then((res) => {
          return { items: res.data['hydra:member']}
      })
    },
     methods:{
             postNewTicket() {
                const config={ headers: {'Content-Type': 'application/json',"Content-type": "application/json"} };
                return axios.post(`http://127.0.0.1:8000/api/tickets`, 
                {ticketdecaisse: this.ticketdecaisse,username:this.loggedInUser.username,price:this.priceTicket,gain: 'ticket gagnants'},
                config).then(response=>{console.log(response)})
            }
        }
  }
</script>
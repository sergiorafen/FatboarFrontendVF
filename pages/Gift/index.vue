<template>
<div id="app">
    <b-card title="Card Title" no-body>
    <b-card-header header-tag="nav">
      <b-nav card-header tabs>
        <b-nav-item active href="#">Tickets Gagnants</b-nav-item>
        <b-nav-item href="/gift/filtre">Vérifications</b-nav-item>
      </b-nav>
    </b-card-header>
    <b-card-body class="text-center">
      <div id="table" b-input-group="size">
        <b-card-text>
       Vous trouverez ci-dessous la liste des gagnants par les tirages au sort.
      </b-card-text>
                  <b-btn disabled="!keyword" variant="link" size="sm" @click="keyword=''">
                      <div class="chart"><b-table striped hover :items="chart" :fields="fields" :keyword="keyword"></b-table></div>
                  </b-btn>
      </div>
      <form method="post" @submit.prevent="putDataGain">
              <input type="text" minlength="10" maxlength="10" pattern="[0-9]{10}" v-model="keyword" placeholder="Rechercher un numero de ticket">
              <button type="submit"  class="btn btn-success">Remettre<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
      </form>
    </b-card-body>
  </b-card>

</div>
</template>

<script>
import axios from 'axios'
import Vue from 'vue'
import { mapGetters } from 'vuex'
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'
  Vue.use(Chartkick.use(Chart))
  export default {
      data () {
      return {
        keyword: '',
        dataArray: [],
        fields: [
          {key: 'id', label: 'id', sortable: true},
          {key: 'numticket', label: 'Numero Ticket', sortable: true},
          {key: 'username', label: 'Email', sortable: true},
          {key: 'gain', label: 'Gain', sortable: true},
          {key: 'etat', label: 'Etat', sortable: true},
        ]
      }
    },
    asyncData ({ params }) {
      return axios.get(`http://127.0.0.1:8000/api/gains`
      )
      .then((res) => {
          return { chart: res.data['hydra:member'] }
      })
    },
    middleware:'authenticated',
    computed: {
      ...mapGetters(['loggedInUser']),
      items () {
              return this.keyword
                ? this.dataArray.filter(item => item.ticket.includes(this.keyword) || item.prenom.includes(this.keyword) || item.email.includes(this.keyword))
                : this.dataArray
            },
    },
    methods:{
             putDataGain() {
                const config={ headers: {'Content-Type': 'application/json',"Content-type": "application/json"} };
                return axios.put(`http://127.0.0.1:8000/api/gains/`+this.keyword, {"etat": 'RECU'},config).then(response=>{console.log(response)})
            }
        }
  }
</script>
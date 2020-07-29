<template>
<div id="app">
    <b-card title="Card Title" no-body>
    <b-card-header header-tag="nav">
      <b-nav card-header tabs>
        <b-nav-item active>Vérifications Tickets</b-nav-item>
      </b-nav>
    </b-card-header>
    <b-card-body class="text-center">
      <div id="table" b-input-group="size">
        <b-card-text>
       Vous trouverez ci-dessous la liste des gagnants par les tirages au sort.
      </b-card-text>
                  <b-btn disabled="!keyword" variant="link" size="sm" @click="keyword=''">
                      <div class="chart"><b-table striped hover :items="items" :fields="fields" :keyword="keyword"></b-table></div>
                  </b-btn>
      </div>
      <form method="post" @submit.prevent="putDataGain">
              <input type="text" v-model="keyword" placeholder="Rechercher un numero de ticket">
              <button type="submit"  class="btn btn-success">Remettre<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
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
  Vue.use(Chartkick.use(Chart))
  export default {
      data () {
      return {
        keyword: '',
        dataArray: [
          { ticket:'4545477',prenom: 'John', nom: 'Doe', email: 'johndoe@example.com',numero:'12123234',date:'20-03-2020',etat:'DISPONIBLE'},
          { ticket:'12121454',prenom: 'Jane', nom: 'Doe', email: 'janedoe@example.com',numero:'12123234',date:'20-03-2020',etat:'RECU'  },
          { ticket:'5566666',prenom: 'John', nom: 'Doo', email: 'johndoo@example.com',numero:'12123234',date:'20-03-2020',etat:'DISPONIBLE'  },
          { ticket:'12121454',prenom: 'Jane', nom: 'Doo', email: 'janedoo@example.com',numero:'12123234',date:'20-03-2020',etat:'RECU'  }
        ],
        fields: [
          {key: 'ticket', label: 'Numero Ticket', sortable: true},
          {key: 'nom', label: 'Nom', sortable: true},
          {key: 'prenom', label: 'Prenom', sortable: true},
          {key: 'numero', label: 'Numero', sortable: true},
          {key: 'date', label: 'Date', sortable: true},
          {key: 'email', label: 'Email', sortable: true},
          {key: 'etat', label: 'ETAT', sortable: true}
        ]
      }
    },
    computed: {
      items () {
        return this.keyword
          ? this.dataArray.filter(item => item.ticket.includes(this.keyword) || item.prenom.includes(this.keyword) || item.email.includes(this.keyword))
          : this.dataArray
      }
    },
    methods:{
             putDataGain() {
                const config={ headers: {'Content-Type': 'application/json',"Content-type": "application/json"} };
                return axios.put(`http://127.0.0.1:8000/api/gains/`+this.keyword, {"etat": 'RECU'},config).then(response=>{console.log(response)})
            }
        }
  }
</script>
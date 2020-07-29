<template>
<div id="app">
    <b-card title="Card Title" no-body>
    <b-card-header header-tag="nav">
      <b-nav card-header tabs>
        <b-nav-item  href="/../Gift">Tickets Gagnants</b-nav-item>
        <b-nav-item active href="#">Vérifications</b-nav-item>
      </b-nav>
    </b-card-header>
    <b-card-body class="text-center">
      <div id="table" b-input-group="size">
        <b-card-text>
       Vous pouvez effectuer un filtre à partir du numero de ticket.
      </b-card-text>
                  <b-btn disabled="!keyword" variant="link" size="sm" @click="keyword=''">
                      <div class="chart"><b-table striped hover :items="items" :fields="fields" :keyword="keyword"></b-table></div>
                  </b-btn>
      </div>
      <form method="post" @submit.prevent="putDataGain">
              <input type="text" v-model="keyword" placeholder="Rechercher un numero de ticket">
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
                { ticket:'0123456789',email: 'johndoe@example.com',Gain:'Ticket gagnants',date:'20-03-2020',etat:'DISPONIBLE'},
                { ticket:'1234567890',email: 'janedoe@example.com',Gain:'Ticket gagnants',date:'20-03-2020',etat:'RECU'  },
                { ticket:'2234567890',email: 'johndoo@example.com',Gain:'Ticket gagnants',date:'20-03-2020',etat:'DISPONIBLE'  },
                { ticket:'9874563210',email: 'janedoo@example.com',Gain:'Ticket gagnants',date:'20-03-2020',etat:'RECU'  }
        ],
        fields: [
          {key: 'ticket', label: 'Numero Ticket', sortable: true},
          {key: 'date', label: 'Date', sortable: true},
          {key: 'email', label: 'Email', sortable: true},
          {key: 'etat', label: 'ETAT', sortable: true}
        ]
      }
    },
    computed: {
      items () {
        return this.keyword
          ? this.dataArray.filter(item => item.ticket.includes(this.keyword)|| item.email.includes(this.keyword))
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
<template>

    <div id="app">
      <b-card title="Card Title" no-body>
        <b-card-header header-tag="nav">
          <b-nav card-header tabs>
            <b-nav-item active href="#" >Informations principales</b-nav-item>
            <b-nav-item  href="/dashboard/allTickets">Tous les tickets</b-nav-item>
            <b-nav-item  href="/dashboard/Game">Game</b-nav-item>
          </b-nav>
        </b-card-header>

        <b-card-body class="text-justify">
          <b-card-text>
          Email
          </b-card-text>
          <b-card-text>
          </b-card-text>
        </b-card-body>
      </b-card>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
        <script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
        <div class="container dashboard">
        <br/>
        <h1><p>Dashboard</p></h1>
        <br/>
        <b-row>
          <b-col><div class="chart"><b-table striped hover :items="chartData['hydra:member']" :fields="fieldsChart1"></b-table></div></b-col>
          <b-col><div class="chart"><b-table striped hover :items="chartBurger['hydra:member']" :fields="fieldsBurger"></b-table ></div></b-col>
          <b-col><div class="chart"><column-chart  :data="chartLot"></column-chart ></div></b-col>
        </b-row>
        <br/><br/>
        <b-row>
          <b-col><div class="chart"><pie-chart :data="chartSell"></pie-chart></div></b-col>
          <b-col><div class="chart"><line-chart :data="chartSell"></line-chart></div></b-col>
        </b-row>
        <br/><br/>
        </div>
    </div>
</template>
<style>
#app{
  background: lightgray;
}

.headerNavbar {
    border-bottom: 27px solid darkred;
}
.dashboard{
  background: #FFFFFF;
}
.chart{
    background: repeat;
    box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7), -1px 2px 20px rgba(255, 255, 255, 0.6) inset;
}
</style>
<script>
import axios from 'axios'
import Vue from 'vue'
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'
import { mapGetters } from 'vuex'

Vue.use(Chartkick.use(Chart))


  export default {
    middleware: 'authenticated',
        computed: {
              ...mapGetters(['loggedInUser'])
        },
    asyncData ({ params }) {
        return axios.get(`http://127.0.0.1:8000/api/burgers`
        )
        .then((res) => {
            return { burger: res.data['hydra:member'] }
        })
    },
    data() {
      return {
        chartData: [],
        chartBurger: [],
        chartClient: [],
        chartLot:[["Burger",3],["menu du jour", 4],["voiture", 1,["Entree dessert", 3]]],
        chartSell:[["BurgerMata","100 vendus"],["Burger dada", "300 vendus"],["Burgersese", "120 vendus"]],
        // Note 'isActive' is left out and will not appear in the rendered table
        username:'',
        price:'',
        fieldsChart1: [
          {key: 'name', label: 'Nom', sortable: true},
          {key: 'quantite', label: 'Quantité', sortable: true},
        ],
        fieldsBurger: [
          {key: 'title', label: 'Burger', sortable: true},
          {key: 'description', label: 'Ingrédient', sortable: true},
        ],
        fieldsUser: [
          {key: 'username', label: 'Nom', sortable: true},
          {key: 'email', label: 'Email', sortable: true},
          {key: 'majeur', label: 'Majeur', sortable: true},
        ],
        fields: [
          {
            key: 'last_name',
            sortable: true
          },
          {
            key: 'first_name',
            sortable: false
          },
          {
            key: 'age',
            label: 'Person age',
            sortable: true
            // Variant applies to the whole column, including the header and footer
           // variant: 'danger'
          }
        ]
      }
    },
    async asyncData ({ params }) {
      const [res, resBurger] = await Promise.all([ 
      axios.get(`http://127.0.0.1:8000/api/lots`),
      axios.get(`http://127.0.0.1:8000/api/burgers`),

      ])
      return {
        chartData: res.data,
        chartBurger: resBurger.data,

      }
    }
  }
</script>
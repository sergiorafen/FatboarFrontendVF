<template>
  <div>
  <b-card title="Card Title" no-body>
    <b-card-header header-tag="nav">
      <b-nav card-header tabs>
        <b-nav-item href="/../profile" >Mes informations</b-nav-item>
        <b-nav-item  href="./tickets">Mes tickets</b-nav-item>
        <b-nav-item  active href="#">Ce que j'ai gagné</b-nav-item>
      </b-nav>
    </b-card-header>

    <b-card-body class="text-center">
      <b-card-text>
       Vous trouverez ci-dessous tous vos gains.
      </b-card-text>
      <div class="chart"><b-table striped hover :items="items" :fields="fields"></b-table></div>
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
        items: [
          { Date:'20-04-2020',intitule:'Burger',Numero:'545457' ,Etat:'Disponible'},
          { Date:'20-04-2020',intitule:'Burger',Numero:'545457' ,Etat:'Remis'},
          { Date:'20-04-2020',intitule:'Burger',Numero:'545457' ,Etat:'Remis'},
          { Date:'20-04-2020',intitule:'Burger',Numero:'545457' ,Etat:'Remis'},
          { Date:'20-04-2020',intitule:'Burger',Numero:'545457' ,Etat:'Disponible'},
          { Date:'20-04-2020',intitule:'Menu du jour',Numero:'454454121' ,Etat:'Disponible'},
          { Date:'20-04-2020',intitule:'Menu du jour',Numero:'' ,Etat:'Disponible'},
          { Date:'20-04-2020',intitule:'Menu du jour',Numero:'' ,Etat:'Remis'},
          { Date:'20-04-2020',intitule:'Menu du jour',Numero:'' ,Etat:'Disponible'}
        ]
      }
    }
  }
  
</script>
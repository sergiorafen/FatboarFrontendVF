 <template>
    <b-card title="Card Title" no-body>
        <b-card-header header-tag="nav">
          <b-nav card-header tabs>
            <b-nav-item  href="/../dashboard" >Informations principales</b-nav-item>
            <b-nav-item  active href="#">Tous les tickets gagnants</b-nav-item>
            <b-nav-item  href="./Game">Game</b-nav-item>
          </b-nav>
        </b-card-header>

        <b-card-body class="text-justify">
          <b-card-text>
          Vous verrez ci-dessous tous les tickets gagnants
          </b-card-text>
          <b-button variant="success" href="C:\wamp64\www\FatBoar\Frontend\Prod\pages\Dashboard\script\exportExcel.php">Télécharger Excel</b-button>
          <div class="chart"><b-table striped hover :items="items" :fields="fields"></b-table></div>
        </b-card-body>
    </b-card>
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
    }
  }
</script>
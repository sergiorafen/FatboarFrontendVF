<template>
        <div id="wrapper">
            <img class="fit-picture"
            src="/img/logo.png"
            style="width: 20px; height: 20px;"
            alt="Grapefruit slice atop a pile of other slices">
       
        <div class="container">
        <b-row>
            <div class="col-lg-12"><h1>Les lots à gagner</h1></div><br>
        </b-row>
        <div class="row">
            <!-- <div class="chart"><b-table striped hover :items="items" :fields="fields" :keyword="keyword"></b-table></div>-->
            <div  class="col-lg-4 col-md-6 col-xs-12" v-for="item in testGain['hydra:member']">
            <div>
                <b-card
                    v-bind:title ="item.name"
                    v-bind:img-src= "item.imageUrl"
                    img-alt="Image"
                    img-top
                    tag="article"
                    style="max-width: 20rem;"
                    class=""
                >
                    <b-card-text>
                    Quantité gagné : {{item.quantite}}
                    </b-card-text>
                    
                    <b-button href="/register" variant="primary">Participer</b-button>
                </b-card>
                <br/>
                </div>
            </div>  
            <img src="~../../images/lots/burgerfrite.jpg" style="display: none;">
            <img src="~../../images/lots/dessert.jpg" style="display: none;">
            <img src="~../../images/lots/reduc.jpg" style="display: none;">
            <img src="~../../images/lots/voiture.jpg" style="display: none;">
           </div>
        </div>
        <br/>
     </div>
</div>
</template>

<style>
#DeltaPlaceHolderPageTitleInTitleArea{
	display: none;
}


.card img{
    height: 300px;
    object-fit: cover;
}
</style>

<script>

import { mapGetters } from 'vuex'
import axios from 'axios';

export default {
    computed: {
        middleware: 'auth',
        ...mapGetters(['loggedInUser'])
    },
        asyncData ({ params }) {
        return axios.get(`http://127.0.0.1:8000/api/lots`
        )
        .then((res) => {
            return { testGain: res.data }
        })
    }
}
</script>
<template>
    <div id="wrapper">
    <div class="container">
    <b-row>
        <div class="col-lg-12">Burger </div>
    </b-row>
    <div class="row">
        
        <div  class="col-lg-4 col-md-6 col-xs-12" v-for="item in burger['hydra:member']">
        <div>
            <b-card
                v-bind:title ="item.title"
                v-bind:img-src= "item.imageurl"
                img-alt="Image"
                img-top
                tag="article"
                class=""
            >
                <b-card-text> 
                Numéro du lot : {{item.title}}
                
                </b-card-text>
                <div class="description">
                {{item.description}}
                </div>
            </b-card>
            </div>
        </div>  
        <img src="~../../images/burgers/burger-dada.jpg" style="display: none;">
        <img src="~../../images/burgers/burger-sese.jpg" style="display: none;">
        <img src="~../../images/burgers/burger-kiki.jpg" style="display: none;">
        <img src="~../../images/burgers/burger-mata.jpg" style="display: none;">
        <img src="~../../images/burgers/burger-cheese.jpg" style="display: none;">
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

.card{
    margin-bottom: 40px;
}

.card-body{
    height: 200px;
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
    return axios.get(`http://127.0.0.1:8000/api/burgers`
    )
    .then((res) => {
        return { burger: res.data }
    })
}
}
</script>
<template>
    <div class="container">
        <div id="wrapper">
        <h2 class="med-text">Du nouveau</h2>
        <h3 class="bg-text">chez Fatboar !</h3>
        <ul id="menuPortee" class="nav-tabs column4">
            <li class="active" onclick="showActuByPortee('All', this)"><a>Tous les articles</a></li>
	    </ul>
        <ul id="menuCat" class="nav-tabs column4">
		    <li class="activeCat" onclick="showActuByCat('All', this)"><a>Tous les articles</a></li>
	    </ul>
        <div id="contentActu" class="row news-raw">
		
	    </div>
        <ul id="pagin"></ul>
        <div id="numberTeam">
	    </div>
     </div>
    <h2 class="text-center">Contact</h2>
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">
                    <!--Form with header-->
                    <form action="mail.php" method="post">
                        <div class="card border-primary rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-info text-white text-center py-2">
                                    <p class="m-0">Pour toute question n'hesitez à nous écrire</p>
                                </div>
                            </div>
                            <div class="card-body p-3">

                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nom & Prénom " required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="nombre" name="email" placeholder="exemple@gmail.com" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                        </div>
                                        <textarea class="form-control" placeholder="Votre message" required></textarea>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input type="submit" value="Envoyer" class="btn btn-info btn-block rounded-0 py-2">
                                </div>
                            </div>

                        </div>
                    </form>
                    <!--Form with header-->
                </div>
	</div>
</div>
</template>
<script>
export default {
    methods: 
    {
        test(){
console.log("test");
var username = "Admin";
var password = "FKDjshdf876jh6^%shj";
var proxy = 'https://cors-anywhere.herokuapp.com/';
var requestUri = "https://dev.viapost-sl.club/api/login_check";

var varPortee = "All";
var varCategorie = "All";
var data;
jQuery.ajax({
	url: requestUri,
	dataType: "json",
	type: 'post',
	data: {
		"_username": "Admin",
		"_password": "FKDjshdf876jh6^%shj"
	},
	success: function(result){	
	    console.log(result.token);
	    jQuery.ajax({
	    type: 'POST',
            url: 'https://dev.viapost-sl.club/api/post/list/all',
            dataType: 'json',
            crossDomain: true,
            headers: {
                'Authorization': 'Bearer ' + result.token
            },
            success: function (result) {
		   console.log(result);
		   data = result.data;
		   var tabCat = [];
		 
			var tabPortee = [];
			for(var i = 0; i < data.length; i++){
				if (tabCat.indexOf(data[i].category) === -1){
					tabCat.push(data[i].category);
				}
				
				if (tabPortee.indexOf(data[i].Scope) === -1){
					tabPortee.push(data[i].Scope);
				}
				
				showActu(data,i);
				
			}
			pagination(data);
			
			for(var j = 0; j < tabCat.length; j++){
					var li =  document.createElement("li");
					li.setAttribute("onclick", "showActuByCat('"+ tabCat[j] +"', this)");
					li.setAttribute("class", "liCat");
					var a = document.createElement("a");
					a.appendChild(document.createTextNode(tabCat[j]));
					li.appendChild(a);
					jQuery("#menuCat").append(li);
			}
			
			
			for(var k = 0; k < tabPortee.length; k++){
					var li =  document.createElement("li");
					li.setAttribute("onclick", "showActuByPortee('"+ tabPortee[k] +"', this)");
					var a = document.createElement("a");
					a.appendChild(document.createTextNode(tabPortee[k]));
					li.appendChild(a);
					jQuery("#menuPortee").append(li);
			}
	   },
	   error: function (error) {
			console.log(error);
	   }
	});
	},
	error: function (e) {
		console.log(e);               
	}
});
	
	function showActu(data,i){
		var col = document.createElement("div");
		col.setAttribute("class", "col-4 col-12 paginElement");
		var post = document.createElement("div");
		post.setAttribute("class", "post-blck float reveal");
		col.appendChild(post);
		var postImg = document.createElement("div");
		postImg.setAttribute("class", "post-img float");
		post.appendChild(postImg);
		var aFirst = document.createElement("a");
		aFirst.setAttribute("href", "/Pages/Actualite.aspx?%24id=" + data[i].id);
		//aFirst.setAttribute("target", "_blank");
		postImg.appendChild(aFirst);
		var img = document.createElement("img");
		img.setAttribute("class", "img-responsive");
		img.setAttribute("src", data[i].image);	
		aFirst.appendChild(img);
		var blogcon = document.createElement("div");
		blogcon.setAttribute("class", "blog-conn float");
		var categorie = document.createElement("div");
		categorie.setAttribute("class", "categories-raw");
		categorie.appendChild(document.createTextNode(data[i].category));
		blogcon.appendChild(categorie);
		var catPublic = document.createElement("div");
		catPublic.setAttribute("class", "public");
		catPublic.appendChild(document.createTextNode(data[i].Scope));
		blogcon.appendChild(catPublic);
		var aSecond = document.createElement("a");
		aSecond.setAttribute("href", "/Pages/Actualite.aspx?%24id=" + data[i].id);
		//aSecond.setAttribute("target", "_blank");
		var h6 = document.createElement("h6");
		h6.appendChild(document.createTextNode(truncateString(data[i].title, 40)));
		aSecond.appendChild(h6);
		blogcon.appendChild(aSecond);
		var postShort = document.createElement("div");
		postShort.setAttribute("class", "post-short-content");
		postShort.innerHTML = truncateString(data[i].shortContent, 150);
		blogcon.appendChild(postShort);
		var aThird = document.createElement("a");
		aThird.setAttribute("href", "/Pages/Actualite.aspx?%24id=" + data[i].id);
		aThird.setAttribute("target", "_blank");
		aThird.setAttribute("class", "readSuite left orange");
		aThird.appendChild(document.createTextNode("Lire la suite"));
		blogcon.appendChild(aThird);
		
		var ulSocial = document.createElement("ul");
		ulSocial.setAttribute("class", "social");
		blogcon.appendChild(ulSocial);
		
		if (data[i].Scope != "Interne"){
		
			var liLink = document.createElement("li");
			ulSocial.appendChild(liLink);
			var aLink = document.createElement("a");
			aLink.setAttribute("href", "");
			aLink.setAttribute("target", "_blank");
			liLink.appendChild(aLink);
			var imgLink = document.createElement("img");
			imgLink.setAttribute("class", "rsc-responsive");
			imgLink.setAttribute("src", "/Style%20Library/Images/logo-linkedin.png");
			imgLink.setAttribute("alt", "Share on LinkedIn");
			var openLink = "window.open('http://www.linkedin.com/shareArticle?mini=true&url="+ data[i].url +"','sharer','toolbar=0,status=0,width=548,height=525');";
			imgLink.setAttribute("onClick", openLink);
			aLink.appendChild(imgLink);
			var liTwitter = document.createElement("li");
			ulSocial.appendChild(liTwitter);
			var aTwitter = document.createElement("a");
			aTwitter.setAttribute("href", "");
			aTwitter.setAttribute("target", "_blank");
			liTwitter.appendChild(aTwitter);
			var imgTwitter = document.createElement("img");
			imgTwitter.setAttribute("class", "rsc-responsive");
			imgTwitter.setAttribute("src", "/Style%20Library/Images/logo-twitter.png");
			imgTwitter.setAttribute("alt", "Share on Twitter");
			var openTwitter = "window.open('https://twitter.com/intent/tweet?url="+ data[i].url +"','sharer','toolbar=0,status=0,width=548,height=525');";
			imgTwitter.setAttribute("onClick", openTwitter);
			aTwitter.appendChild(imgTwitter);
		
		}
	
		var liMail = document.createElement("li");
		ulSocial.appendChild(liMail);
		var aMail = document.createElement("a");
		aMail.setAttribute("href", "mailto:?subject=Actualité&body="+ data[i].url +"");
		aMail.setAttribute("target", "_blank");
		liMail.appendChild(aMail);
		var imgMail = document.createElement("img");
		imgMail.setAttribute("class", "rsc-responsive");
		imgMail.setAttribute("src", "/Style%20Library/Images/gmail.png");
		imgMail.setAttribute("alt", "Share on Mail");
		aMail.appendChild(imgMail);
		
		post.appendChild(blogcon);
		

		jQuery("#contentActu").fadeIn();
		jQuery("#contentActu").append(col);
	}
	
	function showActuByPortee(portee, myElement){
		varPortee = portee;
	
		var current = document.getElementsByClassName("active");
		current[0].className = current[0].className.replace("active", "");
		jQuery(myElement).addClass("active");
		document.getElementById("contentActu").style.display = "none";
		document.getElementById("contentActu").innerHTML = "";
		if (portee == "All"){
			for(var i = 0; i < data.length; i++){
				if(varCategorie == "All"){
					showActu(data,i);
				}
				else if(data[i].category == varCategorie){
					showActu(data,i);
				}
			}
			pagination(data);
		}else{
			for(var i = 0; i < data.length; i++){
				if (data[i].Scope == portee){
					if (data[i].Scope == portee){
						if(varCategorie == "All"){
							showActu(data,i);
						}else if (data[i].category == varCategorie)
						{
							showActu(data,i);
						}
					}
				}
			}
			pagination(data);
		}
	}
	
	function showActuByCat(categorie, myElement){
		varCategorie = categorie;
		console.log(categorie);

		var current = document.getElementsByClassName("activeCat");
		current[0].className = current[0].className.replace("activeCat", "");
		jQuery(myElement).addClass("activeCat");
		document.getElementById("contentActu").style.display = "none";
		document.getElementById("contentActu").innerHTML = "";
		if (categorie == "All"){
			for(var i = 0; i < data.length; i++){
				if(varPortee == "All"){
					showActu(data,i);
				}
				else if(data[i].Scope == varPortee){
					showActu(data,i);
				}
			}
			pagination(data);
		}else{
			for(var i = 0; i < data.length; i++){
				if (data[i].category == categorie){
					if (data[i].category == categorie){
						if(varPortee == "All"){
							showActu(data,i);
						}else if (data[i].Scope == varPortee)
						{
							showActu(data,i);
						}
					}
				}
			}
			pagination(data);
		}
	}
	
	function pagination(data){
    
		document.getElementById("pagin").innerHTML = "";
		
		pageSize = 6;

		var pageCount =  jQuery(".paginElement").length / pageSize;
		for(var i = 0 ; i <pageCount;i++){
			jQuery("#pagin").append('<li><a class="pageNumber" href="#">'+(i+1)+'</a></li> ');
		}
        
        document.getElementById("numberTeam").innerHTML = "";
        var numberTeam = document.createElement("p");
		numberTeam.appendChild(document.createTextNode(jQuery(".paginElement").length +" actualités" ));
		jQuery('#numberTeam').append(numberTeam);
        
        
		jQuery("#pagin li").first().find("a").addClass("current")
		showPage = function(page) {
			jQuery(".paginElement").hide();
			jQuery(".paginElement").each(function(n) {
			if (n >= pageSize * (page - 1) && n < pageSize * page)
				jQuery(this).show();
			});        
		}

		showPage(1);

		jQuery("#pagin li a").click(function() {
			jQuery("#pagin li a").removeClass("current");
			jQuery(this).addClass("current");
			showPage(parseInt(jQuery(this).text())) 
		});
	}
	
	function truncateString(str, num) {
	  if (str.length <= num) {
		return str
	  }
	  return str.slice(0, num) + '...'
	}
        }
    }
}
</script>
/***********************************************************\
 author - Kennouche Omar Wild Code School chartres Session 1
\***********************************************************/

// On initialise la variable autocomplete
var autocomplete;
// On declare une variable qui va stocker les coordonners latitude et longitude
var myLatLng;
// On declare une variable qui va stocker les coordonners latitude.
var latitudeSearch;
// On declare une variable qui va stocker les coordonners longitude.
var longitudeSearch;
// On declare une variable pour stocker l'address
var address;
// On declare une variable map
var map;
// On declare une variable zoom et on lui affecte 14 par default.
var zoom = 14;
// On declare une variable pour stocker le lien vers les markers.
var assetMarker;
// On declare une variable pour stocker le lien vers les images etablissements.
var assetEtablissement;
// On test si l'Objet  myLatLng et defini ou null.
if (myLatLng === undefined || myLatLng == null && navigator.geolocation) {

  navigator.geolocation.getCurrentPosition(function(position) {

    latitudeSearch = parseFloat(localStorage.getItem('lat'));
    longitudeSearch = parseFloat(localStorage.getItem('lng'));
    address = localStorage.getItem('address');

    showEtablissementMarker(latitudeSearch, longitudeSearch, address);
    showEtablissementDetail(latitudeSearch, longitudeSearch);
    });
    }else{
      myLatLng = {
      lat: latitudeSearch, 
      lng: longitudeSearch
      };
    }

// Fonction qui permet de lancer l'autocompletion.
function initautocomplete() {

  // Fonction qui permet de lancer la geolocalisation qui sera executer au moment de lexecution de initautocomplet.
  geolocate();

  autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{types: ['geocode']});

  autocomplete.addListener('place_changed', function(){

  place = autocomplete.getPlace();
  address = place.formatted_address;
  lat = place.geometry.location.lat();
  lng = place.geometry.location.lng();
    
  });
}
// Fonction qui est lancer dans la fonction initautocomplete qui permet de faire une recherche en fonction de la geolocalisation.
function geolocate() {

  if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function(position) {
    var geolocation = {
    lat: position.coords.latitude,
    lng: position.coords.longitude
    };
    var circle = new google.maps.Circle({
    center: geolocation,
    radius: position.coords.accuracy
    });
    autocomplete.setBounds(circle.getBounds());
  });
  }
}
// Fonction qui initialise la map.
function initMap() {

  map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      zoom: zoom,
      zoomControl: true,
      mapTypeControl: true,
      mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
      position: google.maps.ControlPosition.TOP_CENTER  
      },
      streetViewControl: true,
      streetViewControlOptions: {
      position: google.maps.ControlPosition.LEFT_TOP
      }
  });
  
    // On test la presence d'une address sinon on affiche un marker a notres geolocalisation.
    if(address === undefined || address == null){
    $('#resultatMap').text( 'résultat autour de vous' );  
    }else{
      $('#resultatMap').text( 'Effectuer votre recherche' );
    }
}
// Fonction qui affiche la map en fonction des resultat de recherche
function affichageMap(results){

  if(results.length < 15){ zoom = 14; }else{ zoom = 18; }
    myLatLng = {
    lat: latitudeSearch, 
    lng: longitudeSearch
    };
  initMap(myLatLng,zoom);

  $('#resultatMap').text( "résultat pour "+ address );
  
  for (var i = 0; i < results.length; i++) {
    var tab = results[i];
    var LatLong = {lat: Number(tab.lat), lng: Number(tab.lng)};
    addMarkerWithTimeout(LatLong, i * 200);
  }

  function addMarkerWithTimeout(LatLong, timeout) {
    window.setTimeout(function() {
      marker = new google.maps.Marker({
      position: LatLong,
      map: map,
      animation: google.maps.Animation.DROP,
      icon: assetMarker + "marker_map/hotels.png"
      });
    }, timeout);
  }
}
// Fonction qui execute une requete une ajax.
function showEtablissementMarker(latitudeSearch, longitudeSearch){

  assetMarker = document.getElementById('assetMarker').getAttribute('src');

  $.ajax({
      url: Routing.generate('showMap'),
      type: 'POST',
      dataType: "json",
      data: {'lat': latitudeSearch, 'lng': longitudeSearch },
      beforeSend: function(){ // Avant d'envoyer la requete
        $('#loading').css('display', 'block ');
        $('#loadingImg').css('display', 'block ');
      },
      success: function (results){

        setInterval(function(){ 
          $('#loading').css('display', 'none');
          $('#loadingImg').css('display', 'none');
        },2000);

        affichageMap(results);

      }
    });
}
function showEtablissementDetail(latitudeSearch, longitudeSearch){

  assetEtablissement = document.getElementById('assetEtablissement').getAttribute('src');

  $.ajax({
      url: Routing.generate('Etablissement'),
      type: 'POST',
      dataType: "json",
      data: {'lat': latitudeSearch, 'lng': longitudeSearch },
      beforeSend: function(){ // Avant d'envoyer la requete
        $('#loading').css('display', 'block');
        $('#loadingImg').css('display', 'block');
      },
      success: function (results){

        setInterval(function(){ 
          $('#loading').css('display', 'none');
          $('#loadingImg').css('display', 'none');
        },2000);

        affichageResultats(results);

      }
    });
}
function sortingEtablissementDetail(latitudeSearch, longitudeSearch, sorting, direction){

  assetEtablissement = document.getElementById('assetEtablissement').getAttribute('src');

  $.ajax({
      url: Routing.generate('SortingEtablissement'),
      type: 'POST',
      dataType: "json",
      data: {'lat': latitudeSearch, 'lng': longitudeSearch, 'prixmini': sorting , 'direction': direction },
      beforeSend: function(){ // Avant d'envoyer la requete
        $('#loading').css('display', 'block');
        $('#loadingImg').css('display', 'block');
      },
      success: function (results){

        setInterval(function(){ 
          $('#loading').css('display', 'none');
          $('#loadingImg').css('display', 'none');
        },2000);

        affichageResultats(results);

      }
    });
}
function starEtablissementDetail(latitudeSearch, longitudeSearch, star, direction){
  
  assetEtablissement = document.getElementById('assetEtablissement').getAttribute('src');

  $.ajax({
      url: Routing.generate('StarEtablissement'),
      type: 'POST',
      dataType: "json",
      data: {'lat': latitudeSearch, 'lng': longitudeSearch, 'etoile': star , 'direction': direction },
      beforeSend: function(){ // Avant d'envoyer la requete
        $('#loading').css('display', 'block');
        $('#loadingImg').css('display', 'block');
      },
      success: function (results){

        setInterval(function(){ 
          $('#loading').css('display', 'none');
          $('#loadingImg').css('display', 'none');
        },2000);

        affichageResultats(results);

      }
    });
}
function affichageResultats (results) {

  $('#two > section').remove();

  for (var i = 0; i < results.length; i++) {
    var detail = results[i];
    console.log(results);
    // On declare une variable etoile qui va nous permettre de stocker le resultat de la condition switch
    var etoile;
    if(detail.description == null){ detail.description = "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500"; }
    if(detail.prixmini == null){ detail.prixmini = 0; }
    if(detail.path == null || detail.path === undefined){ detail.path = 'no-picture.png';}
    switch (detail.etoile) {
      case 0:  etoile = "<span class='rating0' id='rating'></span>";
        break;
      case 1:  etoile = "<span class='rating1' id='rating'></span>";
        break;
      case 2:  etoile = "<span class='rating2' id='rating'></span>";
        break;
      case 3:  etoile = "<span class='rating3' id='rating'></span>";
        break;
      case 4:  etoile = "<span class='rating4' id='rating'></span>";
        break;
      case 5:  etoile = "<span class='rating5' id='rating'></span>";
        break;
      default: etoile = "<span class='rating0' id='rating'></span>";
        break;
    }
    // Apres l'element identifier par l'id #two on va ajouter tous les elements qui ce trouve dans la fonction append.
    $('#two').append("<section class='spotlight'>"
            +"<div class='image'>"
            +"<a href=''>"
            +"<img src=" + assetEtablissement + detail.path + ">"
            +"</a>"
            +"</div>"
            +"<div class='content'>"
            +"<h3 class='major'><a href='club-house.php?code=capricorne'>" + detail.name + "</a>" + etoile + "</h3>"
            +"<p class='descriptif_hotel'>" + detail.description + "</p>"
            +"<div id='prix'>"
            +"<h2 id='elements'>"
            +"<img src='http://localhost/Tobook-Chartres/web/img/jauge_coeur_1.png' title='Note' >"
            +"</h2>"
            +"<p class='infoprix'>à partir de: <span>" + detail.prixmini + "€</span></p>"
            +"<a href='club-house.php?code=capricorne' class='button detail'>Plus de détails</a>"
            +"</div>"
            +"<p class='vue'>Evalué par <span>25</span> personnes</p>"
            +"</div>"
            );
          
  }    
}

jQuery(document).ready(function() {
  
  // Quand on mes le focus dans le champs recherche on vide le localstorage. 
  $('#autocomplete').focus(function() {
  $(this).val('');  
  });
  // Fonction qui permet de recuperer la categorie de l'etablissement rechercher
  $('#category').change(function() {
    var category = document.getElementById("category"); 
    var typeEtablissement = category.options[category.selectedIndex].getAttribute('value');
    });
    // Fonction qui sera executer des lors que l'on submit le formulaire
  $("#formHome").submit(function() {
    localStorage.setItem('lat',lat);
      localStorage.setItem('lng',lng);
      localStorage.setItem('address',address);
    });
  // Fonction qui sera executer des lors que l'on submit le formulaire
  $("#form").submit(function(event) {
    event.preventDefault();
    latitudeSearch = parseFloat(lat);
    longitudeSearch = parseFloat(lng);
    showEtablissementMarker(latitudeSearch, longitudeSearch);
    showEtablissementDetail(latitudeSearch, longitudeSearch);
    });
  // Fonction qui sera executer des lors que l'on selectionne un choix prix moin cher ou plus cher
    $('#prix').change(function() {
    var prix = document.getElementById("prix"); 
    var direction = prix.options[prix.selectedIndex].getAttribute('value');
    var sorting = prix.getAttribute('name');
    sortingEtablissementDetail(latitudeSearch, longitudeSearch, sorting, direction);
    });
    // Fonction qui sera executer des lors que l'on selectionne un choix evaluation positif ou evaluation negative
    $('#etoile').change(function() {
      var etoile = document.getElementById("etoile"); 
    var direction = etoile.options[etoile.selectedIndex].getAttribute('value');
    var star = etoile.getAttribute('name');
    starEtablissementDetail(latitudeSearch, longitudeSearch, star, direction);
    });
    // Fonction qui sera executer des lors que l'on selectionne un choix de notation
    $('#note').change(function() {
      var rating = document.getElementById("note"); 
    var direction = rating.options[etoile.selectedIndex].getAttribute('value');
    var estimation = rating.getAttribute('name');
    estimationEtablissementDetail(latitudeSearch, longitudeSearch, estimation, direction);
    });
})
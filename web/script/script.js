/***********************************************************\
 author - Kennouche Omar Wild Code School chartres Session 1
\***********************************************************/
// On initialise la variable autocomplete
var autocomplete;
// On declare une variable qui va stocker les coordonners latitude et longitude
var myLatLng;
// On declare une variable infowindow.
var infoWindow;
// On declare une variable map
var map;
// On declare une variable zoom
var zoom = 14;
// On declare une variable pour stocker l'address
var address;
// On declare une variable pour stocker le type de recherche
var choice;
// On test si des coordonnées son disponible sinon on lance la geolocalisation
if (myLatLng === undefined || myLatLng == null && navigator.geolocation) {
navigator.geolocation.getCurrentPosition(
  function(position) {
      myLatLng = {
    lat: position.coords.latitude,
    lng: position.coords.longitude
    };
      initMap(myLatLng,zoom);
      // On positionne un marker au coordonner
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Votre position'
    });
  });
    }else{
      myLatLng = {
      lat: latitudeSearch, 
      lng: longitudeSearch
      };
    }
// Fonction qui initialise la map
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
      icon: "../../web/img/marker_map/hotels.png"
      });
    }, timeout);
  }
}
// Fonction qui permet de lancer l'autocompletion.
function initautocomplete() {

  geolocate();

  autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{types: ['geocode']});

  autocomplete.addListener('place_changed', function(){

  place = autocomplete.getPlace();
  address = place.formatted_address;
  lat = place.geometry.location.lat();
  lng = place.geometry.location.lng();
  
  });
}
// Fonction qui est lancer dans la fonction initautocomplete qui permet de faire une recherche en fonction de la geolocalisation
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
<<<<<<< HEAD
=======

  infowindow = new google.maps.InfoWindow();

  var service = new google.maps.places.PlacesService(map);

  if(choice == 'hotels'){
      marker_path = "../../img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'chambreHotes'){
      marker_path = "../../img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'gites'){
      marker_path = "../../img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'restaurants'){
      marker_path = "../../img/marker_map/restaurant64.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['restaurant']
           }, callback);

    }else if(choice == 'musees'){
      marker_path = "../../img/marker_map/museum64.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['museum']
           }, callback);
    }
}

function callback(results, status) {
  if (status === google.maps.places.PlacesServiceStatus.OK) {
    var resultat = JSON.stringify(results);
    localStorage.setItem('resultat',resultat);
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
>>>>>>> 8bf9339a3107fcee28f636948dbb5b34afd785e1
  }
}
jQuery(document).ready(function() {

  // Quand on mes le focus dans le champs recherche on vide le localstorage. 
  $('#autocomplete').focus(function() {
  $(this).val('');
  });

  $('#category').blur(function() {
    var selectType = document.getElementById("category"); 
    var choice = selectType.options[selectType.selectedIndex].getAttribute('value');
    localStorage.setItem('choice',choice);
  });

  $('#submitForm').click(function() {
  
    var selectType = document.getElementById("category"); 
    var choice = selectType.options[selectType.selectedIndex].getAttribute('value');
    localStorage.setItem('choice',choice);
  });
<<<<<<< HEAD
=======
  
}

$(document).ready(function() {

    // Quand on mes le focus dans le champs recherche on vide le localstorage. 
    $('#autocomplete').focus(function() {
    localStorage.clear();
    });
>>>>>>> 8bf9339a3107fcee28f636948dbb5b34afd785e1

  $("#form").submit(function(event) {
  event.preventDefault();
  latitudeSearch = parseFloat(lat);
  longitudeSearch = parseFloat(lng);
    $.ajax({
      url: Routing.generate('mapResult'),
      type: 'POST',
      dataType: "json",
      data: {'lat': latitudeSearch, 'lng': longitudeSearch },
      success: function (results){
        affichageMap(results);

      }
    });
    });
});

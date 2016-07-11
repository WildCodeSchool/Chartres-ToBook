/***************************************************
* author - Kennouche Omar Wild Code School Session 1
****************************************************/
var autocomplete;

function initautocomplete() {
 
  geolocate();

  autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{types: ['geocode']});

  autocomplete.addListener('place_changed', function(){
  
  place = autocomplete.getPlace();
  address = place.formatted_address;
  lat = place.geometry.location.lat();
  lng = place.geometry.location.lng();
  lat = lat.toString();
  lng = lng.toString();
  localStorage.setItem('address',address);
  localStorage.setItem('latitude',lat);
  localStorage.setItem('longitude',lng);

  // On ecrit les données dans des champs cachés comme ça elles seront envoyées lors de la soumission du formulaire
  $("input[name=latitude]").val(lat);
  $("input[name=longitude]").val(lng);
  $("input[name=address]").val(address);

  });
}

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

// On declare une variable infowindow.
var infowindow;
// On declare une variable marker_path
var marker_path;
// On declare une variable map
var map;
// On stock dans une variable les valeurs de l'address qui provient du formulaire de recherche de la homepage.
address = localStorage.getItem('address');
choice = localStorage.getItem('choice');
// On stock dans une variable les valeurs de latitude qui provient du formulaire de recherche de la homepage.
latitudeSearch = parseFloat(localStorage.getItem('latitude'));
// On stock dans une variable les valeurs de longitude qui provient du formulaire de recherche de la homepage.
longitudeSearch = parseFloat(localStorage.getItem('longitude'));

// declaration de la fonction initMap qui sera appeler en callback dans l'url de l'api google map.  
function initMap(resultat) {

  var myLatLng = {
    lat: latitudeSearch, 
    lng: longitudeSearch
    };

  map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 12,
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

  infowindow = new google.maps.InfoWindow();

  var service = new google.maps.places.PlacesService(map);

  if(choice == 'hotels'){
      marker_path = "../../web/img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'chambreHotes'){
      marker_path = "../../web/img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'gites'){
      marker_path = "../../web/img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'restaurants'){
      marker_path = "../../web/img/marker_map/restaurant64.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['restaurant']
           }, callback);

    }else if(choice == 'musees'){
      marker_path = "../../web/img/marker_map/museum64.png";
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
  }
}

function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    position: placeLoc,
    animation: google.maps.Animation.DROP,
    icon: marker_path
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
  
  //****//
  marker.addListener('click', function() {
  infowindow.open(map, marker);
  });
  
}

jQuery(document).ready(function($) {

    // Quand on mes le focus dans le champs recherche on vide le localstorage. 
    $('#autocomplete').focus(function() {
    localStorage.clear();
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

});
 

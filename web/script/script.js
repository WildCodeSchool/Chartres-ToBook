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

/***************************************************
* author - Kennouche Omar Wild Code School Session 1
****************************************************/
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
function initMap() {
 
  //marker_path = "http://80.67.190.233/web/Chartres-ToBook/web/img/marker_map/tobook.png"


  var myLatLng = {lat: latitudeSearch, lng: longitudeSearch};

  map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 14,
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
      marker_path = "http://localhost/Chartres-ToBook/web/img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'chambreHotes'){
      marker_path = "http://localhost/Chartres-ToBook/web/img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'gites'){
      marker_path = "http://localhost/Chartres-ToBook/web/img/marker_map/hotels.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['lodging']
           }, callback);

    }else if(choice == 'restaurants'){
      marker_path = "http://localhost/Chartres-ToBook/web/img/marker_map/restaurant64.png";
      service.nearbySearch({
           location: myLatLng,
           radius: 10000,
           types: ['restaurant']
           }, callback);

    }else if(choice == 'musees'){
      marker_path = "http://localhost/Chartres-ToBook/web/img/marker_map/museum64.png";
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
    position: place.geometry.location,
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
 
// function initMap() {

//     var map;
//     var myLatLng = {lat: latitudeSearch, lng: longitudeSearch};
//     //****//
//     map = new google.maps.Map(document.getElementById('map'), {
//           center: myLatLng,
//           zoom: 14,
//           zoomControl: true,
//           mapTypeControl: true,
//           mapTypeControlOptions: {
//          style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
//          position: google.maps.ControlPosition.TOP_CENTER
//        },
//          streetViewControl: true,
//          streetViewControlOptions: {
//          position: google.maps.ControlPosition.LEFT_TOP
//          }
//     });

//     //****//
//    var marker = new google.maps.Marker({
//      map: map,
//      animation: google.maps.Animation.DROP,
//      position: myLatLng,
//      title: address
//    });
//    //****//
//    var contentString = "<div id='street-view' style='width:340px;min-height:160px;'></div>";
//    //****//
//    var infowindow = new google.maps.InfoWindow({
//      content: contentString,
//    });
//    //****//
//    marker.addListener('click', function() {
//      infowindow.open(map, marker);
//      initialize();
//    });
// }

// var panorama;
// function initialize() {
//   panorama = new google.maps.StreetViewPanorama(
//       document.getElementById('street-view'),
//       {
//         position: {lat: latitudeSearch, lng: longitudeSearch},
//         pov: {heading: 165, pitch: 0},
//         zoom: 1
//       });
// }

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
// On declare une variable map
var marker;
// On declare une variable qu va contenir les infos dans l'info bulle des markers.
var infoWindow;
// On declare une variable qui va permetre de stocker le contenu preparer qui va s'afficher au dessu des markers.
var contentString;
// On declare une variable zoom et on lui affecte 14 par default.
var zoom = 14;
// On declare une variable pour stocker le lien vers les markers.
var assetMarker;
// On declare une variable pour stocker le lien vers les images etablissements.
var assetEtablissement;
// Chargement des fonctionnalités jquery avant le reste.
var detail;
var eloile;
var winInfo;
var nbResult;
jQuery(document).ready(function() {
 
  // Quand on mes le focus dans le champs recherche on vide le localstorage. 
  $('#autocomplete').focus(function() {
  $(this).val('');
  localStorage.clear();  
  });
  // Fonction qui permet de recuperer la categorie de l'etablissement rechercher
  $('#category').change(function() {
    var category = document.getElementById("category"); 
    var typeEtablissement = category.options[category.selectedIndex].getAttribute('value');
    });
    // Fonction qui sera executer des lors que l'on submit le formulaire
  $("#formHome").submit(function() {
    localStorage.setItem('lat',latitudeSearch);
    localStorage.setItem('lng',longitudeSearch);
    localStorage.setItem('address',address);
    });
  // Fonction qui sera executer des lors que l'on submit le formulaire
  $("#form").submit(function(event) {
    event.preventDefault();
    latitudeSearch = parseFloat(latitudeSearch);
    longitudeSearch = parseFloat(longitudeSearch);
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
// On test si les variable latitudeSearch longitudeSearch et defini ou null.
if (latitudeSearch === undefined || latitudeSearch == null && longitudeSearch === undefined || longitudeSearch == null){
  
    if(localStorage.getItem('lat') === undefined || localStorage.getItem('lat') == null && localStorage.getItem('lng') === undefined || localStorage.getItem('lng') == null && navigator.geolocation){
        
        navigator.geolocation.getCurrentPosition(function(position) {
          
          latitudeSearch = position.coords.latitude,
          longitudeSearch = position.coords.longitude

          myLatLng = {
            lat: latitudeSearch,
            lng: longitudeSearch
          }
          
          initMap(myLatLng,zoom);
          showTextResult(address);
          marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            animation: google.maps.Animation.DROP
          });

          showEtablissementDetail(latitudeSearch, longitudeSearch);

        });

    }else{

        latitudeSearch = parseFloat(localStorage.getItem('lat'));
        longitudeSearch = parseFloat(localStorage.getItem('lng'));
        address = localStorage.getItem('address');
        
        showEtablissementMarker(latitudeSearch, longitudeSearch);
        showEtablissementDetail(latitudeSearch, longitudeSearch);
    }
}else{
}
// Fonction qui permet de lancer l'autocompletion.
function initautocomplete() {

  // Fonction qui permet de lancer la geolocalisation qui sera executer au moment de lexecution de initautocomplet.
  geolocate();

  autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{types: ['geocode']});

  autocomplete.addListener('place_changed', function(){

  place = autocomplete.getPlace();
  address = place.formatted_address;
  latitudeSearch = place.geometry.location.lat();
  longitudeSearch = place.geometry.location.lng();
 
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
}
// Fonction qui affiche la map en fonction des resultat de recherche
function affichageMap(results){

  nbResult = results.length;

  if(results.length < 15){ zoom = 14; }else{ zoom = 17; }
  
  myLatLng = {
  lat: latitudeSearch, 
  lng: longitudeSearch
  };

  initMap(myLatLng,zoom);

  for (var i = 0; i < results.length; i++) {
    winInfo = results[i];
    marker = new google.maps.Marker({
      position: new google.maps.LatLng( results[i].lat, results[i].lng),
      map: map,
      animation: google.maps.Animation.DROP,
      icon: assetMarker + "marker_map/hotels.png"
    });
    (function(contentString){
      contentString = "<div id='content'>"+
      "<div id='siteNotice'>"+
      "</div>"+
      "<h1 id='firstHeading' class='firstHeading'>"+ winInfo.name +"</h1>"+
      "<div id='bodyContent'>"+
      "<p>" + winInfo.description + "</p>"+
      "<p><a href=" + winInfo.email + ">" + winInfo.email + "</a> </p>"+
      '</div>'+
      '</div>'
      ;
      google.maps.event.addListener(marker, 'click', function() {
        // affectation du texte passé en paramètre
        infoWindow = new google.maps.InfoWindow({content: contentString});
        // infoWindow.setContent(contentString);
        // affichage InfoWindow
        infoWindow.open( this.getMap(), this);
      });
    })();
  }
  
  showTextResult(address,nbResult);
}
// Fonction qui va afficher le text de la bar de resultat.
function showTextResult(address, nbResult) {

  // On test la presence d'une address sinon on affiche un marker a notres geolocalisation.
  if(address === undefined || address == null){
    $('#resultatMap').text( 'Effectuer votre recherche' );  
  }else{
    $('#resultatMap').before("<span class='badge badge-mr'>" + nbResult + "</span>")
    $('#resultatMap').text( "résultats pour "+ address );
  }
}
// Fonction qui execute une requete une ajax.
function showEtablissementMarker(latitudeSearch, longitudeSearch){
  $('.badge-mr').remove();
  assetMarker = document.getElementById('assetMarker').getAttribute('src');

  $.ajax({
      url: Routing.generate('showMap', {'_locale': 'fr'}),
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
      url: Routing.generate('Etablissement', {'_locale': 'fr'}),
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
      url: Routing.generate('SortingEtablissement', {'_locale': 'fr'}),
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
      url: Routing.generate('StarEtablissement', {'_locale': 'fr'}),
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
function affichageResultats(results) {
  var divSelect = '.listEtablissement';
  var divPager = '#pagination';
  var nbParPage = 15;
  $('#two > section').remove();

  assetEtablissement = document.getElementById('assetEtablissement').getAttribute('src');
 
  for (var i = 0; i < results.length; i++) {
    detail = results[i];
    // On declare une variable etoile qui va nous permettre de stocker le resultat de la condition switch
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
    $('#two').append("<section class='spotlight listEtablissement row'>"
            +"<div class='image col-md-5'>"
            +"<a href=''>"
            +"<img src=" + assetEtablissement + detail.path + ">"
            +"</a>"
            +"</div>"
            +"<div class='content col-md-7'>"
            +"<h3 class='major'><a href='clubhouse/" + detail.page +"'' target='_blank'>" + detail.name + "</a>" + etoile + "</h3>"
            +"<p class='descriptif_hotel'>" + detail.description + "</p>"
            +"<div id='prix'>"
            +"<h2 id='elements'>"
            +"<img src='http://localhost/Tobook-Chartres/web/img/jauge_coeur_1.png' title='Note' >"
            +"</h2>"
            +"<p class='infoprix'>à partir de: <span>" + detail.prixmini + "€</span></p>"
            +"<a href='clubhouse/" + detail.page +"' target='_blank' class='button detail'>Plus de détails</a>"
            +"</div>"
            +"<p class='vue'>Evalué par <span>25</span> personnes</p>"
            +"</div>"
            +"</section>"
            );          
  }
  
  pagination(nbParPage,divSelect,divPager);   
}
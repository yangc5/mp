var defaultBounds;

function setupBounds(pt1, pt2, pt3, pt4) {
    defaultBounds = new google.maps.LatLngBounds(
    new google.maps.LatLng(pt1, pt2),
    new google.maps.LatLng(pt3, pt4));  
    searchbox.setBounds(defaultBounds);
}

function setupListeners() { 
//  google.maps.event.addDomListener(window, 'load', initialize);
    // searchbox is the var for the google places object created on the page
    google.maps.event.addListener(searchbox, 'place_changed', function() {
      var place = searchbox.getPlace();
      if (!place.geometry) {
        // Inform the user that a place was not found and return.
        return;
      }  else {      
        // migrates JSON data from Google to hidden form fields
        populateResult(place);
      }
  });
}

function populateResult(place) {
  // moves JSON data retrieve from Google to hidden form fields
  // so Yii2 can post the data
  $('#place-location').val(JSON.stringify(place['geometry']['location']));
  $('#place-google_place_id').val(place['place_id']);
  $('#place-full_address').val(place['formatted_address']);
  $('#place-website').val(place['website']);
  $('#place-vicinity').val(place['vicinity']);
  $('#place-name').val(place['name']);
  loadMap(place['geometry']['location'],place['name']);
}

function loadMap(gps,name) {
  var mapcanvas = document.createElement('div');
  mapcanvas.id = 'mapcanvas';
  mapcanvas.style.height = '300px';
  mapcanvas.style.width = '300px';
  mapcanvas.style.border = '1px solid black';
    
  document.querySelector('article').appendChild(mapcanvas);  
  
  var latlng = new google.maps.LatLng(gps['k'], gps['D']);
  var myOptions = {
    zoom: 16,
    center: latlng,
    mapTypeControl: false,
    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
  
  var marker = new google.maps.Marker({
      position: latlng, 
      map: map, 
      title:name
  });  
}
@extends('layouts.app')



@section('content')
<div class="row">
              <!-- Discussions Component -->
              <div class="col-lg-5 col-md-12 col-sm-12 mb-4">

 <div style="width: 640px; height: 480px" id="map"></div>
  <script>
    // Initialize the platform object:
    var platform = new H.service.Platform({
    'app_id': 'BsNhpmthkn0bMKGMMMV7',
    'app_code': 'AMDCR2_HijeOSo4pjRvjiw'
    });
    var map = new H.Map(document.getElementById('map'),
      platform.createDefaultLayers().normal.map, {
      center: {lat: 36.0735, lng: 4.7547},
      zoom: 15
      });

    // Create a group object to hold map markers:
    var group = new H.map.Group();

    // Create the default UI components:
    var ui = H.ui.UI.createDefault(map, platform.createDefaultLayers());

    // Add the group object to the map:
    map.addObject(group);

    // Obtain a Search object through which to submit search
    // requests:
    var search = new H.places.Search(platform.getPlacesService()),
      searchResult, error;

    // Define search parameters:
    var params = {
    // Plain text search for places with the word "hotel"
    // associated with them:
      'q': 'hospitals',
    //  Search in the Chinatown district in San Francisco:
      'at': '36.0735,4.7547'
    };

    // Define a callback function to handle data on success:
    function onResult(data) {
      var str = JSON.stringify(data.results);
      console.dir(data.results.items[0]);
      addPlacesToMap(data.results);
      route(36.0735,4.7547,data.results.items[0]);
    }

    // Define a callback function to handle errors:
    function onError(data) {
      error = data;
    }

    // This function adds markers to the map, indicating each of
    // the located places:
    function addPlacesToMap(result) {
      group.addObjects(result.items.map(function (place) {
      var marker = new H.map.Marker({lat: place.position[0],
        lng: place.position[1]});
     
      return marker;
      }));
    }
    function route(lat,lon, data){
      var routingParameters = {
  // The routing mode:
  'mode': 'fastest;car',
  // The start point of the route:
  'waypoint0': 'geo!'+data.position[0]+','+data.position[1],
  // The end point of the route:
  'waypoint1': 'geo!'+lat+','+lon,
  // To retrieve the shape of the route we choose the route
  // representation mode 'display'
  'representation': 'display'
};

// Define a callback function to process the routing response:
var onResult = function(result) {
  var route,
    routeShape,
    startPoint,
    endPoint,
    linestring;
  if(result.response.route) {
  // Pick the first route from the response:
  route = result.response.route[0];
  // Pick the route's shape:
  routeShape = route.shape;

  // Create a linestring to use as a point source for the route line
  linestring = new H.geo.LineString();

  // Push all the points in the shape into the linestring:
  routeShape.forEach(function(point) {
    var parts = point.split(',');
    linestring.pushLatLngAlt(parts[0], parts[1]);
  });

  // Retrieve the mapped positions of the requested waypoints:
  startPoint = route.waypoint[0].mappedPosition;
  endPoint = route.waypoint[1].mappedPosition;

  // Create a polyline to display the route:
  var routeLine = new H.map.Polyline(linestring, {
    style: { strokeColor: 'blue', lineWidth: 10 }
  });

  // Create a marker for the start point:
  var startMarker = new H.map.Marker({
    lat: startPoint.latitude,
    lng: startPoint.longitude
  });

  // Create a marker for the end point:
  var endMarker = new H.map.Marker({
    lat: endPoint.latitude,
    lng: endPoint.longitude
  });

  // Add the route polyline and the two markers to the map:
  map.addObjects([routeLine, startMarker, endMarker]);

  // Set the map's viewport to make the whole route visible:
  map.setViewBounds(routeLine.getBounds());
  }
};

// Get an instance of the routing service:
var router = platform.getRoutingService();

// Call calculateRoute() with the routing parameters,
// the callback and an error callback function (called if a
// communication error occurs):
router.calculateRoute(routingParameters, onResult,
  function(error) {
    alert(error.message);
  });
    }

    // Run a search request with parameters, headers (empty), and
    // callback functions:
    search.request(params, {}, onResult, onError);
  </script>
@endsection
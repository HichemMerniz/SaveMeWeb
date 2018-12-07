@extends('layouts.app')

@section('content')
<div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Accueil</span>
                <h3 class="page-title">View General</h3>
              </div>
            </div>
            <!-- End Page Header -->
            <!-- Small Stats Blocks -->
            <div class="row">
              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Helps</span>
                        <h6 class="stats-small__value count my-3">2,390</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">4.7%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">urgences</span>
                        <h6 class="stats-small__value count my-3">182</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                  </div>
                </div>
              </div>
              
              <div class="col-lg col-md-4 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Users</span>
                        <h6 class="stats-small__value count my-3">2,413</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                  </div>
                </div>
              </div>
              
              <div class="col-lg col-md-4 col-sm-12 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Subscribers</span>
                        <h6 class="stats-small__value count my-3">17,281</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--decrease">2.4%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-5"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Small Stats Blocks -->
            <div class="row">
              <!-- Discussions Component -->
              <div class="col-lg-5 col-md-12 col-sm-12 mb-4">

 <div style="width: 640px; height: 480px" id="map"></div>
  <script>


//todo dont forget to get positions from user


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
  console.dir(route);
  routeShape = route.shape;
SimulePosiUrg(route);
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
    const sleep = (milliseconds) => {
  return new Promise(resolve => setTimeout(resolve, milliseconds));
}
async function SimulePosiUrg(data){
for(var i = 0; i<data.shape.length;i++){
  await sleep(Math.floor(Math.random() * 3000) + 500);
    console.log("posi",data.shape[i]);
}
//dont forget to send them back to user
}

    // Run a search request with parameters, headers (empty), and
    // callback functions:
    search.request(params, {}, onResult, onError);
  </script>


                <div class="card card-small blog-comments">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Umergency</h6>
                  </div>
                  <div class="card-body p-0">
                    <div class="blog-comments__item d-flex p-3">
                      <div class="blog-comments__avatar mr-3">
                        <img src="{{asset('assets/img/avatars/0.jpg')}}" alt="User avatar" /> </div>
                      <div class="blog-comments__content">
                        <div class="blog-comments__meta text-muted">
                          <a class="text-secondary" href="">Merniz</a>
                          <a class="text-secondary" href="">Hichem</a>
                        </div>
                        <p class="m-0 my-1 mb-2 text-muted">Description for health</p>
                        <div class="blog-comments__actions">
                          <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-white">
                              <span class="text-success">
                                <i class="material-icons">check</i>
                              </span> Approve </button>
                            <button type="button" class="btn btn-white">
                              <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Reject </button>
                            <button type="button" class="btn btn-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-light">
                                <i class="material-icons">more_vert</i>
                              </span> Edit </button>
                              <div class="dropdown-menu">
                               <a class="dropdown-item" href="#">Hospital 1</a>
                               <a class="dropdown-item" href="#">Hospital 2</a>
                               <a class="dropdown-item" href="#">Hospital 3</a>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <div class="card-footer border-top">
                    <div class="row">
                      <div class="col text-center view-report">
                        <button type="submit" class="btn btn-white">View All Umergengys</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Discussions Component -->
            
            </div>
          </div>
@endsection
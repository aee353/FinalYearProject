map = new OpenLayers.Map("mapdiv");
map.addLayer(new OpenLayers.Layer.OSM());

epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
projectTo = map.getProjectionObject();

//adds generic co-ordinates when map is created
var lonLat = new OpenLayers.LonLat( -0.1279688 ,51.5077286 ).transform(epsg4326, projectTo);
var vectorLayer = new OpenLayers.Layer.Vector("Overlay");


var zoom=6;
map.setCenter (lonLat, zoom);

showUsers()
setInterval(() => {
}, 10000)

function showUsers(){

    removeFeatures();
    xml = new XMLHttpRequest();

    xml.open('GET', "ajaxMap.php?=");
    xml.send();
    //http handling
    xml.onreadystatechange = function (){
        if (this.readyState == 4 && this.status == 200) {
            //looping the array object
            var users = JSON.parse(this.responseText);


            users.forEach(function (user){
                Marker(user);

            });


            //adds to map
            addVectorLayer();

        }
    };
}



function marker(hotel) {
    //adds marker to map base through overlay vector
    var feature = new OpenLayers.Feature.Vector(
        new OpenLayers.Geometry.Point( hotel.longitude, hotel.latitude ).transform(epsg4326, projectTo),
        {description: '<div class=" "><img src="/Media/travel.png'  + '" alt="Photo" id="imgTag" class="d-md-flex w-50 h-50">' +
                '<table class=" align-self-center"> <thead> <tr><th>Username</th><th>First Name</th><th>Last Name</th></tr></thead><tbody >' +
                '<tr>' + hotel.hotelName +' ' + hotel.review +' '+hotel.rating+ '</td>' + '</td></tr></tbody></table></div>'},
        {externalGraphic: '/Media/marker.png', graphicHeight: 30, graphicWidth: 30, graphicXOffset:-12, graphicYOffset:-25  }
    );

    vectorLayer.addFeatures(feature);
}

function Marker(friend) {
    //adds marker to map base through overlay vector
    var feature = new OpenLayers.Feature.Vector(
        new OpenLayers.Geometry.Point( friend.longitude, friend.latitude ).transform(epsg4326, projectTo),
        {description: '<div class="tab-content "><img src="/Media/travel.png'  + '" alt="Photo" id="imgTag" class="d-md-flex w-50 h-50">' +
                '<table class=" align-self-center"> <thead> <tr><th>Username</th><th>First Name</th><th>Last Name</th></tr></thead><tbody >' +
                '<tr>' + friend.username +' ' + friend.firstName +' '+friend.lastName+ '</td>' + '</td></tr></tbody></table></div>'},
        {externalGraphic: '/Media/marker.png', graphicHeight: 30, graphicWidth: 30, graphicXOffset:-12, graphicYOffset:-25  }
    );

    vectorLayer.addFeatures(feature);
}

//adds new marker to map base
function addVectorLayer(){
    map.addLayer(this.vectorLayer);
}

function removeFeatures() {
    vectorLayer.removeAllFeatures();
}

//Add a selector control to the vectorLayer with popup functions
var controls = {
    selector: new OpenLayers.Control.SelectFeature(vectorLayer, { onSelect: createPopup, onUnselect: removeDisplay })
};

function createPopup(feature) {
    feature.popup = new OpenLayers.Popup.FramedCloud("pop",
        feature.geometry.getBounds().getCenterLonLat(),
        null,
        '<div class="markerContent">'+feature.attributes.description+'</div>',
        null,
        true,
        function() { controls['selector'].unselectAll(); }
    );
    map.addPopup(feature.popup);
}

function removeDisplay(feature) {
    feature.popup.destroy();
    feature.popup = null;
}

//enables a user to actually access popups on screen
map.addControl(controls['selector']);
controls['selector'].activate();

function getLoc(){
    const status = document.querySelector('#status');
    const mapLink = document.querySelector('#map-link');

    mapLink.href='';
    mapLink.textContent='';

    function success(position){
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        status.textContent='';
        mapLink.href='https://wwww.openstreetmap.ord/#map=18/${latitude}/${longitude}'
    }

}


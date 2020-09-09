<script><link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

<style>
#mapid { height: 180px; }

</style>

<h1>Productores</h1>

<div id="googleMap" style="width:80%;height:250px;"></div>

<script>


function myMap() {
  const myLatLng = { lat: -38.95146614, lng: -68.05905819 };
  var mapProp= {
    center:new google.maps.LatLng(-38.95146614,-68.05905819),
    zoom:15,
  };
 
 var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
 
 new google.maps.Marker({
    position: myLatLng,
    map,
    title: "Productor"
  });

}
</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbryvr-215IpAVrBJ50KY6DToPUplMcmM&callback=myMap"></script>

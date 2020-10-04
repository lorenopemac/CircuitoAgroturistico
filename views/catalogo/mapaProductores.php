<style>
#mapid { height: 180px; }

</style>

<div id="googleMap" style="width:100%;height:600px;"></div>


<script>
    var productores = <?php echo json_encode($productores); ?>;
    
    function myMap() {

      lat = -38.95146614;
      long = -68.05905819;
        
      var mapProp = {
          center: new google.maps.LatLng(lat, long),
          zoom: 10,
      };

      var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
      productores.forEach(function(productor){
        var contenido =
          '<div id="content">' +
          '<div id="siteNotice">' +
          "</div>" +
          '<h4>'+productor[0]+'</h4>' +
          "</div>";
          var myLatLng = {
            lat: parseFloat(productor[1]),
            lng: parseFloat(productor[2]),
          };
          var infowindow = new google.maps.InfoWindow({
            content: contenido,
          });
          var marker = new google.maps.Marker({position: myLatLng,map,title: productor[0],draggable: true,animation: google.maps.Animation.DROP,});
          marker.addListener("click", () => {
            infowindow.open(map, marker);
          });
      },this);
      
        
    }

</script>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbryvr-215IpAVrBJ50KY6DToPUplMcmM&callback=myMap"></script>

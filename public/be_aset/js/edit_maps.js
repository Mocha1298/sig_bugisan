var lng = document.getElementById("Garis_Bujur").value;
var lat = document.getElementById("Garis_Lintang").value;

L.marker([lat,lng]).addTo(mymap).bindPopup("Lokasi terkini")

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Anda menandai lokasi ini")
        .openOn(mymap);

    document.getElementById("Garis_Lintang").value = e.latlng.lat.toString();
    document.getElementById("Garis_Bujur").value = e.latlng.lng.toString();
}

mymap.on("click", onMapClick);
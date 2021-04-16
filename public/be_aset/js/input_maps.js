var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Anda menandai lokasi ini")
        .openOn(mymap);
    document.getElementById("Garis_Bujur").value = e.latlng.lng.toString();
    document.getElementById("Garis_Lintang").value = e.latlng.lat.toString();
}

mymap.on("click", onMapClick);

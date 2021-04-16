bounds = new L.LatLngBounds(new L.LatLng(-7.736758, 110.494436), new L.LatLng(-7.736758, 110.494436));
var mymap = L.map("mapid", {
    // center: [-7.741, 110.5],
    center: bounds.getCenter(),
    zoom: 18,
    scrollWheelZoom: false,
    // zoom: 5,
    // layers: [osm1],
    maxBounds: bounds,
    maxBoundsViscosity: 0.75
});
L.geoJSON([bugisan]).addTo(mymap);

mymap.on("click", onMapClick);
L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(mymap);

L.marker([-7.736758, 110.494436])
.bindTooltip('Kantor Pemerintahan Desa Bugisan')
.addTo(mymap);

var popup = L.popup();

function onMapClick(e) {
    popup.setLatLng(e.latlng);
}
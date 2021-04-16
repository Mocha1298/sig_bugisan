bounds = new L.LatLngBounds(new L.LatLng(-7.741, 110.5), new L.LatLng(-7.741, 110.5));
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

var tiles = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    minZoom: 16,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(mymap);

L.marker([-7.741, 110.5])
.addTo(mymap)
.bindTooltip("Nama Kerusakan")
.bindPopup(
    (info =
        "<div class='col-auto'>"+
            "<div class='small-box bg-white'>"+
                "<div class='header text-center'>"+
                    "<br>"+
                    "<h5><strong>Nama Kerusakan</strong></h5>"+
                "</div>"+
                "<img src='/be_aset/img/hero_1.jpg' alt='' width='200px' height='auto'>"+
                "<a href='#' class='small-box-footer'><h6>Detail Kerusakan <i class='fas fa-arrow-circle-right'></i></h6>"+
                "</a>"+
            "</div>"+
        "</div>"
    )
);

var popup = L.popup();

function onMapClick(e) {
    popup.setLatLng(e.latlng);
}

mymap.on("click", onMapClick);

var id = document.getElementById("id").value;
function load_ajax() {
    const ajax = new XMLHttpRequest();
    ajax.open("GET", "/datapeta1", true);
    ajax.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let data = JSON.parse(this.responseText);
            var i;
            var info;
            for (i = 0; i < data.length; i++) {
                if(data[i].Id_Kerusakan == id){
                    var bounds = new L.LatLngBounds(new L.LatLng(data[i].Garis_Lintang, data[i].Garis_Bujur), new L.LatLng(data[i].Garis_Lintang, data[i].Garis_Bujur))
                    var mymap = L.map("mapid", {
                        center: bounds.getCenter(),
                        zoom: 18,
                        scrollWheelZoom: false,
                        maxBounds: bounds,
                        maxBoundsViscosity: 0.75
                    });

                    L.geoJSON([bugisan], {
                        style: function(feature) {
                            return feature.properties && feature.properties.style;
                        },
                    
                        pointToLayer: function(feature, latlng) {
                            return L.circleMarker(latlng, {
                                radius: 8,
                                fillColor: "#ff7800",
                                color: "#ff7800",
                                weight: 1,
                                opacity: 1,
                                fillOpacity: 0.8
                            });
                        }
                    }).addTo(mymap);
                    
                    mymap.on("click", onMapClick);

                    L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                        maxZoom: 20,
                        minZoom:15,
                        subdomains:['mt0','mt1','mt2','mt3']
                    }).addTo(mymap);
    
                    if(data[i].Status == 'Rencana')
                    {
                        L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                        .bindTooltip(data[i].Nama_Tempat)
                        .addTo(mymap);
                    }
                    else if(data[i].Status == 'Sedang')
                    {
                        L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                        .bindTooltip(data[i].Nama_Tempat)
                        .addTo(mymap);
                    }
                    else{
                        L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                        .bindTooltip(data[i].Nama_Tempat)
                        .addTo(mymap);
                    }
                }
            }
        }
    };
    ajax.send();
}
load_ajax();

var popup = L.popup();

function onMapClick(e) {
    popup.setLatLng(e.latlng);
}

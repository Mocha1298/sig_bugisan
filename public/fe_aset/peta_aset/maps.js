// Inisialisasi LayerGroup
var layerGroup = L.layerGroup();
mymap.addLayer(layerGroup);
var marker = []

// KONDISI AWAL MARKER 
function load_ajax1() {
    const ajax = new XMLHttpRequest();
    ajax.open("GET", "/fe/datapeta", true);
    ajax.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let data = JSON.parse(this.responseText);
            
            var i;

            for (i = 0; i < data.length; i++) {
                if(data[i].Status == 'Rencana')
                {
                    marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                    .addTo(mymap)
                    // .bindLabel('Look revealing label!')
                    .bindTooltip(data[i].Nama_Tempat)
                    .bindPopup(
                        (info =
                            "<div class='card' style='width: 13rem;'>"+
                                "<div class='card-body text-center py-2'>"+
                                    "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                "</div>"+
                                "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                    "Detail"+
                                "</a>"+
                            "</div>"
                            )
                    )
                    ;
                    layerGroup.addLayer(marker[i]);
                }
                else if(data[i].Status == 'Sedang')
                {
                    marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                    .addTo(mymap)
                    .bindTooltip(data[i].Nama_Tempat)
                    .bindPopup(
                        (info =
                            "<div class='card' style='width: 13rem;'>"+
                                "<div class='card-body text-center py-2'>"+
                                    "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                "</div>"+
                                "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                    "Detail"+
                                "</a>"+
                            "</div>"
                            )
                    );
                    layerGroup.addLayer(marker[i]);
                }
                else{
                    marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                    .addTo(mymap)
                    .bindTooltip(data[i].Nama_Tempat)
                    .bindPopup(
                        (info =
                            "<div class='card' style='width: 13rem;'>"+
                                "<div class='card-body text-center py-2'>"+
                                    "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                "</div>"+
                                "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                    "Detail"+
                                "</a>"+
                            "</div>"
                            )
                    );
                    layerGroup.addLayer(marker[i]);
                }
            }
        }
    };
    ajax.send();
}
load_ajax1();

let jenis,level,rw;

// enkapsulasi setter
function setlevel(level) {
    this.level = level;
}
function setjenis(jenis) {
    this.jenis = jenis;
}

function setrw(rw) {
    this.rw = rw;
}
// akhir

// enkapsulasi getter
function getlevel() {
    return this.level
}
function getjenis() {
    return this.jenis
}

function getrw() {
    return this.rw
}
// akhir

// Awal event
document.getElementById('filter').addEventListener('click', function (e) {

    jenis = document.getElementById('Jenis_Kerusakan').value;
    level = document.getElementById('Level_Kerusakan').value;
    rw = document.getElementById('RW').value;

    setjenis(jenis);
    setlevel(level);
    setrw(rw);

    function load_ajax() {
    
        const ajax = new XMLHttpRequest();
        ajax.open("GET", "/fe/datapeta", true);
        ajax.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                
                var i;
    
                // HAPUS LAYER MARKER
                for (i = 0; i < marker.length; i++) {
                    layerGroup.removeLayer(marker[i])
                }
    
                for (i = 0; i < data.length; i++) {
                    if(getjenis() != ''){
                        if(getlevel() != ''){
                            if(getrw() != ''){
                                if(data[i].Id_Jenis == getjenis() && data[i].Level_Kerusakan == getlevel() && data[i].RW == getrw()){
                                    if(data[i].Status == 'Rencana')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else if(data[i].Status == 'Sedang')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else{
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                }
                            }
                            else{
                                if(data[i].Id_Jenis == getjenis() && data[i].Level_Kerusakan == getlevel()){
                                    if(data[i].Status == 'Rencana')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else if(data[i].Status == 'Sedang')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else{
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    
                                }
                            }
                        }
                        else{
                            if(getrw() != ''){
                                if(data[i].Id_Jenis == getjenis() && data[i].RW == getrw()){
                                    if(data[i].Status == 'Rencana')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else if(data[i].Status == 'Sedang')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else{
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                }
                            }
                            else{
                                if(data[i].Id_Jenis == getjenis()){
                                    if(data[i].Status == 'Rencana')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else if(data[i].Status == 'Sedang')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else{
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                }
                            }
                        }
                    }
                    else{
                        if(getlevel() != ''){
                            if(getrw() != ''){
                                if(data[i].Level_Kerusakan == getlevel() && data[i].RW == getrw()){
                                    if(data[i].Status == 'Rencana')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else if(data[i].Status == 'Sedang')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else{
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                }
                            }
                            else{
                                if(data[i].Level_Kerusakan == getlevel()){
                                    if(data[i].Status == 'Rencana')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else if(data[i].Status == 'Sedang')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else{
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                }
                            }
                        }
                        else{
                            if(getrw() != ''){
                                if(data[i].RW == getrw()){
                                    if(data[i].Status == 'Rencana')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else if(data[i].Status == 'Sedang')
                                    {
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                    else{
                                        marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                                        .addTo(mymap)
                                        .bindTooltip(data[i].Nama_Tempat)
                                        .bindPopup(
                                            (info =
                                                "<div class='card' style='width: 13rem;'>"+
                                                    "<div class='card-body text-center py-2'>"+
                                                        "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                    "</div>"+
                                                    "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                                    "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                        "Detail"+
                                                    "</a>"+
                                                "</div>"
                                                )
                                        );
                                        layerGroup.addLayer(marker[i]);
                                    }
                                }
                            }
                            else if(getrw()==''){
                                if(data[i].Status == 'Rencana')
                                {
                                    marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: plan})
                                    .addTo(mymap)
                                    .bindTooltip(data[i].Nama_Tempat)
                                    .bindPopup(
                                        (info =
                                            "<div class='card' style='width: 13rem;'>"+
                                                "<div class='card-body text-center py-2'>"+
                                                    "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                "</div>"+
                                                "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                    "Detail"+
                                                "</a>"+
                                            "</div>"
                                            )
                                    );
                                    layerGroup.addLayer(marker[i]);
                                }
                                else if(data[i].Status == 'Sedang')
                                {
                                    marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: fix})
                                    .addTo(mymap)
                                    .bindTooltip(data[i].Nama_Tempat)
                                    .bindPopup(
                                        (info =
                                            "<div class='card' style='width: 13rem;'>"+
                                                "<div class='card-body text-center py-2'>"+
                                                    "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                "</div>"+
                                                "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto1+"' class='card-img-top'>"+
                                                "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                    "Detail"+
                                                "</a>"+
                                            "</div>"
                                            )
                                    );
                                    layerGroup.addLayer(marker[i]);
                                }
                                else if(data[i].Status == 'Selesai'){
                                    marker[i] = L.marker([data[i].Garis_Lintang, data[i].Garis_Bujur], {icon: finn})
                                    .addTo(mymap)
                                    .bindTooltip(data[i].Nama_Tempat)
                                    .bindPopup(
                                        (info =
                                            "<div class='card' style='width: 13rem;'>"+
                                                "<div class='card-body text-center py-2'>"+
                                                    "<h6 class='card-title'><strong>"+data[i].Nama_Tempat+"</strong></h6>"+
                                                "</div>"+
                                                "<img src='/be_aset/dist/img/kerusakan/"+data[i].Foto2+"' class='card-img-top'>"+
                                                "<a href='/fe/kerusakan/"+data[i].Id_Kerusakan+"' class='card-body bg-primary py-2 text-center text-light'>"+
                                                    "Detail"+
                                                "</a>"+
                                            "</div>"
                                            )
                                    );
                                    layerGroup.addLayer(marker[i]);
                                }
                            }
                        }
                    }                  
                }

                var jos = layerGroup.getLayers().length;
                if(jos==0){
                    for (i = 0; i < marker.length; i++) {
                        layerGroup.removeLayer(marker[i])
                    }
                    $("#myModal").modal();
                }
            }
        };
        ajax.send();
    }
    load_ajax();
});
// akhir event

var popup = L.popup();

function onMapClick(e) {
    popup.setLatLng(e.latlng);
}


mymap.on("click", onMapClick);

// FOUND MY LOCATION
// function onLocationFound(e) {
//     var radius = e.accuracy / 2;

//     L.marker(e.latlng).addTo(mymap)
//         .bindPopup("Lokasi Anda ada didalam radius " + radius + "meter.").openPopup();

//     L.circle(e.latlng, radius).addTo(mymap);
// }

// function onLocationError(e) {
//     alert(e.message);
// }

// mymap.on('locationfound', onLocationFound);
// mymap.on('locationerror', onLocationError);

// mymap.locate({setView: true, maxZoom: 16});
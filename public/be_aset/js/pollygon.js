var bugisan = {
    type: "FeatureCollection",
    features: [
        {
            type: "Feature",
            properties: {},
            geometry: {
                type: "Polygon",
                coordinates: [
                    [
                        [110.49259185791016, -7.735741808526649],
                        [110.49259185791016, -7.736624196994383],
                        [110.49309611320494, -7.737006919129244],
                        [110.49312829971313, -7.738899262358053],
                        [110.49366474151611, -7.7393882934968525],
                        [110.49375057220459, -7.740653393158708],
                        [110.49224853515625, -7.740600237787131],
                        [110.49136877059937, -7.740206887829221],
                        [110.49159407615662, -7.741386936601752],
                        [110.49422264099121, -7.741588926601042],
                        [110.4938793182373, -7.744778229546142],
                        [110.49697995185852, -7.74455497912575],
                        [110.49823522567748, -7.744682550809036],
                        [110.50072431564331, -7.747563534368233],
                        [110.5007404088974, -7.747154244546903],
                        [110.50353527069092, -7.747606057963231],
                        [110.50381422042845, -7.746160253324878],
                        [110.5056381225586, -7.746096467711822],
                        [110.5065393447876, -7.746160253324878],
                        [110.50739765167235, -7.745097158512882],
                        [110.50778388977051, -7.743842703184193],
                        [110.50778388977051, -7.741822809637158],
                        [110.50748348236084, -7.740802228163418],
                        [110.50791263580322, -7.740972325247329],
                        [110.50804138183594, -7.7402281499984955],
                        [110.50896406173706, -7.740334460828761],
                        [110.50913572311401, -7.739165040221239],
                        [110.50924301147461, -7.738761057802982],
                        [110.50883531570435, -7.738016878650794],
                        [110.50784826278687, -7.737740468916896],
                        [110.50660371780396, -7.73731522281864],
                        [110.50621747970581, -7.738590959826837],
                        [110.50572395324707, -7.738569697574995],
                        [110.50591707229614, -7.737442796693136],
                        [110.50532698631287, -7.737336485133723],
                        [110.50512313842772, -7.7385378041952295],
                        [110.50417900085449, -7.7382932882035025],
                        [110.5044150352478, -7.737145124259257],
                        [110.50123929977417, -7.73637967989305],
                        [110.50121247768402, -7.737363063026096],
                        [110.49775242805481, -7.736831504860554],
                        [110.49838811159134, -7.7345218768518444],
                        [110.4937344789505, -7.734333172508641],
                        [110.49422264099121, -7.73605542873568],
                        [110.49259185791016, -7.735741808526649]
                    ]
                ]
            }
        }
    ]
};
bounds = new L.LatLngBounds(new L.LatLng(-7.757714, 110.489099), new L.LatLng(-7.725033, 110.510357));
var mymap = L.map("mapid", {
    center: bounds.getCenter(),
    zoom: 15,
    scrollWheelZoom: false,
    maxBounds: bounds,
    maxBoundsViscosity: 0.75
});

L.geoJSON([bugisan]).addTo(mymap);

var tiles = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    minZoom: 15,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(mymap);

// BAGIAN CUSTOM MARKER NYA

// Marker Selesai
var finn = L.icon({
    iconUrl: '/be_aset/dist/img/marker/marker-hijau.png',

    iconSize:     [40, 46], // size of the icon
    iconAnchor:   [10, 37], // point of the icon which will correspond to marker's location
    popupAnchor:  [10, -25], // point from which the popup should open relative to the iconAnchor
    tooltipAnchor: [9,-20], //Alhamdulillah nemu bind tool up e aku :D
});

// Marker Sedang
var fix = L.icon({
    iconUrl: '/be_aset/dist/img/marker/fix.png',

    iconSize:     [45,45], // size of the icon
    iconAnchor:   [15, 37], // point of the icon which will correspond to marker's location
    popupAnchor:  [7, -25], // point from which the popup should open relative to the iconAnchor
    tooltipAnchor: [10,-10], //Alhamdulillah nemu bind tool up e aku :D
});


// Marker Rencana
var plan = L.icon({
    iconUrl: '/be_aset/dist/img/marker/marker-merah.png',

    iconSize:     [54, 48], // size of the icon
    iconAnchor:   [10, 37], // point of the icon which will correspond to marker's location
    popupAnchor:  [4, -25], // point from which the popup should open relative to the iconAnchor
    tooltipAnchor: [3,-23], //Alhamdulillah nemu bind tool up e aku :D
});
 
var printer = L.easyPrint({
    tileLayer: tiles,
    sizeModes: ["Current", "A4Landscape", "A4Portrait"],
    filename: "myMap",
    exportOnly: true,
    hideControlContainer: true
}).addTo(mymap);
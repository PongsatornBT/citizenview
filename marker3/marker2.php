<?php include 'data.php'?>
<?php //include 'json/datapackage.php'?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jerome Andre">

    <!-- Load personnal CSS styles -->
    <!-- <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" href="styles/styles2.css"> -->

    <!-- Load leaflet elements -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <!-- Load Marker Cluster element -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@latest"></script>


    <!-- loads files for SCALE BAR -->
    <!-- <script src="scripts/L.Control.BetterScale.js"></script> -->
    <!-- <link rel="stylesheet" href="styles/L.Control.BetterScale.css" /> -->
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add Bootstrap JS (and its dependency, jQuery) -->
    <link rel="stylesheet" href="styles_image.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>

    <!-- Carte-->

    <div id="mapcontainer">
        <div id="map"></div>
    </div>

    <!-- <div class="inputs_2" id="event-type">
        <h4> ประเภท &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </h4>
        <input type="checkbox" class="event-type" name="culture" value="culture" checked="true">
        <label class="input-text" for="culture">วัฒนธรรม &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </label>
        <input type="checkbox" class="event-type" name="bio" value="bio" checked="true">
        <label class="input-text" for="bio">ความหลากหลายทางชีวภาพ &nbsp;&nbsp; </label>
    </div> -->

    <div class="inputs_5" id="rating">
        <h4> Rating
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </h4>
        <input type="checkbox" class="rating" name="1" value="1" checked="true">
        <label class="input-text" for="1"><img src="img/1star.png" width='100'>&nbsp; &nbsp; &nbsp; </label>
        <input type="checkbox" class="rating" name="1.5" value="1.5" checked="true">
        <label class="input-text" for="1.5"><img src="img/1.5star.png" width='100'>&nbsp; &nbsp; &nbsp; </label>

        <input type="checkbox" class="rating" name="2 star" value="2" checked="true">
        <label class="input-text" for="2"><img src="img/2star.png" width='100'>&nbsp;&nbsp;&nbsp;&nbsp; </label>
        <input type="checkbox" class="rating" name="2.5 star" value="2.5" checked="true">
        <label class="input-text" for="2.5"><img src="img/2.5star.png" width='100'>&nbsp;&nbsp;&nbsp;&nbsp; </label>

        <input type="checkbox" class="rating" name="3 star" value="3" checked="true">
        <label class="input-text" for="3"><img src="img/3star.png" width='100'>&nbsp;&nbsp;&nbsp;&nbsp; </label>
        <input type="checkbox" class="rating" name="3.5 star" value="3.5" checked="true">
        <label class="input-text" for="3.5"><img src="img/3.5star.png" width='100'>&nbsp;&nbsp;&nbsp;&nbsp; </label>

        <input type="checkbox" class="rating" name="4 star" value="4" checked="true">
        <label class="input-text" for="4"><img src="img/4star.png" width='100'>&nbsp;&nbsp;&nbsp;&nbsp; </label>
        <input type="checkbox" class="rating" name="4.5 star" value="4.5" checked="true">
        <label class="input-text" for="4.5"><img src="img/4.5star.png" width='100'>&nbsp;&nbsp;&nbsp;&nbsp; </label>

        <input type="checkbox" class="rating" name="5 star" value="5" checked="true">
        <label class="input-text" for="5"><img src="img/5star.png" width='100'>&nbsp;&nbsp;&nbsp;&nbsp; </label>
    </div>


    <!-- <div class="inputs_4" style="top:10px" id="provinces"> -->
    <div class="inputs_4" id="provinces">
        <h4>จังหวัด</h4>&nbsp
        <?php for($i = 0; $i <$count_province;$i++){ ?>
        <div>
            <input type="checkbox" class="provinces" name="<?php echo $fetch_provinces[$i][0];?>"
                value="<?php echo $fetch_provinces[$i][0];?>" checked="true">
            <label class="input-text"
                for="<?php echo $fetch_provinces[$i][0];?>"><?php echo $fetch_provinces[$i][0]. "<br>";?>
            </label>
            <?php } ?>
            <input type="checkbox" class="provinces" name="Unknown" value="Unknown" checked="true">
            <label class="input-text" for="Unknown">Unknown
            </label>
            <br>
        </div>
    </div>
    <?php
        // for($i=0;$i<$count;$i++){
        //     echo $fetch[$i][4]."<br>";
        // }
    ?>

</body>

<script>
var map = L.map('map').setView([13.900723, 100.507316], 6);

/* Modifie le fond de carte suivant le niveau de zoom, celui de l'Atlas of Roman Empire n'est pas disponible > 11 */
var romanempiremap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://dh.gu.se/dare/">Digital Atlas of the Roman Empire (DARE) </a> contributors',
});

var OSM = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>',
    subdomains: 'abcd',
    maxZoom: 49
});

romanempiremap.addTo(map); //initial layer according to initial zoom

map.on("zoomend", function(e) {
    console.log("Zoom level: ", map.getZoom());
    if (map.getZoom() > 11) { //Level 11 is the treshold 
        map.removeLayer(romanempiremap);
        OSM.addTo(map);
    } else {
        map.removeLayer(OSM);
        romanempiremap.addTo(map);
    }
});

let checkboxStates

let provinceFeatures;
let jsontest; // Declare jsontest variable outside the function

// fetch('province.geojson')
//     .then(response => response.json())
//     .then(data => {
//         provinceFeatures = data.features;
//         jsontest = processProvinceData(); //provinceFeatures); // Update jsontest
//     });

fetch('../province.geojson')
    .then(response => response.json())
    .then(data => {
        provinceFeatures = data.features;
        jsontest = processProvinceData();
        // console.log(jsontest);

        function updateCheckboxStates() {
            checkboxStates = {
                rating: [],
                provinces: []

            }

            for (let input of document.querySelectorAll('input')) {
                if (input.checked) {
                    switch (input.className) {
                        case 'rating':
                            checkboxStates.rating.push(input.value);
                            break
                        case 'provinces':
                            checkboxStates.provinces.push(input.value);
                            break

                    }
                }
            }
        }

        for (let input of document.querySelectorAll('input')) {
            //Listen to 'change' event of all inputs
            input.onchange = (e) => {
                mcg.clearLayers()
                geojsonLayer.clearLayers()
                updateCheckboxStates()
                geojsonLayer.addData(jsontest).addTo(mcg)
            }
        }

        /****** INIT ******/
        updateCheckboxStates()
        geojsonLayer.addData(jsontest).addTo(mcg)
    });

function pointInPolygon(point, vs) {
    let inside = false;
    for (let i = 0, j = vs.length - 1; i < vs.length; j = i++) {
        const xi = vs[i][0],
            yi = vs[i][1];
        const xj = vs[j][0],
            yj = vs[j][1];
        const intersect = ((yi > point[1]) !== (yj > point[1])) &&
            (point[0] < (xj - xi) * (point[1] - yi) / (yj - yi) + xi);
        if (intersect) inside = !inside;
    }
    return inside;
}

function getProvince(lat, lon) {
    const point = [lon, lat];
    for (const feature of provinceFeatures) {
        if (pointInPolygon(point, feature.geometry.coordinates[0])) {
            return feature.properties.pv_tn; // Note: Changed to "pv_tn"
        }
    }
    return "Unknown";
}

function processProvinceData() { //features) {
    const result = {
        "type": "FeatureCollection",
        "features": [
            <?php for ($i = 0; $i < $count_data; $i++) { 
                        if ($fetch[$i][1] != NULL && $fetch[$i][5] != NULL && $fetch[$i][6] != NULL && $fetch[$i][6] != '' && $fetch[$i][5] != '') { ?> {
                "type": "Feature",
                "properties": {
                    "field_1": "<?php echo $fetch[$i][0]; ?>",
                    "field_2": "<?php echo $fetch[$i][1]; ?>",
                    "field_3": "<?php echo $fetch[$i][4]; ?>",
                    // "eventType": "culture",
                    "provinces": getProvince(<?php echo $fetch[$i][5]; ?>, <?php echo $fetch[$i][6]; ?>),
                    "field_4": "<?php echo $fetch[$i][5]; ?>",
                    "field_5": "<?php echo $fetch[$i][6]; ?>",
                    "year": "50",
                    "rating": "<?php echo $fetch[$i][8]; ?>",
                    "img": [<?php
                                $count_picture = 0;
                                $count_img_file = 0;
                                for ($j = $count_picture; $j < $count_image; $j++) {
                                    if ($fetch_pic[$j][2] == $fetch[$i][0]) {
                                        echo '"' . $fetch_pic[$j][1] . '", ';
                                        $count_img_file++;
                                    }
                                }
                                ?>],
                    "count_img_file": "<?php echo $count_img_file; ?>",
                    "video": "<?php
                                for ($k = 0; $k < $count_video; $k++) {
                                    if ($fetch_video[$k][2] == $fetch[$i][0]) {
                                        echo $fetch_video[$k][1];
                                    } else {
                                        echo '';
                                    }
                                }
                                ?>",
                },
                "geometry": {
                    "type": "Point",
                    "coordinates": [<?php echo $fetch[$i][6]; ?>, <?php echo $fetch[$i][5]; ?>]
                }
            },
            <?php } //if
                    } ?> //loop

        ]
    };

    return result; // Return the result
}

// Prepare the Marker Cluster Group
const mcg = L.markerClusterGroup().addTo(map);

const geojsonLayer = L.geoJSON(null, {
    filter: (feature) => {
        const isRatingChecked = checkboxStates.rating.includes(feature.properties.rating)
        const isProvincesChecked = checkboxStates.provinces.includes(feature.properties.provinces)
        return isRatingChecked && isProvincesChecked
    },
    pointToLayer: function(feature, latlng) {
        return L.circleMarker(latlng, {
            radius: 8,
            weight: 2,
            opacity: 1,
            fillOpacity: 0.7

        });
    },
    // bind Popup to each feature
    onEachFeature: function(feature, layer) {

        var popupText = "<img src='img/" + feature.properties.rating + "star.png' width='100'>" + "<br>" +
            "<b>ชื่อ :</b> " +
            feature.properties.field_2 + "<br>";

        if (feature.properties.field_3 != '') {
            const maxLength = 100; // Maximum length you want to display
            if (feature.properties.field_3.length > maxLength) {
                const truncatedText = feature.properties.field_3.substring(0, maxLength);
                const spaceIndex = truncatedText.lastIndexOf(' ');
                if (spaceIndex !== -1) {
                    popupText = popupText + "<b>รายละเอียด :</b> " + truncatedText.substring(0,
                        spaceIndex) + "<br>";
                } else {
                    popupText = popupText + "<b>รายละเอียด :</b> " + truncatedText + "<br>";
                }
            } else {
                popupText = popupText + "<b>รายละเอียด :</b> " + feature.properties.field_3 + "<br>";
            }
        } else {
            popupText = popupText + "<b>รายละเอียด :</b> ไม่มี<br>";
        }
        if (feature.properties.img[0] != '') {
            popupText +=
                '<section aria-label="Newest Photos">' +
                '<div class="carousel" data-carousel>'
            if (feature.properties.count_img_file > 1) {
                popupText +=
                    '<button class="carousel-button prev" data-carousel-button="prev">' + '<<' +
                    '</button>' +
                    '<button class="carousel-button next" data-carousel-button="next">' + '>>' +
                    '</button>'
            }
            for (let i = 0; i < feature.properties.count_img_file; i++) {
                if (i == 0) {
                    popupText +=
                        '<ul data-slides>' +
                        '<li class="slide" data-active>' +
                        '<img src ="../uploads/picture/' + feature.properties.img[i] +
                        '">' +
                        '</li>';
                } else {
                    popupText +=
                        '<li class="slide">' +
                        '<img src ="../uploads/picture/' + feature.properties.img[i] +
                        '">' +
                        '</li>';
                }
            }
            popupText +=
                '</ul>' +
                '</div>' +
                '</section>';
        }
        if (feature.properties.video != '') {
            popupText = popupText +
                "<video src='../uploads/video/" + feature.properties.video +
                "' width='150px' height='100px' controls>Your browser does not support the video tag.</video>" +
                "<br>";
        }


        layer.bindPopup(popupText, {
            closeButton: true,
            offset: L.point(0, -10)
        });
        layer.on('click', function() {
            layer.openPopup();
            const buttons = document.querySelectorAll("[data-carousel-button]")

            buttons.forEach(button => {
                button.addEventListener("click", () => {
                    const offset = button.dataset.carouselButton === "next" ? 1 : -1
                    const slides = button
                        .closest("[data-carousel]")
                        .querySelector("[data-slides]")

                    const activeSlide = slides.querySelector("[data-active]")
                    let newIndex = [...slides.children].indexOf(activeSlide) +
                        offset
                    if (newIndex < 0) newIndex = slides.children.length - 1
                    if (newIndex >= slides.children.length) newIndex = 0

                    slides.children[newIndex].dataset.active = true
                    delete activeSlide.dataset.active
                })
            }) //slide image

        });
    },
})
</script>

</html>
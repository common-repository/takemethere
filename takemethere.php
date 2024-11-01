<?php

/**
 * Plugin Name: TakeMeThere
 * Plugin URI: https://wordpress.org/plugins/TakeMeThere/
 * Description: Plugin Based on leaflet.js and nominatim openstreetmap API for locating a place on MAP
 * Version: 1.0
 * Author: aviket
 * License: GPL2
 */
wp_enqueue_script('jquery');
wp_enqueue_script('news', plugin_dir_url(__FILE__) . 'js/init.js', array('jquery'), '', true);
wp_enqueue_script('leaflet', plugin_dir_url(__FILE__) . 'js/leaflet/leaflet.js');
wp_enqueue_style('leaflet_stylesheet', plugin_dir_url(__FILE__) . 'js/leaflet/leaflet.css');

function TakeMeThere($atts, $content) {

    echo '<table border="1" style="border-color=#ff0000;border-spacing: 2px;">';
    echo '<tr>';
    echo '<td align="center" style="background:#a1b3cc">';
    echo '<label for="dist">Distance Range From Center</label>';
    echo '</td>';

    echo '<td align="center" style="background:#edf2e8">';
    echo '<input type="range" id="dist" min="100" value="100" max="1000" step="100" onchange="dispd();"><br>';
    echo '</td>';
    echo '<tr>';
    echo '<td align="center" style="background:#a1b3cc">';
    echo 'KM';
    echo '</td>';
    echo '<td align="center" style="background:#edf2e8">';
    echo '<label id="vald" >100</label>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '<div id="map" style="width: 600px; height: 400px"></div>';

    echo '<div class="frmSearch">';
    echo ' place name: <input type="text" name="fname" id="pname">';
    echo '<div id="suggesstion-box"></div>';
    echo '</div>'
    ?>
    <script>
        function dispd()
        {
            document.getElementById("vald").innerText = document.getElementById("dist").value;
            document.getElementById("suggesstion-box").innerHTML = "";
            document.getElementById("pname").value = "";


        }
        var map = L.map('map').setView([19.228967, 72.844626], 16);


        mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';




        L.tileLayer(
                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; ' + mapLink + ' Contributors',
                    maxZoom: 18
                }).addTo(map);
    </script>			

    <?php

}

add_shortcode('TakeMeThere', 'TakeMeThere');
?>
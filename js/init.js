jQuery(document).ready(function () {

    var mrkr;
    var minlength = 3;
    var val1 = ""
    jQuery("#pname").on('keyup input', function () {
        var that = this,
                value = jQuery(this).val();
        val1 = "";

        jQuery("#suggesstion-box").html = "";
        val1 = "";
        if (value.length >= minlength) {



            jQuery.ajax({
                type: "GET",
                async: true,
                crossDomain: true,
                url: "http://nominatim.openstreetmap.org/search?format=json&q=" + value,
                dataType: "json"
            }).done(function (data) {
                //console.log(data);
                val1 = "";
                var ln = data.length;
                for (var jj = 0; jj < ln; jj++)
                {


                    var cntr = map.getCenter();
                    var newpt = L.latLng(data[jj].lat, data[jj].lon);
                    var dst = cntr.distanceTo(newpt);
                    var lmt = document.getElementById("dist").value * 1000;
                    console.log(dst);

                    if (dst < lmt)

                    {
                        jQuery("#suggesstion-box").html("");
                        val1 = val1 + '<a class="getmethere" data-lat="' + data[jj].lat + '" data-lon="' + data[jj].lon + '">' + data[jj].display_name.substring(0, 50) + "</a><br>";
                    }
                }

                jQuery("#suggesstion-box").show();
                jQuery("#suggesstion-box").html("");
                jQuery("#suggesstion-box").html(val1);
                jQuery("#search-box").css("background", "#FFF");

                jQuery(".getmethere").on("click", (function () {
                    //console.log(this.innerHTML);
                    var lat = jQuery(this).data("lat");
                    var lon = jQuery(this).data("lon");
                    map.panTo(new L.LatLng(lat, lon));
                    if (!(typeof (mrkr) == 'undefined'))
                    {
                        map.removeLayer(mrkr);
                    }
                    mrkr = L.marker([lat, lon]);
                    mrkr.bindPopup(this.innerText, {
                        showOnMouseOver: true
                    });
                    mrkr.addTo(map);


                }));


            })

        }
        else
        {
            jQuery("#suggesstion-box").html("");
        }
    });




});

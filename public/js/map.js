var geocoder;
var map;
var marker1;
var marker2;

function initialize() {
    var latlng = new google.maps.LatLng(-23.6747024, -46.60654929999998);
    var options = {
        zoom: 5,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map"), options);

    geocoder = new google.maps.Geocoder();

    marker1 = new google.maps.Marker({
        map: map,
        draggable: true,
    });

    marker2 = new google.maps.Marker({
        map: map,
        draggable: true,
    });
    marker2.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');

    marker1.setPosition(latlng);
    marker2.setPosition(latlng);
}

$(document).ready(function () {

    initialize();

    function loadMarkerInMap(addr, markerNum) {
        geocoder.geocode({ 'address': addr }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();

                    $('#add' + markerNum).val(results[0].formatted_address);
                    $('#txtLatitude' + markerNum).val(latitude);
                    $('#txtLongitude' + markerNum).val(longitude);

                    var location = new google.maps.LatLng(latitude, longitude);
                    var markerName = window['marker' + markerNum];
                    eval(markerName).setPosition(location);
                }
            }
        })
    }

    $("#add1").blur(function() {
        if($(this).val() != "")
            loadMarkerInMap($(this).val(), '1');
    });

    $("#add2").blur(function() {
        if($(this).val() != "")
            loadMarkerInMap($(this).val(), '2');
    });

    google.maps.event.addListener(marker1, 'drag', function () {
        geocoder.geocode({ 'latLng': marker1.getPosition() }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#add1').val(results[0].formatted_address);
                    $('#txtLatitude1').val(marker1.getPosition().lat());
                    $('#txtLongitude1').val(marker1.getPosition().lng());
                }
            }
        });
    });

    google.maps.event.addListener(marker2, 'drag', function () {
        geocoder.geocode({ 'latLng': marker2.getPosition() }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#add2').val(results[0].formatted_address);
                    $('#txtLatitude2').val(marker2.getPosition().lat());
                    $('#txtLongitude2').val(marker2.getPosition().lng());
                }
            }
        });
    });

    $("#add1").autocomplete({
        source: function (request, response) {
            geocoder.geocode({ 'address': request.term }, function (results, status) {
                response($.map(results, function (item) {
                    return {
                        label: item.formatted_address,
                        value: item.formatted_address,
                        latitude: item.geometry.location.lat(),
                        longitude: item.geometry.location.lng()
                    }
                }));
            })
        },
        select: function (event, ui) {
            $("#txtLatitude1").val(ui.item.latitude);
            $("#txtLongitude1").val(ui.item.longitude);
            var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
            marker1.setPosition(location);
        }
    });

    $("#add2").autocomplete({
        source: function (request, response) {
            geocoder.geocode({ 'address': request.term }, function (results, status) {
                response($.map(results, function (item) {
                    return {
                        label: item.formatted_address,
                        value: item.formatted_address,
                        latitude: item.geometry.location.lat(),
                        longitude: item.geometry.location.lng()
                    }
                }));
            })
        },
        select: function (event, ui) {
            $("#txtLatitude2").val(ui.item.latitude);
            $("#txtLongitude2").val(ui.item.longitude);
            var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
            marker2.setPosition(location);
        }
    });

    $("form").submit(function(event) {
        event.preventDefault();
        var api = $(this).attr('action');
        $.ajax({
            'processing': true,
            'serverSide': true,
            type: "POST",
            data: $(this).serialize(),
            url: api,
            datatype: "json",
            success: function(ret) {

                console.log(ret);
                var polyline = new google.maps.Polyline({
                    path: [],
                    strokeColor: '#FF0000',
                    strokeWeight: 3
                });
                var bounds = new google.maps.LatLngBounds();


                var legs = ret.legs;
                for (i=0;i<legs.length;i++) {
                    var steps = legs[i].steps;
                    for (j=0;j<steps.length;j++) {
                        var nextSegment = google.maps.geometry.encoding.decodePath(steps[j].polyline.points);
                        for (k=0;k<nextSegment.length;k++) {
                            polyline.getPath().push(nextSegment[k]);
                            bounds.extend(nextSegment[k]);
                        }
                    }
                }

                polyline.setMap(map);
                map.fitBounds(bounds);

                var origin = $('#result').find('div#origin');
                var dest = $('#result').find('div#dest');

                origin.find('p.add').html('Endereço: ' + ret.origin.address);
                origin.find('p.lat').html('Latitude: ' + ret.origin.latitude);
                origin.find('p.lng').html('Latitude: ' + ret.origin.longitude);

                dest.find('p.add').html('Endereço: ' + ret.destination.address);
                dest.find('p.lat').html('Latitude: ' + ret.destination.latitude);
                dest.find('p.lng').html('Latitude: ' + ret.destination.longitude);

                $('#result').show();
            },
            error: function(response){
                alert('Error'+response);
            }

        });
    });

    $("#btnReset").click(function(event) {
        initialize();
    });

});
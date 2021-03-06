<div id="widget_<?php echo $widget->id; ?>"   > <?php echo $controls; ?><div>

<div id="w_<?php echo $widget->id; ?>" style="margin-top:30px; height:<?php echo $parm['height']; ?>;width:100%;">
    
</div>
</div><script>

var mapData = [
    <?php foreach ($parm['db'] as $row) { ?>
    {"label":"<?php echo $this->escaper->escapeJs($row['label']); ?>","lat":<?php echo $this->escaper->escapeJs($row['latitude']); ?>, "lng":<?php echo $this->escaper->escapeJs($row['longitude']); ?>},
<?php } ?>
];


        var avg_lat = 0;
        var avg_long = 0;
         // get min and max values
        for (var i = 0; i < mapData.length; i++) {
            avg_lat += mapData[i].lat;
            avg_long += mapData[i].lng;
        }

        if(mapData.length>0)
        {
       avg_lat= avg_lat/mapData.length;
       avg_long= avg_long/mapData.length;
        }
        

    if($("#w_<?php echo $widget->id; ?>").length){
        cluster_map = new GMaps({
            div: '#w_<?php echo $widget->id; ?>',
            lat: avg_lat,
            lng: avg_long,
            markerClusterer: function (map) {
                return new MarkerClusterer(map);
            }
        });

        var lat_span = -12.035988012939503 - -12.050677786181573;
        var lng_span = -77.01528673535154 - -77.04137926464841;
        
        


        for (var i = 0; i < mapData.length; i++) {
            var latitude = mapData[i].lat;
            var longitude = mapData[i].lng;

           var marker = cluster_map.addMarker({
                lat: latitude,
                lng: longitude,
                title: mapData[i].label
            });
        
            google.maps.event.addListener(marker, "click",  function() {
                
                update_dashboard("<?php echo $parm['link_table']; ?>","<?php echo $parm['target_link']; ?>","=", this.title,<?php echo $widget->id; ?>);
                     
                        });
            
            
        };
    
            
    
        
        var bounds = new google.maps.LatLngBounds();
for(i=0;i<cluster_map.markers.length;i++) {
 bounds.extend(cluster_map.markers[i].getPosition());
}

cluster_map.fitBounds(bounds);
        
        
        

    }

</script><?php echo $this->getContent(); ?></div>
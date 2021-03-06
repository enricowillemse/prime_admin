<div id="widget_<?php echo $widget->id; ?>"   > <?php echo $controls; ?>
<div>
<div id="w_<?php echo $widget->id; ?>" style="background-color:#333;width:100%;height:<?php echo $parm['height']; ?>"></div>
</div>    <script>
    
var mapData = [
    <?php foreach ($parm['db'] as $row) { ?>
    {"name":"<?php echo $this->escaper->escapeJs($row['label']); ?>", "value":<?php echo $this->escaper->escapeJs($row['value']); ?> ,"latitude":<?php echo $this->escaper->escapeJs($row['latitude']); ?>, "longitude":<?php echo $this->escaper->escapeJs($row['longitude']); ?>},
<?php } ?>
];

        var map;
        var minBulletSize = 3;
        var maxBulletSize = 70;
        var min = Infinity;
        var max = -Infinity;
        var avg_lat = 0;
        var avg_long = 0;
        AmCharts.theme = AmCharts.themes.black;
         // get min and max values
        for (var i = 0; i < mapData.length; i++) {
            avg_lat += mapData[i].latitude;
            avg_long += mapData[i].longitude;
            var value = mapData[i].value;
            if (value < min) {
                min = value;
            }
            if (value > max) {
                max = value;
            }
        }
        
        if(mapData.length>0)
        {
       avg_lat= avg_lat/mapData.length;
       avg_long= avg_long/mapData.length;
        }
        

configChart = function() {
    
  map = new AmCharts.AmMap();
            map.pathToImages = "/assets/global/plugins/maps-amcharts/ammap/images/";
            map.areasSettings = {
                unlistedAreasColor: "#FFFFFF",
                unlistedAreasAlpha: 0.1,
                autoZoom: true,
            selectedColor: "#CC0000"
            };
            
            
            map.imagesSettings = {
                balloonText: "<span style='font-size:14px;'><b>[[title]]</b>: [[value]]</span>",
                alpha:0.6
            }
            map.zoomControl = {
                "buttonFillColor": "#39B0CA",
                top: 60
            }
            var dataProvider = {
                mapVar: AmCharts.maps.worldLow,
                images:  [],
                "zoomLevel": 4.5,
                "zoomLatitude": avg_lat,
                "zoomLongitude": avg_long
            }
            // create circle for each country
            for (var i = 0; i < mapData.length; i++) {
                var dataItem = mapData[i];
                var value = dataItem.value;
                // calculate size of a bubble
                var size = (value - min) / (max - min) * (maxBulletSize - minBulletSize) + minBulletSize;
                if (size < minBulletSize) {
                    size = minBulletSize;
                }

                dataProvider.images.push({
                    type: "circle",
                    width: size,
                    height: size,
                    color: "#eea638",
                    longitude: dataItem.longitude,
                    latitude: dataItem.latitude,
                    title: dataItem.name,
                    value: value
                });
            }
            map.dataProvider = dataProvider;
	map.write("w_<?php echo $widget->id; ?>");
};
    
    if (AmCharts.isReady) {
      configChart();
    } else {
      AmCharts.ready(configChart);
    }
        
        </script><?php echo $this->getContent(); ?></div>
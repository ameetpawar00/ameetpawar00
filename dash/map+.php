
<script src="http://www.ammap.com/lib/3/ammap.js" type="text/javascript"></script>
<script src="http://www.ammap.com/lib/3/maps/js/worldHigh.js" type="text/javascript"></script>
<div id="mapdiv" style="width: 1000px; height: 450px;"></div>&#8203;

<script type="text/javascript">
    var map;
    AmCharts.ready(function() {
        map = new AmCharts.AmMap();
        map.pathToImages = "http://www.ammap.com/lib/images/";
        map.panEventsEnabled = true;
        map.backgroundColor = "#ffffff";
        map.backgroundAlpha = 1;
        
        map.zoomControl.panControlEnabled = true;
        map.zoomControl.zoomControlEnabled = true;
    
        var dataProvider = {
            mapVar: AmCharts.maps.worldHigh,
            getAreasFromMap: true,
            areas: [
            { id: "IN", color: "#b82121" },
            { id: "AU", color: "#4444ff" },
            { id: "US", color: "#20a8d9" }
            ]
        };
    
        map.dataProvider = dataProvider;
    
        map.areasSettings = {
            autoZoom: true,
            color: "#CDCDCD",
            colorSolid: "#5EB7DE",
            selectedColor: "#5EB7DE",
            outlineColor: "#666666",
            rollOverColor: "#88CAE7",
            rollOverOutlineColor: "#FFFFFF"
        };
    
        map.write("mapdiv");
    });
</script>





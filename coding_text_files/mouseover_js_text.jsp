  		var icon_hover = L.icon({
            iconUrl: 'icons/' + icon_url + '_hover.png',
        });
              
        // Use e.target to change style of marker we mouseover and mouseout 
        layer.on("mouseover", function (e) {
            // e.target = original fill color
            // Which will be used when we rollover marker
            layer.setIcon(icon_hover);
        });
        layer.on("mouseout", function (e) {
            // Change the style to the original version
            layer.setIcon(icon);
        });
Maps: Crimes reported in the Cedar Valley
===========

* [Live demo](http://wcfcourier.com/app/crime_map/)
- This is the code that runs our crime maps. We map certain calls for service for both Waterloo and Cedar Falls, Iowa.

The short of how this app works:
1. I get a list of calls for service in PDF form from our local police departments every day.
- Note: Here's the PDF from [Waterloo](http://www.waterloopolice.com/images/crpress.PDF). And here's one from [Cedar Falls](http://www.cedarfalls.com/Archive.aspx?AMID=82&Type=Recent)
2. I turn those into HTML files using [PDFtoText](http://en.wikipedia.org/wiki/Pdftotext) 
3. I then use [Beautiful Soup](http://www.crummy.com/software/BeautifulSoup/) to pull out the calls we want and compile a spreadsheet with those calls. More information on which calls we use on the is available in my blog post below.
- Note: These actions are all ran on the command line. So I put all of these commands in an AppleScript file to help simply the process.
5. I then add those calls to our Google spreadsheets for [Waterloo](https://docs.google.com/spreadsheet/ccc?key=0As3JvOeYDO50dFcwTXJPTTFUaEoxMTN6QjYyUDlILUE#gid=18) and [Cedar Falls](https://docs.google.com/spreadsheet/ccc?key=0As3JvOeYDO50dEgxVXZGVHN1aUdwVVNJN1dJeVY5cUE)
6. I then use [this website](http://gmaps-samples.googlecode.com/svn/trunk/spreadsheetsgeocoder/geocodespreadsheet.htm) to get the latitude and longitude values from the addresses for each call we want to map.
7. Finally, I convert these spreadsheets into JSON using [Mr. Data Converter](http://shancarter.github.io/mr-data-converter/)
8. The JSON data powers the whole add. [Leaflet](http://leafletjs.com/) is used for the map, [DataTables](https://datatables.net/) shows a table of the calls, [jQuery Geocodify](http://datadesk.github.io/jquery-geocodify/) is used for the search box, [jQRangeSlider](http://ghusse.github.io/jQRangeSlider/) is used for the range slider under the map and [Bootstrap](http://getbootstrap.com/) is used for the graphs, tabs and overall design.

* It takes me about 20 minutes to update both the Waterloo and Cedar Falls crime maps. I update the map about twice a week.

* For more information on the project, read [this blog post](http://csessig.wordpress.com/2012/08/13/how-we-did-it-waterloo-crime-map/) and [this blog post](http://csessig.wordpress.com/2012/10/21/going-mobile/)

* This project has been around since July 2012 and has evolved since those above tutorials were written. If you have any questions, shoot me an e-mail at csessig86@gmail.com
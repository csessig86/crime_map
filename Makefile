crime:
	cd ~/Desktop/WCFCourier/crime_map/report; rm * && wget http://www.waterloopolice.com/images/crpress.PDF && pdftohtml -c crpress.PDF
	cd ~/Desktop/WCFCourier/crime_map/report_cf; pdftohtml -c calls.PDF
	cd ~/Desktop/WCFCourier/crime_map; python scrape_wloo.py && python scrape_cf.py
	open csv/todays_crime_data_wloo.csv
	open csv/todays_crime_data_cf.csv
	open https://docs.google.com/spreadsheet/ccc?key=0As3JvOeYDO50dE10Ni01ckJXbnVNUWNzSUhPUEdrUHc
	open http://gmaps-samples.googlecode.com/svn/trunk/spreadsheetsgeocoder/geocodespreadsheet.htm
	open http://shancarter.github.io/mr-data-converter/
	open http://www.vpaf.uni.edu/pubsaf/crime_stats/log/index.shtml
	cd ~/Desktop/WCFCourier/crime_map/csv; open UNI.xlsx

no_download:
	cd ~/Desktop/WCFCourier/crime_map/report; pdftohtml -c crpress.PDF
	cd ~/Desktop/WCFCourier/crime_map/report_cf; pdftohtml -c calls.PDF
	cd ~/Desktop/WCFCourier/crime_map; python scrape_wloo.py && python scrape_cf.py
	open csv/todays_crime_data_wloo.csv
	open csv/todays_crime_data_cf.csv
	open https://docs.google.com/spreadsheet/ccc?key=0As3JvOeYDO50dE10Ni01ckJXbnVNUWNzSUhPUEdrUHc
	open http://gmaps-samples.googlecode.com/svn/trunk/spreadsheetsgeocoder/geocodespreadsheet.htm
	open http://shancarter.github.io/mr-data-converter/
	open http://www.vpaf.uni.edu/pubsaf/crime_stats/log/index.shtml
	cd ~/Desktop/WCFCourier/crime_map/csv; open UNI.xlsx
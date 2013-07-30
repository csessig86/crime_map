import urllib2
from bs4 import BeautifulSoup
import re

# PDF taken from the Cedar Falls Police Department's website:
# http://www.cedarfalls.com/Archive.aspx?AMID=82

# Create a CSV where we'll save our data.
f = open('csv_cf/todays_crime_data.csv', 'w')
# Add headers
f.write("date" + "," + "times" "," + "crime" + "," + "location" + "," + "disposition" + "\n")

# Use PDFtoHTML to convert into HTML
# For Mac users, go to command line and type: brew install pdftohtml
# Command line command convert PDF pages to HTML pages: pdftohtml -c calls.PDF

# URL of the crime report index, which includes links to several pages with crime reports on them
url = 'file://localhost/Users/chrisessig/Desktop/WCFCourier/crime_map/report_cf/calls_ind.html'
page = urllib2.urlopen(url)
soup = BeautifulSoup(page)

# Go through record page we specify with range
# PDFtoHTML gives us several pages of crimes
# Depending on how many crimes were reported
# So we create a for loop to go through each one
for x in range(1, 21):
	# This prints on the command line
	report_page = str(x)
	print "Getting data for page " + report_page
	
	# Create new URL for each page and pass that to Beautiful Soup
	new_url = 'file://localhost/Users/chrisessig/Desktop/WCFCourier/crime_map/report_cf/calls-' + report_page + '.html'
	new_page = urllib2.urlopen(new_url)
	new_soup = BeautifulSoup(new_page)
	# We'll now start pulling content from URLs
	# We need to pull date, time, crime type, etc
	
	# This regex looks for the date + time div
	# Basic format: "07/01/2012 00:13:37"
	date_regex = re.compile('\d{2}[/]\d{2}[/]\d{4}')
	
	# All date + time divs have varying left attributes, like 102, 112, 117, etc.
	# All disposition divs have a left attribute of 700
	# All location divs have a left attribute of 464
	# Look for these divs with regex
	date_regex_css_test01 = re.compile('[a-z]*\d*\;left:112')
	date_regex_css_test02 = re.compile('[a-z]*\d*\;left:117')
	
	# Search for div containing this regex using BS
	# And make sure it is one of the crimes specified
	# Then put the content of each div into the arrays below
	dates = []
	crime = []
	disposition = []
	location = []

	date_time = new_soup.find('div', text='Date & Time')
	if date_time != None:
		date_time02 = date_time.attrs['style']

		if date_time02[-3:] == '102':
			print 'Success 1'
			crime_regex_css = re.compile('[a-z]*\d*\;left:246')
			location_regex_css = re.compile('[a-z]*\d*\;left:454')
			disposition_regex_css = re.compile('[a-z]*\d*\;left:690')
			date_regex_css = re.compile('[a-z]*\d*\;left:102')
		elif date_time02[-3:] == '112':
			print 'Success 2'
			crime_regex_css = re.compile('[a-z]*\d*\;left:256')
			location_regex_css = re.compile('[a-z]*\d*\;left:464')
			disposition_regex_css = re.compile('[a-z]*\d*\;left:700')
			date_regex_css = re.compile('[a-z]*\d*\;left:112')
		elif date_time02[-3:] == '117':
			print 'Success 3'
			crime_regex_css = re.compile('[a-z]*\d*\;left:261')
			location_regex_css = re.compile('[a-z]*\d*\;left:469')
			disposition_regex_css = re.compile('[a-z]*\d*\;left:705')
			date_regex_css = re.compile('[a-z]*\d*\;left:117')
		else:
			print date_time02[-3:]
		
		# We'll first find all the date divs
		for post in new_soup.find_all(attrs={'style' : date_regex_css}):
			if date_regex.match(post.get_text()):
				if post.find_previous('div').get_text() != 'NR' and post.find_previous('div').get_text() != 'DC' and post.find_previous('div').get_text() != 'NF' and post.find_previous('div').get_text() != 'GA' and post.find_previous('div').get_text() != 'UN' and post.find_previous('div').get_text() != 'C':
					# Then we'll see if a report was filed on the call
					# With CF reports 'PROGRESS/JUST' is a separate DIV after 'ASSAULT IN' or 'BURGLARY IN'
					# So we need to find the div before 'PROGRESS/JUST' to get the actual crime
					if post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'PROGRESS/JUST':
						this = post.find_previous(attrs={'style' : crime_regex_css})
						if this.find_previous(attrs={'style' : crime_regex_css}).get_text()  == 'BURGLARY IN' or this.find_previous(attrs={'style' : crime_regex_css}).get_text()  == 'SHOOTING IN'  or this.find_previous(attrs={'style' : crime_regex_css}).get_text()  == 'STABBING IN'  or this.find_previous(attrs={'style' : crime_regex_css}).get_text()  == 'ASSAULT IN' or this.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'ROBBERY IN':
							# Finally, we'll append the call
							# If it matches all the criteria above
							dates.append(post.get_text())
							crime.append(this.find_previous(attrs={'style' : crime_regex_css}).get_text())
							disposition.append(post.find_previous('div').get_text())
							location.append(post.find_previous(attrs={'style' : location_regex_css}).get_text())
				
					# Same logic for Assault / Ambulance requested
					if post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'REQUESTED':
						this = post.find_previous(attrs={'style' : crime_regex_css})
						if this.find_previous(attrs={'style' : crime_regex_css}).get_text()  == 'ASSAULT/AMBULANCE':
							# Finally, we'll append the call
							# If it matches all the criteria above
							dates.append(post.get_text())
							crime.append(this.find_previous(attrs={'style' : crime_regex_css}).get_text())
							disposition.append(post.find_previous('div').get_text())
							location.append(post.find_previous(attrs={'style' : location_regex_css}).get_text())
					# Otherwise we'll grab the first div with the crime left attribute
					if post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'MVA HIT & RUN' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'BURGLARY' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'BURGLARY IN' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'ROBBERY' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'ROBBERY IN' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'ASSAULT' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'ASSAULT/AMBULANCE' or post.find_previous('div').get_text() == 'ASSAULT IN' or post.find_previous('div').get_text() == 'ASSAULT/RAPE' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'WEAPONS VIOLATIONS' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'STABBING IN PROGRESS/JUST' or post.find_previous('div').get_text() == 'STABBING IN' or post.find_previous('div').get_text() == 'SHOOTING IN PROGRESS/JUST' or post.find_previous('div').get_text() == 'SHOOTING IN' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'HOMICIDE' or post.find_previous(attrs={'style' : crime_regex_css}).get_text() == 'WEAPON:SHOTS FIRED':
						# Finally, we'll append the call
						# If it matches all the criteria above
						dates.append(post.get_text())
						crime.append(post.find_previous(attrs={'style' : crime_regex_css}).get_text())
						disposition.append(post.find_previous('div').get_text())
						location.append(post.find_previous(attrs={'style' : location_regex_css}).get_text())
	
		# Change the codes to words                
		for x in range(0, len(disposition)):
			disposition[x] = re.sub('RI', 'REPORT INITIATED', disposition[x])
			disposition[x] = re.sub('CI', 'CITATION ISSUED', disposition[x])
			disposition[x] = re.sub('AS', 'ASSISTED', disposition[x])
			disposition[x] = re.sub('RW', 'REFERRED WITHIN DEPT', disposition[x])
			disposition[x] = re.sub('WA', 'WARNING & ADVISED', disposition[x])
			disposition[x] = re.sub('RO', 'REFERRED TO OTHER DEPT', disposition[x])
			disposition[x] = re.sub('VW', 'VERBAL WARNING', disposition[x])
			disposition[x] = re.sub('XA', 'EXTRA ATTENTION', disposition[x])
			disposition[x] = re.sub('IX', 'INFO EXCHANGE', disposition[x])
		
		# Make crime labels the same as Waterloo, since we're using the same JS file
		# To properly style the dispositions
		for x in range(0, len(crime)):
			crime[x] = re.sub('BURGLARY IN', 'BURGLARY IN PROGRESS/JUST', crime[x])
			crime[x] = re.sub('ROBBERY IN', 'ROBBERY IN PROGRESS/JUST', crime[x])
			crime[x] = re.sub('ASSAULT IN', 'ASSAULT IN PROGRESS/JUST', crime[x])
			crime[x] = re.sub('ASSAULT/AMBULANCE', 'ASSAULT/AMBULANCE REQUESTED', crime[x])
		
		for x in range(0, len(dates)):
			# We'll split up the date and time
			# Which are both contained in the same array
			new_date1 = dates[x].split(" ")
			
			# Remove commas so we don't screw up the CSV
			new_date2 = new_date1[0].replace(",", " -")
			new_time = new_date1[1].replace(",", " -")
			new_crime = crime[x].replace(",", " -")
			new_location = location[x].replace(",", " -")
			location_sub = re.sub(" 'WPD FRCT", "", location[x])
			location_sub2 = re.sub("/", " and", location[x])
			new_disposition = disposition[x].replace(",", " -")
			
			# Write content to the CSV
			f.write(new_date2 + "," + new_time + "," + new_crime + "," + location_sub2 + "," + new_disposition + "\n")

# Always a good idea to close!
f.close()
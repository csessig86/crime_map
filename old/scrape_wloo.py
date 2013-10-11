import urllib2
from bs4 import BeautifulSoup
import re

# PDF taken from the Waterloo Police Department's website:
# http://www.waterloopolice.com/images/crpress.PDF

# Create a CSV where we'll save our data.
f = open('csv/todays_crime_data.csv', 'w')
# Add headers
f.write("date" + "," + "times" "," + "crime" + "," + "location" + "," + "disposition" + "\n")

# Use PDFtoHTML to convert into HTML
# For Mac users, go to command line and type: brew install pdftohtml
# Command line command convert PDF pages to HTML pages: pdftohtml -c crpress.PDF

# URL of the crime report index, which includes links to several pages with crime reports on them
url = 'file://localhost/Users/chrisessig/Desktop/WCFCourier/crime_map/report/crpress_ind.html'
page = urllib2.urlopen(url)
soup = BeautifulSoup(page)

# Go through record page we specify with range
# PDFtoHTML gives us several pages of crimes
# Depending on how many crimes were reported
# So we create a for loop to go through each one
for x in range(2, 89):
    
    # This prints on the command line
    report_page = str(x)
    print "Getting data for page " + report_page
    
    # Create new URL for each page and pass that to Beautiful Soup
    new_url = 'file://localhost/Users/chrisessig/Desktop/WCFCourier/crime_map/report/crpress-' + report_page + '.html'
    new_page = urllib2.urlopen(new_url)
    new_soup = BeautifulSoup(new_page)
    
    # We'll now start pulling content from URLs
    # We need to pull date, time, crime type, etc
    
    # This regex looks for the date + time div
    # Basic format: "07/01/2012 00:13:37"
    date_regex = re.compile('\d{2}[/]\d{2}[/]\d{4}')
    # All date + time divs have a left attribute of 103
    # All disposition divs have a left attribute of 677
    # All location divs have a left attribute of 677
    # Look for these divs with regex
    date_regex_css = re.compile('[a-z]*\d*\;left:103')
    disposition_regex_css = re.compile('[a-z]*\d*\;left:677')
    location_regex_css = re.compile('[a-z]*\d*\;left:460')
    
    # Search for div containing this regex using BS
    # And make sure it is one of the crimes specified
    # Then put the content of each div into the arrays below
    dates = []
    crime = []
    disposition = []
    location = []
    
    # We'll first find all the date divs
    for post in new_soup.find_all(attrs={'style' : date_regex_css}):
        if date_regex.match(post.get_text()):
            if post.find_previous('div').get_text() == 'MVA HIT & RUN' or post.find_previous('div').get_text() == 'BURGLARY' or post.find_previous('div').get_text() == 'BURGLARY IN PROGRESS/JUST' or post.find_previous('div').get_text() == 'ROBBERY' or post.find_previous('div').get_text() == 'ROBBERY IN PROGRESS/JUST' or post.find_previous('div').get_text() == 'ASSAULT' or post.find_previous('div').get_text() == 'ASSAULT/AMBULANCE REQUESTED' or post.find_previous('div').get_text() == 'ASSAULT IN PROGRESS/JUST' or post.find_previous('div').get_text() == 'WEAPONS VIOLATIONS' or post.find_previous('div').get_text() == 'STABBING IN PROGRESS/JUST' or post.find_previous('div').get_text() == 'SHOOTING IN PROGRESS/JUST' or post.find_previous('div').get_text() == 'HOMICIDE' or post.find_previous('div').get_text() == 'WEAPON:SHOTS FIRED':
                # Then we'll see if a report was filed on the call
                if post.find_previous(attrs={'style' : disposition_regex_css}).get_text() != 'NO REPORT' and post.find_previous(attrs={'style' : disposition_regex_css}).get_text() != 'NOTHING FOUND' and post.find_previous(attrs={'style' : disposition_regex_css}).get_text() != 'GONE ON ARRIVAL' and post.find_previous(attrs={'style' : disposition_regex_css}).get_text() != 'DUPLICATE CALL' and post.find_previous(attrs={'style' : disposition_regex_css}).get_text() != 'UNFOUNDED' and post.find_previous(attrs={'style' : disposition_regex_css}).get_text() != 'CALL CANCELLED' and post.find_previous(attrs={'style' : disposition_regex_css}).get_text() != 'NOT NEEDED':
                    # Finally, we'll append the call
                    # If it matches all the criteria above
                    dates.append(post.get_text())
                    crime.append(post.find_previous('div').get_text())
                    disposition.append(post.find_previous(attrs={'style' : disposition_regex_css}).get_text())
                    location.append(post.find_previous(attrs={'style' : location_regex_css}).get_text())
                    
                    
                
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
import time
import googlemaps  # pip install googlemaps
import location as location
import pandas as pd  # pip install pandas


def kilometers_to_meters(kilometers):
    try:
        return kilometers * 1_609.344
    except:
        return 0


API_KEY = open('API_KEY.txt', 'r').read()
map_client = googlemaps.Client(API_KEY)

address = 'aruvikkara'
geocode = map_client.geocode(address=address)
(lat, lng) = map(geocode[0]['geometry']['location'].get, ('lat', 'lng'))

location = (8.566159032903618, 77.01718586644942),
search_string = 'hospital'
distance = kilometers_to_meters(15)
hospital_list = []

response = map_client.places_nearby(
    Location=location,
    keyword='hospital nearby',
    radius=distance
)

hospital_list.extend(response.get('results'))
next_page_token = response.get('next_page_token')

while next_page_token:
    time.sleep(2)
    response = map_client.places_nearby(
        Location=location,
        keyword='hospital nearby',
        radius=distance,
        page_token=next_page_token
    )
    hospital_list.extend(response.get('results'))
    next_page_token = response.get('next_page_token')

df = pd.DataFrame(hospital_list)
df['url'] = 'https://www.google.com/maps/place/?q=place_id:' + df['place_id']
df.to_excel('hospital list.xlsx', index=False)
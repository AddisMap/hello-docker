THE FINAL INTENDED URL Endpoint for Signle POIs (Business Pages)
 Make a route that takes a way/node ID + type (similar like the addismap.com URLs)
 and loads the data from the openstreetmap.org JSON and displays it
 1. Get all Map data (Node/Way/Relation) from OSM using BBOX or Area
 2. Generate a JSON data generating URL (End Point) for each Map data
 3. Get a JSON Response using OSM_TYPE & OSM_ID obtained from OSM_OVERPASS_API {Elements}

 Get URL https://www.addismap.com/p6624545638/bati-complex
 Get URL https://openplaceguide.org/{name}
 Get URL https://openplaceguide.org/{osm_type}{osm_id}/{osm_name}
 Get URL https://openplaceguide.org/{osm_type}/{osm_id}  -> desired URL (Endpoint)
 Get URL https://www.openstreetmap.org/api/0.6/way/162817836.json


date=`date +%FT%H-%M-%S`
#XAPI="http://xapi.openstreetmap.org/api/0.6/map"
XAPI="http://www.overpass-api.de/api/xapi?map"
## ETHIOPIA via Geofabrik
URL=http://download.geofabrik.de/openstreetmap/africa/ethiopia.osm.bz2
dir=/srv/downloads/osm/ethiopia
name="ethiopia"
wget $URL -O $dir/$date-$name.osm.bz2
## ETHIOPIA via Geofabrik
URL=http://download.geofabrik.de/openstreetmap/africa/ethiopia.osm.pbf
dir=/srv/downloads/osm/ethiopia
name="ethiopia"
wget $URL -O $dir/$date-$name.osm.pbf
## Addis via XAPI
dir=/srv/downloads/osm/addis-ababa
name="addis-ababa"
top=9.13
bottom=8.8
left=38.61
right=38.96
URL=$XAPI?bbox=$left,$bottom,$right,$top
wget $URL -O $dir/$date-$name.osm
bzip2 $dir/$date-$name.osm
/srv/bame-website/scripts/new-osm.sh $dir/$date-$name.osm.bz2
#XAPI="http://xapi.openstreetmap.org/api/0.6"
#top=14.8922
#bottom=3.4024
#left=32.9999
#right=47.9862
#URL=$XAPI/map?bbox=$left,$bottom,$right,$top



# Attributes #

| **Name** | **Required** | **Default** | **Description** |
|:---------|:-------------|:------------|:----------------|
| address  | yes          |             | Full address that will be centered on the map |
| width    | no           | 300         | Width of the map |
| height   | no           | 200         | Height of the map |
| zoomLevel | no           | 13          | Initial zoom level of the map |

# Usage #

## Configuring the API key ##
It is very easy to include maps from Google Maps inside your application. The first thing you need to do for this is to request a new API key. Check [this](http://code.google.com/apis/maps/signup.html) link to sign up for an API key and to read more information.

Once you've received the API key, configure the `gmaps_api_key` inside the `main.conf` configuration file:
```
gmaps_api_key=ABQIAAAAx_lFmPrs_Gkl6KMgU-Z9aRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxTSiMpaub_ph7dOeTqVyazTRWS5SA
```

## Using the component ##
At this point, Movico provides one component for displaying a Google Map with a certain width and height, centered at a certain address. This component uses the Google Maps Javascript API V2 to display the map. Basically, this is how to use the component in your views:
```
<googleMap address="Biesweg, Gellik, Belgium" width="400" height="300" zoomLevel="15"/>
```
This will display a map like so:

![http://php-movico.googlecode.com/files/Screen%20shot%202011-09-22%20at%2008.39.58.png](http://php-movico.googlecode.com/files/Screen%20shot%202011-09-22%20at%2008.39.58.png)
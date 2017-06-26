# Readme

*Repositorio de versionamiento*

## Curso GIS
### Postgrado de informática

La instalación de Sublimetext3 es la habitual en windows (siguiente, siguiente..)

Sobre el key de activación, en el archivo encontraran 3 keys de activación, pueden utilizar cualquiera de ellas.


**Links de ayuda**

- http://boundingbox.klokantech.com/
- https://maps.googleapis.com/maps/api/js
- http://maps.stamen.com/js/tile.stamen.js
- http://www.latlong.net/

### Proyecciones
- http://docs.openlayers.org/library/spherical_mercator.html#what-is-spherical-mercator



#### Ayuda
```
mapboxLayer = new OpenLayers.Layer.XYZ('MapBox', [
             				    
			    "http://b.tiles.mapbox.com/v3/isawnyu.map-knmctlkh/${z}/${x}/${y}.png",
   
   "http://c.tiles.mapbox.com/v3/isawnyu.map-knmctlkh/${z}/${x}/${y}.png",
            	"http://d.tiles.mapbox.com/v3/isawnyu.map-knmctlkh/${z}/${x}/${y}.png"
			    ], {
            sphericalMercator: true,
            //tileSize: new OpenLayers.Size([512, 512]),
            wrapDateLine: true,
        	numZoomLevels: 19
        });
```        

google:

       ("Mapa Satelital",{type:google.maps.MapTypeId.TIPYMAP});

## Shp a sql

```
shp2pgsql -s <SRID> <shapefile> <tablename> <db_name> > filename.sql
```
donde SRID: 4326, 26910, 900913, etc.


## Pasos para configurar PosGIS

### paso 1

conectarse a postgres

### paso 2

Crear un usuario específico para el curso

### paso 3

Crear la DB (dbcursogis) y que el usuario creado sea dueño de la nueva DB

### paso 4

Cargar y/o habilitar PostGIS en la nueva DB


## Pasos para cargar un shape a PostGIS

### paso 1

Conseguir un archivo Shape (shp)

### paso 2

Convertir el archivo shape a un archivo SQL (.sql)

### paso 3

Importar el archivo SQL a postGIS























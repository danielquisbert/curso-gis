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

### Control para la consulta de información de un Layer
```  
new OpenLayers.Control.WMSGetFeatureInfo({
	queryVisible: true,
	eventListeners: {
		getfeatureinfo: function (event){
			....
			....
		}
	}
});

```  

### Popup 
```
popup = new OpenLayers.Popup.FramedCloud(
	'Popup',
	map.getLonLatFromPixel(event.xy),
	null,
	event.text,
	null,
	true
);

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

conectarse a postgres:

cambio de usuario a **postgres**
```
sudo su
su postgres
```

ingreso a la DB por defecto de postgres
```
psql
```
Para salir de la consola de postgres presionar Ctrl + D

### paso 2

Crear un usuario específico para el curso

Con el usuario de postgres lanzamos comandos propios del servidor
```
createuser cursouser
```
Ingresando a la consola de postgres, cambiamos el password del nuevo usuario

```
psql
ALTER ROLE cursouser WITH PASSWORD '123456';
```

### paso 3

Crear la DB (dbcursogis) y que el usuario creado sea dueño de la nueva DB

Al igual que en el usuario con el usuario postgres y comendos del servidor creamos la DB y hacemos que el usuario creado sea dueño de la nueva DB

```
createdb dbcursogis -O cursouser
```

### paso 4

Cargar y/o habilitar PostGIS en la nueva DB

Se debe impolrtar los SQLs necesarios de: /usr/share/postgresql/9.4/contrib/postgis-2.1/

```
psql -h localhost -U cursouser -d dbcursogis -f /usr/share/postgresql/9.4/contrib/postgis-2.1/postgis.sql
psql -h localhost -U cursouser -d dbcursogis -f /usr/share/postgresql/9.4/contrib/postgis-2.1/postgis_comments.sql
psql -h localhost -U cursouser -d dbcursogis -f /usr/share/postgresql/9.4/contrib/postgis-2.1/spatial_ref_sys.sql
psql -h localhost -U cursouser -d dbcursogis -f /usr/share/postgresql/9.4/contrib/postgis-2.1/legacy.sql
```

Nota: para poder subir estos archivos se debe tener privilegios de SUPERUSUARIOS, para esto se cambia el privilegio a el usuario **cursouser** de la siugiente manera

```
psql
ALTER ROLE cursouser WITH SUPERUSER;
```

Por seguridad un usuario distinto de postgres no debería ser superusuario, para esto después de importar los SQLs para postGIS, se debe quitar los privilegios de superusuario a cursouser

```
psql
ALTER ROLE cursouser WITH NOSUPERUSER;
```

## Pasos para cargar un shape a PostGIS

### paso 1

Conseguir un archivo Shape (shp)

### paso 2

Convertir el archivo shape a un archivo SQL (.sql)

Se utiliza los comandos:
```
shp2pgsql -s 4326 archivoShape.shp nombreNuevaTabla dbcursogis > nombreArchivo.sql
```

### paso 3

Importar el archivo SQL a postGIS

```
psql -h localhost -U cursouser -d dbcursogis -f /PATH/ARCHIVO/SHAPE/nombreArchivo.sql
```























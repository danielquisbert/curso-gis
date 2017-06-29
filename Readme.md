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
	map.getLonLatFromPixel(xy),
	null,
	event.text,
	null,
	true
);

```

### Centrar el mapa utilizando un boundingbox (encuadre) y la función **getCenterLonLat** de la clase Map

```
new OpenLayers.Bounds(-x, -y, x, y);
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


## Configuraciones adicionales

Ayudaran a mejorar el performance de la aplicación que se vaya a desarrollar

```
OpenLayers.DOTS_PER_INCH = 90.71428571428572;
```

Para mostrar de mejor manera el error de imágenes no renderizadas

```
OpenLayers.Util.onImageLoadErrorColor= 'transparent';

o

.olImageLoadError { 
    background-color: transparent; 
    opacity: 0.5; 
    filter: alpha(opacity=50); /* IE */ 
} 

OpenLayers.Util.onImageLoadError = function() {
     this.src = '/path/to/custom-blank.png';
};
```
Para la navegación desde un dispositivo móvil

```
controlTouch = new OpenLayers.Control.TouchNavigation({dragPanOptions:{enableKinetic:true}});
```

Utilizar una resolución recomendada para el mapa

```
maxResolution: 196543.0339
```

Personalizar las fuentes para el mapa y los layers

```
new OpenLayers.Control.Attribution({
	template:"<span style='color:darkblue;font-weight:bold;'>Curso GIS - Postgrado en Informática</span>"
});
```


















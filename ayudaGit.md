# Comandos GIT

## configuración inicial, se configura el nombre de usuario y el correo electrónico

```
git config --global user.name "Nombre Completo"
git config --global user.email "correode@ejemplo.com"
```

## Versionamiento del repositorio Local

### Adición y commiteo al área de versionamiento (*repositorio Local*)

```
git add nombreArchivo1 nombreArchivo2 nombreArchivo3 ... nombreArchivoN
git commit -m "Comentarios pertinentes sobre el trabajo con los archivos adicionados"
```

## Llevar o empujar lo versionado en local hacía el *repositorio Remoto*

siguiendo el formato:

git push nombreRepositorioRemoto nombreRama

Ejemplo:

```
git push origin master
```

## Actualización o sincronización del repositorio local con el repositorio remoto

### Actualización de la información (cambios) en el repositorio remoto al repositorio local

```
git fetch origin master
```

### Aplicar o escribir los cambios nuevos traidos en la actualización

```
git pull origin master
```

## Ramas

### Ver ramas

```
git branch
```

### Ver todas las ramas (locales y remotas)

```
git branch -a
```

### Crear una nueva rama

```
git branch nombreNuevaRama
```

### Cambiar de rama

```
git checkout nombreRama
```


## Comandos GIT adicionales

### Ver el historial de commits

```
git log
```

### Ver diferencias con el repositorio remoto

```
git diff nombreArchivo
```

### Ver la URL de mi repositorio remoto

```
git remote -v
```

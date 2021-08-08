# Medium Free Viewer

### About

This project was born with the purpose of solving a big problem 
that the Medium website has.
This root of this problem is that there are some articles that are considered "Premium",
so it allows you to see up to 3 "premium" articles per month.
An easy way to passthrough this, is to open a window in (the browser's) incognito mode
and continue reading these articles.

A solution that I came up with is making the requests on an external server,
which then shows this rendering, like a proxy does, and save the render in a 
caché to avoid making so many requests to the Medium's server.

This project was made in 1 weekend. I didn't want to spendy any more time than that doing it.

### Issues found:
- Soft: I have to add specific parameters that are not found in
Lumen's documentation on the topic of Caché with Redis.
- Soft: If a user puts some other URL that does not belongs to Medium,
it renders anyways. This is solved by a Rule that, given an IP, verifies if is on the 
IPs Range, and I used the range that belongs to Medium.
- Moderate: Medium has a script that if not loads these components successfully shows an
"500 error". To avoid this error, this script is eliminated one step before of showing
the render to the client. (more info in: app\Actions\AllowMediumPost.php)
- Moderate: Medium has certain domains that does not belongs to their IPs range, so I have to 
find a way to relate certain web pages made with Medium through of their Response Headers
  (more info in: app\Rules\MediumRule::hasSpecificHeaders)
- High: For their premium content, Medium uses a API that returns the content structured in JSON
format, not in HTML, this building process is made by a script in Javascript. Given that this
Javascript code is minified and part of this is obfuscated, I decided to discontinue the project.

### Decisions

- I used Lumen given that I didn't need the many features that Laravel has.
- I used Heroku for the hosting given that it is free and my usage isn't big.
- I used Redis for Caché topics given that Heroku has a free service of 20 MB.
- I used Chrome Extension to make a quick extension to when you click and redirects you 
the article to the server.
- I used cURL to make the request to Medium's server.
- I used gzip for the render compression given that each render takes up a lot of space. This compresses
from 800kB to 40kB (compression ratio 95%)
- I use unit testing in Actions and feature testing for the controller.


### Acerca
Este proyecto nace en propósito de un gran inconveniente que tiene el sitio web Medium.
El inconveniente se basa en que algunos artículos son considerados "Premium"
por lo que te permite visualizar hasta 3 artículos "premium" al mes. 
Dando poco lugar a visualizar más.
Una forma fácil de passthrought de esto es abriendo una ventana en modo incógnito
del navegador y poder continuar visualizando artículos.

Una solución que se me ocurrió fue realizar las peticiones vía un servidor externo,
mostrar su renderizado, al estilo de un proxy, y guardar dicho renderizado 
en un caché para evitar realizar tantas peticiones al servidor de
Medium.

Este proyecto fue hecho en un fin de semana. Mas tiempo que eso no quise dedicar.

### Inconvenientes encontrados:
- Leve: Hay que añadir ciertos parámetros que no se encuentra en la
documentación de Lumen para el tema del cacheo con Redis.
- Leve: Si un usuario ponía cualquier url en vez de una de Medium, se renderizaba igual.
  Se solucionó poniendo una Rule que dado una IP verifica si este esta dentro 
 de un Rango de IPs y se puso aquel rango que pertenece a Medium.
- Moderado: Medium tiene un script, que sino carga bien sus componentes te muestra
  un error tipo 500. Para evitar dicho error se elimina dicho script un paso antes de 
  mostrar el renderizado al cliente. (mas info ver: app\Actions\AllowMediumPost.php)
- Moderado: Medium tiene ciertos dominios que no pertenecen a su rango de IPs
entonces tuve que encontrar un modo de relacionar ciertas páginas con Medium
  a través de los Response Headers. (más info ver: app\Rules\MediumRule:hasSpecificHeaders)
- Grave: Medium para su contenido premium, utiliza una API y esta devuelve el contenido
estructurado en JSON, no en HTML, ese armado lo hace un script de Javascript.
  Dado que el código de Javascript está minificado y en cierta parte ofuscado.
  Desistí de continuar el proyecto.

### Decisiones

- Usé Lumen dado que no necesitaba tantos artilugios que poseé Laravel.
- Usé Heroku para el hosting del servidor dado que es gratuito y no lo uso tanto.
- Usé Redis para el caché ya que Heroku posee un servicio gratuito de 20MB.
- Usé Chrome Extension para realizar una extensión rápida de clickear un botón 
y redireccionar el articulo hacia el servidor.
- Usé cURL para realizar el request al servidor de Medium.
- Usé gzip para la compresión de los renderizados ya que ocupaban mucho espacio.
de 800kB hasta 40kB (relacion de compresión de 95%)
- Usé testing unitario en los Actions y feature tests para el controlador.

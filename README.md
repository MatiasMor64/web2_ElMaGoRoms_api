# web2_ElMaGoRoms - Entrega API Rest
## Descripción
Este proyecto consiste en una página web donde los usuarios pueden descargar ROMs para jugar videojuegos de otras plataformas en su PC. La base de datos almacena información sobre los juegos, plataformas, categorías y usuarios que pueden publicar sus propios ROMs.
![Diagrama de la base de datos](public/img/web2_elmagoroms.png)

## Explicaciones de EndPoints.

- **Listar todos los juegos (GET)**
  Genera un listado simple de todos los objetos a la vez.
  **url a utilizar:**
    'http://localhost/web2_ElMaGoRoms_api-main/api/juegos'

- **Listar en orden alfabetico segun el nombre (GET)**
  Ordena el listado general en forma alfabetica, segun si es descendiente o ascendiente
  **url a utilizar:**
    'http://localhost/web2_ElMaGoRoms_api-main/api/juegos/asc'
                             o
    'http://localhost/web2_ElMaGoRoms_api-main/api/juegos/desc'

- **Buscar un juego en especifico (GET)**
  Busca un juego particular segun la ID del mismo
  **url a utilizar:**
    'http://localhost/web2_ElMaGoRoms_api-main/api/juego/"ID de un juego"'

- **modificar un objeto especifico (PUT)**
  Modifica un juego particular segun la ID del mismo
  **url a utilizar:**
    'http://localhost/web2_ElMaGoRoms_api-main/api/juego/"ID de un juego"'
  **ejemplo de estructura para armar una modificacion:**
    {
      "nombre": "-nombre del juego-",
      "imagen": "imagen html del juego-",
      "descripción": "-descripcion general del juego-",
      "plataforma": "-plataforma a ingresar-",
      "categoria": "-categoria a ingresar-"
    }

  - **crear un juego (POST)**
  Crea un nuevo juego
  **url a utilizar:**
    'http://localhost/web2_ElMaGoRoms_api-main/api/juego'
  **ejemplo de estructura para crear un juego:**
     {
      "nombre": "Pokemon Platino",
      "descripción": "Juego clasico de la Nintendo Ds, el culmen de la 4ta generacion de pokemon",
      "imagen": "imagen html de pokemon platino",
      "usuario": "APICreator",
      "plataforma": "Nintendo Ds",
      "categoria": "Aventura"
    }

##Notas a tener en cuenta:
- Para poder crear y modificar, los codigos de plataforma y categoria deben ser exactos tal cual lo que aparece en la base de datos, cualquier cambio, incluso cambiar una mayuscula, resultara en el codigo fallando
- Lo mismo no sucede en el crear usuarios, por otra parte, el codigo permite que se cree un usuario nuevo, pero requiere que se ingrese la data del juego a crear de nuevo una vez se crea el usuario

## Autor
Este proyecto fue realizado por Matías Morcillo (matiasmorcillo128@gmail.com) y Iago Medina Durán (iagomduran@gmail.com).

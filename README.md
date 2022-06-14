
# Nombre del proyecto.

Cryptoworld

## Descripción general del Proyecto.

La aplicación consiste en un exchange, un portal donde los usuarios 
podrán:
Comprar criptomonedas a través de tarjeta de crédito. Recibir
criptomonedas de la cartera de otro usuario. Convertir esas 
criptomonedas en otras en base a su precio. Venderlas por
fiat. Retirar el fiat por tarjeta de crédito.

## Objetivos generales.
 * **Objetivo:** “Compra, venta y transferencia de criptomonedas”.
 * **Casos de uso:** “Comprar criptos”, “vender criptos”, “recibir criptos”, “enviar criptos”.

## Instrucciones de instalación y despliegue.
 * **En local:** Hacemos un clone del repositorio en github, luego dentro del repositorio ejecutaremos los siguientes comandos:

    ```composer install, npm install && npm run dev``` 

    necesitaremos también generar el archivo .env por lo que simplemente podríamos hacer un ```cp .env.example .env```, luego crear una base de datos
    y añadir la información en el archivo .env, finalmente hacemos un php artisan migrate, php artisan key:generate y un php artisan serve.
    Por otro lado podríamos usar el servicio de apache donde instalaremos la carpeta del proyecto en ```/var/www/html/``` y utilizar las directivas de apache para desplegar el proyecto.
 
 * **En remoto:** Utilizaremos el servicio que mas nos guste y realizaremos la instalacion de la base de datos de la misma forma que en local utilizando las opciones que nos de el proveedor del servicio

## Manual básico de usuario.

* Indice:


![App Screenshot](https://cryptoworld-proyecto.s3.eu-west-3.amazonaws.com/readme/indice.png)


En la página principal del sitio en la barra de arriba podremos registrarnos, iniciar sesión y realizar alguna operación como comprar cripto.







![App Screenshot](https://cryptoworld-proyecto.s3.eu-west-3.amazonaws.com/readme/cartera.png)En la cartera es donde podremos realizar la mayoría de operaciones, como depositar retirar enviar convertir o vender.







![App Screenshot](https://cryptoworld-proyecto.s3.eu-west-3.amazonaws.com/readme/cartera.png)
![App Screenshot](https://cryptoworld-proyecto.s3.eu-west-3.amazonaws.com/readme/operacion.png)La operación de comprar de criptomonedas nos llevará a este formulario, en las demás operaciones también son parecidos e igualmente intuitivos, en ellos podremos realizar las operaciones que creamos convenientes.
## Dificultades encontradas y soluciones aplicadas.

 * **Binance api:** Las librerías existentes en php no tienen la función que necesitaba, la cual era extraer del json el valor actual de un par de monedas así que he tenido que crear esa función.
 * **Amazon aws:** Permiso forbidden en la aplicación, la solución fue crear un usuario nuevo (IAM) y asignar políticas de fullAccess
 * **Stripe api:** Problema entre el diseño y la librería .js de stripe para conseguir el token que verifica la compra, solucionado con código javascript tras bastante esfuerzo.
## Diagrama


![App Screenshot](https://cryptoworld-proyecto.s3.eu-west-3.amazonaws.com/readme/diagrama.png)


## Glosario de términos.

* **Exchange:** Son plataformas o mercados digitales que permiten intercambiar
      monedas digitales por dinero fiat y/u otras criptomonedas o mercancías.

* **Criptomoneda:** Es un activo digital que emplea un cifrado criptográfico para
			 garantizar su titularidad y asegurar la integridad de las transacciones.

* **Cartera de criptomonedas:** Es una cuenta digital que se usa para almacenar,
				        enviar y recibir criptomonedas como el bitcoin.

* **Dirección de la criptomoneda:** código alfanumérico que indica un posible destino
					 para un pago de la criptomoneda que estés 
					 operando.
* **Par de monedas / divisas:** En un par de de monedas o divisas es un activo
				       financiero compuesto por dos monedas que
				       cotizan en el mercado la comparación de una
				       moneda sobre otra.

* **Velas japonesas:** Representación gráfica de la información esencial de la cotización
			     de un activo financiero.
* **Indicadores:** Son señales que pueden indicar un próximo movimiento de la
		         criptomoneda, permite afinar la estrategia

* **Temporalidad:** Tiempo de vida de una vela en el mercado.

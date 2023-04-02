--> 
Esto es para quedarme con el filtro que he hecho --->  https://laravel.com/docs/5.2/reque

OBJETIVOS:
1/////

METER TODO EN EL INDEX PERO HACER FUNCIONES QUE HACEN LOS FILTROS Y QUE SE  LLAMEN DESDE EL INDEX

propiedad derivada estado ---> cambiar la documentacion (si tiene respuesta) calcular esa propiedad

cambiar filtros --> https://www.google.com/search?q=check+if+request+laravel+input&rlz=1C1CHBF_esES918ES918&oq=check+if+request+laravel+input&aqs=chrome..69i57j0i22i30l3.9135j0j7&sourceid=chrome&ie=UTF-8


2/////

OBJETIVO: hacer un perfil de edit distinto para los medicos normales (esta hecho) y despues uno especial
para los de direccion y admin (editan para poner los datos de aceptar o no aceptar la incidencia)

ADEMAS arreglar que se pueda acceder desde los botones de la exclamacion y de la cruz y el tick que se pueda enviar info



PREGUNTAS:

-Pk hago el store y update con request illuminate y no como venia en app 
-Como puedo poner un boton para lo del registro y acceder y todo eso?
-Como puedo hacer para que una persona tenga varios users--> problema para las vistas
-pk hasmanythrought no me funcionaba para conectar acceso a user directamente en su modelo
-Que hace el codigo en edit acceso --> el de sanitario_id



-- PK NO FUNCIONA EL HASONE --> por ejemplo al hacer index accesos


-- cOMO PODRIA SELECCIONAR Y MANDAR DOS PROFESIONES EN EL DESPEGABLE

--COMO CREAR NUEVO METODO DE LA POLICIE para el filtrar de sanitarios (metodo del controller)

////////////////////////////////////////////////////

CAMBIOS DE NOMBRES en archivos: cosas que hay que tocar

databaseseeder
accesoseeder
migraciones
factorias
modelos
POLICIS
controlador
VISTAS
HTTP/REQUEST
RUTAS
/////////////////////////////////////////////

AUTENTIFICACION: cosas que ya he revisado

tabla users
modelo user
authenticate
auth sesion status
---> TOCAR: auth.php (routes)
            authenticatedsession
            registeredsession



/////////////////////////////////////////////////////////////////////////////////////////////7
RELACIONES N:N



CITA MEDICAMENTE --> EJEMPLO

Migraciones ---> TABLA INTERMEDIA:

Convencion de nombre--> pivot table --> articulo y provedor (ordenado por orden alfabetico, (minuscula))--> articulo_proveedor
CREAR LA TABLA INTERMEDIA: (no vale el --all) .vendor.. --create migration...


MODELOS: 


relaciones en el modelo--> belongs to many (por los dos lados)
with pivot() coge las variables de la tabla inteemdia y as mete en la tabla medicamentos (los asocia)
se accede como medicamento->pivot->precio



metodo atach--> 
cuando asocio un nuevo metodo de la policie a uno nuevo del controlador ---> se uso un middleware que es "can"

can:attach medicamento, tiene que ser un metodo en una policie public fuction attach medicamento()

 ->middleware('can:detach_medicamento,cita'); cita tiene que coincidir con el path parameter dela peticion http

CITA CONTROLLER:
attach_medicamento()
 validateWithBag ya que tengo mas de un formulario en la vista--> sirve para identidicar cual de los formularios es
problema con medicamentos



añadir un elemento nuevo a una tabla intermedia --> ATTACH

$cita->medicamentos()->attach($request->medicamento_id, [
            'inicio' => $request->inicio,
            'fin' => $request->fin,
            'comentarios' => $request->comentarios,
            'tomas_dia' => $request->tomas_dia
        ]);


DETACH --> borrar fila de la tabla intermedia

tercer metodo--> SYNC  (no hace falta hacerlo)


   sts






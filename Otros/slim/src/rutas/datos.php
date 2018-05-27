<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \slim\App;


///////////////////////   METODO PARA AUTETICAR UsuarioS ////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

$authentication =  function (){
    $app = \slim\App::getInstance();
    $user = $app->request->headers->get('HTTP_USER');
    $password = $app->request->headers->get('HTTP_PASSWORD');
    $password = sha1($pass);
    //validamos los datos de acceso
    $isvalid = R::findOne('user','user=? AND password=?', array($user,$password));
    try{
        if(!$isvalid){
            throw new Exception("Usuario o Password inválidos");
        }

    }catch(Exception $e){
        $app->status(401);
        echo json_encode(array('status' => 'error', 'message' => $e->getMessage() ));
        $app->stop();
    }
};


///////////////////////   METODOS PARA USUARIOS ////////////////////////////
//////////////////obtener todos los Usuarios datos 
$app->get('/datos/usuarios', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM user';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $usuarios = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($usuarios);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un usuario
$app->get('/datos/usuarios/{id}', function(Request $request, Response $response){

      $id =  $request->getAttribute('id'); 

      $consulta = "SELECT * FROM user WHERE id = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $usuario = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($usuario);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Agregar un Usuario
$app->post('/datos/usuarios/agregar', function(Request $request, Response $response){

      //$id = $request->getParam('id');
      $username = $request->getParam('username');
      $name = $request->getParam('name');
      $lastname = $request->getParam('lastname');
      $email = $request->getParam('email');
      $password = $request->getParam('password');
      $is_active = $request->getParam('is_active');
      $is_admin = $request->getParam('is_admin');
      $created_at = $request->getParam('created_at');
     

      $consulta = "INSERT INTO user (username, name, lastname, email, password,  is_active, is_admin, created_at) 
      VALUES  (:username, :name, :lastname, :email, :password,  :is_active, :is_admin, :created_at)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
//     $statement->bindParam(':id', $id);
     $statement->bindParam(':username', $username);
     $statement->bindParam(':name', $name);
     $statement->bindParam(':lastname', $lastname);
     $statement->bindParam(':email', $email);
     $statement->bindParam(':password', $password);
     $statement->bindParam(':is_active',$is_active);
     $statement->bindParam(':category_id', $category_id);
     $statement->bindParam(':created_at', $created_at);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Actualizar un Usuario
$app->put('/datos/usuarios/actualizar/{id}', function(Request $request, Response $response){

      $id =  $request->getAttribute('id'); 
      
      //$id = $request->getParam('id');
      $username = $request->getParam('username');
      $name = $request->getParam('name');
      $lastname = $request->getParam('lastname');
      $email = $request->getParam('email');
      $password = $request->getParam('password');
      $is_active = $request->getParam('is_active');
      $is_admin = $request->getParam('is_admin');
      $created_at = $request->getParam('created_at');


      $consulta = "UPDATE user SET 
                   username    = :username,
                   name        = :name,
                   lastname    = :lastname,
                   email       = :email,
                   password    = :password,
                   is_active   = :is_active,
                   is_admin    = :is_admin,
                   created_at  = :created_at
                   WHERE id = $id";

                   

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     //$statement->bindParam(':id', $id);
     $statement->bindParam(':username', $username);
     $statement->bindParam(':name', $name);
     $statement->bindParam(':lastname', $lastname);
     $statement->bindParam(':email', $email);
     $statement->bindParam(':password', $password);
     $statement->bindParam(':is_active',$is_active);
     $statement->bindParam(':category_id', $category_id);
     $statement->bindParam(':created_at', $created_at);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar un usuario
$app->delete('/datos/usarios/borrar/{id}', function(Request $request, Response $response){

      $id =$request->getAttribute('id');

      $consulta = "DELETE FROM user WHERE id = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Usuario Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});



///////////////////////   METODOS PARA DOCENTES ////////////////////////////
//////////////////obtener todos de los docentes datos 
$app->get('/datos/docentes', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM docentes';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $docentes = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($docentes);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////obtener un docente 
$app->get('/datos/docentes/{id}', function(Request $request, Response $response){

      $id =  $request->getAttribute('id'); 

      $consulta = "SELECT * FROM docentes WHERE id = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $docente = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($docente);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Agregar un  docente
$app->post('/datos/docentes/agregar', function(Request $request, Response $response){

    //  $id = $request->getParam('id');
      $no = $request->getParam('no');
      $nombre = $request->getParam('nombre');
      $apellido = $request->getParam('apellido');
      $genero = $request->getParam('genero');
      $fecha_de_nac = $request->getParam('fecha_de_nac');
      $email = $request->getParam('email');
      $direccion = $request->getParam('direccion');
      $telefono = $request->getParam('telefono');
      $is_active = $request->getParam('is_active');
      $category_id = $request->getParam('category_id');
      $created_at = $request->getParam('created_at');
     


      $consulta = "INSERT INTO docentes (no, nombre, apellido, genero, fecha_de_nac, email, direccion, telefono, is_active,
      category_id, created_at) VALUES  (:no, :nombre, :apellido, :genero, :fecha_de_nac, :email, :direccion, :telefono, 
      :is_active, :category_id, :created_at)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
    // $statement->bindParam(':id', $id);
     $statement->bindParam(':no', $no);
     $statement->bindParam(':nombre', $nombre);
     $statement->bindParam(':apellido', $apellido);
     $statement->bindParam(':genero', $genero);
     $statement->bindParam(':fecha_de_nac', $fecha_de_nac);
     $statement->bindParam(':email', $email);
     $statement->bindParam(':direccion', $direccion);
     $statement->bindParam(':telefono', $telefono);
     $statement->bindParam(':is_active',$is_active);
     $statement->bindParam(':category_id', $category_id);
     $statement->bindParam(':created_at', $created_at);
     $statement->execute();
         echo '{"notice": {"text": "Docente Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Actualizar un docente
$app->put('/datos/docentes/actualizar/{id}', function(Request $request, Response $response){

      $id =  $request->getAttribute('id'); 
      
      //$id = $request->getParam('id');
      $no = $request->getParam('no');
      $nombre = $request->getParam('nombre');
      $apellido = $request->getParam('apellido');
      $genero = $request->getParam('genero');
      $fecha_de_nac = $request->getParam('fecha_de_nac');
      $email = $request->getParam('email');
      $direccion = $request->getParam('direccion');
      $telefono = $request->getParam('telefono');
      $is_active = $request->getParam('is_active');
      $category_id = $request->getParam('category_id');
      $created_at = $request->getParam('created_at');


      $consulta = "UPDATE docentes SET 
                   no          = :no,
                   nombre      = :nombre,
                   apellido    = :apellido,
                   genero      = :genero,
                fecha_de_nac   = :fecha_de_nac,
                   email       = :email,
                   direccion   = :direccion,
                   telefono    = :telefono,
                   is_active   = :is_active,
                   category_id = :category_id,
                   created_at  = :created_at
                   WHERE id = $id";

                   

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     //$statement->bindParam(':id', $id);
     $statement->bindParam(':no', $no);
     $statement->bindParam(':nombre', $nombre);
     $statement->bindParam(':apellido', $apellido);
     $statement->bindParam(':genero', $genero);
     $statement->bindParam(':fecha_de_nac', $fecha_de_nac);
     $statement->bindParam(':email', $email);
     $statement->bindParam(':direccion', $direccion);
     $statement->bindParam(':telefono', $telefono);
     $statement->bindParam(':is_active',$is_active);
     $statement->bindParam(':category_id', $category_id);
     $statement->bindParam(':created_at', $created_at);
     $statement->execute();
         echo '{"notice": {"text": "Docente Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar un dato de docente
$app->delete('/datos/docentes/borrar/{id}', function(Request $request, Response $response){

      $id =$request->getAttribute('id');

      $consulta = "DELETE FROM docentes WHERE id = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Docente Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////////   METODOS PARA PUBLICACIONES ////////////////////////////
//////////////////obtener todoas las publicaciones
$app->get('/datos/publicaciones', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM publicaciones';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $publicaciones = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($publicaciones);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener una publicacion
$app->get('/datos/publicaciones/{id}', function(Request $request, Response $response){

      $id =  $request->getAttribute('id'); 

      $consulta = "SELECT * FROM publicaciones WHERE id = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $publicacion = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($publicacion);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Agregar una publicacion
$app->post('/datos/publicaciones/agregar', function(Request $request, Response $response){
 
     // $id = $request->getParam('id');
      $asunto = $request->getParam('asunto');
      $descripcion = $request->getParam('descripcion');
      $mensaje = $request->getParam('mensaje');
      $dia = $request->getParam('dia');
      $hora = $request->getParam('hora');
      $created_at = $request->getParam('created_at');
      //$sintomas = $request->getParam('sintomas');
      //$enfermedad = $request->getParam('enfermedad');
      //$medicamentos = $request->getParam('medicamentos');
      //$reservacioncol = $request->getParam('reservacioncol');
      //$precio = $request->getParam('precio');
      $is_web = $request->getParam('is_web');
      $publica = $request->getParam('publica');
      $payment_id = $request->getParam('payment_id');
      $user_id = $request->getParam('user_id');
      $pacient_id = $request->getParam('pacient_id');
      $status_id = $request->getParam('status_id');


      $consulta = "INSERT INTO publicaciones (asunto, descripcion, mensaje, dia, hora, created_at, 
      is_web, publica, payment_id, user_id, pacient_id, status_id) VALUES 
      (asunto, :descripcion, :mensaje, :dia, :hora, :created_at, :is_web, :publica, :payment_id, :user_id, :pacient_id,
       :status_id)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     //$statement->bindParam(':id', $id);
     $statement->bindParam(':asunto', $asunto);
     $statement->bindParam(':descripcion', $descripcion);
     $statement->bindParam(':mensaje', $mensaje);
     $statement->bindParam(':dia', $dia);
     $statement->bindParam(':hora', $hora);
     $statement->bindParam(':created_at', $created_at);
     //$statement->bindParam(':sintomas', $sintomas);
     //$statement->bindParam(':enfermedad', $enfermedad);
     //$statement->bindParam(':medicamentos', $medicamentos);
     //$statement->bindParam(':reservacioncol', $reservacioncol);
     //$statement->bindParam(':precio', $precio);
     $statement->bindParam(':is_web', $is_web);
     $statement->bindParam(':publica', $publica);
     $statement->bindParam(':payment_id', $payment_id);
     $statement->bindParam(':user_id', $user_id);
     $statement->bindParam(':pacient_id', $pacient_id);
     $statement->bindParam(':status_id', $status_id);
     $statement->execute();
         echo '{"notice": {"text": "Publicacion Agregada Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Actualizar un  empleado
$app->put('/datos/publicaciones/actualizar/{id}', function(Request $request, Response $response){

      $id =  $request->getAttribute('id'); 

      $asunto = $request->getParam('asunto');
      $descripcion = $request->getParam('descripcion');
      $mensaje = $request->getParam('mensaje');
      $dia = $request->getParam('dia');
      $hora = $request->getParam('hora');
      $created_at = $request->getParam('created_at');
      //$sintomas = $request->getParam('sintomas');
      //$enfermedad = $request->getParam('enfermedad');
      //$medicamentos = $request->getParam('medicamentos');
      //$reservacioncol = $request->getParam('reservacioncol');
      //$precio = $request->getParam('precio');
      $is_web = $request->getParam('is_web');
      $publica = $request->getParam('publica');
      $payment_id = $request->getParam('payment_id');
      $user_id = $request->getParam('user_id');
      $pacient_id = $request->getParam('pacient_id');
      $status_id = $request->getParam('status_id');
      
   

      $consulta = "UPDATE publicaciones SET 
  
                 asunto       = :asunto, 
                 descripcion  = :descripcion, 
                 mensaje      = :mensaje, 
                 dia          = :dia, 
                 hora         = :hora, 
                 is_web       = :is_web, 
                 publica      = :publica, 
                 payment_id   = :payment_id, 
                 user_id      = :user_id, 
                 pacient_id   = :pacient_id, 
                 status_id    = :status_id
                   WHERE id = $id";

                   //idRol       = :idRol

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     //$statement->bindParam(':id', $id);
     $statement->bindParam(':asunto', $asunto);
     $statement->bindParam(':descripcion', $descripcion);
     $statement->bindParam(':mensaje', $mensaje);
     $statement->bindParam(':dia', $dia);
     $statement->bindParam(':hora', $hora);
     $statement->bindParam(':created_at', $created_at);
    // $statement->bindParam(':sintomas', $sintomas);
     //$statement->bindParam(':enfermedad', $enfermedad);
     //$statement->bindParam(':medicamentos', $medicamentos);
     //$statement->bindParam(':reservacioncol', $reservacioncol);
     //$statement->bindParam(':precio', $precio);
     $statement->bindParam(':is_web', $is_web);
     $statement->bindParam(':publica', $publica);
     $statement->bindParam(':payment_id', $payment_id);
     $statement->bindParam(':user_id', $user_id);
     $statement->bindParam(':pacient_id', $pacient_id);
     $statement->bindParam(':status_id', $status_id);
     $statement->execute();
         echo '{"notice": {"text": "Publicacion Actualizada Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar una publicacion
$app->delete('/datos/publicaciones/borrar/{id}', function(Request $request, Response $response){

      $id =$request->getAttribute('id');

      $consulta = "DELETE FROM publicaciones WHERE id = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Publicacion Borrada Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});



///////////////////////   METODOS PARA EMPLEADOS ////////////////////////////
//////////////////obtener todos de los empleados datos 
$app->get('/datos/empleados', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM empleados';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $empleados = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($empleados);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////obtener un empleados 
$app->get('/datos/empleados/{idEmpleado}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idEmpleado'); 

      $consulta = "SELECT * FROM empleados WHERE idEmpleado = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $empleado = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($empleado);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Agregar un  empleado
$app->post('/datos/empleados/agregar', function(Request $request, Response $response){

      $nombre = $request->getParam('nombre');
      $apellido = $request->getParam('apellido');
      $direccion = $request->getParam('direccion');
      $telefono = $request->getParam('telefono');
      $correo = $request->getParam('correo');
      $idRol = $request->getParam('idRol');

      $consulta = "INSERT INTO empleados (nombre, apellido, direccion, telefono, correo, idRol) VALUES 
      (:nombre, :apellido, :direccion, :telefono, :correo, :idRol)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':nombre', $nombre);
     $statement->bindParam(':apellido', $apellido);
     $statement->bindParam(':direccion', $direccion);
     $statement->bindParam(':telefono', $telefono);
     $statement->bindParam(':correo', $correo);
     $statement->bindParam(':idRol',$idRol);
     $statement->execute();
         echo '{"notice": {"text": "Cliente Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Actualizar un  empleado
$app->put('/datos/empleados/actualizar/{idEmpleado}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idEmpleado'); 
      
     // $idEmpleado = $request->getParam('idEmpleado');
      $nombre = $request->getParam('nombre');
      $apellido = $request->getParam('apellido');
      $direccion = $request->getParam('direccion');
      $telefono = $request->getParam('telefono');
      $correo = $request->getParam('correo');
      $idRol = $request->getParam('idRol');

      $consulta = "UPDATE empleados SET 
                   nombre      = :nombre,
                   apellido    = :apellido,
                   direccion   = :direccion,
                   telefono    = :telefono,
                   correo      = :correo,
                   idRol       = :idRol
                   WHERE idEmpleado = $id";

                   //idRol       = :idRol

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
    // $statement->bindParam(':idEmpleado', $idEmpleado);
     $statement->bindParam(':nombre', $nombre);
     $statement->bindParam(':apellido', $apellido);
     $statement->bindParam(':direccion', $direccion);
     $statement->bindParam(':telefono', $telefono);
     $statement->bindParam(':correo', $correo);
     $statement->bindParam(':idRol', $idRol);
     $statement->execute();
         echo '{"notice": {"text": "Cliente Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar un dato de empleado
$app->delete('/datos/empleados/borrar/{idEmpleado}', function(Request $request, Response $response){

      $id =$request->getAttribute('idEmpleado');

      $consulta = "DELETE FROM empleados WHERE idEmpleado = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Cliente Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////////   METODOS PARA ALUMNOS /////////////////////////////////////////////////////
//////////////////obtener todos los datos de alumnos ///////////////////////////////////////////////
$app->get('/datos/alumnos', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM alumnos';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $alumnos = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($alumnos);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////obtener un dato de alumnos //////////////////////////////////////////////////
$app->get('/datos/alumnos/{id}', function(Request $request, Response $response){

      $id =  $request->getAttribute('id'); 

      $consulta = "SELECT * FROM alumnos WHERE id = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $alumno = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($alumno);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Agregar un alumno
$app->post('/datos/alumnos/agregar', function(Request $request, Response $response){
 
    //  $id = $request->getParam('id');
      $nombre = $request->getParam('nombre');
      $apellido = $request->getParam('apellido');
      $edad = $request->getParam('edad');
      $telefono = $request->getParam('telefono');
      $direccion = $request->getParam('direccion');
      //$nombre_esp = $request->getParam('nombre_esp');
      $carne = $request->getParam('carne');
      $grado = $request->getParam('grado');
      //$alergico = $request->getParam('alergico');
      //$monarquia = $request->getParam('monarquia');
      //$ciclos = $request->getParam('ciclos');
      //$gestas = $request->getParam('gestas');
      //$partos = $request->getParam('partos');
      //$cesareas = $request->getParam('cesareas');
      //$abortos = $request->getParam('abortos');
      //$fur = $request->getParam('fur');
      //$fpp = $request->getParam('fpp');
      //$control_prenatal = $request->getParam('control_prenatal');
      //$anti = $request->getParam('anti');
      $genero = $request->getParam('genero');
      //$imagen = $request->getParam('imagen');
      $es_favorito = $request->getParam('es_favorito');
      $is_active = $request->getParam('is_active');
      $carrera = $request->getParam('carrera');
      $created_at = $request->getParam('created_at');
      


      $consulta = "INSERT INTO alumnos (nombre, apellido, edad, telefono, direccion, carne, grado, 
         genero, es_favorito, is_active, carrera, created_at) 
       VALUES 
      (:nombre, :apellido, :edad, :telefono, :direccion, :carne, :grado,  
       :genero, :es_favorito, :is_active, :carrera, :created_at)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
    // $statement->bindParam(':id', $id);
     $statement->bindParam(':nombre', $nombre);
     $statement->bindParam(':apellido', $apellido);
     $statement->bindParam(':edad', $edad);
     $statement->bindParam(':telefono', $telefono);
     $statement->bindParam(':direccion', $direccion);
     //$statement->bindParam(':nombre_esp', $nombre_esp);
     $statement->bindParam(':carne', $carne);
     $statement->bindParam(':grado', $grado);
     //$statement->bindParam(':alergico', $alergico);
     //$statement->bindParam(':monarquia', $monarquia);
     //$statement->bindParam(':ciclos', $ciclos);
     //$statement->bindParam(':gestas', $gestas);
     //$statement->bindParam(':partos', $partos);
     //$statement->bindParam(':cesareas', $cesareas);
     //$statement->bindParam(':abortos', $abortos);
     //$statement->bindParam(':fur', $fur);
     //$statement->bindParam(':fpp', $fpp);
     //$statement->bindParam(':control_prenatal', $control_prenatal);
     //$statement->bindParam(':anti', $anti);
     $statement->bindParam(':genero', $genero);
     //$statement->bindParam(':imagen', $imagen);
     $statement->bindParam(':es_favorito', $es_favorito);
     $statement->bindParam(':is_active', $is_active);
     $statement->bindParam(':carrera', $carrera);
     $statement->bindParam(':created_at', $created_at);
     $statement->execute();
         echo '{"notice": {"text": "Alumno Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Actualizar un Alumno
$app->put('/datos/alumnos/actualizar/{id}', function(Request $request, Response $response){

      $id =  $request->getAttribute('id'); 

    //  $id = $request->getParam('id');
      $nombre = $request->getParam('nombre');
      $apellido = $request->getParam('apellido');
      $edad = $request->getParam('edad');
      $telefono = $request->getParam('telefono');
      $direccion = $request->getParam('direccion');
      //$nombre_esp = $request->getParam('nombre_esp');
      $carne = $request->getParam('carne');
      $grado = $request->getParam('grado');
      //$alergico = $request->getParam('alergico');
      //$monarquia = $request->getParam('monarquia');
      //$ciclos = $request->getParam('ciclos');
      //$gestas = $request->getParam('gestas');
      //$partos = $request->getParam('partos');
      //$cesareas = $request->getParam('cesareas');
      //$abortos = $request->getParam('abortos');
      //$fur = $request->getParam('fur');
      //$fpp = $request->getParam('fpp');
      //$control_prenatal = $request->getParam('control_prenatal');
      //$anti = $request->getParam('anti');
      $genero = $request->getParam('genero');
      //$imagen = $request->getParam('imagen');
      $es_favorito = $request->getParam('es_favorito');
      $is_active = $request->getParam('is_active');
      $carrera = $request->getParam('carrera');
      $created_at = $request->getParam('created_at');
      
      $consulta = "UPDATE alumnos SET
                    id         =:id, 
                    nombre     =:nombre, 
                    apellido   =:apellido, 
                    edad       =:edad, 
                    telefono   =:telefono, 
                    direccion  =:direccion, 
                    carne      =:carne, 
                    grado      =:grado,  
                    genero     =:genero, 
                    es_favorito =:es_favorito,
                    is_active   =:is_active, 
                    carrera     =:carrera , 
                    created_at  =:created_at
                   WHERE id = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     //$statement->bindParam(':id', $id);
     $statement->bindParam(':nombre', $nombre);
     $statement->bindParam(':apellido', $apellido);
     $statement->bindParam(':edad', $edad);
     $statement->bindParam(':telefono', $telefono);
     $statement->bindParam(':direccion', $direccion);
     //$statement->bindParam(':nombre_esp', $nombre_esp);
     $statement->bindParam(':carne', $carne);
     $statement->bindParam(':grado', $grado);
     //$statement->bindParam(':alergico', $alergico);
     //$statement->bindParam(':monarquia', $monarquia);
     //$statement->bindParam(':ciclos', $ciclos);
     //$statement->bindParam(':gestas', $gestas);
     //$statement->bindParam(':partos', $partos);
     //$statement->bindParam(':cesareas', $cesareas);
     //$statement->bindParam(':abortos', $abortos);
     //$statement->bindParam(':fur', $fur);
     //$statement->bindParam(':fpp', $fpp);
     //$statement->bindParam(':control_prenatal', $control_prenatal);
     //$statement->bindParam(':anti', $anti);
     $statement->bindParam(':genero', $genero);
     //$statement->bindParam(':imagen', $imagen);
     $statement->bindParam(':es_favorito', $es_favorito);
     $statement->bindParam(':is_active', $is_active);
     $statement->bindParam(':carrera', $carrera);
     $statement->bindParam(':created_at', $created_at);
     $statement->execute();
         echo '{"notice": {"text": "Alumno Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});



//////////////////eliminar un dato de alumnos
$app->delete('/datos/alumnos/borrar/{id}', function(Request $request, Response $response){

      $id =$request->getAttribute('id');

      $consulta = "DELETE FROM alumnos WHERE id = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Alumno Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});



///////////////////////   METODOS PARA ESTUDIANTES /////////////////////////////////////////////////////
//////////////////obtener todos los datos de estudiantes ///////////////////////////////////////////////
$app->get('/datos/estudiantes', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM estudiantes';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $estudiante = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($estudiante);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un dato de estudiantes //////////////////////////////////////////////////
$app->get('/datos/estudiantes/{idEstudiante}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idEstudiante'); 

      $consulta = "SELECT * FROM estudiantes WHERE idEstudiante = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $estudiante = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($estudiante);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Agregar un estudiante
$app->post('/datos/estudiantes/agregar', function(Request $request, Response $response){

      $nombre = $request->getParam('nombre');
      $apellido = $request->getParam('apellido');
      $direccion = $request->getParam('direccion');
      $telefono = $request->getParam('telefono');
      $grado = $request->getParam('grado');
      $clave = $request->getParam('clave');
      $idCarrera = $request->getParam('idCarrera');
      $idNota = $request->getParam('idNota');

      $consulta = "INSERT INTO estudiantes (nombre, apellido, direccion, telefono, clave, idCarrera, idNota) VALUES 
      (:nombre, :apellido, :direccion, :telefono, :clave, :idCarrera, :idNota)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':nombre', $nombre);
     $statement->bindParam(':apellido', $apellido);
     $statement->bindParam(':direccion', $direccion);
     $statement->bindParam(':telefono', $telefono);
     $statement->bindParam(':clave', $clave);
     $statement->bindParam(':idCarrera',$idCarrera);
     $statement->bindParam(':idNota',$idNota);
     $statement->execute();
         echo '{"notice": {"text": "Estudiante Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Actualizar un estudiante
$app->put('/datos/estudiantes/actualizar/{idEstudiante}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idEstudiante'); 

      $nombre = $request->getParam('nombre');
      $apellido = $request->getParam('apellido');
      $direccion = $request->getParam('direccion');
      $telefono = $request->getParam('telefono');
      $grado = $request->getParam('grado');
      $clave = $request->getParam('clave');
      $idCarrera = $request->getParam('idCarrera');
      $idNota = $request->getParam('idNota');
      
      $consulta = "UPDATE estudiantes SET 
                   nombre      = :nombre,
                   apellido    = :apellido,
                   direccion   = :direccion,
                   telefono    = :telefono,
                   grado       = :grado,
                   clave       = :clave,
                   idCarrera   = :idCarrera,
                   idNota      = :idNota
                   WHERE idEstudiante = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':nombre', $nombre);
     $statement->bindParam(':apellido', $apellido);
     $statement->bindParam(':direccion', $direccion);
     $statement->bindParam(':telefono', $telefono);
     $statement->bindParam(':grado', $grado);
     $statement->bindParam(':clave', $clave);
     $statement->bindParam(':idCarrera',$idCarrera);
     $statement->bindParam(':idNota',$idNota);
     $statement->execute();
         echo '{"notice": {"text": "Estudiante Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});

//////////////////eliminar un dato de estudiante
$app->delete('/datos/estudiantes/borrar/{idEstudiante}', function(Request $request, Response $response){

      $id =$request->getAttribute('idEstudiante');

      $consulta = "DELETE FROM estudiantes WHERE idEstudiante = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Estudiante Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////   METODOS PARA NOTAS /////////////////////////////////////////////////////////////////
//////////////////obtener todos los datos de notas 
$app->get('/datos/notas', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM notas';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $notas = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($notas);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un usuario notas
$app->get('/datos/notas/{idNota}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idNota'); 

      $consulta = "SELECT * FROM notas WHERE idNota = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $notas = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo Usuario
     echo json_encode($notas);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Agregar una nota
$app->post('/datos/notas/agregar', function(Request $request, Response $response){

      $unidad_I = $request->getParam('unidad_I');
      $unidad_II = $request->getParam('unidad_II');
      $unidad_III = $request->getParam('unidad_III');
      $final = $request->getParam('final');
      $idEst = $request->getParam('idEst');

      $consulta = "INSERT INTO notas (unidad_I, unidad_II, unidad_III, final, idEst) VALUES 
      (:unidad_I, :unidad_II, :unidad_III, :final, :idEst)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':unidad_I', $unidad_I);
     $statement->bindParam(':unidad_II', $unidad_II);
     $statement->bindParam(':unidad_III', $unidad_III);
     $statement->bindParam(':final', $final);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Actualizar una nota
$app->put('/datos/notas/actualizar/{idNota}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idNota'); 
      
      $unidad_I = $request->getParam('unidad_I');
      $unidad_II = $request->getParam('unidad_II');
      $unidad_III = $request->getParam('unidad_III');
      $final = $request->getParam('final');
      $idEst = $request->getParam('idEst');

      $consulta = "UPDATE notas SET 
                   unidad_I      = :unidad_I,
                   unidad_II     = :unidad_II,
                   unidad_III    = :unidad_III,
                   final         = :final,
                   idEst         = :idEst
                   WHERE idNota = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':unidad_I', $unidad_I);
     $statement->bindParam(':unidad_II', $unidad_II);
     $statement->bindParam(':unidad_III', $unidad_III);
     $statement->bindParam(':final', $final);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar una nota
$app->delete('/datos/notas/borrar/{idNota}', function(Request $request, Response $response){

      $id =$request->getAttribute('idNota');

      $consulta = "DELETE FROM notas WHERE idNota = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Usuario Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});





//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////   METODOS PARA CUARTO COMPU /////////////////////////////////////////////////////////////////
//////////////////obtener todos los datos de cuarto_compu 
$app->get('/datos/cuarto_compu', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM cuarto_compu';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_compu = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($cuarto_compu);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un usuario  cuarto_compu 
$app->get('/datos/cuarto_compu/{idCuarto_compu}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_compu'); 

      $consulta = "SELECT * FROM cuarto_compu WHERE idCuarto_compu = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_compu = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo Usuario
     echo json_encode($cuarto_compu);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Agregar un  cuarto_compu
$app->post('/datos/cuarto_compu/agregar', function(Request $request, Response $response){

      $compu_aplicada = $request->getParam('compu_aplicada');
      $sistemas_software = $request->getParam('sistemas_software');
      $lab_I = $request->getParam('lab_I');
      $expresion_art = $request->getParam('expresion_art');
      $idEst = $request->getParam('idEst');

      $consulta = "INSERT INTO cuarto_compu (compu_aplicada, sistemas_software, lab_I, expresion_art, idEst) VALUES 
      (:compu_aplicada, :sistemas_software, :lab_I, :expresion_art, :idEst)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':compu_aplicada', $compu_aplicada);
     $statement->bindParam(':sistemas_software', $sistemas_software);
     $statement->bindParam(':lab_I', $lab_I);
     $statement->bindParam(':expresion_art', $expresion_art);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Actualizar un  cuarto_compu
$app->put('/datos/cuarto_compu/actualizar/{idCuarto_compu}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_compu'); 
      
   //   $idCuarto_compu = $request->getParam('idCuarto_compu');
      $compu_aplicada = $request->getParam('compu_aplicada');
      $sistemas_software = $request->getParam('sistemas_software');
      $lab_I = $request->getParam('lab_I');
      $expresion_art = $request->getParam('expresion_art');
      $idEst = $request->getParam('idEst');

      $consulta = "UPDATE cuarto_compu SET 
                   compu_aplicada       = :compu_aplicada,
                   sistemas_software    = :sistemas_software,
                   lab_I                = :lab_I,
                   expresion_art        = :expresion_art,
                   idEst                = :idEst
                   WHERE idCuarto_compu = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
    // $statement->bindParam(':idCuarto_compu', $idCuarto_compu);
     $statement->bindParam(':compu_aplicada', $compu_aplicada);
     $statement->bindParam(':sistemas_software', $sistemas_software);
     $statement->bindParam(':lab_I', $lab_I);
     $statement->bindParam(':expresion_art', $expresion_art);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar un cuarto_compu 
$app->delete('/datos/cuarto_compu/borrar/{idCuarto_compu}', function(Request $request, Response $response){

      $id =$request->getAttribute('idCuarto_compu');

      $consulta = "DELETE FROM cuarto_compu WHERE idCuarto_compu = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Usuario Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////   METODOS PARA CUARTO COMUN /////////////////////////////////////////////////////////////////
//////////////////obtener todos los datos de cuarto_comun 
$app->get('/datos/cuarto_comun', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM cuarto_comun';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_comun = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($cuarto_comun);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un dato de cuarto_comun
$app->get('/datos/cuarto_comun/{idCuarto_comun}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_comun'); 

      $consulta = "SELECT * FROM cuarto_comun WHERE idCuarto_comun = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_comun = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($cuarto_comun);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Agregar un dato de  cuarto_comun
$app->post('/datos/cuarto_comun/agregar', function(Request $request, Response $response){

      $mate = $request->getParam('mate');
      $lenguaje_literatura = $request->getParam('lenguaje_literatura');
      $ingles = $request->getParam('ingles');
      $fisica_fun = $request->getParam('fisica_fun');
      $compu_aplicada = $request->getParam('compu_aplicada');
      $edu_fisica = $request->getParam('edu_fisica');
      $conta = $request->getParam('conta');
      $filosofia = $request->getParam('filosofia');
      $tics = $request->getParam('tics');
      $idEst = $request->getParam('idEst');

      $consulta = "INSERT INTO cuarto_comun (mate, lenguaje_literatura, ingles, fisica_fun, compu_aplicada, edu_fisica, conta,
      filosofia, tics, idEst) VALUES 
      (:mate, :lenguaje_literatura, :ingles, :fisica_fun, :compu_aplicada, :edu_fisica, :conta, :filosofia, :tics, :idEst)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':mate', $mate);
     $statement->bindParam(':lenguaje_literatura', $lenguaje_literatura);
     $statement->bindParam(':ingles', $ingles);
     $statement->bindParam(':fisica_fun', $fisica_fun);
     $statement->bindParam(':compu_aplicada', $compu_aplicada);
     $statement->bindParam(':edu_fisica', $edu_fisica);
     $statement->bindParam(':conta', $conta);
     $statement->bindParam(':filosofia', $filosofia);
     $statement->bindParam(':tics', $tics);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Actualizar un  dato de cuarto_comun
$app->put('/datos/cuarto_comun/actualizar/{idCuarto_comun}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_comun'); 

      $mate = $request->getParam('mate');
      $lenguaje_literatura = $request->getParam('lenguaje_literatura');
      $ingles = $request->getParam('ingles');
      $fisica_fun = $request->getParam('fisica_fun');
      $compu_aplicada = $request->getParam('compu_aplicada');
      $edu_fisica = $request->getParam('edu_fisica');
      $conta = $request->getParam('conta');
      $filosofia = $request->getParam('filosofia');
      $tics = $request->getParam('tics');
      $idEst = $request->getParam('idEst');

      $consulta = "UPDATE cuarto_comun SET 
                   mate                   = :mate,
                   lenguaje_literatura    = :lenguaje_literatura,
                   ingles                 = :ingles,
                   fisica_fun             = :fisica_fun, 
                   compu_aplicada         = :compu_aplicada,
                   edu_fisica             = :edu_fisica,
                   conta                  = :conta,
                   filosofia              = :filosofia,
                   tics                   = :tics,
                   idEst                  = :idEst
                   WHERE idCuarto_comun = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':mate', $mate);
     $statement->bindParam(':lenguaje_literatura', $lenguaje_literatura);
     $statement->bindParam(':ingles', $ingles);
     $statement->bindParam(':fisica_fun', $fisica_fun);
     $statement->bindParam(':compu_aplicada', $compu_aplicada);
     $statement->bindParam(':edu_fisica', $edu_fisica);
     $statement->bindParam(':conta', $conta);
     $statement->bindParam(':filosofia', $filosofia);
     $statement->bindParam(':tics', $tics);
     $statement->bindParam(':idEst', $idEst);

     $statement->execute();
         echo '{"notice": {"text": "Usuario Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});

//////////////////eliminar un dato de cuarto_comun 
$app->delete('/datos/cuarto_comun/borrar/{idCuarto_comun}', function(Request $request, Response $response){

      $id =$request->getAttribute('idCuarto_comun');

      $consulta = "DELETE FROM cuarto_comun WHERE idCuarto_comun = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Usuario Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////   METODOS PARA CUARTO EDUCACION /////////////////////////////////////////////////////////////////
//////////////////obtener todos los datos de cuarto_educacion 
$app->get('/datos/cuarto_educacion', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM cuarto_educacion';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_educacion = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($cuarto_educacion);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un dato de cuarto_comun
$app->get('/datos/cuarto_educacion/{idCuarto_edu}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_edu'); 

      $consulta = "SELECT * FROM cuarto_educacion WHERE idCuarto_edu = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_educacion = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($cuarto_educacion);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Agregar un dato de  cuarto_educacion
$app->post('/datos/cuarto_educacion/agregar', function(Request $request, Response $response){

      $produc_des = $request->getParam('produc_des');
      $elab_proyecto = $request->getParam('elab_proyecto');
      $psicologia = $request->getParam('psicologia');
      $mam = $request->getParam('mam');
      $funda_pedagogia = $request->getParam('funda_pedagogia');
      $estrategia_aprendizaje = $request->getParam('estrategia_aprendizaje');
      $idEst = $request->getParam('idEst');

      $consulta = "INSERT INTO cuarto_educacion (produc_des, elab_proyecto, psicologia, mam, funda_pedagogia, 
      estrategia_aprendizaje, idEst) VALUES 
      (:produc_des, :elab_proyecto, :psicologia, :mam, :funda_pedagogia, :estrategia_aprendizaje, :idEst)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':produc_des', $produc_des);
     $statement->bindParam(':elab_proyecto', $elab_proyecto);
     $statement->bindParam(':psicologia', $psicologia);
     $statement->bindParam(':mam', $mam);
     $statement->bindParam(':funda_pedagogia', $funda_pedagogia);
     $statement->bindParam(':estrategia_aprendizaje', $estrategia_aprendizaje);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Actualizar un  dato de cuarto_educacion
$app->put('/datos/cuarto_educacion/actualizar/{idCuarto_edu}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_edu'); 

      $produc_des = $request->getParam('produc_des');
      $elab_proyecto = $request->getParam('elab_proyecto');
      $psicologia = $request->getParam('psicologia');
      $mam = $request->getParam('mam');
      $funda_pedagogia = $request->getParam('funda_pedagogia');
      $estrategia_aprendizaje = $request->getParam('estrategia_aprendizaje');
      $idEst = $request->getParam('idEst');

      $consulta = "UPDATE cuarto_educacion SET 
                   produc_des               = :produc_des,
                   elab_proyecto            = :elab_proyecto,
                   psicologia               = :psicologia,
                   mam                      = :mam, 
                   funda_pedagogia          = :funda_pedagogia,
                   estrategia_aprendizaje   = :estrategia_aprendizaje,
                   idEst                    = :idEst
                   WHERE idCuarto_edu = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':produc_des', $produc_des);
     $statement->bindParam(':elab_proyecto', $elab_proyecto);
     $statement->bindParam(':psicologia', $psicologia);
     $statement->bindParam(':mam', $mam);
     $statement->bindParam(':funda_pedagogia', $funda_pedagogia);
     $statement->bindParam(':estrategia_aprendizaje', $estrategia_aprendizaje);
     $statement->bindParam(':idEst', $idEst);

     $statement->execute();
         echo '{"notice": {"text": "Usuario Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar un dato de cuarto_educacion
$app->delete('/datos/cuarto_educacion/borrar/{idCuarto_edu}', function(Request $request, Response $response){

      $id =$request->getAttribute('idCuarto_edu');

      $consulta = "DELETE FROM cuarto_educacion WHERE idCuarto_edu = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Usuario Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////   METODOS PARA CUARTO MECANICA ///////////////////////////////////////////////////////////////
//////////////////obtener todos los datos de cuarto_comun 
$app->get('/datos/cuarto_mecanica', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM cuarto_mecanica';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_mecanica = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($cuarto_mecanica);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un dato de cuarto_comun
$app->get('/datos/cuarto_mecanica/{idCuarto_mecanica}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_mecanica'); 

      $consulta = "SELECT * FROM cuarto_mecanica WHERE idCuarto_mecanica = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_mecanica = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($cuarto_mecanica);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Agregar un dato de  cuarto_mecanica
$app->post('/datos/cuarto_mecanica/agregar', function(Request $request, Response $response){

      $metal_I = $request->getParam('metal_I');
      $proceso_soldadura = $request->getParam('proceso_soldadura');
      $mant_auto = $request->getParam('mant_auto');
      $higiene_trab = $request->getParam('higiene_trab');
      $admin_mant = $request->getParam('admin_mant');
      $idEst = $request->getParam('idEst');

      $consulta = "INSERT INTO cuarto_mecanica (metal_I, proceso_soldadura, mant_auto, higiene_trab, admin_mant, idEst) VALUES 
      (:metal_I, :proceso_soldadura, :mant_auto, :higiene_trab, :admin_mant, :idEst)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':metal_I', $metal_I);
     $statement->bindParam(':proceso_soldadura', $proceso_soldadura);
     $statement->bindParam(':mant_auto', $mant_auto);
     $statement->bindParam(':higiene_trab', $higiene_trab);
     $statement->bindParam(':admin_mant', $admin_mant);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Actualizar un  dato de cuarto_mecanica
$app->put('/datos/cuarto_mecanica/actualizar/{idCuarto_mecanica}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_mecanica'); 

      $metal_I = $request->getParam('metal_I');
      $proceso_soldadura = $request->getParam('proceso_soldadura');
      $mant_auto = $request->getParam('mant_auto');
      $higiene_trab = $request->getParam('higiene_trab');
      $admin_mant = $request->getParam('admin_mant');
      $idEst = $request->getParam('idEst');

      $consulta = "UPDATE cuarto_mecanica SET 
                   metal_I             = :metal_I,
                   proceso_soldadura   = :proceso_soldadura,
                   mant_auto           = :mant_auto,
                   higiene_trab        = :higiene_trab, 
                   admin_mant          = :admin_mant,
                   idEst               = :idEst
                   WHERE idCuarto_mecanica = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);

     $statement->bindParam(':metal_I', $metal_I);
     $statement->bindParam(':proceso_soldadura', $proceso_soldadura);
     $statement->bindParam(':mant_auto', $mant_auto);
     $statement->bindParam(':higiene_trab', $higiene_trab);
     $statement->bindParam(':admin_mant', $admin_mant);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar un dato de cuarto_mecanica
$app->delete('/datos/cuarto_mecanica/borrar/{idCuarto_mecanica}', function(Request $request, Response $response){

      $id =$request->getAttribute('idCuarto_mecanica');

      $consulta = "DELETE FROM cuarto_mecanica WHERE idCuarto_mecanica = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Usuario Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////   METODOS PARA CUARTO PARVULARIO /////////////////////////////////////////////////////////////
//////////////////obtener todos los datos de cuarto_parvulario 
$app->get('/datos/cuarto_parvulario', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM cuarto_parvulario';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_parvulario = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($cuarto_parvulario);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un dato de cuarto_parvulario
$app->get('/datos/cuarto_parvulario/{idCuarto_parvu}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_parvu'); 

      $consulta = "SELECT * FROM cuarto_parvulario WHERE idCuarto_parvu = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $cuarto_parvulario = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($cuarto_parvulario);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Agregar un dato de  cuarto_parvulario
$app->post('/datos/cuarto_parvulario/agregar', function(Request $request, Response $response){

      $literatura_hispa = $request->getParam('literatura_hispa');
      $len_infantil = $request->getParam('len_infantil');
      $estudio_economico = $request->getParam('estudio_economico');
      $psicologia = $request->getParam('psicologia');
      $pedag_general = $request->getParam('pedag_general');
      $didactica_general = $request->getParam('didactica_general');
      $his_educacion = $request->getParam('his_educacion');
      $form_musical = $request->getParam('form_musical');
      $intro_danza = $request->getParam('intro_danza'); 
      $idEst = $request->getParam('idEst');

      $consulta = "INSERT INTO cuarto_parvulario (literatura_hispa, len_infantil, estudio_economico, psicologia, pedag_general, 
      didactica_general, his_educacion, form_musical, intro_danza, idEst) VALUES 
      (:literatura_hispa, :len_infantil, :estudio_economico, :psicologia, :pedag_general, :didactica_general, 
      :his_educacion, :form_musical, :intro_danza, :idEst)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':literatura_hispa', $literatura_hispa);
     $statement->bindParam(':len_infantil', $len_infantil);
     $statement->bindParam(':estudio_economico', $estudio_economico);
     $statement->bindParam(':psicologia', $psicologia);
     $statement->bindParam(':pedag_general', $pedag_general);
     $statement->bindParam(':didactica_general', $didactica_general);
     $statement->bindParam(':his_educacion', $his_educacion);
     $statement->bindParam(':form_musical', $form_musical);
     $statement->bindParam(':intro_danza', $intro_danza);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Actualizar un  dato de cuarto_parvulario
$app->put('/datos/cuarto_parvulario/actualizar/{idCuarto_parvu}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idCuarto_parvu'); 

      $literatura_hispa = $request->getParam('literatura_hispa');
      $len_infantil = $request->getParam('len_infantil');
      $estudio_economico = $request->getParam('estudio_economico');
      $psicologia = $request->getParam('psicologia');
      $pedag_general = $request->getParam('pedag_general');
      $didactica_general = $request->getParam('didactica_general');
      $his_educacion = $request->getParam('his_educacion');
      $form_musical = $request->getParam('form_musical');
      $intro_danza = $request->getParam('intro_danza'); 
      $idEst = $request->getParam('idEst');

      $consulta = "UPDATE cuarto_parvulario SET 
                   literatura_hispa      = :literatura_hispa,
                   len_infantil          = :len_infantil,
                   estudio_economico     = :estudio_economico,
                   psicologia            = :psicologia,
                   pedag_general         = :pedag_general, 
                   didactica_general     = :didactica_general,
                   his_educacion         = :his_educacion,
                   form_musical          = :form_musical,
                   intro_danza           = :intro_danza,
                   idEst               = :idEst
                   WHERE idCuarto_parvu = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':literatura_hispa', $literatura_hispa);
     $statement->bindParam(':len_infantil', $len_infantil);
     $statement->bindParam(':estudio_economico', $estudio_economico);
     $statement->bindParam(':psicologia', $psicologia);
     $statement->bindParam(':pedag_general', $pedag_general);
     $statement->bindParam(':didactica_general', $didactica_general);
     $statement->bindParam(':his_educacion', $his_educacion);
     $statement->bindParam(':form_musical', $form_musical);
     $statement->bindParam(':intro_danza', $intro_danza);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar un dato de cuarto_parvulario
$app->delete('/datos/cuarto_parvulario/borrar/{idCuarto_parvu}', function(Request $request, Response $response){

      $id =$request->getAttribute('idCuarto_parvu');

      $consulta = "DELETE FROM cuarto_parvulario WHERE idCuarto_parvu = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Usuario Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////   METODOS PARA SEXTO PARVULARIO /////////////////////////////////////////////////////////////
//////////////////obtener todos los datos de sexto_parvulario 
$app->get('/datos/sexto_parvulario', function(Request $request, Response $response){

      $consulta = 'SELECT * FROM sexto_parvulario';

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $sexto_parvulario = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON
     echo json_encode($sexto_parvulario);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////obtener un dato de sexto_parvulario
$app->get('/datos/sexto_parvulario/{idSexto_parvu}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idSexto_parvu'); 

      $consulta = "SELECT * FROM sexto_parvulario WHERE idSexto_parvu = '$id' ";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $ejecutar = $db->query($consulta);
     $sexto_parvulario = $ejecutar->fetchAll(PDO::FETCH_OBJ);
     $db = null; //para cerrar la consulta

     //exportar y mostrar en formato JSON un solo cliente
     echo json_encode($sexto_parvulario);

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});


///////////////////Agregar un dato de  sexto_parvulario
$app->post('/datos/sexto_parvulario/agregar', function(Request $request, Response $response){

      $lit_infantil = $request->getParam('lit_infantil');
      $intro_filosofia = $request->getParam('intro_filosofia');
      $pluricultural_medicina = $request->getParam('pluricultural_medicina');
      $seminario_edu = $request->getParam('seminario_edu');
      $juegos_edu = $request->getParam('juegos_edu');
      $for_musical = $request->getParam('for_musical');
      $teatro_infantil = $request->getParam('teatro_infantil');
      $prac_docente = $request->getParam('prac_docente');
      $idEst = $request->getParam('idEst');

      $consulta = "INSERT INTO sexto_parvulario (lit_infantil, intro_filosofia, pluricultural_medicina, seminario_edu, juegos_edu, 
      for_musical, teatro_infantil, prac_docente, idEst) VALUES 
      (:lit_infantil, :intro_filosofia, :pluricultural_medicina, :seminario_edu, :juegos_edu, :for_musical, 
       :teatro_infantil, :prac_docente, :idEst)";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':lit_infantil', $lit_infantil);
     $statement->bindParam(':intro_filosofia', $intro_filosofia);
     $statement->bindParam(':pluricultural_medicina', $pluricultural_medicina);
     $statement->bindParam(':seminario_edu', $seminario_edu);
     $statement->bindParam(':juegos_edu', $juegos_edu);
     $statement->bindParam(':for_musical', $for_musical);
     $statement->bindParam(':teatro_infantil', $teatro_infantil);
     $statement->bindParam(':prac_docente', $prac_docente);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Agregado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

///////////////////Actualizar un  dato de sexto_parvulario
$app->put('/datos/sexto_parvulario/actualizar/{idSexto_parvu}', function(Request $request, Response $response){

      $id =  $request->getAttribute('idSexto_parvu'); 

      $lit_infantil = $request->getParam('lit_infantil');
      $intro_filosofia = $request->getParam('intro_filosofia');
      $pluricultural_medicina = $request->getParam('pluricultural_medicina');
      $seminario_edu = $request->getParam('seminario_edu');
      $juegos_edu = $request->getParam('juegos_edu');
      $for_musical = $request->getParam('for_musical');
      $teatro_infantil = $request->getParam('teatro_infantil');
      $prac_docente = $request->getParam('prac_docente');
      $idEst = $request->getParam('idEst');

      $consulta = "UPDATE sexto_parvulario SET 
                   lit_infantil              = :lit_infantil,
                   intro_filosofia           = :intro_filosofia,
                   pluricultural_medicina    = :pluricultural_medicina,
                   seminario_edu             = :seminario_edu,
                   juegos_edu                = :juegos_edu, 
                   for_musical               = :for_musical,
                   teatro_infantil           = :teatro_infantil,
                   prac_docente              = :prac_docente,
                   idEst                     = :idEst
                   WHERE idSexto_parvu = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->bindParam(':lit_infantil', $lit_infantil);
     $statement->bindParam(':intro_filosofia', $intro_filosofia);
     $statement->bindParam(':pluricultural_medicina', $pluricultural_medicina);
     $statement->bindParam(':seminario_edu', $seminario_edu);
     $statement->bindParam(':juegos_edu', $juegos_edu);
     $statement->bindParam(':for_musical', $for_musical);
     $statement->bindParam(':teatro_infantil', $teatro_infantil);
     $statement->bindParam(':prac_docente', $prac_docente);
     $statement->bindParam(':idEst', $idEst);
     $statement->execute();
         echo '{"notice": {"text": "Usuario Actualizado Correctamente"}';

 }catch(PDOException $e){
     echo '{"error": {"text": '.$e->getMessage().'}';
 }
});


//////////////////eliminar un dato de sexto_parvulario
$app->delete('/datos/sexto_parvulario/borrar/{idSexto_parvu}', function(Request $request, Response $response){

      $id =$request->getAttribute('idSexto_parvu');

      $consulta = "DELETE FROM sexto_parvulario WHERE idSexto_parvu = $id";

 try{
     //instanciar base de datos
     $db = new db();

     //conexion
     $db = $db->conectar();
     $statement = $db->prepare($consulta);
     $statement->execute();
     $db = null; //para cerrar la consulta

    echo '{"notice": {"text": "Usuario Borrado Correctamente"}';

 }catch(PDOException $e){
     echo'{"error": {"text": '.$e->getMessage().'}';
 }
});

<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \slim\App;

//////////////////obtener todos los datos de cuarto_compu 
$app->get('/api/cuarto_compu', function(Request $request, Response $response){

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
$app->get('/api/cuarto_compu/{idCuarto_compu}', function(Request $request, Response $response){

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
$app->post('/api/cuarto_compu/agregar', function(Request $request, Response $response){

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
$app->put('/api/cuarto_compu/actualizar/{idCuarto_compu}', function(Request $request, Response $response){

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
$app->delete('/api/cuarto_compu/borrar/{idCuarto_compu}', function(Request $request, Response $response){

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
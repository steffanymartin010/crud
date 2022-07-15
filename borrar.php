<?php
include '../CRUD/funciones.php';

$config = include '../CRUD/config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $cod_producto = $_GET['cod_producto'];
  $consultaSQL = "DELETE FROM productos WHERE cod_producto=" . $cod_producto;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

 

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

<?php require "../CRUD/templates/header.php"; ?>

<div class="container mt-2">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
       El producto se ha eliminado exitosamente.
        <?= $resultado['mensaje'] ?>
      </div>
    </div>
  </div>
</div>
<br><br>
<form method="post">
          <div class="form-group">
            <a class="btn btn-primary" href="./index.php">Regresar al inicio</a>
          </div>
        </form>

<?php require "../CRUD/templates/footer.php"; ?>
<?php
include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}

$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  if (isset($_POST['nom_producto'])) {
    $consultaSQL = "SELECT * FROM productos WHERE nom_producto LIKE '%" . $_POST['nom_producto'] . "%'";
  } else {
    $consultaSQL = "SELECT * FROM productos";
  }

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $productos = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}

$titulo = isset($_POST['nom_producto']) ? 'Lista de productos (' . $_POST['nom_producto'] . ')' : 'Lista de productos';
?>

<?php include "../CRUD/templates/header.php"; ?>

<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<form action="../Mercaley/administrador/usuario/">
<input type="submit" class="regresar" value="Regresar al Inicio">
</form>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="crear.php"  class="btn btn-primary mt-4">Crear nuevos datos</a>
      <hr>
      <form method="post" class="form-inline">
        <div class="form-group mr-3">
          <input type="text" id="nom_ producto" name="nom_producto" placeholder="Buscar por nombre producto" class="form-control">
        </div>
        <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
        <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3"><?= $titulo ?></h2>
      <table class="table">
        <thead>
          <tr>
            <th>cod_producto</th>
            <th>nom_producto</th>
            <th>descripcion_producto</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($productos && $sentencia->rowCount() > 0) {
            foreach ($productos as $fila) {
              ?>
              <tr>
                <td><?php echo escapar($fila["cod_producto"]); ?></td>
                <td><?php echo escapar($fila["nom_producto"]); ?></td>
                <td><?php echo escapar($fila["descripcion_producto"]); ?></td>
                <td>
                  <a href="<?= 'borrar.php?cod_producto=' . escapar($fila["cod_producto"]) ?>">🗑️Borrar</a>
                  <a href="<?= 'editar.php?cod_producto=' . escapar($fila["cod_producto"]) ?>">✏️Editar</a>
                </td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title> CRUD </title>
  <style>
    body {
    margin: 0;
    background: #f0e4da;
  }

  .regresar{
    margin: 15px;
    height: 40px;
    background-color: #F0921B;
    border: solid #F0921B;
    color: #fff;
    border-radius: 5px;
    font-size: 17px;
  }
  </style>

</head>


<?php include "templates/footer.php"; ?>
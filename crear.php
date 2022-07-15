<?php

include '../CRUD/funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}

if (isset($_POST['submit'])) {
  $resultado = [
    'error' => false,
    'mensaje' => 'Los datos de: ' . escapar($_POST['nom_producto']) . ' han sido agregados con éxito'
  ];

  $config = include '../CRUD/config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $productos = [
      "cod_producto"  => $_POST['cod_producto'],
      "nom_producto"   => $_POST['nom_producto'],
      "descripcion_producto" => $_POST['descripcion_producto'],
    ];

    $consultaSQL = "INSERT INTO productos (cod_producto, nom_producto, descripcion_producto)";
    $consultaSQL .= "values (:" . implode(", :", array_keys($productos)) . ")";

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute($productos);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>

<?php include 'templates/header.php'; ?>

<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Crea nuevos datos</h2>
      <hr>
      <form method="post">
      <div class="form-group">
          <label for="cod_producto">cod_producto</label>
          <input type="number" name="cod_producto" id="cod_producto" class="form-control">
        </div>
        <div class="form-group">
          <label for="nom_producto">nom_producto</label>
          <input type="text" name="nom_producto" id="nom_producto" class="form-control">
        </div>
        <div class="form-group">
          <label for="descripcion_producto">descripcion_producto</label>
          <input type="text" name="descripcion_producto" id="descripcion_producto" class="form-control">
        </div>
        <div class="form-group">
          <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<head>

  <meta charset="utf-8">
  <title> CRUD </title>
  <style>
    body {
    margin: 0;
    background: #f0e4da;
  }
 </style>

</head>

<?php include 'templates/footer.php'; ?>
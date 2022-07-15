<?php
include '../CRUD/funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}

$config = include '../CRUD/config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

if (!isset($_GET['cod_producto'])) {
  $resultado['error'] = true;
  $resultado['mensaje'] = 'Los datos que usted ingreso no existe';
}

if (isset($_POST['submit'])) {
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $productos = [
      "cod_producto"          => $_GET['cod_producto'],
      "nom_producto"          => $_POST['nom_producto'],
      "descripcion_producto"  => $_POST['descripcion_producto']
    ];
    
    $consultaSQL = "UPDATE productos SET
        nom_producto = :nom_producto,
        descripcion_producto = :descripcion_producto,
        updated_at = NOW()
        WHERE cod_producto = :cod_producto";
    $consulta = $conexion->prepare($consultaSQL);
    $consulta->execute($productos);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $cod_producto = $_GET['cod_producto'];
  $consultaSQL = "SELECT * FROM productos WHERE cod_producto =" . $cod_producto;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $productos = $sentencia->fetch(PDO::FETCH_ASSOC);

  if (!$productos) {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'No se ha encontrado los datos';
  }

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

<?php require "../CRUD/templates/header.php"; ?>

<?php
if ($resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($_POST['submit']) && !$resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">
          Se ha actualizado correctamente los datos.
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($productos) && $productos) {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando los datos de: <?= escapar($productos['nom_producto']) . ' ' . escapar($productos['descripcion_producto'])  ?></h2>
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="nom_producto">nom_producto</label>
            <input type="text" name="nom_producto" id="nom_producto" value="<?= escapar($productos['nom_producto']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="descripcion_producto">descripcion_producto</label>
            <input type="text" name="descripcion_producto" id="descripcion_producto" value="<?= escapar($productos['descripcion_producto']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="./index.php">Regresar al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
}
?>

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

<?php require "../CRUD/templates/footer.php"; ?>
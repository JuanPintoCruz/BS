<?php
$server = "localhost";
$user = "root";
$password = "";
$bd = "crudmartes";
try {
    $conexion = new PDO("mysql:host=$server;dbname=$bd", $user, $password);
} catch (PDOException $e) {
    exit("Error de conexión: ");
    echo "Error Conexion";
}
?>

-------------CLIENTES.PHP------------------------------

<?php
include("../BD/bd.php");

// Eliminar datos
if (isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    $sentencia = $conexion->prepare("DELETE FROM tbl_clientes WHERE id = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Mensaje de confirmación
    $mensaje = "Registro eliminado";
    header("Location: clientes.php?mensaje=");
    exit;
}

// Obtener la lista de clientes
$sentencia = $conexion->query("SELECT * FROM tbl_clientes");
$lista_tbl_clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Lista de Clientes</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <br>
        <a href="crear.php" class="btn btn-primary">Crear clientes</a>
        <br>
        <table class="table">
            <h1 class="my-4">Lista de Clientes</h1>
            <thead>
                <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_tbl_clientes as $registro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($registro['id']); ?></td>
                        <td><?php echo htmlspecialchars($registro['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($registro['apellido']); ?></td>
                        <td>
                           <a class="btn btn-primary" href="editar.php?txtID=<?php echo htmlspecialchars($registro['id']); ?>" role="button">Editar</a>
                           <a class="btn btn-danger" href="clientes.php?txtID=<?php echo htmlspecialchars($registro['id']); ?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
<!-- $url_base = "http://localhost:8081/admin3/";

<?php echo $url_base;?>
href="<?php echo $url_base;?>index.php"  -->


    <!-- <section id="testimonios" class=" py-5">
    <div class="container">
      <h2 class="text-center mb-4">
        Testimonios
      </h2>
      <div class="row">
        <?php foreach ($lista_testimonios as $testimonio){ ?>
        <div class="col-md-6 d-flex">
          <div class="card mb-4 w-100">
            <div class="card-body">
              <p style="color:black;font-weight:bold;font-size:1.4rem;" class="card-text text-center">
                <?php echo $testimonio["nombre"]?>
              </p>
            </div>
            <div class="card-footer text-muted">
              <br>
              <p style="color:black;font-size:1.1rem;" class="card-text">
              <?php echo $testimonio["opinion"]?>
               </p>
              <br>
            </div>
          </div>
        </div>
     <?php } ?>
      </div>
    </div>
  </section>

  //Testimonios
$sentencia=$conexion->prepare("SELECT * FROM tbl_testimonios LIMIT 2");
$sentencia->execute();
$lista_testimonios= $sentencia->fetchAll(PDO::FETCH_ASSOC); -->

------------------------CREAR----------------
<?php
include("../BD/bd.php");

if ($_POST) {
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
    // Prepara la consulta SQL para insertar los datos del clientes
    $sentencia = $conexion->prepare("INSERT INTO `tbl_clientes` (`nombre`, `apellido`)
     VALUES (:nombre, :apellido)");
    // Verifica si la preparación fue exitosa antes de proceder
        // Bindear los parámetros
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":apellido", $apellido);
        // Ejecutar la consulta
        $sentencia->execute();
        header("Location: clientes.php");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Crear</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    </head>
    <body>
         <br><br><br>
        <div class="container">
        <div class="card">
            <div class="card-header">Crear los clientes</div>
            <div class="card-body">
              <form action="" method="post">
              <label for="nombre" class="form-label">Nombre:</label>
              <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required >
              <br>
              <label for="apellido" class="form-label">Apellido</label>
              <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Ingrese el Apellido" required >
              <br>
              <button type="submit" class="btn btn-primary">Crear</button>
              <a href="clientes.php" class="btn btn-danger">Cancelar</a>
            </form>

            </div>
        </div>
        </div>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>

------------------------Editar
<?php 
include("../BD/bd.php");

// Manejar la solicitud GET para obtener los datos del colaborador
$nombre = $apellido = '';

if (isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    // Consulta para obtener los datos del registro
    $sentencia = $conexion->prepare("SELECT * FROM tbl_clientes WHERE id=:id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el registro
    if ($registro) {
        $nombre = $registro["nombre"];
        $apellido = $registro["apellido"];
    }
}

// Consulta para obtener la lista de perfiles
$sentencia_tbl_clientes = $conexion->prepare("SELECT * FROM tbl_clientes");
$sentencia_tbl_clientes->execute();
$lista_tbl_clientes = $sentencia_tbl_clientes->fetchAll(PDO::FETCH_ASSOC);

// Verifica si se ha enviado el formulario por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos del formulario
    $txtID = isset($_POST["txtID"]) ? $_POST["txtID"] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
    
    // Prepara y ejecuta la consulta SQL para actualizar los datos del perfil
    $sentencia = $conexion->prepare("UPDATE tbl_clientes SET nombre=:nombre, apellido=:apellido WHERE id=:id");
    // Asigna los valores a los parámetros de la consulta
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellido", $apellido);
    $sentencia->bindParam(":id", $txtID);
    // Ejecutar la consulta de actualización
    $sentencia->execute();
    header("Location: clientes.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Editar Cliente</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    </head>

    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">Editar Cliente</div>
                <div class="card-body">
                    <form action="" method="post">
                        <label for="txtID">ID</label>
                        <input type="text" class="form-control" id="txtID" name="txtID" value="<?php echo htmlspecialchars($txtID ?? ''); ?>" readonly>
                        <br>
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" placeholder="Ingrese el nombre" required>
                        <br>
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input class="form-control" type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" placeholder="Ingrese el apellido" required>
                        <br>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="clientes.php" class="btn btn-danger">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
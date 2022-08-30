<?php
session_start();
session_destroy();
session_start();
if (!empty($_SESSION['active'])) {
    //header('location: sistema/');
} else {
    if (!empty($_POST)) {

        if (empty($_POST['usuario']) || empty($_POST['contra'])) {
            echo "<script> alert('Debe colocar usuario y contraseña');window.location='index.html'</script>";
        } else {
            require_once "connection.php";
            $usuario = mysqli_real_escape_string($conn, $_POST["usuario"]);
            $contra = mysqli_real_escape_string($conn, $_POST["contra"]);

            $sql = "SELECT * FROM user WHERE email = '$usuario'";

            $queryusuario = mysqli_query($conn, $sql);
            $nr = mysqli_num_rows($queryusuario);
            if ($nr == 1) {
                $data = mysqli_fetch_array($queryusuario);
                $contra_encript = $data['password'];
                if (password_verify($contra, $contra_encript)) {
                    $_SESSION['active'] = true;
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['name'] = $data['name'];

                    echo "<script> alert('Ingresó correctamente');window.location='LogIn.php'</script>";
                    //header('location: sistema/');
                } else {
                    echo "<script> alert('Contraseña inválido');window.location='LogIn.php'</script>";
                    session_destroy();
                }
            } else {
                echo "<script> alert('Usuario o contraseña inválido');window.location='LogIn.php'</script>";
                session_destroy();
            }
            mysqli_close($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="contenedor">
        <div class="contenido">
            <h1 class="titulo">Inicio de sesión</h1>
            <form action="" class="formulario" method="POST">
                <input type="email"  class="usuario" id="usuario" name="usuario"  placeholder="Nombre de usuario..." required>
                <input type="password" class="clave" id="contra" name="contra" placeholder="Contraseña">
                <input type="submit" value="Ingresar">
            </form>
            <a href="#" class="opciones">¿Olvidaste tu contraseña?</a>
            <a href="../html/registro.php" class="opciones">Registrate ahora</a>
        </div>
    </div>
</body>
</html>
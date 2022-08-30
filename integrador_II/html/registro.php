<?php

if (!empty($_POST)) {
    try {
        require_once "connection.php";

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $nombre.= ' '.$apellido;
        $usuario = $_POST["usuario"];
        $usuario2 = $_POST["usuario2"];
        $contra = $_POST["clave"];
        $contra2 = $_POST["clave2"];
        $pass_encript = password_hash($contra, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user(name, email, password) VALUES('$nombre', '$usuario', '$pass_encript')";

        $ejecutar = mysqli_query($conn, $sql);

        if (!$ejecutar) {
            echo "<script> alert('No se pudo registrar el usuario');window.location='registro.php'</script>";
        } else {
            echo  "<script> alert('Usuario registrado exitosamente');window.location='registro.php'</script>";
        }
    } catch (Exception $e) {
        echo  "<script> alert('No se pudo registrar el usuario. Revise si ya existe un registro con el mismo usuario o identificación');window.location='registro.php'</script>";
    }finally{
        mysqli_close($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
    <div class="contenedor">
        <div class="contenido">
            <h1 class="titulo">Registro de usuario</h1>
            <form action="" class="formulario" method="POST" id="form_registro">
                <input type="text"  name="nombre" id="nombre"  placeholder="Nombre..." required>
                <input type="text" name="apellido" id="apellido" placeholder="Apellido..." required>
                <input type="email"  name="usuario" id="usuario"  placeholder="Correo electronico..." required>
                <input type="email"  name="usuario2" id="usuario2"  placeholder="Confirmar correo..." required>
                <input type="password" name="clave" id="clave" placeholder="Contraseña..." required>
                <input type="password" name="clave2" id="clave2" placeholder="Confirmar contraseña...">
                <label for="tyc" class="check"><input type="checkbox" name="tyc" id="tyc" required>  Acepto terminos y condiciones</label>
                
                <input id="btn_registro" type="submit" value="Ingresar">
            </form>
    </div>
    <script src="../js/logic.js"></script>
</body>
</html>
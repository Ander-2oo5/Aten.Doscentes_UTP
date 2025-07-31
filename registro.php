<?php

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$contrasenia = $_POST['contrasenia'];
$confirmpassword = $_POST['confirmpassword'];



if (!empty($nombres) && !empty($apellidos) && !empty($telefono) && !empty($email) && !empty($contrasenia) && !empty($confirmpassword)) {
    $data = "$nombres,$apellidos,$telefono,$email,$contrasenia,$confirmpassword\n";
    $file = fopen('usuarios.txt', 'a'); 
    fwrite($file, $data); 
    fclose($file);
    
    echo'<script type="text/javascript">
    alert("Usuario exitoso");
    window.location.href="Login.php";
    </script>';
    
    //header('Location: Principal.php');
    exit();
} else {
    echo'<script type="text/javascript">
    alert("Complete todos los datos");
    window.location.href="registro.html";
    </script>';
    exit();
}   
/*
if (!empty($nombres) && !empty($apellidos) && !empty($telefono) && !empty($email) && !empty($contraseña) && !empty($confirmPassword)) {

    $archivo = fopen("./usuarios.txt", "a") or die ("ERROR al abrir el archivo");
    fwrite($archivo, "Datos: ");
    fwrite($archivo, "\n");
    fwrite($archivo, $_POST['nombres']);
    fwrite($archivo, "\n");
    fwrite($archivo, $_POST['apellidos']);
    fwrite($archivo, "\n");
    fwrite($archivo, $_POST['telefono']);
    fwrite($archivo, "\n");
    fwrite($archivo, $_POST['email']);
    fwrite($archivo, "\n");
    fwrite($archivo, $_POST['contraseña']);
    fwrite($archivo, "--------------------- \n\n");
    fclose($archivo);

    echo "Registrado con exito";
    exit();
} else {
    echo '<script type="text/javascript">
    alert("Complete todos los datos");
    window.location.href="Registro.html";
    </script>';
    exit();
}*/


?>
<?php
    $modalidad = $_POST['modalidad'];
    $tipo_taller = $_POST['tipo_taller'];
    $fecha_inscripcion = $_POST['fecha_inscripcion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $campusutp = $_POST['campusutp'];
    
    if (!empty($modalidad) && !empty($tipo_taller) && !empty($fecha_inscripcion) && !empty($nombre) && !empty($apellido) && !empty($celular) && !empty($dni) && !empty($email) && !empty($campusutp)) {
        $data = "Nombre: $nombre, Apellido: $apellido, Modalidad: $modalidad, Tipo de taller: $tipo_taller, Fecha de inscripción: $fecha_inscripcion, Celular: $celular, DNI: $dni, Email: $email, Campus: $campusutp\n";
        $file = fopen('reservas.txt', 'a'); 
        fwrite($file, $data); 
        fclose($file);
        
        echo'<script type="text/javascript">
        alert("Reserva exitosa");
        window.location.href="Principal.php";
        </script>';
        
        //header('Location: Principal.php');
        exit();
    } else {
        echo'<script type="text/javascript">
        alert("Complete todos los datos");
        window.location.href="formulario.php";
        </script>';
        exit();
    }   
?>

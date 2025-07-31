<?php
$username = $_POST['username'];
$dni = $_POST['dni'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

if (!empty($username) && !empty($dni) && !empty($newPassword) && !empty($confirmPassword)) {
    echo'<script type="text/javascript">    
    window.location.href="Recuperacion.html";
    </script>';
    exit();
} else {
    echo'<script type="text/javascript">
    alert("Complete todos los datos");
    window.location.href="Contraseña.html";
    </script>';
    exit();
}
?>
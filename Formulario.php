<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: Login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Imagenes/utpcad.ico">
    <link rel="stylesheet" href="css/styles_For.css">
    <script src="Archivos/formulario.js"></script>
    <title>Reserva un Taller</title>
</head>
<body>
    <button class="logout-btn" onclick="window.location.href='CerrarSesion.php'">Cerrar Sesión</button>
    <div class="todo">
        <div class="form-container">
            <form action="actionFormulario.php" method="POST" id="formulario" name="formulario" onsubmit="return validarFormulario(event);">
                <h1>Reservar taller:</h1>
                <p>
                    <label for="modalidad">Modalidad:</label>
                    <select id="modalidad" name="modalidad">
                        <option value="">Selecciona tu modalidad</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Virtual">Virtual</option>
                    </select>
                    <span class="error" id="error-modalidad"></span>
                </p>
                <p>
                    <label for="tipo_taller">Tipo de taller:</label>
                    <select id="tipo_taller" name="tipo_taller">
                        <option value="">Seleccione un tipo de taller</option>
                        <option value="TIC">Manejo de las TIC</option>
                        <option value="Estudio">Técnicas de estudio</option>
                        <option value="Personal">Crecimiento personal</option>
                        <option value="Pedagogicas">Actividades Pedagógicas</option>
                        <option value="Diversidad">Manejo de la diversidad en el aula</option>
                        <option value="Programacion">Elaboración de programación docente</option>
                        <option value="Juegos">Juegos didácticos</option>
                    </select>
                    <span class="error" id="error-tipo_taller"></span>
                </p>
                <p>
                    <label for="fecha_inscripcion">Fecha de inscripción: </label>
                    <input name="fecha_inscripcion" type="date" id="fecha_inscripcion" size="26">
                    <span class="error" id="error-fecha"></span>
                </p>
                <p>
                    <label for="nombre">Datos del estudiante:</label>
                    <input type="text" name="nombre" id="nombre" size="10" placeholder="Nombre">
                    <span class="error" id="error-nombre"></span>
                    <input type="text" name="apellido" id="apellido" size="10" placeholder="Apellido">
                    <span class="error" id="error-apellido"></span>
                    <input type="text" name="celular" id="celular" size="10" placeholder="Celular" minlength="9" maxlength="9">
                    <span class="error" id="error-celular"></span>
                    <input type="text" name="dni" id="dni" size="10" placeholder="DNI" minlength="8" maxlength="8">
                    <span class="error" id="error-dni"></span>
                    <input name="email" type="email" id="email" size="26" placeholder="Correo electrónico">
                    <span class="error" id="error-email"></span>
                </p>
                <p>
                    <label for="campusutp">Campus:</label>
                    <select id="campusutp" name="campusutp" required>
                        <option value="LCentro">Lima Centro</option>
                        <option value="LNorte">Lima Norte</option>
                        <option value="LSur">Lima Sur</option>
                        <option value="Chimbote">Chimbote</option>
                        <option value="Arequipa">Arequipa</option>
                        <option value="Chiclayo">Chiclayo</option>
                    </select>
                    <span class="error" id="error-campus"></span>
                </p>
                <input type="submit" name="button" id="button" value="Reservar Taller">
                <div id="mensaje-exito"></div>
            </form>
        </div>
        <div class="image-container">
            <img src="https://static.vecteezy.com/system/resources/previews/045/793/108/non_2x/cartoon-male-teacher-carrying-a-book-and-a-blackboard-behind-him-vector.jpg" width="500px" alt="Estudiantes">
        </div>
        <div id="recuadro-exito">
        <div class="icono">
            <img src="Imagenes/icons8-aprobación.gif" alt="Éxito">
        </div>
        <div class="mensaje">
            Taller registrado con exito
        </div>
        <button class="boton-aceptar" id="boton-aceptar">Aceptar</button>
    </div>
</body>
</html>

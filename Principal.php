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
    <meta charset="utf-8">
    <title>CAD UTP</title>
    <link rel="icon" href="Imagenes/utpcad.ico">
    <link rel="stylesheet" href="css/styles_Prin.css">
    <link href="Archivos/archivo.js">

</head>
<body>
<button class="logout-btn" onclick="window.location.href='CerrarSesion.php'">Cerrar Sesión</button>

<section class="contenedor_1">
<div class="intro">
    <div class="encabezado">
        <div class="enzabezado_titulo">
            <img class="logo_utp" src="Imagenes/logo_utp.png" alt="Logo UTP" width="100" height="100">
            <h1>Centro de Atención al Docente</h1>
        </div>
        <div class="encabezado_nav">
            <nav>
                <ul>
                    <li><a href="#tramites">Trámites a realizar</a></li>
                    <li><a href="#sistemas">Sistemas de evaluación docente</a></li>
                    <li><a href="#reglamentos">Reglamentos y Políticas</a></li>
                    <li><a href="#manuales">Manuales-Instructivos-Guías</a></li>
                </ul>
            </nav>
        </div>
    </div>
        <div class="intro_text">
            <p>El Centro de Atención al Docente es tu recurso esencial para resolver inconvenientes, responder consultas, gestionar trámites y acceder a una amplia biblioteca virtual de manuales, guías y reglamentos para facilitar tu trayectoria educativa.</p>
        </div>
    </div>
</section>
<section class="contenedor_2"> 
    <section class="main_section"> 
        <div class="column">
            <img src="imagenes/img3.png" alt="taller" width="120">
            <b><p>Tenemos la siguiente lista de talleres o capacitaciones disponibles:</p></b>
            <ul>
                <li>Manejo de las TIC</li>
                <li>Técnicas de estudio</li>
                <li>Crecimiento personal</li>
                <li>Actividades Pedagógicas</li>
            </ul>
        </div>
        <div class="column">
            <img src="imagenes/img1.png" alt="taller" width="120">
            <h2>Portal Docentes</h2>
            <p>Información de tu boletas, marcaciones, clases, registro de notas y asistencias de tus alumnos y más.</p>
        </div>
        <div class="column">
            <img src="imagenes/img2.png" alt="taller" width="120">
            <h2>Centro de atención al Docente - CAD</h2>
            <p>Sistema Virtual para realizar consultas y hacer seguimiento a los trámites realizados</p>
        </div>
    </section>
    <section class="main_section_3">
    <h2>Información para Profesores:<p class="Info_Prof"> Recursos para la enseñanza y capacitación continua de docentes, planificación de clases efectivas, evaluación del desempeño estudiantil e innovación en metodologías educativas.</p></h2>
        <div class="column3">
            <h3>Tutoriales para Docentes UTP:</h3>
            <iframe width="300" height="150" src="https://www.youtube.com/embed/videoseries?si=PaWX01-3q6O57FpT&amp;list=PLr85ri9hPeSbDVz0SbTOGw1K8VLM0bVOl" title="Pedagogia Presencial" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="column3">
            <h3>Desarrollo Docente UTP:</h3>
            <iframe width="300" height="150" src="https://www.youtube.com/embed/muQReuyw0ko?si=OaABnOiGd1OjsdA5" title="Pedagogia Virtual" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </section>
</section>
<section class="contenedor_3">
    <div class="ultima_section">
    <h1 class="not">Ultimas Noticias:</h1>
        <div class="column4">
            <img src="imagenes/Not2.jpg" alt="Noticia profesores 1" width="350" height="200">
            <h3><a href="https://www.utp.edu.pe/noticias/investigacion/docente-de-la-utp-obtuvo-el-primer-puesto-en-el-concurso-nacional-de-invenciones-2022" target="_blank">Docente de la UTP obtuvo el primer puesto en el Concurso Nacional de Invenciones 2022 de Indecopi</a></h3>
        </div>
        <div class="column4">
            <img src="imagenes/Not3.jpg" alt="Noticia profesores 2" width="350" height="200">
            <h3><a href="https://www.utp.edu.pe/noticias/investigacion/egresados-y-docentes-utp-desarrollan-sistema-de-reconocimiento-de-placas-vehiculares" target="_blank">Docentes de la UTP desarrollan sistema de reconocimiento de placas vehiculares</a></h3>
        </div>
        <div class="column4">
            <img src="imagenes/Not1.jpg" alt="Noticia profesores 3" width="350" height="200">
            <h3><a href="https://www.utp.edu.pe/noticias/investigacion/docente-de-utp-arequipa-presento-investigacion-en-conferencia-internacional-cities" target="_blank">Docente de la UTP Arequipa presentó investigación en conferencia internacional</a></h3>
        </div>
        
    </div>
</section>
    <section class="Contraportada">
            <form action="Formulario.php">
                <input type="submit" name="button" id="button" value="Reservar Taller">
                <footer class="footer">
                    <div class="container">
                        <div class="footer-section">
                            <h2>Nuestros campus</h2>
                            <div class="campus-links">
                                <a href="#">Arequipa</a> 
                                <a href="#">Chiclayo</a>
                                <a href="#">Chimbote</a>
                                <a href="#">Huancayo</a>
                                <a href="#">Ica</a>
                                <a href="#">Lima Centro</a>
                                <a href="#">Lima Este - Ate</a>
                                <a href="#">Lima Este - SJL</a>
                                <a href="#">Lima Norte</a>
                                <a href="#">Lima Sur</a>
                                <a href="#">Piura</a>
                                <a href="#">Trujillo</a>
                            </div>
                            <div class="buttons">
                                <button>Resultados de Admisión 2024 - Ciclo Marzo</button>
                                <button>Trabaja en UTP</button>
                                <button>Ubica nuestras sedes</button>
                            </div>
                        </div>
                        <div class="footer-section">
                            <div class="contact">
                                <p><strong>Postulantes</strong></p>
                                <p>Lima: <a href="tel:(01) 315 9610">(01) 315 9610</a> | Provincia: <a href="tel:0801 19 610">0801 19 610</a></p>
                                <p>WhatsApp: <a href="https://bit.ly/ConversaUTP_WA">https://bit.ly/ConversaUTP_WA</a></p>
                                <p>Correo: <a href="mailto:admision@utp.edu.pe">admision@utp.edu.pe</a></p>
                            </div>
                            <div class="contact">
                                <p><strong>Alumnos (SAE):</strong></p>
                                <p>Lima: <a href="tel:(01) 315 9600">(01) 315 9600</a> | Provincia: <a href="tel:0801 19 600">0801 19 600</a></p>
                                <p>WhatsApp: <a href="https://bit.ly/contacto_SAE">https://bit.ly/contacto_SAE</a></p>
                            </div>
                        </div>
                            <div class="footer-section">
                            <h2>Horario de atención:</h2>
                        <div class="hours">
                            <p><strong>Postulantes</strong></p>
                            <p>Lun - Sáb: 8:30 a.m. a 8:00 p.m.</p>
                            <p><strong>Alumnos (SAE):</strong></p>
                            <p>Lun - Vie: 7:00 a.m. a 10:00 p.m.</p>
                            <p>Sáb - Dom: 7:00 a.m. a 8:00 p.m.</p>
                        </div>
                        <p>UTP S.A.C. RUC: 20462509236</p>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="social-links">
                        <a href="#"><img src="Imagenes/ico_fb.gif" alt="Facebook"></a>
                        <a href="#"><img src="Imagenes/ico_youtu.gif" alt="YouTube"></a>
                        <a href="#"><img src="Imagenes/ico_link.gif" alt="LinkedIn"></a>
                        <a href="#"><img src="Imagenes/ico_ig.gif" alt="Instagram"></a>
                        <a href="#"><img src="Imagenes/ico_tik.gif" alt="TikTok"></a>
                    </div>
                    <div class="legal-links">
                        <a href="#">Políticas de privacidad</a>
                        <a href="#">Portal de transparencia</a>
                        <a href="#">Términos y condiciones</a>
                        <a href="#">Mapa del sitio</a>
                        <a href="#"><img src="https://www.utp.edu.pe/sites/default/files/inline-images/libro-reclamaciones.png" alt="Libro de Reclamaciones"></a>
                    </div>
                </div>
            </footer>
        </section>
</body>
</html>


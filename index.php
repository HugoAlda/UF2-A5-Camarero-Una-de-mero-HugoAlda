<head>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3bc5094caf.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="style.css">

    <link rel="shortcut icon" href="img/icono.ico"/>

    <title>YAKO</title>

</head>
<?php
    // Cargar el archivo XML
    $menu = simplexml_load_file('menu.xml');
?>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?php
                    // Agregar un enlace para mostrar todos los platos
                    $claseActiva = isset($_GET['tipo']) && $_GET['tipo'] == '' ? 'active' : ''; // Verificar si está seleccionado el filtro "Yakho Hugo"
                    echo '<a class="navbar-brand" . $claseActiva . " href="?tipo=">Yako</a>';
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php
                    
                        $tipos = array(); // Array para almacenar los tipos de platos únicos
                        
                        // Recorrer cada plato de la sección ENTRANTES
                        foreach ($menu->ENTRANTES->PLATO as $plato){
                            // Obtener el atributo tipo de cada plato
                            $tipo = (string)$plato['tipo'];
                        
                            // Verificar si el tipo ya está en el array
                            if (!in_array($tipo, $tipos)){
                                // Si no está, agregarlo al array y mostrar el enlace en la barra de navegación
                                $tipos[] = $tipo;
                                echo '<li class="nav-item">';
                                // Verificar si este tipo está seleccionado
                                $claseActiva = isset($_GET['tipo']) && $_GET['tipo'] == $tipo ? 'active' : '';
                                echo '<a class="nav-link ' . $claseActiva . '" href="?tipo=' . $tipo . '">' . ucfirst($tipo) . '</a>';
                                echo '</li>';
                            }
                        }

                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="tabla">
        <img class="imagen" src="img/logo.png">
        <table class="icon">
            <tbody>
                <tr>
                    <td><i class="fa-solid fa-wheat-awn-circle-exclamation"></i></td>
                    <td>Contiene gluten</td>
                </tr>
                <tr>
                    <td><i class="fas fa-drumstick-bite"></i></td>
                    <td>Contiene carne</td>
                </tr>
                <tr>
                    <td><i class="fa-solid fa-fish"></i></td>
                    <td>Contiene pescado</td>
                </tr>
                <tr>
                    <td><i class="fa-solid fa-wine-glass"></i></td>
                    <td>Contiene alcohol</td>
                </tr>
                <tr>
                    <td><i class="fas fa-carrot"></i></td>
                    <td>Contiene verduras</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <hr>

    <div class="platos-container">
        <?php
            if(isset($_GET['tipo']) && $_GET['tipo'] !== ''){
                // Mostrar solo los platos del tipo seleccionado
                foreach ($menu->ENTRANTES->PLATO as $plato){
                    // Obtener el tipo de plato de cada plato
                    $tipoPlato = (string)$plato['tipo'];

                    // Verificar si el tipo del plato coincide con el tipo seleccionado
                    if ($_GET['tipo'] == $tipoPlato){
                        echo "<div class='plato'>";
                        echo "<h2>$plato->NOMBRE</h2>";
                        echo "<p>Descripcion: $plato->DESCRIPCION</p>";
                        echo "<p>$plato->CALORIAS</p>";
                        echo "<p class='precio'>$plato->PRECIO</p>";
                        echo "<img class='img-platos' src='$plato->IMAGEN' alt='$plato->NOMBRE'>";
                        echo "</div>";
                    } 
                }
            }else{
                // Mostrar todos los platos sin filtrar
                foreach ($menu->ENTRANTES->PLATO as $plato){
                    echo "<div class='plato'>";
                    echo "<h2>$plato->NOMBRE</h2>";
                    echo "<p>Descripcion: $plato->DESCRIPCION</p>";
                    echo "<p>$plato->CALORIAS</p>";
                    echo "<p class='precio'>$plato->PRECIO</p>";
                    echo "<img class='img-platos' src='$plato->IMAGEN' alt='$plato->NOMBRE'>";
                    echo "</div>";
                }
            }        
        ?>
    </div>

</body>
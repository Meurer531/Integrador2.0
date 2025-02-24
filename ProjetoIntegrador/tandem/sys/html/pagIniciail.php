<?php
session_start();

include_once("../classes/conect.php");

$obj = new conect();
$resultado = $obj->ConectarBanco();

if (!$resultado) {
    die("Erro ao conectar ao banco de dados.");
}

$sql = "SELECT * FROM produtos WHERE tipo='P';";
$consulta = $resultado->prepare($sql);

if (!$consulta) {
    die("Erro ao preparar a consulta.");
}

$indice = 0;

if ($_SESSION['Login'] == FALSE) {
    session_destroy();
    header("location: login.php");
    exit(); // Garante que o script pare aqui.
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/pagInicial.css">
    <link rel="stylesheet" type="text/css" href="../css/barLateral.css">
    <link rel="stylesheet" type="text/css" href="../css/produtos.css">
    <link rel="stylesheet" type="text/css" href="../css/carrousel.css">
    <style>
        /* Estilos para os textos abaixo do carrossel */
        .textos-abaixo {
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .textos-abaixo h1 {
            color: #00171F;
            margin-bottom: 10px;
        }

        .textos-abaixo p {
            color: #333;
            font-size: 1.1em;
        }
    </style>
</head>

<body>
    <form action="pagIniciail.php" method="post">
        <div class="barLat">
            <!-- The sidebar -->
            <div class="sidebar">
                <a class="active" href="#home">Home</a>
                <a href="#news">News</a>
                <a href="#contact">Contact</a>
                <a href="#about">About</a>
                <a href="sair.php">Logout</a>
            </div>

            <!-- Page content -->
            <div class="conteudo">

                <!-- Carrossel -->
                <div id="slider">
                    <input type="radio" name="slider" id="slide1" checked>
                    <input type="radio" name="slider" id="slide2">
                    <input type="radio" name="slider" id="slide3">
                    <input type="radio" name="slider" id="slide4">
                    <div id="slides">
                        <div id="overflow">
                            <div class="inner">
                                <!-- Slide 1 -->
                                <div class="slide slide_1">
                                    <div class="slide-content">
                                        <h2></h2>
                                        <p></p>
                                    </div>
                                </div>
                                <!-- Slide 2 -->
                                <div class="slide slide_2">
                                    <div class="slide-content">
                                        <h2></h2>
                                        <p></p>
                                    </div>
                                </div>
                                <!-- Slide 3 -->
                                <div class="slide slide_3">
                                    <div class="slide-content">
                                        <h2></h2>
                                        <p></p>
                                    </div>
                                </div>
                                <!-- Slide 4 -->
                                <div class="slide slide_4">
                                    <div class="slide-content">
                                        <h2></h2>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Controles do Carrossel -->
                        <div id="controls">
                            <label for="slide1"></label>
                            <label for="slide2"></label>
                            <label for="slide3"></label>
                            <label for="slide4"></label>
                        </div>
                        <!-- Bullets (Indicadores) -->
                        <div id="bullets">
                            <label for="slide1"></label>
                            <label for="slide2"></label>
                            <label for="slide3"></label>
                            <label for="slide4"></label>
                        </div>
                    </div>
                </div>

                <!-- Barra de Pesquisa -->
                <input type="text" id="barPesquisa">

                <!-- Produtos -->
                <div class="produtos">
                    <h1>Items</h1>
                    <div class="bar items">
                        <?php
                        $indice = 0;

                        if ($consulta->execute()) {
                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                $linhas[$indice] = $linha;
                                echo '  <div class="card" style="padding: 2%;">
                                <img src="' . $linhas[$indice]["url_imgprod"] . '" width=120em" height="90em"
                                    style="border-radius: 5px;" alt="Laranjas">
                                <h3 id="nome">' . $linhas[$indice]["nome"] . '</h3>
                                <p id="preco">R$ ' . $linhas[$indice]["preco"] . '</p>
                                <span id="descricaoCard">' . $linhas[$indice]["descricao"] . '</span>
                            </div>';
                                $indice++;
                            }
                        }
                        ?>
                    </div>

                    <h1>Comidas</h1>
                    <div class="bar">
                        <?php
                        $indice = 0;

                        $sql = "SELECT * FROM PRODUTOS WHERE tipo ='C';";
                        $consulta = $resultado->prepare($sql);
                        if ($consulta->execute()) {
                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                $linhas[$indice] = $linha;
                                echo '  <div class="card" style="padding: 2%;">
        <img src="' . $linhas[$indice]["url_imgprod"] . '" width=120em" height="90em" style="border-radius: 5px;">
        <h3 id="nome">' . $linhas[$indice]["nome"] . '</h3>
        <p id="preco">R$ ' . $linhas[$indice]["preco"] . '</p>
        <span id="descricaoCard">' . $linhas[$indice]["descricao"] . '</span>
    </div>';
                                $indice++;
                            }
                        }
                        ?>
                    </div>

                    <h1>Serviços</h1>
                    <div class="bar">
                        <?php
                        $sql = "SELECT * FROM PRODUTOS WHERE tipo ='S';";
                        $consulta = $resultado->prepare($sql);
                        $indice = 0;

                        if ($consulta->execute()) {
                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                $linhas[$indice] = $linha;
                                echo '  <div class="card" style="padding: 2%;">
                                <img src="' . $linhas[$indice]["url_imgprod"] . '" width=120em" height="90em"
                                    style="border-radius: 5px;">
                                <h3 id="nome">' . $linhas[$indice]["nome"] . '</h3>
                                <p id="preco">R$ ' . $linhas[$indice]["preco"] . '</p>
                                <span id="descricaoCard">' . $linhas[$indice]["descricao"] . '</span>
                            </div>';
                                $indice++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
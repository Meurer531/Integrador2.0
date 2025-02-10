<?php
session_start();

include_once("../classes/conect.php");

$obj = new conect();
$resultado = $obj->ConectarBanco();

$sql = "SELECT * FROM produtos WHERE tipo='P';";

$consulta = $resultado->prepare($sql);
$indice = 0;



if ($_SESSION['Login'] == FALSE) {
    session_destroy();
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/pagInicial.css">
    <link rel="stylesheet" type="text/css" href="../css/barLateral.css">
    <link rel="stylesheet" type="text/css" href="../css/produtos.css">
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
                <input type="text" id="barPesquisa">

                <div class="produtos">
                    <h1>items</h1>
                    <div class="bar items">
                        <?
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
                    <h1>comidas</h1>
                    <div class="bar">

                        <?
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

                    <h1>seviços</h1>
                    <div class="bar">

                        <?
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

<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendedor</title>
    <link rel="stylesheet" href="../css/vendedor.css">
    <link rel="stylesheet" href="../css/cartao.css">
    <link rel="icon" type="image" href="tandem.png">
</head>

<body>
    <header>
        <div class="navbar2">
            <div class="logos">Tandem &copy;</div>
        </div>
    </header>


    <div class="navbar">
        <nav>
            <ul>
                <h3 class="hh">O que vamos vender hoje?</h3>
            </ul>
        </nav>
    </div>

    <form enctype="multipart/form-data" method="post" action="pagVendedor.php">
        <div class="image-container">

            <a value="P" name="tipo" class="box" href="#content1">
                <img class="img1" src="prod.png" alt="">
                <h3>Produtos</h3>
                <p>Produtos em geral, como jóias, pulseiras, acessórios, sapatos, artigos decorativos, etc.</p>
            </a>


            <a value="A" name="tipo" class="box" href="#content2">
                <img src="alimentos2.png" alt="">
                <h3>Alimentos</h3>
                <p>Pães de forma, sucos naturais, feiras, verduras, salgados e doces.</p>
            </a>


            <a value="S" name="tipo" class="box" href="#content3">
                <img src="servicos2.png" alt="">
                <h3>Serviços</h3>
                <p>Trabalhos de Jardinagem, limpeza, trabalhos temporários, entre outros.</p>
            </a>
            </li>
            </ul>

            <div class="depoimentos">
                <h2>O que nossos clientes dizem?</h2>
                <div class="depoimento">
                    <p>"A Tandem me ajudou a organizar melhor minhas vendas e alcançar mais clientes!"</p>
                    <span>- Maria Oliveira</span>
                </div>
                <div class="depoimento">
                    <p>"Nunca foi tão fácil divulgar meus produtos e serviços!"</p>
                    <span>- Carlos Mendes</span>
                </div>
            </div>


        </div>
    </form>



    <div class="textContainer">
        <div id="content1">
            <span style="display: none;"><input type="checkbox" value="P" name="tipo" checked></span>
            <input type="file" name="fotoP">
            <input type="text" name="nome" placeholder="nome">
            R$ <input type="number" name="preco" placeholder="preço">
            <input type="text" name="descricao" placeholder="descrição">
            <input type="submit" name="cadastroP">
        </div>
        <div id="content2">
            <span style="display: none;"><input type="checkbox" value="C" name="tipo" checked></span>
            <input type="file" name="fotoP">
            <input type="text" name="nome" placeholder="nome">
            R$ <input type="number" name="preco" placeholder="preço">
            <input type="text" name="descricao" placeholder="descrição">
            <input type="submit" name="cadastroP">
        </div>
        <div id="content3">
            <span style="display: none;"><input type="checkbox" value="S" name="tipo" checked></span>
            <input type="file" name="fotoP">
            <input type="text" name="nome" placeholder="nome">
            R$ <input type="number" name="preco" placeholder="preço">
            <input type="text" name="descricao" placeholder="descrição">
            <input type="submit" name="cadastroP">
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Tandem - Conectando Negócios nas Ruas.</p>
    </footer>

</body>

</html>

<?
extract($_POST);

if (isset($_POST["cadastroP"])) {
    include("../classes/conect.php");
    $obj = new conect();
    $resultado = $obj->ConectarBanco();

    $destino = '../imagens/' . $_FILES['fotoP']['name'];
    $arquivo_temp = $_FILES['fotoP']['tmp_name'];
    move_uploaded_file($arquivo_temp, $destino);

    $tipo = $_POST["tipo"];
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];

    $sql = "INSERT INTO PRODUTOS (url_imgProd,nome,preco,descricao,tipo) VALUES ('" . $destino . "','" . $nome . "','" . $preco . "','" . $descricao . "','" . $tipo . "');";

    $consulta = $resultado->prepare($sql);
    if ($consulta->execute()) {
        echo '
            <script>
                alert("Item Cadastrado");
            </script>
        ';
    }
}
?>
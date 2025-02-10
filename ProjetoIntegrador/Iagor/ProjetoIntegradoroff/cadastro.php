<?

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/cadastro.css">

</head>

<body>
    <form action="cadastro.php" method="post">

    <div class="central">
        <img src="tandem.png" alt="">
            <div class="form-group">
                <div>
                    <label for="login"><b>Nome: </b></label>
                    <input name="login" required maxlength="25" type="text">
                </div>
                <div>
                    <label for="senha"><b>Senha: </b></label>
                    <input  name="senha" required maxlength="12" type="password">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <label for="email"><b>Email: </b></label>
                    <input name="email" required type="email">
                </div>
                <div>
                    <label for="telefone"><b>Telefone: </b></label>
                    <input name="telefone" type="tel">
                </div>
            </div>
            <div class="radio-group">
                <label for="tipo"><b>Cadastrar como: </b></label>
                <input type="radio" id="cliente" name="tipo" value="C" required>
                <label for="cliente"><b>Cliente</b></label>
                <input type="radio" id="vendedor" name="tipo" value="V">
                <label for="vendedor"><b>Vendedor</b></label>
            </div>
            <input type="submit" class="b" value="Cadastrar" name="cadastrar">
            <a href="index.php"><input type="button" class="b" value="Voltar"></a>
    </div>
        </form>

</body>

</html>

<?

    extract($_POST);
    if(isset($_POST["cadastrar"])){
        include_once("tandem/sys/classes/conect.php");

        $obj = new conect();
        $resultado = $obj->ConectarBanco();

        $loginCripto = md5($_POST["login"]);
        $senhaCripto = md5($_POST["senha"]);
        $emailUsuario = $_POST["email"];
        $telUsuario = $_POST["telefone"];
        $cliVend = $_POST["tipo"];

        $sql = "INSERT INTO USUARIO (loginUsuario,senha,email,telefone,tipo) VALUES ('".$loginCripto."','".$senhaCripto."','".$emailUsuario."','".$telUsuario."','".$cliVend."')";//pede pro profesor como que faz um dado tipo ENUM pro "tipo" 


        $consulta = $resultado->prepare($sql);
        if($consulta->execute()){
            echo '
                <script>
                    alert("cadastro");
                </script>
            ';
        }
        else{
            print_r($linhas);
        }
    }
?>
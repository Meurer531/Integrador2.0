<?php

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
    <form method="post" action="cadastro.php">
        <div class="central">
            <h1><img src="tandem.png" alt=""></h1>
            <table>
                <tr>
                    <td><label for="login">Nome:</label></td>
                    <td><input id="login" name="login"  maxlength="25" type="text"></td>
                </tr>
                <tr>
                    <td><label for="senha">Senha:</label></td>
                    <td><input id="senha" name="senha"  maxlength="12" type="password"></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input id="email" name="email"  type="email"></td>
                </tr>
                <tr>
                    <td><label for="telefone">Telefone:</label></td>
                    <td><input id="telefone" name="telefone" type="number"></td>
                </tr>
                <tr>
                    <td><label for="tipo">Cadastrar como:</label></td>
                    <td>
                        <div class="radio-group">
                            <input type="radio" id="cliente" name="tipo" value="C" >
                            <label for="cliente">Cliente</label>

                            <input type="radio" id="vendedor" name="tipo" value="V">
                            <label for="vendedor">Vendedor</label>
                        </div>
                    </td>
                </tr>

            </table>
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
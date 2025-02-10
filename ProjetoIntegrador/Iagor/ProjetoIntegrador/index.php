<?
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image" href="imagens/vendedor.png">
</head>

<body>
    <form method="post" action="index.php">
        <div class="central">
            <img src="imagens/tandem.png" alt="" class="logo">

            <div class="">
                <label for="login"><b>Usuário: </b></label>
                <input id="login" name="login" maxlength="25" type="text">
            </div>

            <label for="senha"><b>Senha: </b></label>
            <input id="senha" name="senha" maxlength="12" type="password">

            <a href="#">Esqueceu sua senha?</a>

            <input class="b" name="Entrar" type="submit" placeholder="Entrar">
            <a href="cadastro.php">
                <input type="button" class="b" value="Cadastrar">
            </a>


        </div>
    </form>
</body>

</html>

<?php
extract($_POST);
if (isset($_POST["Entrar"])) {
    include("tandem/sys/classes/conect.php");
    $obj = new conect();
    $resultado = $obj->ConectarBanco();

    $loginCripto = md5($_POST["login"]);
    $senhaCripto = md5($_POST["senha"]);

    $sql = "SELECT id_usuario,loginUsuario,senha,tipo FROM USUARIO WHERE loginUsuario ='" . $loginCripto . "' AND senha ='" . $senhaCripto . "';";

    $consulta = $resultado->prepare($sql);
    $indice = 0;

    if ($consulta->execute()) {
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $linhas[$indice] = $linha;
            $indice++;
        }

        if ($indice == 1) {
            $_SESSION["Login"] = TRUE;
            $_SESSION["id"] = $linhas[0]["id_usuario"];
            $_SESSION["loginUsuario"] = $linhas[0]["no"];
            $_SESSION["tipo"] = $linhas[0]["tipo"];/*descobrir como separar vendedor de cliente*/
            if ($_SESSION["tipo"] == 'C')
                header("location: tandem/sys/html/pagIniciail.php");
            else
                header("location: tandem/sys/html/pagPesq.php");
        } else {
            echo '
                    <script>
                        alert("Alguém tentou entrar");
                    </script>
                ';
        }
    }
}
unset($_POST["Entrar"])

?>
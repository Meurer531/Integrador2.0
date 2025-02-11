<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="imagens/vendedor.png">
</head>

<body>
    <form method="post" action="index.php">
        <div class="central">
            <div class="divlogo">
                <img src="imagens/tandem.png" alt="Logo" class="logo">
            </div>

            <div class="content">
                <label for="login"><b>Usuário:</b></label>
                <input id="login" name="login" maxlength="25" type="text">

                <label for="senha"><b>Senha:</b></label>
                <input id="senha" name="senha" maxlength="12" type="password">

                <a href="esqueceu.html">Esqueceu sua senha?</a>

                <input id="entrar" class="b" name="Entrar" type="submit" value="Entrar">
                <a href="cadastro.php" class="b">Cadastrar</a>
                <a href="Paginicial.html" class="b">Voltar</a>
            </div>
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

    $sql = "SELECT id_usuario, loginUsuario, senha, tipo FROM USUARIO 
            WHERE loginUsuario ='" . $loginCripto . "' 
            AND senha ='" . $senhaCripto . "';";

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
            $_SESSION["loginUsuario"] = $linhas[0]["loginUsuario"];
            $_SESSION["tipo"] = $linhas[0]["tipo"];

            if ($_SESSION["tipo"] == 'C')
                header("location: tandem/sys/html/pagIniciail.php");
            else
                header("location: tandem/sys/html/pagPesq.php");
        } else {
            echo '<script>alert("Usuário ou senha incorretos!");</script>';
        }
    }
}
unset($_POST["Entrar"]);
?>

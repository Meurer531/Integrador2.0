<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image" href="vendedor.png">
</head>

<body>
    <form method="post" action="index.php">
        <div class="central">
            <img src="imagens/tandem.png" alt="Logo Tandem" class="logo">
            <div class="content">

                <label for="login">Usuário:</label>
                <input id="login" name="login" required maxlength="25" type="text">

                <label for="senha">Senha:</label>
                <input id="senha" name="senha" required maxlength="12" type="password">
                <a href="#">Esqueceu sua senha?</a>

                <input type="submit" class="b" name="Entrar" placeholder="Entrar">
                <a href="cadastro.php"><button class="b" name="Cadastrar">Cadastrar</button></a>
            </div>
        </div>
    </form>
</body>

</html>

<?php
    extract($_POST);
    if(isset($_POST["Entrar"])){
        include("tandem/sys/classes/conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();
        
        $loginCripto = md5($_POST["login"]);
        $senhaCripto = md5($_POST["senha"]);

        $sql = "SELECT id_usuario,loginUsuario,senha FROM USUARIO WHERE loginUsuario ='".$loginCripto."' AND senha ='".$senhaCripto."';";

        $consulta = $resultado->prepare($sql);
        $indice = 0;

        if($consulta->execute()){
            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                $linhas[$indice] = $linha;
                $indice++;
            }

            if($indice == 1){
                $_SESSION["Login"] = TRUE;
                $_SESSION["id"] = $linhas[0]["id_usuario"];
                $_SESSION["loginUsuario"] = $linhas[0]["no"];
                $_SESSION["tipo"] = $linhas[0]["C"];/*descobrir como separar vendedor de cliente*/
                header("location: tandem/sys/html/pagIniciail.php");             
            }
            else{
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
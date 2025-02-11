<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/cadastro.css" />

    <title>Document</title>
    
</head>
<body>
    <form method="post" action="cadas.php">
        <div class="content">
            <h1>Cadastro</h1>
            <input type="text" name="usuer" placeholder="Usuário" required>
            <br>
            <br>
            <input type="email" name="email" placeholder="Email" required>
            <br>
            <br>
            <input type="text" name="logim" placeholder="Login" required>
            <br>
            <br>
            <input type="password" name="senha" placeholder="Senha" required>
            <br>
            <br>
           
            <input type="submit" value="Cadastro" name="Entrar" class="butao">
            <a href="index.php"><input type="button" value="Logar" name="Logar" class="butao"></a>


        </div>
    </form>
</body>
</html>
<?php
   


    extract($_POST);
    if(isset($_POST["Entrar"])){
        include_once("agenda/sys/classes/conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();


        $nomeUsuario = $_POST["usuer"];
        $senhacripto = md5($_POST["senha"]);
        $usercripto = md5($_POST["logim"]);



        $sql = "INSERT INTO usuario (logim,nomeusuario,senha,email,ativo) VALUES ('".$usercripto."', '".$nomeUsuario."', '".$senhacripto."','".$_POST["email"]."',TRUE);";


        $query = $resultado->prepare($sql);
        $indice = 0;

        if($query->execute()){
            echo'
                <script>
                    alert("Cadastro concluído");
                </script>
            ';
        }
        else{
            print_r($linhas);
        }
    }
?>

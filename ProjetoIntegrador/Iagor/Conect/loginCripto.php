<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    
    <style> 
        body{
            position: relative;
            background-color: #F0F8FF;
        }
        .content{
            background-color: lightgray;
            width: 350px;
            height: 300px;
            position: relative;
            left:40%;
            top:200px;
            text-align:center;
            border-radius:10px;
        }
        input{
            width: 200px;
            height: 25px;
        }
        .butao{
            width: 100px;
            height: 30px;
        }
    </style>
</head>
<body>
    <form method="post" action="login.php">
        <div class="content">
            <br>
            <h1>Login</h1>
            <input type="text" name="usuer" placeholder="Usuário" >
            <br>
            <br>
            <input type="password" name="senha" placeholder="Senha">
            <br>
            <br>
            <input type="submit" value="Entrar" name="Entrar" class="butao">
            
        </div>
    </form>
</body>
</html>
<?php
    extract($_POST);
    //isset é para verificar se te algo dentro
    #rapaz, novo metodo de comentar
    if(isset($_POST["Entrar"])){
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();

        $usercripto = md5($_POST["usuer"]);
        $senhacripto = md5($_POST["senha"]);

        $sql = "SELECT nome, senha FROM usuario WHERE nome='".$_POST["usuer"]."' AND senha = '".$_POST["senha"]."';";
                #SELECT nome, senha(campos da tabela)
                #FROM usuario(nome da tabela)
                #WHERE nome='".$_POST["usuer"]."'(selecionar o nome escrito no input nome)
                # AND senha = '".$_POST["senha"]."';(selecionar a senha escrito no input senha)
                #lembrando que é um select, só vai mostrar algo no BD se tiver algo

        $query = $resultado->prepare($sql);
        $indice = 0;
        if($query->execute()){
            while($linha = $query->fetch(PDO::FETCH_ASSOC)){
                $linhas[$indice] = $linha;
                $indice++;
            }
        }
        if($indice == 1){
            print_r($linhas);
        }
        else{
            echo '
            <script>
            alert("Usuário e senha não existe");
            </script>';
        }
    }
?>
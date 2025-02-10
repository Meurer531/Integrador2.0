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
            background-color: #e3e3e3;
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
            height: 20px;
            /*background-color:;*/
            border-radius:10px;
        }
    </style>
</head>
<body>
    <form method="post" action="cadastroCripto.php">
        <div class="content">
            <br>
            <h1>Cadastro</h1>
            <input type="text" name="usuer" placeholder="Usuário" >
            <br>
            <br>
            <input type="password" name="senha" placeholder="Senha">
            <br>
            <br>
            <input type="submit" value="Cadastro" name="Entrar" class="butao">
            
        </div>
    </form>
</body>
</html>
<?php
    extract($_POST);
    if(isset($_POST["Entrar"])){
        include_once("conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();


        $usercripto = md5($_POST["usuer"]);
        $senhacripto = md5($_POST["senha"]);
        #criptografia


        $sql = "INSERT INTO usuario (nome,senha) VALUES ('".$usercripto."','".$senhacripto."');";
                #INSERT INTO usuario(tabela)
                #FROM usuario(nome da tabela)
                #VALUES ('".$usercripto."','".$senhacripto."');(os valores inseridos nos inputs
                #e criptografados no md5)

        $query = $resultado->prepare($sql);
        $indice = 0;
        if($query->execute()){ 
        }
        else{
            print_r($linhas);
        }
    }
?>
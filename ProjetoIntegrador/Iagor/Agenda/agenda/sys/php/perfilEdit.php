<?php
    session_start();

    $var = $_GET['var'];


    include_once("../classes/conect.php");
    $obj = new conect();
    $resultado = $obj->ConectarBanco();

    $sql = "SELECT * FROM usuario WHERE id_usuario=$var;";

    $query = $resultado->prepare($sql);
    $indice = 0;

    if ($query->execute()) {
        while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
            $linhas[$indice] = $linha;
            $indice++;
        }
    }

    

?>
<!DOCTYPE html>
<html>


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Perfil</title>

        <link rel="stylesheet" href="../css/perfilEdit.css">

    </head>


    <body>
        <form method="post" action="perfilEdit.php?var=<?=$var?>" enctype="multipart/form-data">
            <div class="fundo">
                <div class="fundo1">
                    <div class="fotoSession">
                        <label for="foto" class="fotoLabel">
                            <img id="perfilView" src="<?$linhas[0]['img_perfil'];?>">
                        </label>
                        <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" hidden>
                    </div>
                    <div class="information">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value="<?= $linhas[0]['nomeusuario'];?>">

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Digite seu email" value="<?= $linhas[0]['email'];?>">

                        <label for="bio">Biografia:</label>
                        <textarea id="bio" name="bio" placeholder="Fale um pouco sobre você" rows="5" value="<?= $linhas[0]['bio'];?>"></textarea>
           
                        <input id="botao" type="submit" value="Salvar perfil" name="salvar">
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>

<?php

    extract($_POST);
    if (isset($_POST["salvar"])) {
        include_once('../classes/conect.php');
        $obj = new conect();
        $resultado = $obj->ConectarBanco();

        $destino = '../img_perfil/' . $_FILES['foto']['name'];
        $arquivo_temp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($arquivo_temp, $destino);

        $sql = "UPDATE usuario SET nomeusuario = '" . $_POST["nome"] . "', email = '" . $_POST["email"] . "', bio = '" . $_POST["bio"]."', img_perfil = '". $_POST["foto"]."';";

        $query = $resultado->prepare($sql);
        if ($query->execute()) {
            #header("Location: perfil.php?var=$var");
        }
        unset($_POST["salvar"]);
    }
?>
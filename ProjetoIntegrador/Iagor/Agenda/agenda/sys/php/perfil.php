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
        <link rel="stylesheet" href="../css/perfil.css">
    </head>

    <body>
        <form method="post" action="perfil.php?var=<?=$var?>" enctype="multipart/form-data">
            <div class="fundo">
                <div class="fundo1">
                    <div class="fotoSession">
                        <label for="foto" class="fotoLabel">
                            <img id="perfilView" src="../img_contato/Captura de Tela (1).png">
                        </label>
                    </div>
                    <div class="information">
                        <label for="nome">Nome:</label>
                        <? echo $linhas[0]["nomeusuario"]; ?>
                        
                        <label for="email">Email:</label>
                        <? echo $linhas[0]["email"]; ?>
                        
                        <label for="bio">Biografia:</label>
                        <textarea readonly rows="5" ><? echo $linhas[0]["bio"]; ?></textarea>

                    </div>
                    <a href="perfilEdit.php?var=<?= $_SESSION["id"]; ?>"><input id="botao" type="button" value="Editar" name="salvar"></a>
                    <a class="sair" href="agrenda.php"></a>    
                </div>
            </div>
        </form>
    </body>
</html>
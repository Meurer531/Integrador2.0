<?php
session_start();
//session_name('Login');


if ($_SESSION['Login'] == FALSE) {
    session_destroy();
    header("location: login.php");
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"><!--os .. é para voltar-->
    <link rel="stylesheet" type="text/css" href="../css/agendacss.css" />
    <link rel="stylesheet" type="text/css" href="../css/barra.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



</head>

<body>
    <form method="post" action="agrenda.php" enctype="multipart/form-data">
        <script type="text/javascript" src="scripto.js"></script>

        <div class="ageFundo">
            <div class="datas">
                <table border="1px" class="agenda">

                    <tr><!--linha-->
                        <td rowspan="5"><input name="arquivo" type="file" class="texto" /></td>

                        <td colspan="2">Nome:<input type="text" name="name"></td><!--td é coluna-->
                    </tr>
                    <tr>
                        <td colspan="2">Endereço:<input type="text" name="ender"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Telefone:<input type="text" name="tel"></td>
                    </tr>
                    <tr>
                        <td>Celular:<input type="text" name="cel"></td>
                        <td>Email:<input type="email" name="email"></td>
                    </tr>
                    <tr>


                    </tr>

                    <td colspan="3" style="position: relative; content: left ;">
                        <input type="submit" name="inserir" value="inserir">
                        <input type="submit" name="contatos" value="contatos" onclick="contato()">
                    </td>
                </table>
                </form>
                <form method="post" action="agrenda.php" enctype="multipart/form-data"> 
                    <div class="barra">
                        <input type="text" name="nome_contato" placeholder="Pesquisar por Nome" />
                        <button type="submit" name="pesquisar" value="pesquisar">
                            Pesquisar
                        </button>
                    </div>                    
                </form>
            </div>

            



<?php
    extract($_POST);

    if (isset($_POST["inserir"])) {
        include_once("../classes/conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();

        $destino = '../img_contato/' . $_FILES['arquivo']['name'];
        $arquivo_temp = $_FILES['arquivo']['tmp_name'];
        move_uploaded_file($arquivo_temp, $destino);

        $sql = "INSERT INTO contatos (nome,endereco,telefone,email,celular,url_img,usuarioFK) VALUES ('" . $_POST["name"] . "','" . $_POST["ender"] . "','" . $_POST["tel"] . "','" . $_POST["email"] . "','" . $_POST["cel"] . "','" . $destino . "'," . $_SESSION["id"] . ");";


        $query = $resultado->prepare($sql);
        $indice = 0;
        if ($query->execute()) {
            unset($_POST["inserir"]);
        } else {
            print_r($linhas);
        }
    }


    if (isset($_POST["contatos"])) {
        include_once("../classes/conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();


        $sql = "SELECT * FROM contatos WHERE usuariofk=" . $_SESSION["id"] . ";";


        $query = $resultado->prepare($sql);
        $indice = 0;
        if ($query->execute()) {
            echo '<table border="1" class="tabelaCont" id="tabelaCont">
        <tr>
            <td>Foto</td>
            <td>Nome</td>
            <td>Endereço</td>
            <td>Celular</td>
            <td>Telefone</td>
            <td>Email</td>
            <td>Editar</td>
            <td>Exluir</td>
        </tr>';


            while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                $linhas[$indice] = $linha;


                echo '
        <tr>
            <td>
                <img src="' . $linhas[$indice]["url_img"] . '" width="45px" />
            </td>
            <td>' . $linhas[$indice]["nome"] . '</td>

            <td alig>' . $linhas[$indice]["endereco"] . '</td>

            <td >' . $linhas[$indice]["celular"] . '</td>

            <td>' . $linhas[$indice]["telefone"] . '</td>
            
            <td>' . $linhas[$indice]["email"] . '</td>


            <td align="center">
                <a class="editar" href="editarCont.php?var=' . $linhas[$indice]["id_contatos"] . '">&nbsp;</a>
            </td>

            <td align="center">
                <a class="excluir" href="excluirCont.php?var=' . $linhas[$indice]["id_contatos"] . '">&nbsp;</a>
            </td>

        </tr>
    
        ';
                $indice++;
            }/**/


            echo '  </table>';
        }
    }

    



/***************************************************************************************************************************************/
    if(isset($_POST['pesquisar'])){
        include_once("../classes/conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();


        $sql = "SELECT * FROM contatos WHERE nome like '".$_POST['nome_contato']."%';";

        $executado = $resultado->prepare($sql);
        $indice = 0;


        if ($executado->execute()) {
            while ($linha = $executado->fetch(PDO::FETCH_ASSOC)) {
                $linhas[$indice] = $linha;
                $indice++;
            }
            $i = 0;
            $indice--;

            echo '
                <table border="1" class="tabelaCont" id="tabelaCont">
                <tr>
                    <td>Foto</td>
                    <td>Nome</td>
                    <td>Endereço</td>
                    <td>Celular</td>
                    <td>Telefone</td>
                    <td>Email</td>
                    <td>Editar</td>
                    <td>Exluir</td>
                </tr>
                ';

            while ($i <= $indice) {
                echo '
                    <tr>
                        <td>
                            <img src="'.$linhas[$i]["url_img"].'" width="45px" />
                        </td>
                        <td>'.$linhas[$i]["nome"].'</td>


                        <td>'.$linhas[$i]["endereco"].'</td>


                        <td>'.$linhas[$i]["celular"].'</td>


                        <td>'.$linhas[$i]["telefone"].'</td>
                       
                        <td>'.$linhas[$i]["email"].'</td>




                        <td align="center">
                            <a class="editar" href="editarCont.php?var='.$linhas[$i]["id_contatos"].'">&nbsp;</a>
                        </td>


                        <td align="center">
                            <a class="excluir" href="excluirCont.php?var='.$linhas[$i]["id_contatos"].'">&nbsp;</a>
                        </td>


                    </tr>
                ';
                $i++;
               
            }
            echo '</table>';
        } else {
            echo 'errado';
        }
    }
/***************************************************************************************************************************************/
    
?>
<a class="sair"  href="logout.php" ></a>
            </div>
                <div class="conversa">
                    <iframe src="chat.php" class="chat" ></iframe>
                </div>

                <div class="perfilAgenda">

                </div>
            
                <a href="perfil.php?var=<?=  $_SESSION["id"]; ?>">
                    <div class="perfil">
                        <div class="fotoSession">
                            <label for="foto" class="fotoLabel">
                                <img id="perfilView" src="../img_contato/Captura de Tela (1).png">
                            </label>
                            <label style="right:5%; color:black;">
                                <?
                                echo $sql = "SELECT nomeusuario FROM usuario WHERE id_usuario=''";
                                echo $sql = "SELECT email FROM usuario WHERE id_usuario=''";
                                ?>
                            </label>
                        </div>
                    </div>
                </a>

        <script type="text/javascript" src="java.js"></script>
    </body>

</html>
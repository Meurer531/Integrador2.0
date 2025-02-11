
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            texte
        </title>
        <style type="text/css" rel="stylesheet">
            body{
                color: green;
                font-size:50px;
            }
        </style>
    </head>

    <body>
    <?php
        $var=10;//declarar variavel é obrigatório o $
        $var2=20;
        $var3=1.5;//varaivel é variavel, ele não faz diferenciação de variaveis
        $var4 = "fome";
        $soma=$var+$var2+$var3.$var4;//a não ser que seja contatenado

        echo "<br>$var4<br>";
        echo $soma;


        ////imprimir variavel com o texto de duas formas////
        echo "<p>".$soma."</p>";
        echo "<p>$soma</p>";
        //////////////////////////////////////////////////


        print ("<br>Quem disse que Falmengo é time?<br>");//os dois funcionam da mesma maneira
        echo "Flamengo não é time não<br>";// mas utiliza echo pq não precisa das ()
        echo"<ul>";
        for($i=0;$i<100;$i++){
            echo "<li>$i</li>";
        }
        echo"<ul>";
    ?>

        time é o vaxco da gama
    </body>
</html>

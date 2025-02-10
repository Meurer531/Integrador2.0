<!--
No campo src da tag img abaixo enviaremos 4 parametros via GET
l = largura da imagem
a = altura da imagem
tf = tamanho fonte das letras
ql = quantidade de letras do captcha
-->



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <style type="text/css">
      body {
         background-color: rgb(182, 185, 207);
      }

      #fd {
         margin-top: 20px;
         border-radius: 10px;
         margin-left: 30px;
         position: relative;
         top: 60px;
         width: 200px;
      }

      .b {
         margin-top: 10px;
         position: relative;
         background-color: navy;
         color: white;
         padding: 5px 10px;
         border: none;
         border-radius: 15px;
         font-size: 15px;
         margin-top: 10px;
         width: 60%;
         text-align: center;
         display: block;
         top: 100px;
         margin-left: 20px;

      }

      
   </style>
</head>

<body>

   <img src="captcha.php?l=150&a=50&tf=20&ql=5">
   <!--
O texto digitado no campo abaixo sera enviado via POST para
o arquivo validar.php que ira vereficar se o que voce digitou é igual
ao que foi gravado na sessao pelo captcha.php
-->
   <form action="validar.php" name="form" method="post">
      <input id="fd" type="text" name="palavra" />
      <input class="b" type="submit" value="Validar Captcha" />
   </form>

</body>

</html>
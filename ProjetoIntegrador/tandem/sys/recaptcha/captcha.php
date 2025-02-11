<?php
session_start(); // Inicia a sessão

// Evita saída de erros antes da imagem
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 0);

header("Content-type: image/jpeg"); // Define o tipo do conteúdo como imagem

function captcha($largura, $altura, $tamanho_fonte, $quantidade_letras) {
    $largura = intval($largura);
    $altura = intval($altura);
    $tamanho_fonte = intval($tamanho_fonte);
    $quantidade_letras = intval($quantidade_letras);

    // Cria a imagem
    $imagem = imagecreate($largura, $altura);
    $fonte = __DIR__ . "/arial.ttf"; // Caminho absoluto da fonte

    if (!file_exists($fonte)) {
        die("Erro: Fonte não encontrada.");
    }

    $preto  = imagecolorallocate($imagem, 0, 0, 0); // Fundo preto 
    $branco = imagecolorallocate($imagem, 255, 255, 255); // Letras brancas

    // Gera a palavra aleatória
    $caracteres = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789"; // Evita caracteres ambíguos
    $palavra = substr(str_shuffle($caracteres), 0, $quantidade_letras);
    $_SESSION["captcha"] = $palavra; // Armazena na sessão

    // Define o espaço entre as letras
    $espaco_letra = intval($largura / ($quantidade_letras + 1));
    $posicao_y = intval($altura / 1.5); // Ajusta altura para centralizar melhor

    // Adiciona as letras ao captcha
    for ($i = 0; $i < $quantidade_letras; $i++) {
        imagettftext(
            $imagem,
            $tamanho_fonte,
            rand(-25, 25),
            ($espaco_letra * ($i + 1)), // Posicionamento melhorado
            $posicao_y,
            $branco,
            $fonte,
            $palavra[$i]
        );
    }

    imagejpeg($imagem); // Gera a imagem
    imagedestroy($imagem); // Libera memória
}

// Obtém os parâmetros da URL, convertendo para inteiro
$largura = isset($_GET["l"]) ? intval($_GET["l"]) : 120;
$altura = isset($_GET["a"]) ? intval($_GET["a"]) : 40;
$tamanho_fonte = isset($_GET["tf"]) ? intval($_GET["tf"]) : 18;
$quantidade_letras = isset($_GET["ql"]) ? intval($_GET["ql"]) : 5;

captcha($largura, $altura, $tamanho_fonte, $quantidade_letras);
?>

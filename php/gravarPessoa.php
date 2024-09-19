<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include "conexao.php";

    $nome = $_POST['nome'];
    
    $instituicao = $_POST['instituicao'];
    $matricula = $_POST['matricula'];
    $rg = $_POST['rg'];

    $modalidadeColetivas = isset($_POST['modalidadeColetivas']) ? $_POST['modalidadeColetivas'] : array();

    $basquete = in_array('basquete', $modalidadeColetivas) ? 1 : 0;
    $futebolCampo = in_array('futebolCampo', $modalidadeColetivas) ? 1 : 0;
    $futsal = in_array('futsal', $modalidadeColetivas) ? 1 : 0;
    $handebol = in_array('handebol', $modalidadeColetivas) ? 1 : 0;
    $tenisDeMesa = in_array('tenisMesa', $modalidadeColetivas) ? 1 : 0;  
    $voleibol = in_array('voleibol', $modalidadeColetivas) ? 1 : 0;  
    $voleiPraia = in_array('voleiPraia', $modalidadeColetivas) ? 1 : 0;
    $xadrez = in_array('xadrez', $modalidadeColetivas) ? 1 : 0;
    
    $tmp_arq = $_FILES['foto']['tmp_name'];
    $nome_final = $_FILES['foto']['name'];
    $exp = explode(".", $nome_final);
    $extensao = strtolower(end($exp));
    $novonome = md5(uniqid()) . '-' . time().'.'.$extensao;

    $caminho = 'upload//';
    $novonome = $nome_final;
    //$novonome= $_FILES['foto']['name'];

    //$caminhoImagem =$caminho . $novonome;
    $caminhoImagem = $_SESSION["NOMEARQUIVO"];
    // if(file_exists($tmp_arq)){
       
    //     $response = array('arquivo existe' => true);

    // } else {
    //     $response = array(' arquivo não existe' => false);
    // }

    // if(move_uploaded_file($tmp_arq, $caminhoImagem )){
    //     echo "Concluido com sucesso";
    // } else{
    //     echo"Upload não funcionou ";
    // }
    

    
    $sql = "INSERT INTO atletas (nome, instituicao, matricula, rg, basquete, futebolCampo, futsal, handebol, tenisDeMesa, voleibol, voleiPraia, xadrez, caminhoImagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    echo($sql);
    $stmt = $conexao->prepare($sql);

    if ($stmt === false) {
        $response = array('success' => false, 'error' => 'Erro na preparação da consulta: ' . $conexao->error);
        echo json_encode($response);
        exit;
    }


    $stmt->bind_param("ssssiiiiiiiis", $nome, $instituicao, $matricula, $rg, $basquete, $futebolCampo, $futsal, 
            $handebol, $tenisDeMesa, $voleibol, $voleiPraia, $xadrez, $caminhoImagem);

    if ($stmt->execute()) {
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'error' => 'Erro ao inserir atleta no banco de dados: ' . $stmt->error);
        echo json_encode($response);
    }

    $stmt->close();

    $conexao->close();
} else {
    $response = array('success' => false, 'error' => 'Método não permitido.');
    echo json_encode($response);
}
?>

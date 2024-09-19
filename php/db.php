<?php

// function createAtletaDB($conexao,$nomecompleto,$instituicao,$rg,$matricula,$sexo,
//                   $cOpcional1,$cOpcional2,$cOpcional3,$cOpcional4,$cOpcional5,
// 				  $cOpcional6,$cOpcional7,$cOpcional8,$nomeArquivo)
// {
// 	$nomecompleto = mysqli_real_escape_string($conexao,$nomecompleto);
// 	$instituicao = mysqli_real_escape_string($conexao,$instituicao);
// 	$rg = mysqli_real_escape_string($conexao,$rg);
// 	$matricula = mysqli_real_escape_string($conexao,$matricula);
// 	$sexo = mysqli_real_escape_string($conexao,$sexo);
// 	$cOpcional1 = mysqli_real_escape_string($conexao,$cOpcional1);
// 	$cOpcional2 = mysqli_real_escape_string($conexao,$cOpcional2);
// 	$cOpcional3 = mysqli_real_escape_string($conexao,$cOpcional3);
// 	$cOpcional4 = mysqli_real_escape_string($conexao,$cOpcional4);
// 	$cOpcional5 = mysqli_real_escape_string($conexao,$cOpcional5);	
// 	$cOpcional6 = mysqli_real_escape_string($conexao,$cOpcional6);
// 	$cOpcional7 = mysqli_real_escape_string($conexao,$cOpcional7);
// 	$cOpcional8 = mysqli_real_escape_string($conexao,$cOpcional8);
// 	$nomeArquivo = mysqli_real_escape_string($conexao,$nomeArquivo);
// 	$sql = "Insert Into tabatleta (nome,instituicao,rg,sexo,foto,mcbasquete,
// 	        mcfutebolcampo,mcfutsal,mchandebol,mctenismesa,mcvolei,mcvoleipraia,
// 			mcxadrez,matricula) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
// 	$stmt = mysqli_stmt_init($conexao);
// 	if(!mysqli_stmt_prepare($stmt,$sql))
//        exit('SQL error');		

//     mysqli_stmt_bind_param($stmt,'ssssssssssssss',$nomecompleto,$instituicao,
//         $rg,$sexo,$nomeArquivo,$cOpcional1,$cOpcional2,$cOpcional3,$cOpcional4,
//         $cOpcional5,$cOpcional6,$cOpcional7,$cOpcional8,$matricula);
// 	mysqli_stmt_execute($stmt);
// 	mysqli_close($conexao);
// 	return true;
// }


function readAtletaDB($conn) {
    $query = "SELECT * FROM atletas";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Erro na consulta: " . mysqli_error($conn));
    }

    $atletas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $atletas;
}

function deleteAtletaDB($conexao,$id_atleta)
{

	$id_atleta = mysqli_real_escape_string($conexao,$id_atleta);

	if ($id_atleta)
	{
		$sql = "delete from atletas where id_atletas = ?";
		$stmt = mysqli_stmt_init($conexao);
		if(!mysqli_stmt_prepare($stmt,$sql))
			exit('SQL error');
		mysqli_stmt_bind_param($stmt,'i',$id_atleta);
		mysqli_stmt_execute($stmt);
		return true;
	}
}
	 
function findAtletaDB($conn,$id)
{
	$id = mysqli_real_escape_string($conn,$id);
	$atleta;
	$sql = "SELECT * FROM tabatleta  WHERE id = ?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql))
		exit('SQL error');
	mysqli_stmt_bind_param($stmt,'i',$id);
	mysqli_stmt_execute($stmt);
	$atleta = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
	mysqli_close($conn);
	return $atleta;
}

function updateAtletaDB($conn,$id,$nomecompleto,$instituicao,$rg,$matricula,$cOpcional1,$cOpcional2,$cOpcional3,
						$cOpcional4,$cOpcional5,$cOpcional6,$cOpcional7,$cOpcional8,$nomeArquivo){

$sql = "UPDATE atletas SET nome = ?, instituicao = ?, matricula = ?, rg = ?, basquete = ?, futebolCampo = ?, futsal = ?, handebol = ?, tenisDeMesa = ?, voleibol = ?, voleiPraia = ?, xadrez = ?, caminhoImagem = ? WHERE id_atletas = ?";

$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$sql)){
	exit('SQL error');
}
    		
mysqli_stmt_bind_param($stmt,'issssssssssssss',$id,$nomecompleto,$instituicao,
        $rg,$sexo,$nomeArquivo,$cOpcional1,$cOpcional2,$cOpcional3,$cOpcional4,
        $cOpcional5,$cOpcional6,$cOpcional7,$cOpcional8,$matricula );
		
mysqli_stmt_execute($stmt);
mysqli_close($conn);

return true;
}
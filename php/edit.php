<?php
include 'conexao.php';

if (!isset($_GET['id_atletas']) || empty($_GET['id_atletas'])) {
    echo "ID do atleta não fornecido.";
    exit;
}

$id_atletas = $_GET['id_atletas'];

$sql = "SELECT * FROM atletas WHERE id_atletas = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_atletas);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $nome = $row['nome'];
    $instituicao = $row['instituicao'];
    $rg = $row['rg'];
    $matricula = $row['matricula'];
    $basquete = $row['basquete'];
    $futebolCampo = $row['futebolCampo'];
    $futsal = $row['futsal'];
    $handebol = $row['handebol'];
    $tenisDeMesa = $row['tenisDeMesa'];
    $voleibol = $row['voleibol'];
    $voleiPraia = $row['voleiPraia'];
    $xadrez = $row['xadrez'];
    $caminhoImagem = $row['caminhoImagem'];
} else {
    echo "Atleta não encontrado.";
    exit;
}

mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $instituicao = $_POST['instituicao'];
    $matricula = $_POST['matricula'];
    $rg = $_POST['rg'];
    $modalidadeColetivas = isset($_POST['modalidadeColetivas']) ? $_POST['modalidadeColetivas'] : array();

    $basquete = in_array('basquete', $modalidadeColetivas) ? 1 : 0;
    $futebolCampo = in_array('futebolCampo', $modalidadeColetivas) ? 1 : 0;
    $futsal = in_array('futsal', $modalidadeColetivas) ? 1 : 0;
    $handebol = in_array('handebol', $modalidadeColetivas) ? 1 : 0;
    $tenisDeMesa = in_array('tenisDeMesa', $modalidadeColetivas) ? 1 : 0;
    $voleibol = in_array('voleibol', $modalidadeColetivas) ? 1 : 0;
    $voleiPraia = in_array('voleiPraia', $modalidadeColetivas) ? 1 : 0;
    $xadrez = in_array('xadrez', $modalidadeColetivas) ? 1 : 0;

    $foto_atual = $_POST['foto_atual'];
    $novoNomeImagem = '';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $tmp_arq = $_FILES['foto']['tmp_name'];
        $caminho = 'upload/';
        $nome_final = $_FILES['foto']['name'];
        $exp = explode(".", $nome_final);
        $extensao = strtolower(end($exp));
        $novoNomeImagem = md5(uniqid()) . '-' . time() . '.' . $extensao;
        $caminhoImagem = $caminho . $novoNomeImagem;
        move_uploaded_file($tmp_arq, $caminhoImagem);
    } else {
        $caminhoImagem = $foto_atual;
    }

    $sql = "UPDATE atletas SET nome = ?, instituicao = ?, matricula = ?, rg = ?, basquete = ?, futebolCampo = ?, futsal = ?, handebol = ?, tenisDeMesa = ?, voleibol = ?, voleiPraia = ?, xadrez = ?, caminhoImagem = ? WHERE id_atletas = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt, "ssssiiiiiiiiis", 
    $nome, $instituicao, $matricula, $rg,
    $basquete, $futebolCampo, $futsal, $handebol, $tenisDeMesa,
    $voleibol, $voleiPraia, $xadrez, $caminhoImagem, $id_atletas);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: verAtletas.php");
        exit;
    } else {
        echo "Erro ao atualizar os dados: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar Atleta</title>
    <link rel="icon" href="../img/logo.png" type="image/png"/>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form enctype="multipart/form-data" id="formulario" name="formulario" method="POST" class="bg-light p-4 rounded shadow-sm">
                    <input type="hidden" name="foto_atual" value="<?php echo htmlspecialchars($caminhoImagem); ?>">

                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="instituicao">Instituição:</label>
                        <select class="form-control" id="instituicao" name="instituicao" required>
                            <option value="">Selecione</option>
                            <option value="IFPR" <?php echo ($instituicao == 'IFPR') ? 'selected' : ''; ?>>IFPR</option>
                            <option value="IFSC" <?php echo ($instituicao == 'IFSC') ? 'selected' : ''; ?>>IFSC</option>
                            <option value="IFC" <?php echo ($instituicao == 'IFC') ? 'selected' : ''; ?>>IFC</option>
                            <option value="IFRS" <?php echo ($instituicao == 'IFRS') ? 'selected' : ''; ?>>IFRS</option>
                            <option value="IFSUL" <?php echo ($instituicao == 'IFSUL') ? 'selected' : ''; ?>>IFSUL</option>
                            <option value="IFFAR" <?php echo ($instituicao == 'IFFAR') ? 'selected' : ''; ?>>IFFAR</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rg">RG:</label>
                        <input type="text" class="form-control" id="rg" name="rg" value="<?php echo htmlspecialchars($rg); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matrícula:</label>
                        <input type="text" class="form-control" id="matricula" name="matricula" value="<?php echo htmlspecialchars($matricula); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Modalidades Coletivas:</label>
                        <?php
                        $modalidades = [
                            'basquete' => 'Basquete',
                            'futebolCampo' => 'Futebol de Campo',
                            'futsal' => 'Futsal',
                            'handebol' => 'Handebol',
                            'tenisDeMesa' => 'Tênis de Mesa',
                            'voleibol' => 'Voleibol',
                            'voleiPraia' => 'Vôlei de Praia',
                            'xadrez' => 'Xadrez'
                        ];
                        foreach ($modalidades as $key => $value):
                        ?>
                        <div class="form-check">
                            <input type="checkbox" id="modalidade<?php echo ucfirst($key); ?>" name="modalidadeColetivas[]" value="<?php echo $key; ?>" class="form-check-input" <?php echo ($$key) ? 'checked' : ''; ?>>
                            <label for="modalidade<?php echo ucfirst($key); ?>" class="form-check-label"><?php echo $value; ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="form-group mt-4">
                            <label for="foto" class="form-label">Inserir Foto:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                                    <label class="custom-file-label" for="foto">Escolher arquivo</label>
                                </div>
                            </div>
                        </div>

                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="verAtletas.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <br><br><br>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy2LR3P2zQz6OjHE0pG5CB7N7SgXj69v5n5J8wO" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9wPxFj1VJ6j9aLU0a8tk0bQtpD3c2LMo3lJkC7Mk8SgH9T8Fhz2M" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4Ag1Trt4Q4G3y5td5eZz5qzXtZz+Fffl+g1bGg92r3L56R6hLJ13" crossorigin="anonymous"></script>
</body>
</html>

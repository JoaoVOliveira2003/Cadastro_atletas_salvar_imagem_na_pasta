<?php
require_once 'conexao.php';
require_once 'db.php';

$atletas = readAtletaDB($conexao);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="../img/logo.png" type="image/png"/>
    <title>Consulta de Atletas</title>
</head>

<?php include 'header.php'; ?>

<body class="bg-light text-dark">
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col text-center">
                <h1 class="display-4">Consulta de Atletas</h1>
				<a class="btn btn-success text-white" href="/CadastroDeAtletas/index.php">Novo Atleta</a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col text-center">
                <?php if (isset($_GET['message'])) echo printMessage($_GET['message']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Instituição</th>
                                <th>RG</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($atletas as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nome']) ?></td>
                                <td><?= htmlspecialchars($row['instituicao']) ?></td>
                                <td><?= htmlspecialchars($row['rg']) ?></td>
                                <td>
                                    <a class="btn btn-primary text-white" href="edit.php?id_atletas=<?= $row['id_atletas'] ?>">Atualizar</a>
                                    <a class="btn btn-danger text-white" href="delete.php?id_atletas=<?= $row['id_atletas'] ?>">Excluir</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php include 'footer.php'; ?>

                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br>

</body>
</html>

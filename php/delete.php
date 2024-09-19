<?php
require_once 'conexao.php';
require_once 'db.php';

if (isset($_POST['id_atleta'])) {
    deleteAtletaDB($conexao, $_POST['id_atleta']);
    header("Location: ./verAtletas.php");
    exit(); // Para garantir que o redirecionamento ocorra sem continuar o script
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Consulta Atletas</title>
</head>
<?php include 'header.php'; ?>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col text-center">
                <h1 class="display-4">Excluir Atleta</h1>
                <p class="lead">Você tem certeza que deseja remover o atleta?</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id_atleta" value="<?=$_GET['id_atletas']?>" required/>
                            <div class="text-center">
                                <button class="btn btn-danger btn-lg" type="submit">Sim, Remover</button>
                                <a class="btn btn-secondary btn-lg" href="verAtletas.php">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br>
    <?php include 'footer.php'; ?>
</body>

</html>

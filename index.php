<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro de Alunos</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap/css/style.css" />
    <link rel="icon" href="img/logo.png" type="image/png"/>
</head>

<?php include  'php/header.php'; ?>

<body>
    

    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form enctype="multipart/form-data" id="formulario" name="formulario" method="POST" class="w-100" style="max-width: 800px;">
            <div class="p-3">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="instituicao">Instituição:</label>
                    <select class="form-control" id="instituicao" name="instituicao" required>
                        <option value="">Selecione</option>
                        <option>IFPR</option>
                        <option>IFSC</option>
                        <option>IFC</option>
                        <option>IFRS</option>
                        <option>IFSUL</option>
                        <option>IFFAR</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="rg">RG:</label>
                    <input type="text" class="form-control" id="rg" name="rg" required>
                </div>

                <div class="form-group">
                    <label for="matricula">Matrícula:</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" required>
                </div>

                <!-- <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" id="sexo" name="sexo" required>
                        <option value="">Selecione</option>
                        <option>Masculino</option>
                        <option>Feminino</option>
                    </select>
                </div> -->

                <div class="form-group">
                    <label>Modalidades Coletivas:</label>
                    <div class="form-check">
                        <input type="checkbox" id="modalidadeBasquete" name="modalidadeColetivas[]" value="basquete" class="form-check-input">
                        <label for="modalidadeBasquete" class="form-check-label">Basquete</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="modalidadeFutebolCampo" name="modalidadeColetivas[]" value="futebolCampo" class="form-check-input">
                        <label for="modalidadeFutebolCampo" class="form-check-label">Futebol de Campo</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="modalidadeFutsal" name="modalidadeColetivas[]" value="futsal" class="form-check-input">
                        <label for="modalidadeFutsal" class="form-check-label">Futsal</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="modalidadeHandebol" name="modalidadeColetivas[]" value="handebol" class="form-check-input">
                        <label for="modalidadeHandebol" class="form-check-label">Handebol</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="modalidadeTenisMesa" name="modalidadeColetivas[]" value="tenisMesa" class="form-check-input">
                        <label for="modalidadeTenisMesa" class="form-check-label">Tênis de Mesa</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="modalidadeVoleibol" name="modalidadeColetivas[]" value="voleibol" class="form-check-input">
                        <label for="modalidadeVoleibol" class="form-check-label">Voleibol</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="modalidadeVoleiPraia" name="modalidadeColetivas[]" value="voleiPraia" class="form-check-input">
                        <label for="modalidadeVoleiPraia" class="form-check-label">Vôlei de Praia</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="modalidadeXadrez" name="modalidadeColetivas[]" value="xadrez" class="form-check-input">
                        <label for="modalidadeXadrez" class="form-check-label">Xadrez</label>
                    </div>
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

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary" onclick="gravarPessoa()">Gravar</button>
                    <a class="btn btn-success text-white" href="php/verAtletas.php">Ver atletas</a>
                    <button type="button" class="btn btn-secondary ml-2" onclick="location.href='https://portuguesaletra.com/duvidas/saiu-ou-saio/'">Sair</button>
                </div>
            </div>
        </form>
    </div>

    <script src="jQuery/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/scripts.js"></script>
    <!-- <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("foto").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });

    </script> -->
<br><br><br><br>


</body>
<?php include './php/footer.php'; ?>

</html>

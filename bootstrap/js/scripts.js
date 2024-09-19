function funfou() {
    alert('funfou');
}

function limparCampos() {
    document.getElementById('nome').value = '';
    document.getElementById('instituicao').value = '';
    document.getElementById('rg').value = '';
    document.getElementById('matricula').value = '';
    document.getElementById('sexo').value = '';
    document.querySelectorAll('input[name="modalidadeColetivas[]"]').forEach(checkbox => checkbox.checked = false);
    document.getElementById('foto').value = '';
    var fileLabel = document.querySelector('.custom-file-label');
    if (fileLabel) {
        fileLabel.innerText = 'Escolher arquivo';
    }
}

// function gravarPessoa() {
//     SalvarArquivo();
//     $.ajax({
//         type: 'POST',
//         url: 'php/gravarPessoa.php',
//         data: $("#formulario").serialize(),
//         dataType: 'json',
//         success: function(response) {
//             if (response.success) {
//                 alert('Pessoa gravada com sucesso!');
//                 limparCampos();
//                 // Esconde os botões de ação
//                 $('.delete-person-acao').hide();
//                 $('.charge-person-acao').hide();
//                 alert('Erro ao gravar pessoa: ' + response.error);

//             } else {
//                 alert('Erro ao gravar pessoa: ' + response.error);
//             }
//         },
//         error: function(xhr, status, error) {
//             alert('Erro na requisição: ' + status);
//             console.log(xhr.responseText);
//         }
//     });
// }

function gravarPessoa() {
    var nomedaimagem = SalvarArquivo();
    console.log(nomedaimagem);
    var formData = $("#formulario").serializeArray(); 

    $.ajax({
        type: 'POST',
        url: 'php/gravarPessoa.php',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                limparCampos();
                // Esconde os botões de ação
                $('.delete-person-acao').hide();
                $('.charge-person-acao').hide();
            } else {
                alert('Erro ao gravar pessoa: ' + response.error);
            }
        },
        error: function(xhr, status, error) {
            alert('Erro na requisição: ' + status);
            console.log(xhr.responseText);
        }
    });
}


function SalvarArquivo() {
    var fileInput = document.getElementById('foto');
    var file = fileInput.files[0];

    if (file) {
        // Exibir o nome do arquivo
        var formData = new FormData();
        formData.append('image', file);  

        $.ajax({
            url: 'php/gravarImagens.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Arquivo enviado com sucesso!');
                //fileInput.value = '';  // Limpar o input após o envio
            },
            error: function() {
                alert('Erro ao enviar o arquivo.');
            }
        });
    } else {
        alert('Nenhum arquivo selecionado.');
    }
}

// Atualizar o nome do arquivo no label
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileNome = e.target.files[0] ? e.target.files[0].name : 'Escolher arquivo';
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileNome;
});


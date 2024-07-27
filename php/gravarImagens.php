<?php
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
           $fileTmpPath = $_FILES['image']['tmp_name'];
           $fileName = $_FILES['image']['name'];
           $fileSize = $_FILES['image']['size'];
           $fileType = $_FILES['image']['type'];
   
           $fileNameCmps = explode(".", $fileName);
           $fileExtension = strtolower(end($fileNameCmps));
   
           $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
   
           if (in_array($fileExtension, $allowedfileExtensions)) {
            
            // Diretório de upload
           //$uploadFileDir = 'E:/Users/user/Desktop/Xamp2/htdocs/CadastroDeAtletas/imagensSalvas/';  // Note o '/' no final
              $uploadFileDir ='E:/Users/user/Desktop/Xamp2/htdocs/CadastroDeAtletas/upload/';
               // Verifica se o diretório existe e tenta criá-lo se não existir
               if (!is_dir($uploadFileDir)) {
                   mkdir($uploadFileDir, 0777, true);
               }
   
               $dest_path = $uploadFileDir . $fileName;
   
               if (move_uploaded_file($fileTmpPath, $dest_path)) {
                   $message = 'Imagem salva corretamente';
               } else {
                   $message = 'Erro ao mover a imagem para o diretório de upload';
               }
           } else {
               $message = 'Tipo de arquivo não aceito, apenas imagens (JPEG, PNG, GIF) são aceitas';
           }
       } else {
            // $message = 'Erro no envio do arquivo. Código do erro: ' . $_FILES['image']['error'];
       }
   
    //    echo "<script>alert('$message');</script>";
   } else {
       echo "<script>alert('Requisição inválida');</script>";
   }
   ?>
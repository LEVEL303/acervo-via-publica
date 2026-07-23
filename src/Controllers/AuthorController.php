<?php

namespace src\Controllers;

use src\Models\Author;

class AuthorController extends Controller
{
    public function create(): void
    {
        $this->requireAdmin();

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $biography = trim($_POST['biography'] ?? '');
            $photoUrl = null;

            if (empty($name) || empty($biography)) {
                $error = "Por favor, preencha todos os campos obrigatórios.";
            } else {
                
                if (Author::findByName($name)) {
                    $error = "O autor informado já está cadastrado no sistema.";
                } else {

                    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                        $fileName = $_FILES['photo']['name'];
                        $fileTmpPath = $_FILES['photo']['tmp_name'];
                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

                        if (in_array($fileExtension, $allowedExtensions)) {
                            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                            $destPath = __DIR__ . '/../../public/uploads/' . $newFileName;

                            if (move_uploaded_file($fileTmpPath, $destPath)) {
                                $photoUrl = 'uploads/' . $newFileName;
                            } else {
                                $error = "Erro interno ao salvar a imagem.";
                            }

                        } else {
                            $error = "Formato de imagem inválido.";
                        } 
                    }

                    if (!$error && Author::create($name, $biography, $photoUrl)) {
                        $success = "Autor cadastrado com sucesso!";
                    } elseif (!$error) {
                        $error = "Erro interno ao salvar o autor.";
                    }
                }
            }
        }

        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }
}
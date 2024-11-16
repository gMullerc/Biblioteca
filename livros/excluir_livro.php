<?php 
require __DIR__ . '/../sql_dao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    excluirLivro($id);

    header("Location: listagem_livros.php");
    exit();
} else {
    echo "ID não encontrado!";
}
?>
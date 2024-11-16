<?php
require __DIR__ . '/../sql_dao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'];
    $data_criacao = $_POST['data_criacao'];
    $descricao = $_POST['descricao'];
    $estilo_livro = $_POST['estilo_livro'];
    $indicacao_idade = $_POST['indicacao_idade'];

    if ($id) {
        atualizarLivro($id, $nome, $data_criacao, $descricao, $estilo_livro, $indicacao_idade);
    } else {
        adicionarLivro($nome, $data_criacao, $descricao, $estilo_livro, $indicacao_idade);
    }

    header("Location: listagem_livros.php");
    exit();
}
?>

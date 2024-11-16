<?php
require __DIR__ . '/../sql_dao.php';

$id = null;
$nome = '';
$data_criacao = '';
$descricao = '';
$estilo_livro = '';
$indicacao_idade = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $livro = buscarlivroPorId($id);

    if ($livro) {
        $nome = $livro['nome'];
        $data_criacao = $livro['data_criacao'];
        $descricao = $livro['descricao'];
        $estilo_livro = $livro['estilo_livro'];
        $indicacao_idade = $livro['indicacao_idade'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo $id ? 'Editar livro' : 'Adicionar livro'; ?></title>
    <link rel="stylesheet" href="adicionar_livro.css">
</head>
<body>
    <div class="card"> 
        <h2><?php echo $id ? 'Editar livro' : 'Adicionar Novo livro'; ?></h2>
        <form method="POST" action="processar_adicao.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

            <label for="data_criacao">Data de Criação:</label>
            <input type="date" name="data_criacao" id="data_criacao" value="<?php echo htmlspecialchars($data_criacao); ?>" required>

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" value="<?php echo htmlspecialchars($descricao); ?>" maxlength="100" required>

            <label for="estilo_livro">Estilo de livro:</label>
            <input type="text" name="estilo_livro" id="estilo_livro" value="<?php echo htmlspecialchars($estilo_livro); ?>" required>

            <label for="indicacao_idade">Indicação de Idade:</label>
            <input type="text" name="indicacao_idade" id="indicacao_idade" value="<?php echo htmlspecialchars($indicacao_idade); ?>" required>

            <button type="submit"><?php echo $id ? 'Salvar Alterações' : 'Adicionar livro'; ?></button>
            <a href="listagem_livros.php" class="button">Voltar para Listagem</a>
        </form>
    </div>
</body>
</html>

<?php
require '../sql_dao.php';

$livros = buscarLivros();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Livros</title>
    <link rel="stylesheet" href="listagem_livros.css">
</head>
<body>
    <div class="card">
        <h2>Listagem de Livros</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data de Criação</th>
                    <th>Descrição</th>
                    <th>Estilo de Livro</th>
                    <th>Indicação de Idade</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($livros as $livro) {
                    echo "<tr>
                            <td>" . htmlspecialchars($livro['nome']) . "</td>
                            <td>" . htmlspecialchars($livro['data_criacao']) . "</td>
                            <td>" . htmlspecialchars($livro['descricao']) . "</td>
                            <td>" . htmlspecialchars($livro['estilo_livro']) . "</td>
                            <td>" . htmlspecialchars($livro['indicacao_idade']) . "</td>
                            <td><a href='adicionar_livro.php?id=" . $livro['id'] . "' class='button'>Editar</a></td>
                            <td><a href='excluir_livro.php?id=" . $livro['id'] . "' class='button'>Excluir</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
        <div style="text-align: center; margin-top: 20px;">
            <a href="adicionar_livro.php" class="button">Adicionar Novo Livro</a>
        </div>
    </div>
</body>
</html>

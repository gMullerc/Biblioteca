<?php
$nomeBanco = __DIR__ . '/meu_banco.db';

function inicializarBanco() {
    global $nomeBanco;
    $db = new SQLite3($nomeBanco);

    $query = "CREATE TABLE IF NOT EXISTS usuarios (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                senha TEXT NOT NULL
              )";

    $tabelaLivros = "CREATE TABLE IF NOT EXISTS livro (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        data_criacao DATE NOT NULL,
        descricao TEXT NOT NULL CHECK (LENGTH(descricao) <= 100),
        estilo_livro TEXT NOT NULL,
        indicacao_idade TEXT NOT NULL
    )";

    $db->exec($query);
    $db->exec($tabelaLivros);

    $usuarios = [
        ["João Silva", "joao.silva@example.com", password_hash("senha123", PASSWORD_DEFAULT)],
       ];

    $insertQuery = "INSERT OR IGNORE INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $db->prepare($insertQuery);

    foreach ($usuarios as $usuario) {
        $stmt->bindValue(':nome', $usuario[0], SQLITE3_TEXT);
        $stmt->bindValue(':email', $usuario[1], SQLITE3_TEXT);
        $stmt->bindValue(':senha', $usuario[2], SQLITE3_TEXT);
        $stmt->execute();
    }

    $db->close();
}

function buscarLivros() {
    global $nomeBanco;
    $db = new SQLite3($nomeBanco);
    $query = "SELECT * FROM livro";
    $result = $db->query($query);

    $livros = [];
    while ($livro = $result->fetchArray(SQLITE3_ASSOC)) {
        $livros[] = $livro;
    }

    $db->close();
    return $livros;
}

function buscarLivroPorId($id) {
    global $nomeBanco;
    $db = new SQLite3($nomeBanco);

    $query = "SELECT * FROM livro WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $livro = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
    return $livro;
}

function adicionarLivro($nome, $data_criacao, $descricao, $estilo_livro, $indicacao_idade) {
    global $nomeBanco;
    $db = new SQLite3($nomeBanco);
    $query = "INSERT INTO livro (nome, data_criacao, descricao, estilo_livro, indicacao_idade) VALUES (:nome, :data_criacao, :descricao, :estilo_livro, :indicacao_idade)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':data_criacao', $data_criacao, SQLITE3_TEXT);
    $stmt->bindValue(':descricao', $descricao, SQLITE3_TEXT);
    $stmt->bindValue(':estilo_livro', $estilo_livro, SQLITE3_TEXT);
    $stmt->bindValue(':indicacao_idade', $indicacao_idade, SQLITE3_TEXT);
    $stmt->execute();
    $db->close();
}

function excluirLivro($id) {

    global $nomeBanco;
    $db = new SQLite3($nomeBanco);

    $query = "DELETE FROM livro WHERE id = :id";

    $stmt = $db->prepare($query);

    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    $stmt->execute();
} 

function atualizarLivro($id, $nome, $data_criacao, $descricao, $estilo_livro, $indicacao_idade) {
    global $nomeBanco;
    $db = new SQLite3($nomeBanco);
    $query = "UPDATE livro SET nome = :nome, data_criacao = :data_criacao, descricao = :descricao, estilo_livro = :estilo_livro, indicacao_idade = :indicacao_idade WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':data_criacao', $data_criacao, SQLITE3_TEXT);
    $stmt->bindValue(':descricao', $descricao, SQLITE3_TEXT);
    $stmt->bindValue(':estilo_livro', $estilo_livro, SQLITE3_TEXT);
    $stmt->bindValue(':indicacao_idade', $indicacao_idade, SQLITE3_TEXT);
    $stmt->execute();
    $db->close();
}
inicializarBanco();
?>

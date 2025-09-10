<?php
require_once '../includes/db.php';  // Inclui o arquivo que contém a classe DB para conexão com o banco

class User {
    private $conn;
    
    public $nome;
    public $email;
    public $senha;

    // Construtor da classe que recebe a conexão do banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Cadastro do usuário
    public function register() {
        // Definir o SQL para inserção de dados na tabela 'usuarios'
        $query = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";

        // Preparar a declaração SQL
        $stmt = $this->conn->prepare($query);
        
        // Vincular os parâmetros de forma segura
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', password_hash($this->senha, PASSWORD_BCRYPT)); // Usar hash para a senha

        // Executar a declaração e retornar true se for bem-sucedido
        if ($stmt->execute()) {
            return true;
        }

        // Retorna false se a execução falhar
        return false;
    }

    // Login do usuário
    public function login() {
        // Verifique se a coluna 'id' está sendo recuperada da tabela
        $query = "SELECT id, nome, senha FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->senha, $user['senha'])) {
                return $user;  // Aqui você pode acessar o 'id' e outros dados
            }
        }
    
        return false;
    }
    
}

?>

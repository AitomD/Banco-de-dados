<?php
require_once 'db.php'; // Incluir a classe DB para usar a conexão com o banco

class User {
    private $conn;

    public $nome;
    public $email;
    public $senha;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Login do usuário
    public function login() {
        // Query SQL para buscar o usuário pelo email
        $query = "SELECT id, nome, senha FROM usuarios WHERE email = :email LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        // Verifica se o usuário foi encontrado no banco
        if ($stmt->rowCount() > 0) {
            // Usuário encontrado, agora verifica a senha
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verifica se a senha fornecida é igual à senha do banco
            if (password_verify($this->senha, $user['senha'])) {
                return $user;  // Retorna o usuário se as credenciais forem válidas
            }
        }

        return false;  // Caso as credenciais sejam inválidas
    }
}
?>

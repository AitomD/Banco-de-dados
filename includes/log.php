<?php
class User {
    private $conn;

    public $nome;
    public $email;
    public $senha;
    public $telefone;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Valida o telefone (somente números, 10 ou 11 dígitos)
    private function validarTelefone() {
        $numeros = preg_replace('/\D/', '', $this->telefone);
        return preg_match("/^\d{10,11}$/", $numeros);
    }

    // Cadastro do usuário e login automático
    public function register() {
        if (!$this->validarTelefone()) {
            return false; // Telefone inválido
        }

        try {
            $this->conn->beginTransaction();

            // Limpa telefone
            $telNumeros = preg_replace('/\D/', '', $this->telefone);

            // Verifica se o telefone já existe
            $stmtTel = $this->conn->prepare("SELECT id_telefone FROM telefone WHERE nm_telefone = :telefone LIMIT 1");
            $stmtTel->bindParam(':telefone', $telNumeros);
            $stmtTel->execute();

            if ($stmtTel->rowCount() > 0) {
                $idTelefone = (int)$stmtTel->fetchColumn();
            } else {
                // Insere novo telefone
                $stmtInsertTel = $this->conn->prepare("INSERT INTO telefone (nm_telefone) VALUES (:telefone)");
                $stmtInsertTel->bindParam(':telefone', $telNumeros);
                $stmtInsertTel->execute();
                $idTelefone = (int)$this->conn->lastInsertId();
            }

            // Verifica se o e-mail já existe
            $stmtCheck = $this->conn->prepare("SELECT id_usuario FROM usuario WHERE email = :email LIMIT 1");
            $stmtCheck->bindParam(':email', $this->email);
            $stmtCheck->execute();

            if ($stmtCheck->rowCount() > 0) {
                $this->conn->rollBack();
                return false; // E-mail já cadastrado
            }

            // Insere usuário
            $stmtUser = $this->conn->prepare(
                "INSERT INTO usuario (nome, email, senha, user_telefone) 
                 VALUES (:nome, :email, :senha, :telefone)"
            );
            $stmtUser->bindParam(':nome', $this->nome);
            $stmtUser->bindParam(':email', $this->email);
            $stmtUser->bindParam(':senha', password_hash($this->senha, PASSWORD_BCRYPT));
            $stmtUser->bindParam(':telefone', $idTelefone, PDO::PARAM_INT);
            $stmtUser->execute();
            $userId = (int)$this->conn->lastInsertId();

            $this->conn->commit();

            // Inicia sessão
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['id_usuario'] = $userId;
            $_SESSION['nome_usuario'] = $this->nome;

            return true;

        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    // Login do usuário
    public function login() {
        $stmt = $this->conn->prepare("SELECT id_usuario, nome, senha FROM usuario WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->senha, $user['senha'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['id_usuario'] = $user['id_usuario'];
                $_SESSION['nome_usuario'] = $user['nome'];
                return true;
            }
        }

        return false;
    }
}
?>

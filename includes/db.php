<?php
class DB {
    private $host = "localhost";       // Servidor do banco de dados
    private $db_name = "cadastro-login";  // Nome do banco de dados
    private $username = "root";         // Usuário do banco de dados
    private $password = "";             // Senha do banco de dados
    public $conn;

    // Método para estabelecer a conexão com o banco de dados
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Definir o modo de erro
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

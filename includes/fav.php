<?php
class Fav {
    private $conn;

    public $id_favorito;
    public $id_usuario;
    public $id_filme;
    public $poster; // Nova propriedade

    public function __construct($db) {
        $this->conn = $db;
    }

    // Adiciona um favorito, evitando duplicados
    public function add() {
        if ($this->existe()) {
            return false; // Já existe, não adiciona
        }

        $query = "INSERT INTO favorito (id_usuario, id_filme, poster) VALUES (:id_usuario, :id_filme, :poster)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_filme', $this->id_filme);
        $stmt->bindParam(':poster', $this->poster);

        if ($stmt->execute()) {
            $this->id_favorito = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // Remove um favorito pelo id do usuário e do filme
    public function remove() {
        $query = "DELETE FROM favorito WHERE id_usuario = :id_usuario AND id_filme = :id_filme";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_filme', $this->id_filme);

        return $stmt->execute();
    }

    // Lista todos os favoritos de um usuário
    public function listarPorUsuario($id_usuario) {
        $query = "SELECT * FROM favorito WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Verifica se o favorito já existe
    public function existe() {
        $query = "SELECT id_favorito FROM favorito WHERE id_usuario = :id_usuario AND id_filme = :id_filme LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_filme', $this->id_filme);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
?>

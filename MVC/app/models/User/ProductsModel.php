<?php 
require_once DB_;

class ProductsModel {
    protected $conn = null;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->db;
    }

    public function getAllProducts() {
        $query = "SELECT * FROM barang";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $query = "SELECT * FROM barang WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
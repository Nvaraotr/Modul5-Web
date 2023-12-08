<?php

namespace app\Models;

use app\Config\DatabaseConfig;
use mysqli;

class Medicine extends DatabaseConfig
{
    public $conn;

    public function __construct()
    {
        // CONNECT KE DATABASE MYSQL
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // PROSES MENAMPILKAN SEMUA DATA
    public function findAll()
    {
        $sql = "SELECT medicine.*, pharmacy.* FROM medicine JOIN pharmacy ON medicine.pharmacy_id = pharmacy.pharmacy_id";
        $result = $this->conn->query($sql);
        // $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // PROSES MENAMPILAN DATA DENGAN ID
    public function findById($id)
    {
        $sql = "SELECT medicine.*, pharmacy.* FROM medicine JOIN pharmacy ON medicine.pharmacy_id = pharmacy.pharmacy_id WHERE medicine_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // PROSES INSERT DATA
    public function create($data)
    {
        $pharmacyId = $data['pharmacy_id'];
        $medicineName = $data['medicine_name'];
        $medicinePrice = $data['medicine_price'];
        $query = "INSERT INTO medicine (pharmacy_id, medicine_name, medicine_price) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isi", $pharmacyId, $medicineName, $medicinePrice);
        $stmt->execute();
    }

    // PROSES UPDATE DATA DENGAN ID
    public function update($data, $id)
    {
        $pharmacyId = $data['pharmacy_id'];
        $medicineName = $data['medicine_name'];
        $medicinePrice = $data['medicine_price'];

        $query = "UPDATE medicine SET pharmacy_id = ?, medicine_name = ?, medicine_price = ? WHERE medicine_id = ?";
        $stmt = $this->conn->prepare($query);
        // huruf "s" berarti tipe parameter name adalah String dan huruf "i" berarti parameter id adalah integer
        $stmt->bind_param("isii", $pharmacyId, $medicineName, $medicinePrice, $id);
        $stmt->execute();
        $this->conn->close();
    }

    // PROSES DELETE DATA DENGAN ID
    public function destroy($id)
    {
        $query = "DELETE FROM medicine WHERE medicine_id = ?";
        $stmt = $this->conn->prepare($query);
        // huruf "i" berarti parameter pertama adalah integer
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }
}
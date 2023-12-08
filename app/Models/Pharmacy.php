<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Pharmacy extends DatabaseConfig
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
        $sql = "SELECT * FROM pharmacy";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // PROSES MENAMPILAN DATA DENGAN ID
    public function findById($id)
    {
        $sql = "SELECT * FROM pharmacy WHERE pharmacy_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // PROSES INSERT DATA
    public function create($data)
    {
        $pharmacyName = $data['pharmacy_name'];
        $pharmacyAddress = $data['pharmacy_address'];
        $query = 'INSERT INTO pharmacy (pharmacy_name, pharmacy_address) VALUES (?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $pharmacyName, $pharmacyAddress);
        $stmt->execute();
    }

    // PROSES UPDATE DATA DENGAN ID
    public function update($data, $id)
    {
        $pharmacyName = $data['pharmacy_name'];
        $pharmacyAddress = $data['pharmacy_address'];

        $query = "UPDATE pharmacy SET pharmacy_name = ?, pharmacy_address = ? WHERE pharmacy_id = ?";
        $stmt = $this->conn->prepare($query);
        // huruf "s" berarti tipe parameter name adalah String dan huruf "i" berarti parameter id adalah integer
        $stmt->bind_param("ssd", $pharmacyName, $pharmacyAddress, $id);
        $stmt->execute();
        $this->conn->close();
    }

    // PROSES DELETE DATA DENGAN ID
    public function destroy($id)
    {
        $query = "DELETE FROM pharmacy WHERE pharmacy_id = ?";
        $stmt = $this->conn->prepare($query);
        // huruf "i" berarti parameter pertama adalah integer
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }
}
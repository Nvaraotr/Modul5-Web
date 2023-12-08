<?php

namespace app\Controller;

include "app/Models/Pharmacy.php";
include "app/Traits/ApiResponseFormatter.php";

use app\Models\Pharmacy;
use app\Traits\ApiResponseFormatter;

class PharmacyController
{
    // PAKAI TRAIT YANG SUDAH DIBUAT
    use ApiResponseFormatter;

    public function index()
    {
        // DEFINISIKAN OBJECT MODEL PRODUCT YANG SUDAH DIBUAT
        $pharmacyModel = new Pharmacy();
        // PANGGIL FUNGSI GET ALL PRODUCT
        $response = $pharmacyModel->findAll();
        
        // RETURN $response DENGAN MELAKUKAN FORMATTING TERLEBIH DAHULU MENGGUNAKAN TRAIT YANG SUDAH DIPANGGIL
        var_dump($pharmacyModel);
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $pharmacyModel = new Pharmacy();
        $response = $pharmacyModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        // TANGKAP INPUT JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        // VALIDASI APAKAH INPUT VALID
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        // LANJUT JIKA TIDAK ERROR
        $pharmacyModel = new Pharmacy();
        $response = $pharmacyModel->create([
            'pharmacy_name' => $inputData['pharmacy_name'],
            'pharmacy_address' => $inputData['pharmacy_address'],
        ]);
        return $this->apiResponse(200, "success", $response);
    }

    public function update($id)
    {
        // TANGKAP INPUT JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        // VALIDASI APAKAH INPUT VALID
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        // LANJUT JIKA TIDAK ERROR
        $pharmacyModel = new Pharmacy();
        $response = $pharmacyModel->update([
            "pharmacy_name" => $inputData['pharmacy_name'], 
            'pharmacy_address' => $inputData['pharmacy_address'],
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $pharmacyModel = new Pharmacy();
        $response = $pharmacyModel->destroy($id);

        return $this->apiResponse(200, "success", $response);
    }
}
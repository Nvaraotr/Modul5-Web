<?php

namespace app\Controller;

include "app/Models/Medicine.php";

use app\Models\Medicine;
use app\Traits\ApiResponseFormatter;

class MedicineController
{
    // PAKAI TRAIT YANG SUDAH DIBUAT
    use ApiResponseFormatter;

    public function index()
    {
        $medicineModel = new Medicine();
        $response = $medicineModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $medicineModel = new Medicine();
        $response = $medicineModel->findById($id);
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
        $medicineModel = new Medicine();
        $response = $medicineModel->create([
            "pharmacy_id" => $inputData['pharmacy_id'],
            "medicine_name" => $inputData['medicine_name'],
            'medicine_price' => $inputData['medicine_price'],
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
        $medicineModel = new Medicine();
        $response = $medicineModel->update([
            "pharmacy_id" => $inputData['pharmacy_id'],
            "medicine_name" => $inputData['medicine_name'],
            'medicine_price' => $inputData['medicine_price'],
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $medicineModel = new Medicine();
        $response = $medicineModel->destroy($id);

        return $this->apiResponse(200, "success", $response);
    }
}
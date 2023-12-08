<?php

namespace app\Routes;

include "app/Controller/MedicineController.php";

use app\Controller\MedicineController;

class MedicineRoutes
{
    public function handle($method, $path)
    {
        // JIKA REQUEST METHOD GET DAN PATH SAMA DENGAN '/api/product'
        if ($method === 'GET' && $path === '/api/medicine') {
            $controller = new MedicineController();
            echo $controller->index();
        }

        // JIKA REQUEST METHOD GET DAN PATH MENGANDUNG '/api/product/'
        if ($method === 'GET' && strpos($path, '/api/medicine/') === 0) {
            // Extract ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new MedicineController();
            echo $controller->getById($id);
        }

        // JIKA REQUEST METHOD POST DAN PATH SAMA DENGAN '/api/product'
        if ($method === 'POST' && $path === '/api/medicine') {
            $controller = new MedicineController();
            echo $controller->insert();
        }

        // JIKA REQUEST METHOD PUT DAN PATH MENGANDUNG '/api/product/'
        if ($method === 'PUT' && strpos($path, '/api/medicine/') === 0) {
            // Extract ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new MedicineController();
            echo $controller->update($id);
        }

        // JIKA REQUEST METHOD DELETE DAN PATH MENGANDUNG '/api/product/'
        if ($method === 'DELETE' && strpos($path, '/api/medicine/') === 0) {
            // Extract ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new MedicineController();
            echo $controller->delete($id);
        }
    }
}
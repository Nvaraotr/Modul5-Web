<?php

namespace app\Routes;

include "app/Controller/PharmacyController.php";

use app\Controller\PharmacyController;

class PharmacyRoutes
{
    public function handle($method, $path)
    {
        // JIKA REQUEST METHOD GET DAN PATH SAMA DENGAN '/api/product'
        if ($method === 'GET' && $path === '/api/pharmacy') {
            $controller = new PharmacyController();
            echo $controller->index();
        }

        // JIKA REQUEST METHOD GET DAN PATH MENGANDUNG '/api/product/'
        if ($method === 'GET' && strpos($path, '/api/pharmacy/') === 0) {
            // Extract ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new PharmacyController();
            echo $controller->getById($id);
        }

        // JIKA REQUEST METHOD POST DAN PATH SAMA DENGAN '/api/product'
        if ($method === 'POST' && $path === '/api/pharmacy') {
            $controller = new PharmacyController();
            echo $controller->insert();
        }

        // JIKA REQUEST METHOD PUT DAN PATH MENGANDUNG '/api/product/'
        if ($method === 'PUT' && strpos($path, '/api/pharmacy/') === 0) {
            // Extract ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new PharmacyController();
            echo $controller->update($id);
        }

        // JIKA REQUEST METHOD DELETE DAN PATH MENGANDUNG '/api/product/'
        if ($method === 'DELETE' && strpos($path, '/api/pharmacy/') === 0) {
            // Extract ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new PharmacyController();
            echo $controller->delete($id);
        }
    }
}
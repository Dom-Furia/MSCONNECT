<?php
require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../controllers/UserController.php';

$database = new Database();
$db = $database->getConnection();

$controller = new UserController($db);
$method = $_SERVER['REQUEST_METHOD'];

function getRouteParts()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return explode('/', trim($uri, '/'));
};

switch ($method) {
    case 'GET':
        $parts = getRouteParts();
        $resource = $parts[0] ?? null;
        $id = $parts[1] ?? null;

        if ($resource === 'users' && $id) {
            $controller->getUserById($id);
        } elseif ($resource === 'users') {
            $controller->getUsers();
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Rota não encontrada."]);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $parts = getRouteParts();
        $resource = $parts[0] ?? null;

        if ($resource === 'users') {
            $controller->createUser($data);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Rota não encontrada."]);
        }
        
        break;

    case 'PATCH':
        $data = json_decode(file_get_contents("php://input"), true);
        $parts = getRouteParts();
        $resource = $parts[0] ?? null;
        $id = $parts[1] ?? null;

        if ($resource === 'users' && $id) {
            $controller->updateUser($id, $data);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Rota não encontrada."]);
        }
        
        
        break;

    case 'DELETE':
        $parts = getRouteParts();
        $resource = $parts[0] ?? null;
        $id = $parts[1] ?? null;

        if ($resource === 'users' && $id) {
            $controller->deleteUser($id);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Rota não encontrada."]);
        }
        
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido"]);
        break;
}

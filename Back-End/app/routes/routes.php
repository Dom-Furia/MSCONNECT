<?php
require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../controllers/UserController.php';

$database = new Database();
$db = $database->getConnection();

$controller = new UserController($db);
$method = $_SERVER['REQUEST_METHOD'];

function getRouteParts() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return explode('/', trim($uri, '/'));
};

switch ($method) {
    case 'GET':
        $controller->getUsers();
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->createUser($data);
        break;

    case 'PATCH':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = getRouteParts()[0] ?? null;
        var_dump($data);
        var_dump($id);
        $controller->updateUser($id, $data);
        break;

    case 'DELETE':
        $id = getRouteParts()[0] ?? null;
        $controller->deleteUser($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido"]);
        break;
}

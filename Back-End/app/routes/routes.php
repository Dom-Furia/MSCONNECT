<?php
require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../controllers/UserController.php';

$database = new Database();
$db = $database->getConnection();

$controller = new UserController($db);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $controller->getUsers();
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->createUser($data);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $controller->updateUser($data);
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        $controller->deleteUser($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método não permitido"]);
        break;
}
?>

<?php
require_once __DIR__ . '/../services/UserServices.php';

class UserController
{
    private $service;

    public function __construct($db)
    {
        $this->service = new UserService($db);
    }

    private function respond($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getUsers()
    {
        try {
            $users = $this->service->getAllUsers();
            $this->respond($users);
        } catch (Exception $e) {
            $this->respond(["error" => $e->getMessage()], 500);
        }
    }

    public function getUserById($id)
    {
        try {
            $user = $this->service->getUserById($id);
            $this->respond($user);
        } catch (Exception $e) {
            $this->respond(["error" => $e->getMessage()], 404);
        }
    }

    public function createUser($data)
    {
        try {
            $result = $this->service->createUser($data);
            $this->respond($result, 201);
        } catch (Exception $e) {
            $this->respond(["error" => $e->getMessage()], 400);
        }
    }



    public function updateUser($id, $data)
    {
        try {
            $result = $this->service->updateUser($id, $data);
            $this->respond($result);
        } catch (Exception $e) {
            $this->respond(['error' => $e->getMessage()], 400);
        }
    }


    public function deleteUser($id)
    {
        try {
            $result = $this->service->deleteUser($id);
            $this->respond($result);
        } catch (Exception $e) {
            $this->respond(["error" => $e->getMessage()], 400);
        }
    }
}

<?php

require_once __DIR__ . '/../models/User.php';

class UserService
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllUsers()
    {
        $user = new User($this->db);
        return $user->readAll()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($data)
    {
        $user = new User($this->db);

        // Sanitização
        $user->name = htmlspecialchars(trim($data['name'] ?? ''));
        $user->email = filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $user->fone = preg_replace('/\D/', '', $data['fone'] ?? '');

        // Validação
        if (empty($user->name) || !$user->email) {
            throw new Exception("Nome e email são obrigatórios.");
        }

        if ($user->existsByEmail($user->email)) {
            throw new Exception("Usuario já cadastrado.");
        }

        if (!$user->create()) {
            throw new Exception("Falha ao criar usuário.");
        }

        return ["message" => "Usuário criado com sucesso."];
    }

    public function updateUser($id, $data)
    {
        $user = new User($this->db);
        $user->id = $id;

        $existing = $user->findById($id);
        if (!$existing) {
            throw new Exception("Usuário não encontrado.");
        }

        var_dump($existing);

        // Atualiza apenas os campos enviados
        $user->name = isset($data['name']) ? htmlspecialchars(trim($data['name'])) : $existing['name'];
        $user->email = isset($data['email']) ? filter_var($data['email'], FILTER_VALIDATE_EMAIL) : $existing['email'];
        $user->fone = isset($data['fone']) ? preg_replace('/\D/', '', $data['fone']) : $existing['phone'];

        if (!$user->update()) {
            throw new Exception("Falha ao atualizar o usuário.");
        }

        return ["message" => "Usuário atualizado com sucesso."];
    }


    public function deleteUser($id)
    {
        $user = new User($this->db);

        if (!$user->findById($id)) {
            throw new Exception("Usuário não encontrado.");
        }

        $user->id = $id;

        if (!$user->delete()) {
            throw new Exception("Falha ao excluir usuário.");
        }

        return ["message" => "Usuário excluído com sucesso."];
    }
}

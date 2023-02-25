<?php

namespace App\DAO;

class UsuarioDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuarioData($login, $senha): array
    {
        $query = "SELECT login,nome,email,permissao from users u
        inner join user_data ud on ud.user_id = u.user_id
        where login = :login and senha = :senha";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            "login" => $login,
            "senha" => $senha
        ]);
        return $statement->fetchAll(\PDO::FETCH_ASSOC) ?? [];
        
    }

}
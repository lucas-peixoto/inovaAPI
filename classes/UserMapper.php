<?php

class UserMapper extends Mapper
{

    public function getUsers($return_type = 'OBJECT') {
        $sql = "SELECT id, nome, nivel, username
        from usuarios";

        $stmt = $this->db->query($sql);
        $results = [];

        if ($return_type == 'OBJECT') {
            while($row = $stmt->fetch()) {
                $results[] = new UserEntity($row);
            }
        } else if ($return_type == 'ARRAY') {
            while($row = $stmt->fetch()) {
                $results[] = $row;
            }
        }

        return $results;
    }

    /**
    * Get one ticket by its ID
    *
    * @param int $ticket_id The ID of the ticket
    * @return TicketEntity  The ticket
    */
    public function getUserById($user_id, $return_type = 'OBJECT') {
        $sql = "SELECT id, nome, nivel, username
        from usuarios
        where id = :user_id";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["user_id" => $user_id]);

        if($result) {
            if ($return_type == 'OBJECT') {
                return new UserEntity($stmt->fetch());
            } else if ($return_type == 'ARRAY') {
                return $stmt->fetch();
            }
        }
    }

    public function getUserByCredentials($username, $password, $return_type = 'OBJECT') {
        $sql = "SELECT id, nome, nivel, username, password, token
        from usuarios
        where username = :username and password = :password";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["username" => $username, "password" => md5($password)]);
        $data = $stmt->fetch();

        if($data) {
            if ($return_type == 'OBJECT') {
                return new UserEntity($data);
            } else if ($return_type == 'ARRAY') {
                return $data;
            }
        } else {
            return false;
        }
    }

    public function checkToken($token) {
        $sql = "SELECT id
        from usuarios
        where token = :token";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["token" => $token]);

        $row = $stmt->fetch();

        if ($row === false) {
            return false;
        } else {
            return true;
        }
    }

    public function createToken($user) {
        return md5( $user->getNome() . $user->getUsername() );
    }

    public function save(UserEntity $user) {
        $sql = "INSERT into usuarios
            (nome, nivel, username, password, token) values
            (:nome, :nivel, :username, :password, :token)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "nome" => $user->getNome(),
            "nivel" => $user->getNivel(),
            "username" => $user->getUsername(),
            "password" => md5($user->getPassword()),
            "token" => $this->createToken($user)
        ]);

        if(!$result) {
            throw new Exception("Os dados não puderam ser salvos - UserMapper:102");
        }
    }
}

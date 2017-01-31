<?php

class UserMapper extends Mapper
{

    public function getUsers($return_type = 'OBJECT') {
        $sql = "SELECT id, nome, nivel, username, password
        from users";

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
        $sql = "SELECT id, nome, nivel, username, password
        from users
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
        from users
        where username = :username and password = :password";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["username" => $username, "password" => $password]);

        if($result) {
            if ($return_type == 'OBJECT') {
                return new UserEntity($stmt->fetch());
            } else if ($return_type == 'ARRAY') {
                return $stmt->fetch();
            }
        } else {
            return false;
        }
    }

    public function save(UserEntity $user) {
        $sql = "INSERT into users
            (nome, nivel, username, password) values
            (:nome, :nivel, :username, :password)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "nome" => $user->getNome(),
            "nivel" => $user->getNivel(),
            "username" => $user->getUsername(),
            "password" => $user->getPassword(),
            "token" => $user->getCurso()
        ]);

        if(!$result) {
            throw new Exception("Os dados não puderam ser salvos - UserMapper:53");
        }
    }
}

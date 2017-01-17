<?php

class CursoMapper extends Mapper
{

    public function checkName($nome) {
        $sql = "SELECT id
        FROM cursos WHERE nome = :nome";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["nome" => $nome]);

        $row = $stmt->fetch();

        if ($row === false) {
            return -1;
        } else {
            return 1;
        }
    }

    public function getCursos() {
        $sql = "SELECT id, nome FROM cursos";
        $stmt = $this->db->query($sql);
        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = new CursoEntity($row);
        }

        return $results;
    }

    public function getCursoById($id) {
        $sql = "SELECT id, nome
        from cursos where id = :curso_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["curso_id" => $id]);

        return new CursoEntity($stmt->fetch());
    }

    public function save(CursoEntity $curso) {
        $sql = "INSERT into cursos
        (nome) values (:nome)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["nome" => $curso->getNome()]);

        if(!$result) {
            throw new Exception("Os dados não puderam ser salvos - CursoMapper:52");
        }
    }
}

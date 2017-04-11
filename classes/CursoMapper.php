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

    public function getCursos($return_type = 'OBJECT') {
        $sql = "SELECT c.id, c.nome, c.descricao, COUNT(a.id) as total_alunos
            FROM cursos c
            LEFT JOIN alunos a ON a.curso_id = c.id GROUP BY c.id ORDER BY total_alunos DESC";

        $stmt = $this->db->query($sql);
        $results = [];

        if ($return_type == 'OBJECT') {
            while($row = $stmt->fetch()) {
                $results[] = new CursoEntity($row);
            }
        } else if ($return_type == 'ARRAY') {
            while($row = $stmt->fetch()) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function getCursoById($curso_id, $return_type = 'OBJECT') {
        $sql = "SELECT id, nome, descricao,
        	(SELECT COUNT(*) FROM alunos WHERE curso_id = :curso_id) as total_alunos
          FROM cursos WHERE id = :curso_id";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["curso_id" => $curso_id]);

        if($result) {
            if ($return_type == 'OBJECT') {
                return new CursoEntity($stmt->fetch());
            } else if ($return_type == 'ARRAY') {
                return $stmt->fetch();
            }
        }
    }

    public function getCursoByName($curso_nome, $return_type = 'OBJECT') {
        $sql = "SELECT id, nome, descricao
            FROM cursos WHERE nome = :curso_nome";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["curso_nome" => $curso_nome]);

        if($result) {
            if ($return_type == 'OBJECT') {
                return new CursoEntity($stmt->fetch());
            } else if ($return_type == 'ARRAY') {
                return $stmt->fetch();
            }
        }
    }

    public function save(CursoEntity $curso) {
        $sql = "INSERT into cursos
        (nome, descricao) values (:nome, :descricao)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["nome" => $curso->getNome(), "descricao" => $curso->getDescricao()]);

        if(!$result) {
            throw new Exception("Os dados não puderam ser salvos - CursoMapper:52");
        }
    }
}

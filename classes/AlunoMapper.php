<?php

class AlunoMapper extends Mapper
{

    public function getAlunos($return_type = 'OBJECT') {
        $sql = "SELECT a.id, a.nome, a.email, a.telefone, c.nome as curso, a.turno
        from alunos a
        join cursos c on (c.id = a.curso_id)";

        $stmt = $this->db->query($sql);
        $results = [];

        if ($return_type == 'OBJECT') {
            while($row = $stmt->fetch()) {
                $results[] = new AlunoEntity($row);
            }
        } else if ($return_type == 'ARRAY') {
            while($row = $stmt->fetch()) {
                $results[] = $row;
            }
        }

        return $results;
    }

    public function getAlunosByCurso($curso_id, $return_type = 'OBJECT') {
        $sql = "SELECT id, nome, email, telefone, turno
            FROM alunos WHERE curso_id = :curso_id ORDER BY turno";

        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute(["curso_id" => $curso_id]);

        $results = [];

        if($res) {
            if ($return_type == 'OBJECT') {
                while($row = $stmt->fetch()) {
                    $results[] = new AlunoEntity($stmt->fetch());;
                }
            } else if ($return_type == 'ARRAY') {
                while($row = $stmt->fetch()) {
                    $results[] = $row;
                }
            }

            return $results;
        }

        return false;
    }

    public function getAlunoById($aluno_id, $return_type = 'OBJECT') {
        $sql = "SELECT a.id, a.nome, a.email, a.telefone, c.nome as curso, a.turno
        from alunos a join cursos c on (c.id = a.curso_id)
        where a.id = :aluno_id";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["aluno_id" => $aluno_id]);

        if($result) {
            if ($return_type == 'OBJECT') {
                return new AlunoEntity($stmt->fetch());
            } else if ($return_type == 'ARRAY') {
                return $stmt->fetch();
            }
        }
    }

    public function save(AlunoEntity $aluno) {
        $sql = "INSERT into alunos
            (nome, cpf, email, telefone, curso_id, turno, endereco_id) values
            (:nome, :cpf, :email, :telefone,
            (select id from cursos where nome = :curso), :turno, :endereco)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "nome" => $aluno->getNome(),
            "cpf" => $aluno->getCpf(),
            "email" => $aluno->getEmail(),
            "telefone" => $aluno->getTelefone(),
            "curso" => $aluno->getCurso(),
            "turno" => $aluno->getTurno(),
            "endereco" => $aluno->getEndereco()
        ]);

        if(!$result) {
            throw new Exception("Os dados não puderam ser salvos - AlunoMapper:53");
        }
    }
}

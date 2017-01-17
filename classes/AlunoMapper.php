<?php

class AlunoMapper extends Mapper
{
  
  public function getAlunos() {
    $sql = "SELECT a.id, a.nome, a.turno, a.email, c.nome
    from alunos a
    join cursos c on (c.id = a.curso_id)";

    $stmt = $this->db->query($sql);
    $results = [];

    while($row = $stmt->fetch()) {
      $results[] = new AlunoEntity($row);
    }
    return $results;
  }

  /**
  * Get one ticket by its ID
  *
  * @param int $ticket_id The ID of the ticket
  * @return TicketEntity  The ticket
  */
  public function getAlunoById($aluno_id) {
    $sql = "SELECT a.id, a.nome, a.turno, a.email, c.nome
    from alunos a join cursos c on (c.id = a.curso_id)
    where a.id = :aluno_id";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["aluno_id" => $aluno_id]);

    if($result) {
      return new AlunoEntity($stmt->fetch());
    }
  }

  public function save(AlunoEntity $aluno) {
    $sql = "INSERT into alunos
    (nome, turno, email, curso_id) values
    (:nome, :turno, :email,
    (select id from cursos where nome = :curso))";

    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
      "nome" => $ticket->getNome(),
      "turno" => $ticket->getTurno(),
      "email" => $ticket->getEmail(),
      "curso" => $ticket->getCurso()
    ]);

    if(!$result) {
      throw new Exception("Os dados não puderam ser salvos - AlunoMapper:53");
    }
  }
}

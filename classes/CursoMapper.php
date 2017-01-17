<?php

class CursoMapper extends Mapper
{

    public function getCursos() {
        $sql = "SELECT id, nome FROM cursos";
        $stmt = $this->db->query($sql);
        $results = [];
        
        while($row = $stmt->fetch()) {
            $results[] = new ComponentEntity($row);
        }

        return $results;
    }

    public function getComponentById($id) {
        $sql = "SELECT id, component
            from components where id = :component_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["component_id" => $id]);

        return new ComponentEntity($stmt->fetch());
    }
}

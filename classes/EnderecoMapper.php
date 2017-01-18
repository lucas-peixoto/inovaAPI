<?php

class EnderecoMapper extends Mapper
{

    public function getEnderecos() {
        $sql = "SELECT id, rua, numero, bairro, cidade, estado, cep FROM enderecos";
        $stmt = $this->db->query($sql);
        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = new EnderecoEntity($row);
        }

        return $results;
    }

    public function getEnderecoById($id) {
        $sql = "SELECT id, rua, numero, bairro, cidade, estado, cep
        from enderecos where id = :endereco_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["endereco_id" => $id]);

        return new EnderecoEntity($stmt->fetch());
    }

    public function save(EnderecoEntity $endereco) {
        $sql = "INSERT into enderecos
        (rua, numero, bairro, cidade, estado, cep)
        values (:rua, :numero, :bairro, :cidade, :estado, :cep)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "rua" => $endereco->getRua(),
            "numero" => $endereco->getNumero(),
            "bairro" => $endereco->getBairro(),
            "cidade" => $endereco->getCidade(),
            "estado" => $endereco->getEstado(),
            "cep" => $endereco->getCep()
        ]);

        if(!$result) {
            throw new Exception("Os dados não puderam ser salvos - EnderecoMapper:44");
        }

        return $this->db->lastInsertId();;
    }
}

<?php

class AlunoEntity
{

    protected $id;
    protected $nome;
    protected $cpf;
    protected $email;
    protected $telefone;
    protected $curso;
    protected $turno;
    protected $endereco;

    /**
     * Accept an array of data matching properties of this class
     * and create the class
     *
     * @param array $data The data to use to create
     */
    public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['id'])) {
            $this->id = $data['id'];
        }

        $this->nome = $data['nome'];

        if(isset($data['cpf'])) {
            $this->cpf = $data['cpf'];
        }

        $this->email = $data['email'];
        $this->telefone = $data['telefone'];
        $this->curso = $data['curso'];
        $this->turno = $data['turno'];

        if(isset($data['endereco_id'])) {
            $this->endereco = $data['endereco_id'];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function getEndereco() {
        return $this->endereco;
    }

}

<?php

class AlunoEntity
{

    protected $id;
    protected $nome;
    protected $cpf;
    protected $email;
    protected $telefone;
    protected $curso;

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

        if(isset($data['curso'])) {
            $this->curso = $data['curso'];
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

}

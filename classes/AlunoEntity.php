<?php

class AlunoEntity
{

    protected $id;
    protected $nome;
    protected $turno;
    protected $email;
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
        $this->turno = $data['turno'];
        $this->email = $data['email'];
        $this->curso = $data['curso'];
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCurso() {
        return $this->curso;
    }

}

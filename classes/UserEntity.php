<?php

class AlunoEntity
{

    protected $id;
    protected $nome;
    protected $nivel;
    protected $username;
    protected $password;
    protected $token;

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
            $this->password = $data['password'];
            $this->token = $data['token'];
        }

        $this->nome = $data['nome'];
        $this->nivel = $data['nivel'];
        $this->username = $data['username'];
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getToken() {
        return $this->token;
    }

}

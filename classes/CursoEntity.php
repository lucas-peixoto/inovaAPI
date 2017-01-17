<?php

class CursoEntity
{
    protected $id;
    protected $nome;

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

      $this->name = $data['nome'];
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
}

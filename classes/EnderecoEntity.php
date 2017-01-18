<?php

class EnderecoEntity
{
    protected $id;
    protected $rua;
    protected $numero;
    protected $bairro;
    protected $cidade;
    protected $estado;
    protected $cep;

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

      $this->rua = $data['rua'];
      $this->numero = $data['numero'];
      $this->bairro = $data['bairro'];
      $this->cidade = $data['cidade'];
      $this->estado = $data['estado'];
      $this->cep = $data['cep'];
    }

    public function getId() {
        return $this->id;
    }

    public function getRua() {
        return $this->rua;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCep() {
        return $this->cep;
    }

    public function toString() {
        return "{$this->rua}, n {$this->numero}, {$this->bairro} {$this->cidade} {$this->cep}";
    }

}

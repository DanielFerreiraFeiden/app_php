<?php

class Produtos
{
    private $id;
    private $nome;
    private $descricao;
    private $codigo_barras;
    private $qtde_estoque;
    private $ativo;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setnome($nome)
    {
        $this->id = $nome;
    }

    public function getnome()
    {
        return $this->nome;
    }

    public function setdescricao($descricao)
    {
        $this->id = $descricao;
    }

    public function getdescricao()
    {
        return $this->descricao;
    }

    public function setcodigo_barras($codigo_barras)
    {
        $this->id = $codigo_barras;
    }

    public function getcodigo_barras()
    {
        return $this->codigo_barras;
    }

    public function setqtde_estoque($qtde_estoque)
    {
        $this->id = $qtde_estoque;
    }

    public function getqtde_estoque()
    {
        return $this->qtde_estoque;
    }

    public function setativo($ativo)
    {
        $this->id = $ativo;
    }

    public function getativo()
    {
        return $this->ativo;
    }
}

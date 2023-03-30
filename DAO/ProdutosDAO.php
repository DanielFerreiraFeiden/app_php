<?php

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . './classes/produtos.class.php');

class ProdutosDAO
{
    public function inserirProduto(Produtos $produtos)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, codigo_barras, qtde_estoque, ativo) VALUES (:nome, :descricao, :codigo_barras, :qtde_estoque, :ativo)");
            $stmt->bindValue(":nome", $produtos->getNome());
            $stmt->bindValue(":descricao", $produtos->getdescricao());
            $stmt->bindValue(":codigo_barras", $produtos->getcodigo_barras());
            $stmt->bindValue(":qtde_estoque", $produtos->getqtde_estoque());
            $stmt->bindValue(":ativo", $produtos->getativo());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao inserir produto: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function buscarProduto($id)
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id;");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $produtos = new Produtos();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $produtos->setId($rs->id);
                $produtos->setNome(($rs->nome));
                $produtos->setdescricao($rs->descricao);
                $produtos->setcodigo_barras($rs->codigo_barras);
                $produtos->setqtde_estoque($rs->qtde_estoque);
                $produtos->setativo($rs->ativo);
            }
            return $produtos;
        } catch (PDOException $ex) {
            echo "Erro ao buscar produto " . $ex->getMessage();
            die();
        }
    }

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM produtos;");
            $stmt->execute();
            $produtos = new Produtos();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $produtos->setId($rs->id);
                $produtos->setNome(($rs->nome));
                $produtos->setdescricao($rs->descricao);
                $produtos->setcodigo_barras($rs->codigo_barras);
                $produtos->setqtde_estoque($rs->qtde_estoque);
                $produtos->setativo($rs->ativo);
                $retorno[]= clone $produtos;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar produto " . $ex->getMessage();
            die();
        }
    }

    public function atualizaProdutos(Produtos $produtos)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE produtos SET id ='', :nome ='', descricao ='', codigo_barras ='', qtde_estoque ='', ativo ='' WHERE id = :id");
            $stmt->bindValue(":nome", $produtos->getnome());
            $stmt->bindValue(":descricao", $produtos->getdescricao());
            $stmt->bindValue(":codigo_barras", $produtos->getcodigo_barras());
            $stmt->bindValue(":qtde_estoque", $produtos->getqtde_estoque());
            $stmt->bindValue(":ativo", $produtos->getativo());
            $stmt->bindValue(":id", $produtos->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            $pdo->rollBack();
            echo "Erro ao atualizar produto: " . $ex->getMessage();
            die();
        }
    }

    public function removeProduto($id)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir produto: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }
}

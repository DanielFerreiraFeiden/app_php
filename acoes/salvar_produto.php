<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/cliente.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/cliente.controller.php");

$produto = new Produtos();

if (isset($_POST) && isset($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $descricao  = addslashes(filter_input(INPUT_POST, 'descricao'));
    $codigo_barras   = addslashes(filter_input(INPUT_POST, 'codigo_barras'));
    $qtde_estoque   = addslashes(filter_input(INPUT_POST, 'qtde_estoque'));
    $ativo   = addslashes(filter_input(INPUT_POST, 'ativo'));

    if (empty($nome) || empty($codigo_barras)) {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e Codigo de barras";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_produtos.php?key=' . $id);
        die();
    }
    $produto->setid($id);
    $produto->setnome($nome);
    $produto->setdescricao($descricao);
    $produto->setcodigo_barras($codigo_barras);
    $produto->setqtde_estoque($qtde_estoque);
    $produto->setativo($ativo);

    $DAO = new ProdutosDAO();
    $resultado = $DAO->atualizaProdutos($produto);

    if ($resultado) {
        $_SESSION['mensagem'] = "Produto atualizado com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar produto";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_produto.php');
} else {

    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $cpfcnpj = isset($_POST['cpfcnpj']) ? $_POST['cpfcnpj'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;

    if ($nome && $codigo_barras) {

        $produto->setnome($nome);
        $produto->setdescricao($descricao);
        $produto->setcodigo_barras($codigo_barras);
        $produto->setqtde_estoque($qtde_estoque);
        $produto->setativo($ativo);

        $dao = new ProdutosDAO();
        $resultado = $dao->inserirProduto($produto);
        if ($resultado) {
            $_SESSION['mensagem'] = "Produto criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar produto";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e Codigo de Barras";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_cliente.php');
}

<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "./classes/produtos.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "./DAO/ProdutosDAO.php");

$produto = new Produtos();

if (isset($_GET) && isset($_GET['id'])) {
    $id = addslashes(filter_input(INPUT_GET, 'id'));

    $dao = new ProdutosDAO();
    $resultado = $dao->removeProduto($id);
    if ($resultado) {
        $_SESSION['mensagem'] = "Produto excluido com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir produto";
        $_SESSION['sucesso'] = false;
    }
}
header('Location:../public/home.php');
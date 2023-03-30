<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/cliente.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/cliente.controller.php");

$cliente = new Cliente();

if (isset($_GET) && isset($_GET['id'])) {
    $id = addslashes(filter_input(INPUT_GET, 'id'));

    $dao = new ClienteController();
    $resultado = $dao->removeCliente($id);
    if ($resultado) {
        $_SESSION['mensagem'] = "Excluido com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir";
        $_SESSION['sucesso'] = false;
    }
}
header('Location:../public/home.php');
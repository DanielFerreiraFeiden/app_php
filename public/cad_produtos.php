<?php
require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) ."./classes/produtos.class.php");

$produtos = new Produtos();

if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new ClienteController();
    $cliente = $controller->buscarPorId($id);
}

?>

<div class="container">

<form>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $produtos->getNome() ?>">
            <input type="hidden" name="id" value="<?= $produtos->getId(); ?>">
        </div>
        <div class="mb-3">
            <label for="cpfcnpj" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $produtos->getdescricao() ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Codigo Barras</label>
            <input type="number" class="form-control" id="codigo_barras" name="codigo_barras" value="<?= $produtos->getcodigo_barras() ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Quantidade Estoque</label>
            <input type="number" class="form-control" id="qtde_estoque" name="qtde_estoque" value="<?= $produtos->getqtde_estoque() ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Ativo</label>
            <input type="text" class="form-control" id="ativo" name="ativo" value="<?= $produtos->getativo() ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    <?php
    if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == TRUE) {
    ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php
    }
    if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == false) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php
    }
    unset($_SESSION['sucesso'], $_SESSION['mensagem']);
    ?>

</div>
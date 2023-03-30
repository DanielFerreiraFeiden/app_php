<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/DAO/ProdutosDAO.php');
$DAO = new ProdutosDAO();
$produto = $DAO->buscarTodos();

?>
<div class="container">
    <?php require_once('nav.php'); ?>

    <h1>Lista de Clientes</h1>
    <a class="btn btn-primary" href="cad_produtos.php">Novo Produto</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Codigo Barras</th>
                <th scope="col">Quantidade Produtos</th>
                <th scope="col">Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($produto as $c) :
            ?>
                <tr>
                    <td><?= $c->getid(); ?></td>
                    <td><?= $c->getnome(); ?></td>
                    <td><?= $c->getdescricao(); ?></td>
                    <td><?= $c->getcodigo_barras(); ?></td>
                    <td><?= $c->getqtde_estoque(); ?></td>
                    <td><?= $c->getativo(); ?></td>
                    <td>
                        <a class="btn btn-light" href="cad_produtos.php?key=<?=$c->getId()?>">Editar</a>
                        <a class="btn btn-light" href="../acoes/excluir_produto.php?id=<?=$c->getId()?>">Excluir</a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>



</div>

<?php
require_once('./footer.php');
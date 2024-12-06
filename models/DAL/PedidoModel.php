<?php
    require_once 'Conexao.php';

    class PedidoDAO {
        public function getPedidos() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM pedido;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($pedidos as &$pedido) {
                $pedido = new PedidoModel(
                    $pedido['idPedido'],
                    $pedido['idUsuario'],
                    $pedido['statusPedido'],
                    $pedido['valorTotalPedido'],
                    $pedido['obsPedido']
                );
            }

            return $pedidos;
        }

        public function createPedido(PedidoModel $pedido) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO pedido (idUsuario, statusPedido, valorTotalPedido, observacoesPedido) VALUES (:idUsuario, :statusPedido, :valorTotalPedido, :observacoesPedido);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idUsuario', $pedido->idUsuario);
            $stmt->bindValue(':statusPedido', $pedido->statusPedido);
            $stmt->bindValue(':valorTotalPedido', $pedido->valorTotalPedido);
            $stmt->bindValue(':observacoesPedido', $pedido->obsPedido);

            return $stmt->execute();
        }

    }
?>
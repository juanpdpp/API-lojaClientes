<?php
    require_once 'DAL/PedidoDAO.php';

    class PedidoModel {
        public ?int $idPedido;
        public ?int $idUsuario;
        public ?string $statusPedido;
        public ?float $valorTotalPedido;
        public ?string $obsPedido;
    
        public function __construct(
            ?int $idPedido = null,
            ?int $idUsuario = null,
            ?string $statusPedido = null,
            ?float $valorTotalPedido = null,
            ?string $obsPedido = null
        ) {
            $this->idPedido = $idPedido;
            $this->idUsuario = $idUsuario;
            $this->statusPedido = $statusPedido;
            $this->valorTotalPedido = $valorTotalPedido;
            $this->obsPedido = $obsPedido;
        }
    
        public function getPedidos() {
            $pedidoDAO = new PedidoDAO();

            $pedidos = $pedidoDAO->getPedidos();

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

        public function create() {
            $pedidoDAO = new PedidoDAO();

            return $pedidoDAO->createPedido($this);
        }
    }
?>
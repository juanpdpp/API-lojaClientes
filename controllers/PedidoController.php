<?php
    require_once './models/PedidoModel.php';

    class PedidoController {
        public function getPedidos(int $idCliente) {
            $pedidoModel = new PedidoModel();

            $pedidos = $pedidoModel->getPedidos();

            return json_encode([
                'error' => null,
                'result' => $pedidos
            ]);
        }

        public function createPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idCliente']))
                return $this->mostrarErro('Você deve informar o id do usuario');

        
            $pedido = new PedidoModel(
                null,
                $dados['idPedido'],
                $dados['idCliente'],
                $dados['statusPedido'],
                $dados['valorTotalPedido'],
                $dados['obsPedido'],
            );

            $pedido->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }
?>
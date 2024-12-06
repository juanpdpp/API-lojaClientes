<?php
    require_once './models/ClienteModel.php';

    class ClienteController {
        public function getClientes() {
            $clienteModel = new ClienteModel();

            $clientes = $clienteModel->getClientes();

            return json_encode([
                'error' => null,
                'result' => $clientes
            ]);
        }

        public function createCliente() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['nomeCliente']))
                return $this->mostrarErro('Você deve informar o nomeCliente!');

            if (empty($dados['sobrenomeCliente']))
                return $this->mostrarErro('Você deve informar o sobrenomeCliente!');

            if (empty($dados['emailCliente']))
                return $this->mostrarErro('Você deve informar o emailCliente!');
                
        
            $cliente = new ClienteModel(
                null,
                $dados['nomeCliente'],
                $dados['sobrenomeCliente'],
                $dados['emailCliente'],
                $dados['telefoneCliente'],
                $dados['enderecoCliente'],
                $dados['cidadeCliente'],
                $dados['estadoCliente'],
                $dados['cepCliente']
            );

            $cliente->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updateCliente() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idCliente']))
                return $this->mostrarErro('Você deve informar o idCliente!');

            if (empty($dados['nomeCliente']))
                return $this->mostrarErro('Você deve informar o nomeCliente!');

            if (empty($dados['sobrenomeCliente']))
                return $this->mostrarErro('Você deve informar o sobrenomeCliente!');

            if (empty($dados['emailCliente']))
                return $this->mostrarErro('Você deve informar o emailCliente!');
        
            $cliente = new ClienteModel(
                $dados['idCliente'],
                $dados['nomeCliente'],
                $dados['sobrenomeCliente'],
                $dados['emailCliente'],
                $dados['telefoneCliente'],
                $dados['enderecoCliente'],
                $dados['cidadeCliente'],
                $dados['estadoCliente'],
                $dados['cepCliente']
            );

            $cliente->update();

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
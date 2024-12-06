<?php
    require_once 'DAL/ClienteDAO.php';

    class ClienteModel {
        public ?int $idCliente;
        public ?string $nomeCliente;
        public ?string $sobrenomeCliente;
        public ?string $emailCliente;
        public ?string $telefoneCliente;
        public ?string $enderecoCliente;
        public ?string $cidadeCliente;
        public ?string $estadoCliente;
        public ?int $cepCliente;
    
        public function __construct(
            ?int $idCliente = null,
            ?string $nomeCliente = null,
            ?string $sobrenomeCliente = null,
            ?string $emailCliente = null,
            ?string $telefoneCliente = null,
            ?string $enderecoCliente = null,
            ?string $cidadeCliente = null,
            ?string $estadoCliente = null,
            ?int $cepCliente = null,
        ) {
            $this->idCliente = $idCliente;
            $this->nomeCliente = $nomeCliente;
            $this->sobrenomeCliente = $sobrenomeCliente;
            $this->emailCliente = $emailCliente;
            $this->telefoneCliente = $telefoneCliente;
            $this->enderecoCliente = $enderecoCliente;
            $this->cidadeCliente = $cidadeCliente;
            $this->estadoCliente = $estadoCliente;
            $this->cepCliente = $cepCliente;
        }

        public function getClientes() {
            $clienteDAO = new ClienteDAO();

            $clientes = $clienteDAO->getClientes();

            foreach ($clientes as &$cliente) {
                $cliente = new ClienteModel(
                    $cliente['idCliente'],
                    $cliente['nomeCliente'],
                    $cliente['sobrenomeCliente'],
                    $cliente['emailCliente'],
                    $cliente['telefoneCliente'],
                    $cliente['enderecoCliente'],
                    $cliente['cidadeCliente'],
                    $cliente['estadoCliente'],
                    $cliente['cepCliente']

                );
            }
            

            return $clientes;
        }

        public function create() {
            $clienteDAO = new ClienteDAO();

            return $clienteDAO->createCliente($this);
        }

        public function update() {
            $clienteDAO = new ClienteDAO();

            return $clienteDAO->updateCliente($this);
        }
    }
?>
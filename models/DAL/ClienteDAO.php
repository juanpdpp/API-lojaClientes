<?php
    require_once 'Conexao.php';

    class ClienteDAO {
        public function getClientes() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM cliente;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createCliente(ClienteModel $cliente) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO cliente VALUES (:id, :nome, :sobrenome, :email, :telefone, :endereco, :cidade, :estado, :cep);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':nome', $cliente->nomeCliente);
            $stmt->bindValue(':sobrenome', $cliente->sobrenomeCliente);
            $stmt->bindValue(':email', $cliente->emailCliente);
            $stmt->bindValue(':telefone', $cliente->telefoneCliente);
            $stmt->bindValue(':cidade', $cliente->cidadeCliente);
            $stmt->bindValue(':estado', $cliente->estadoCliente);
            $stmt->bindValue(':cep', $cliente->cepCliente);

            return $stmt->execute();
        }

        public function updateCliente(ClienteModel $cliente) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE cliente SET nomeCliente = :nome, sobrenomeCliente = :sobrenome, emailCliente = :email, telefoneCliente = :telefone, enderecoCliente = :endereco, cidadeCliente = :cidade, estadoCliente = :estado, cepCliente = :cep WHERE idCliente = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $cliente->idCliente);
            $stmt->bindValue(':nome', $cliente->nomeCliente);
            $stmt->bindValue(':sobrenome', $cliente->sobrenomeCliente);
            $stmt->bindValue(':email', $cliente->emailCliente);
            $stmt->bindValue(':telefone', $cliente->telefoneCliente);
            $stmt->bindValue(':cidade', $cliente->cidadeCliente);
            $stmt->bindValue(':estado', $cliente->estadoCliente);
            $stmt->bindValue(':cep', $cliente->cepCliente);

            return $stmt->execute();
        }
    }
?>
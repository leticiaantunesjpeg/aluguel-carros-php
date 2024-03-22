<?php
class VeiculoService
{
    private $conexao;
    private $veiculo;

    public function __construct(Conexao $conexao, Veiculo $veiculo)
    {
        $this->conexao = $conexao->conectar();
        $this->veiculo = $veiculo;
    }

    public function inserir()
    {
        $query = 'INSERT INTO veiculo(marca, modelo, placa, valor, disponibilidade, imagem) VALUES (:marca, :modelo, :placa, :valor, :disponibilidade, :imagem)';
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':marca', $this->veiculo->__get('marca'));
        $stmt->bindValue(':modelo', $this->veiculo->__get('modelo'));
        $stmt->bindValue(':placa', $this->veiculo->__get('placa'));
        $stmt->bindValue(':valor', $this->veiculo->__get('valor'));
        $stmt->bindValue(':disponibilidade', $this->veiculo->__get('disponibilidade'));
        $stmt->bindValue(':imagem', $this->veiculo->__get('imagem'));

        $stmt->execute();
    }

    public function atualizar()
    {
        $query = "UPDATE veiculo SET marca = ?, modelo = ?, placa = ?, valor = ?, disponibilidade = ?, imagem = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(1, $this->veiculo->__get('marca'));
        $stmt->bindValue(2, $this->veiculo->__get('modelo'));
        $stmt->bindValue(3, $this->veiculo->__get('placa'));
        $stmt->bindValue(4, $this->veiculo->__get('valor'));
        $stmt->bindValue(5, $this->veiculo->__get('disponibilidade'));
        $stmt->bindValue(6, $this->veiculo->__get('imagem'));
        $stmt->bindValue(7, $this->veiculo->__get('id'));

        return $stmt->execute();
    }

    public function recuperarVeiculos()
    {
        $query = 'SELECT * FROM veiculo';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function remover()
    {
        $query = 'DELETE FROM veiculo WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->veiculo->__get('id'));
        $stmt->execute();
    }
}

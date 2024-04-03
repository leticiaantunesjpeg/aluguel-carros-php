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

    public function recuperarVeiculos()
    {
        $query = 'SELECT * FROM veiculo';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}

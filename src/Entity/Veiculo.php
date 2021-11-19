<?php

namespace Ricardo\Teste\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @ORM\Entity
 * @ORM\Table(name="veiculo")
*/
class Veiculo implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
    */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $marca;

    /**
    * @ORM\Column(type="string")
    */
    private string $veiculo;

    /**
     * @ORM\Column(type="integer")
     */
    private int $ano;

    /**
     * @ORM\Column(type="string")
     */
    private string $descricao;

    /**
     * @ORM\Column(type="integer")
     */
    private int $vendido;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $created;






    /**
     * @param string $veiculo
     */
    public function setVeiculo(string $veiculo): void
    {
        $this->veiculo = $veiculo;
    }

    /**
     * @param int $ano
     */
    public function setAno(int $ano): void
    {
        $this->ano = $ano;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @param int $vendido
     */
    public function setVendido(int $vendido): void
    {
        $this->vendido = $vendido;
    }

    /**
     * @param DateTimeInterface $created
     */
    public function setCreated(DateTimeInterface $created): void
    {
        $this->created = $created;
    }

    /**
     * @param string $marca
     */
    public function setMarca(string $marca): void
    {
        $this->marca = $marca;
    }

    public function recuperaId(): int
    {
        return $this->id;
    }

    public function recuperaVeiculo(): string
    {
        return $this->veiculo;
    }

    public function alteraVeiculo(string $veiculo): void
    {
        $this->veiculo = $veiculo;
    }

    public function recuperaAno(): int
    {
        return $this->ano;
    }

    public function alteraAno(int $ano): void
    {
        $this->ano = $ano;
    }

    public function recuperaDescricao(): string
    {
        return $this->descricao;
    }

    public function alteraDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function recuperaVendido(): int
    {
        return $this->vendido;
    }

    public function alteraVendido(int $vendido): void
    {
        $this->vendido = $vendido;
    }

    public function recuperaCreated(): DateTimeInterface
    {
        return $this->created;
    }

    public function alteraCreated(DateTimeInterface $created): void
    {
        $this->created = $created;
    }

    public function recuperaMarca() :string {
        return $this->marca;
    }

    #[ArrayShape(['id' => "int", 'veiculo' => "string", 'ano' => "int", 'descricao' => "string", 'vendido' => "int", 'created' => "\DateTimeInterface"])]
    public function jsonSerialize(): array
    {
        return [
                'id'=>$this->id,
                'veiculo'=>$this->veiculo,
                'ano'=>$this->ano,
                'descricao'=>$this->descricao,
                'vendido'=>$this->vendido,
                'created'=>$this->created,
            ];
    }

}

<?php

namespace App\Entity;

use App\Repository\CitaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitaRepository::class)]
class Cita
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $estado = null;

    #[ORM\Column]
    private ?int $hora = null;

    #[ORM\Column]
    private ?int $minutos = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $precio = null;

    #[ORM\JoinTable(name: 'cliente_cita')]
    #[ORM\JoinColumn(name: 'cliente_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'cita_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Cliente::class)]
    private Collection $clientes;

    public function __construct() {
        $this->clientes = new Collection();
    }

    public function setCliente(Cliente $cliente):void{
        $this->clientes = $cliente;
    }

    public function getCliente(): ?Collection{
        return $this->clientes;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getHora(): ?int
    {
        return $this->hora;
    }

    public function setHora(int $hora): static
    {
        $this->hora = $hora;

        return $this;
    }

    public function getMinutos(): ?int
    {
        return $this->minutos;
    }

    public function setMinutos(int $minutos): static
    {
        $this->minutos = $minutos;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\OfertaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfertaRepository::class)]
class Oferta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $descuento = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Cliente::class, mappedBy: 'id_cliente')]
    private Collection $cliente;

    public function __construct() {
        $this->cliente = new Collection();
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente){
        $this->cliente = $cliente;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescuento(): ?string
    {
        return $this->descuento;
    }

    public function setDescuento(?string $descuento): static
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }
}

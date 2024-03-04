<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
class Cliente implements UserInterface, PasswordAuthenticatedUserInterface 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nombre = null;

    #[ORM\Column(length: 300)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $contrasena = null;

    #[ORM\ManyToOne(targetEntity: Oferta::class, inversedBy: 'id_oferta')]
    #[ORM\JoinColumn(name: 'id_oferta', referencedColumnName: 'id')]
    private Oferta|null $oferta = null;

    public function getRoles():array{
        return [];
    }

    public function eraseCredentials(): void {

    }

    public function getUserIdentifier(): string {
        return "";
    }
    
    public function getPassword(): ?string
    {
       return $this->contrasena;
    }

    public function getSalt(): ?string
    {
       return '';
    }

    public function getUsername(): string
    {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getContrasena(): ?string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): static
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    public function __toString(){
        return json_encode($this);
    }

}

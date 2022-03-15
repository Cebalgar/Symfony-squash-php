<?php

namespace App\Entity;

use App\Repository\OpinionesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpinionesRepository::class)]
class Opiniones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $Descripcion;

    #[ORM\Column(type: 'string', length: 30)]
    private $Nombre;

    #[ORM\Column(type: 'string', length: 100)]
    private $Ciudad;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'opiniones')]
    #[ORM\JoinColumn(nullable: false)]
    private $Usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->Ciudad;
    }

    public function setCiudad(string $Ciudad): self
    {
        $this->Ciudad = $Ciudad;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->Usuario;
    }

    public function setUsuario(?User $Usuario): self
    {
        $this->Usuario = $Usuario;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $Nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $Email;

    #[ORM\Column(type: 'date')]
    private $Fecha;

    #[ORM\Column(type: 'time')]
    private $Hora;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $Usuario;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getHora(): ?\DateTimeInterface
    {
        return $this->Hora;
    }

    public function setHora(\DateTimeInterface $Hora): self
    {
        $this->Hora = $Hora;

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

<?php

namespace App\Entity;

use App\Repository\CoolingChamberRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoolingChamberRepository::class)
 */
class CoolingChamber
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $temp_probe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hygro_probe;

    /**
     * @ORM\ManyToOne(targetEntity=Store::class, inversedBy="coolingChambers")
     */
    private $store;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $name = str_replace(' ','_', $name);
        $this->name = $name;

        return $this;
    }

    public function getTempProbe(): ?string
    {
        return $this->temp_probe;
    }

    public function setTempProbe(): self
    {
        $this->temp_probe = 'CC'.$this->id.'-TP01';

        return $this;
    }

    public function getHygroProbe(): ?string
    {
        return $this->hygro_probe;
    }

    public function setHygroProbe(): self
    {
        $this->hygro_probe = 'CC'.$this->id.'-HP01';

        return $this;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store): self
    {
        $this->store = $store;

        return $this;
    }
}

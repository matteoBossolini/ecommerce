<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Carrello
 *
 * @ORM\Table(name="Carrello", indexes={@ORM\Index(name="id_utente", columns={"id_utente"})})
 * @ORM\Entity(repositoryClass=App\Repository\CarrelloRepository::class)
 */
class Carrello
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_carrello", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCarrello;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utente", referencedColumnName="id")
     * })
     */
    private $idUtente;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Prodotto", inversedBy="idCarrello")
     * @ORM\JoinTable(name="prodotto_carrello",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_carrello", referencedColumnName="id_carrello")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="sku", referencedColumnName="sku")
     *   }
     * )
     */
    private $sku;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sku = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCarrello(): ?int
    {
        return $this->idCarrello;
    }

    public function getIdUtente(): ?User
    {
        return $this->idUtente;
    }

    public function setIdUtente(?User $idUtente): self
    {
        $this->idUtente = $idUtente;

        return $this;
    }

    /**
     * @return Collection|Prodotto[]
     */
    public function getSku(): Collection
    {
        return $this->sku;
    }

    public function addSku(Prodotto $sku): self
    {
        if (!$this->sku->contains($sku)) {
            $this->sku[] = $sku;
        }

        return $this;
    }

    public function removeSku(Prodotto $sku): self
    {
        $this->sku->removeElement($sku);

        return $this;
    }

}

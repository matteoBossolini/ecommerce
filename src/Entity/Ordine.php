<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ordine
 *
 * @ORM\Table(name="Ordine", indexes={@ORM\Index(name="id_utente", columns={"id_utente"})})
 * @ORM\Entity(repositoryClass=App\Repository\OrdineRepository::class)
 */
class Ordine
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ordine", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrdine;

    /**
     * @var string
     *
     * @ORM\Column(name="indirizzo", type="string", length=128, nullable=false)
     */
    private $indirizzo;

    /**
     * @var string
     *
     * @ORM\Column(name="cap", type="string", length=5, nullable=false, options={"fixed"=true})
     */
    private $cap;

    /**
     * @var string
     *
     * @ORM\Column(name="nazione", type="string", length=128, nullable=false)
     */
    private $nazione;

    /**
     * @var string
     *
     * @ORM\Column(name="citta", type="string", length=128, nullable=false)
     */
    private $citta;

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
     * @ORM\ManyToMany(targetEntity="Prodotto", inversedBy="idOrdine")
     * @ORM\JoinTable(name="ordine_prodotto",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_ordine", referencedColumnName="id_ordine")
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

    public function getIdOrdine(): ?int
    {
        return $this->idOrdine;
    }

    public function getIndirizzo(): ?string
    {
        return $this->indirizzo;
    }

    public function setIndirizzo(string $indirizzo): self
    {
        $this->indirizzo = $indirizzo;

        return $this;
    }

    public function getCap(): ?string
    {
        return $this->cap;
    }

    public function setCap(string $cap): self
    {
        $this->cap = $cap;

        return $this;
    }

    public function getNazione(): ?string
    {
        return $this->nazione;
    }

    public function setNazione(string $nazione): self
    {
        $this->nazione = $nazione;

        return $this;
    }

    public function getCitta(): ?string
    {
        return $this->citta;
    }

    public function setCitta(string $citta): self
    {
        $this->citta = $citta;

        return $this;
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

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Tag;

/**
 * Prodotto
 *
 * @ORM\Table(name="Prodotto", indexes={@ORM\Index(name="id_tag", columns={"id_tag"})})
 * @ORM\Entity(repositoryClass=App\Repository\ProdottoRepository::class)
 */
class Prodotto
{
    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=16, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=128, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=512, nullable=false)
     */
    private $descrizione;

    /**
     * @var string
     *
     * @ORM\Column(name="prezzo", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $prezzo;

    /**
     * @var int
     *
     * @ORM\Column(name="quantita", type="smallint", nullable=false)
     */
    private $quantita;

    /**
     * @var string
     *
     * @ORM\Column(name="immagine", type="string", length=255, nullable=false)
     */
    private $immagine;

    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tag", referencedColumnName="id_tag")
     * })
     */
    private $idTag;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ordine", mappedBy="sku")
     */
    private $idOrdine;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Carrello", mappedBy="sku")
     */
    private $idCarrello;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idOrdine = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idCarrello = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDescrizione(): ?string
    {
        return $this->descrizione;
    }

    public function setDescrizione(string $descrizione): self
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    public function getPrezzo(): ?string
    {
        return $this->prezzo;
    }

    public function setPrezzo(string $prezzo): self
    {
        $this->prezzo = $prezzo;

        return $this;
    }

    public function getQuantita(): ?int
    {
        return $this->quantita;
    }

    public function setQuantita(int $quantita): self
    {
        $this->quantita = $quantita;

        return $this;
    }

    public function getImmagine(): ?string
    {
        return $this->immagine;
    }

    public function setImmagine(string $immagine): self
    {
        $this->immagine = $immagine;

        return $this;
    }

    public function getIdTag(): ?Tag
    {
        return $this->idTag;
    }

    public function setIdTag(?Tag $idTag): self
    {
        $this->idTag = $idTag;

        return $this;
    }

    /**
     * @return Collection|Ordine[]
     */
    public function getIdOrdine(): Collection
    {
        return $this->idOrdine;
    }

    public function addIdOrdine(Ordine $idOrdine): self
    {
        if (!$this->idOrdine->contains($idOrdine)) {
            $this->idOrdine[] = $idOrdine;
            $idOrdine->addSku($this);
        }

        return $this;
    }

    public function removeIdOrdine(Ordine $idOrdine): self
    {
        if ($this->idOrdine->removeElement($idOrdine)) {
            $idOrdine->removeSku($this);
        }

        return $this;
    }

    /**
     * @return Collection|Carrello[]
     */
    public function getIdCarrello(): Collection
    {
        return $this->idCarrello;
    }

    public function addIdCarrello(Carrello $idCarrello): self
    {
        if (!$this->idCarrello->contains($idCarrello)) {
            $this->idCarrello[] = $idCarrello;
            $idCarrello->addSku($this);
        }

        return $this;
    }

    public function removeIdCarrello(Carrello $idCarrello): self
    {
        if ($this->idCarrello->removeElement($idCarrello)) {
            $idCarrello->removeSku($this);
        }

        return $this;
    }

}

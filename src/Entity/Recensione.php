<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recensione
 *
 * @ORM\Table(name="Recensione", indexes={@ORM\Index(name="id_utente", columns={"id_utente"}), @ORM\Index(name="sku", columns={"sku"})})
 * @ORM\Entity(repositoryClass=App\Repository\RecensioneRepository::class)
 */
class Recensione
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_recensione", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRecensione;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="string", length=128, nullable=false)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=255, nullable=false)
     */
    private $descrizione;

    /**
     * @var int
     *
     * @ORM\Column(name="voto", type="smallint", nullable=false)
     */
    private $voto;

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
     * @var Prodotto
     *
     * @ORM\ManyToOne(targetEntity="Prodotto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sku", referencedColumnName="sku")
     * })
     */
    private $sku;

    public function getIdRecensione(): ?int
    {
        return $this->idRecensione;
    }

    public function getTitolo(): ?string
    {
        return $this->titolo;
    }

    public function setTitolo(string $titolo): self
    {
        $this->titolo = $titolo;

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

    public function getVoto(): ?int
    {
        return $this->voto;
    }

    public function setVoto(int $voto): self
    {
        $this->voto = $voto;

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

    public function getSku(): ?Prodotto
    {
        return $this->sku;
    }

    public function setSku(?Prodotto $sku): self
    {
        $this->sku = $sku;

        return $this;
    }


}

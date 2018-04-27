<?php

namespace CovoiturageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="CovoiturageBundle\Repository\VoitureRepository")
 */
class Voiture
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="matricule", type="string", length=15 , nullable=false , unique=true)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=50 , nullable=false)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=50 , nullable=false)
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=30 , nullable=false)
     */
    private $couleur;

    /**
     * @var int
     *
     * @ORM\Column(name="nbSieges", type="integer" , nullable=false)
     */
    private $nbSieges;

    /**
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="proprio", referencedColumnName="id")
     * })
     */
    private $proprio;

    /**
     * Voiture constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getProprio()
    {
        return $this->proprio;
    }

    /**
     * @param mixed $proprio
     */
    public function setProprio($proprio)
    {
        $this->proprio = $proprio;
    }


    /**
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Voiture
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Voiture
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Voiture
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Voiture
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set nbSieges
     *
     * @param integer $nbSieges
     *
     * @return Voiture
     */
    public function setNbSieges($nbSieges)
    {
        $this->nbSieges = $nbSieges;

        return $this;
    }

    /**
     * Get nbSieges
     *
     * @return int
     */
    public function getNbSieges()
    {
        return $this->nbSieges;
    }

}


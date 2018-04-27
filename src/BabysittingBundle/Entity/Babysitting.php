<?php

namespace BabysittingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Babysitting
 *
 * @ORM\Table(name="babysitting")
 * @ORM\Entity(repositoryClass="BabysittingBundle\Repository\BabysittingRepository")
 */
class Babysitting
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     * @ORM\Column(name="heure_deb", type="time", nullable=false)
     */
    private $heureDeb;

    /**
     * @var \DateTime
     * @ORM\Column(name="heure_fin", type="time", nullable=false)
     */
    private $heureFin;

    /**
     * @var string
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int
     * @ORM\Column(name="nbr_enfants", type="integer", nullable=false)
     */
    private $nbrEnfants;

    /**
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="babysitteur", referencedColumnName="id")
     * })
     */
    private $babysitteur;

    /**
     * @return mixed
     */
    public function getBabysitteur()
    {
        return $this->babysitteur;
    }

    /**
     * @param mixed $babysitteur
     */
    public function setBabysitteur($babysitteur)
    {
        $this->babysitteur = $babysitteur;
    }

    /**
     * Babysitting constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Babysitting
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Babysitting
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set heureDeb
     *
     * @param \DateTime $heureDeb
     *
     * @return Babysitting
     */
    public function setHeureDeb($heureDeb)
    {
        $this->heureDeb = $heureDeb;

        return $this;
    }

    /**
     * Get heureDeb
     *
     * @return \DateTime
     */
    public function getHeureDeb()
    {
        return $this->heureDeb;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return Babysitting
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Babysitting
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Babysitting
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nbrEnfants
     *
     * @param integer $nbrEnfants
     *
     * @return Babysitting
     */
    public function setNbrEnfants($nbrEnfants)
    {
        $this->nbrEnfants = $nbrEnfants;

        return $this;
    }

    /**
     * Get nbrEnfants
     *
     * @return int
     */
    public function getNbrEnfants()
    {
        return $this->nbrEnfants;
    }
}


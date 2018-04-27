<?php

namespace CovoiturageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Covoiturage
 *
 * @ORM\Table(name="covoiturage")
 * @ORM\Entity(repositoryClass="CovoiturageBundle\Repository\CovoiturageRepository")
 */
class Covoiturage
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;


    /**
     * @var integer
     *
     * @ORM\Column(name="nb_places", type="integer", nullable=false)
     */
    private $nbPlaces;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_dep", type="time", nullable=false)
     */
    private $heureDep;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_dep", type="string", length=255, nullable=false)
     */
    private $lieuDep;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_dest", type="string", length=255, nullable=false)
     */
    private $lieuDest;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="CovoiturageBundle\Entity\Voiture")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="voiture", referencedColumnName="matricule")
     * })
     */
    private $voiture;

    /**
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="covoitureur", referencedColumnName="id")
     * })
     */

    private $covoitureur;

    /**
     * Covoiturage constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * @param int $nbPlaces
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;
    }

    /**
     * @return \DateTime
     */
    public function getHeureDep()
    {
        return $this->heureDep;
    }

    /**
     * @param \DateTime $heureDep
     */
    public function setHeureDep($heureDep)
    {
        $this->heureDep = $heureDep;
    }

    /**
     * @return string
     */
    public function getLieuDep()
    {
        return $this->lieuDep;
    }

    /**
     * @param string $lieuDep
     */
    public function setLieuDep($lieuDep)
    {
        $this->lieuDep = $lieuDep;
    }

    /**
     * @return string
     */
    public function getLieuDest()
    {
        return $this->lieuDest;
    }

    /**
     * @param string $lieuDest
     */
    public function setLieuDest($lieuDest)
    {
        $this->lieuDest = $lieuDest;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * @param string $voiture
     */
    public function setVoiture($voiture)
    {
        $this->voiture = $voiture;
    }

    /**
     * @return mixed
     */
    public function getCovoitureur()
    {
        return $this->covoitureur;
    }

    /**
     * @param mixed $covoitureur
     */
    public function setCovoitureur($covoitureur)
    {
        $this->covoitureur = $covoitureur;
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
}


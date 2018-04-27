<?php


namespace GarderieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Garderies
 *
 * @ORM\Table(name="garderies", indexes={@ORM\Index(name="proprietaire", columns={"proprietaire"})})
 * @ORM\Entity(repositoryClass="GarderieBundle\Repository\GarderieRepository")
 */
class Garderies
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
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50, nullable=false)
     */
    private $adresse;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="string", length=10000, nullable=false)
     */
    private $descriptif;

    /**
     * @var string
     *
     * @ORM\Column(name="langues", type="string", length=250, nullable=false)
     */
    private $langues;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ouverture", type="date", nullable=false)
     */
    private $dateOuverture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fermeture", type="date", nullable=false)
     */
    private $dateFermeture;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;

    /**
     * @var integer
     *
     * @ORM\Column(name="cout", type="integer", nullable=false)
     */
    private $cout;
    /**
     * @var integer
     *
     * @ORM\Column(name="nbInscriptions", type="integer", nullable=false)
     */
    private $nbInscriptions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_deb", type="time", nullable=false)
     */
    private $heureDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_fin", type="time", nullable=false)
     */
    private $heureFin;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=25, nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=3000, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=3000, nullable=false)
     */
    private $email;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var \FrontBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proprietaire", referencedColumnName="id")
     * })
     */
    private $proprietaire;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Garderies
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Garderies
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
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Garderies
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return Garderies
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;
    
        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set langues
     *
     * @param string $langues
     *
     * @return Garderies
     */
    public function setLangues($langues)
    {
        $this->langues = $langues;
    
        return $this;
    }

    /**
     * Get langues
     *
     * @return string
     */
    public function getLangues()
    {
        return $this->langues;
    }

    /**
     * Set dateOuverture
     *
     * @param \DateTime $dateOuverture
     *
     * @return Garderies
     */
    public function setDateOuverture($dateOuverture)
    {
        $this->dateOuverture = $dateOuverture;
    
        return $this;
    }

    /**
     * Get dateOuverture
     *
     * @return \DateTime
     */
    public function getDateOuverture()
    {
        return $this->dateOuverture;
    }

    /**
     * Set dateFermeture
     *
     * @param \DateTime $dateFermeture
     *
     * @return Garderies
     */
    public function setDateFermeture($dateFermeture)
    {
        $this->dateFermeture = $dateFermeture;
    
        return $this;
    }

    /**
     * Get dateFermeture
     *
     * @return \DateTime
     */
    public function getDateFermeture()
    {
        return $this->dateFermeture;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Garderies
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    
        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set cout
     *
     * @param integer $cout
     *
     * @return Garderies
     */
    public function setCout($cout)
    {
        $this->cout = $cout;
    
        return $this;
    }

    /**
     * Get cout
     *
     * @return integer
     */
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * Set heureDeb
     *
     * @param \DateTime $heureDeb
     *
     * @return Garderies
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
     * @return Garderies
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
     * Set etat
     *
     * @param string $etat
     *
     * @return Garderies
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Garderies
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Garderies
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Garderies
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Garderies
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set proprietaire
     *
     * @param \FrontBundle\Entity\User $proprietaire
     *
     * @return Garderies
     */
    public function setProprietaire(\FrontBundle\Entity\User $proprietaire = null)
    {
        $this->proprietaire = $proprietaire;
    
        return $this;
    }

    /**
     * Get proprietaire
     *
     * @return \FrontBundle\Entity\User
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * Set nbInscriptions
     *
     * @param integer $nbInscriptions
     *
     * @return Garderies
     */
    public function setNbInscriptions($nbInscriptions)
    {
        $this->nbInscriptions = $nbInscriptions;
    
        return $this;
    }

    /**
     * Get nbInscriptions
     *
     * @return integer
     */
    public function getNbInscriptions()
    {
        return $this->nbInscriptions;
    }
}

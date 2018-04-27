<?php


namespace GarderieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription", indexes={@ORM\Index(name="IDX_5E90F6D61BB9D5A2", columns={"id_parent"}), @ORM\Index(name="IDX_5E90F6D63A245E7E", columns={"id_garderie"}), @ORM\Index(name="IDX_5E90F6D61280B94F", columns={"id_enfant"})})
 * @ORM\Entity
 */
class Inscription
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
     * @ORM\Column(name="nomParent", type="string", length=250, nullable=false)
     */
    private $nomparent;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=250, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaires", type="string", length=250, nullable=false)
     */
    private $commentaires;

    /**
     * @var string
     *
     * @ORM\Column(name="nurserie", type="string", length=20, nullable=false)
     */
    private $nurserie;

    /**
     * @var string
     *
     * @ORM\Column(name="repas", type="string", length=20, nullable=false)
     */
    private $repas;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50, nullable=false)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour_arriv", type="datetime", nullable=false)
     */
    private $jourArriv;

    /**
     * @var \FrontBundle\Entity\Enfant
     *
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\Enfant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_enfant", referencedColumnName="pseudonyme")
     * })
     */
    private $idEnfant;

    /**
     * @var \FrontBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;

    /**
     * @var \GarderieBundle\Entity\Garderies
     *
     * @ORM\ManyToOne(targetEntity="GarderieBundle\Entity\Garderies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_garderie", referencedColumnName="id")
     * })
     */
    private $idGarderie;



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
     * Set nomparent
     *
     * @param string $nomparent
     *
     * @return Inscription
     */
    public function setNomparent($nomparent)
    {
        $this->nomparent = $nomparent;
    
        return $this;
    }

    /**
     * Get nomparent
     *
     * @return string
     */
    public function getNomparent()
    {
        return $this->nomparent;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Inscription
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
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return Inscription
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    
        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set nurserie
     *
     * @param string $nurserie
     *
     * @return Inscription
     */
    public function setNurserie($nurserie)
    {
        $this->nurserie = $nurserie;
    
        return $this;
    }

    /**
     * Get nurserie
     *
     * @return string
     */
    public function getNurserie()
    {
        return $this->nurserie;
    }

    /**
     * Set repas
     *
     * @param string $repas
     *
     * @return Inscription
     */
    public function setRepas($repas)
    {
        $this->repas = $repas;
    
        return $this;
    }

    /**
     * Get repas
     *
     * @return string
     */
    public function getRepas()
    {
        return $this->repas;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Inscription
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
     * Set jourArriv
     *
     * @param \DateTime $jourArriv
     *
     * @return Inscription
     */
    public function setJourArriv($jourArriv)
    {
        $this->jourArriv = $jourArriv;
    
        return $this;
    }

    /**
     * Get jourArriv
     *
     * @return \DateTime
     */
    public function getJourArriv()
    {
        return $this->jourArriv;
    }

    /**
     * Set idEnfant
     *
     * @param \FrontBundle\Entity\Enfant $idEnfant
     *
     * @return Inscription
     */
    public function setIdEnfant(\FrontBundle\Entity\Enfant $idEnfant = null)
    {
        $this->idEnfant = $idEnfant;
    
        return $this;
    }

    /**
     * Get idEnfant
     *
     * @return \FrontBundle\Entity\Enfant
     */
    public function getIdEnfant()
    {
        return $this->idEnfant;
    }

    /**
     * Set idParent
     *
     * @param \FrontBundle\Entity\User $idParent
     *
     * @return Inscription
     */
    public function setIdParent(\FrontBundle\Entity\User $idParent = null)
    {
        $this->idParent = $idParent;
    
        return $this;
    }

    /**
     * Get idParent
     *
     * @return \FrontBundle\Entity\User
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * Set idGarderie
     *
     * @param \GarderieBundle\Entity\Garderies $idGarderie
     *
     * @return Inscription
     */
    public function setIdGarderie(\GarderieBundle\Entity\Garderies $idGarderie = null)
    {
        $this->idGarderie = $idGarderie;
    
        return $this;
    }

    /**
     * Get idGarderie
     *
     * @return \GarderieBundle\Entity\Garderies
     */
    public function getIdGarderie()
    {
        return $this->idGarderie;
    }
}

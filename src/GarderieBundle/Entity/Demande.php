<?php


namespace GarderieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="id_garderie", columns={"id_garderie"})})
 * @ORM\Entity
 */
class Demande
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
     * @ORM\Column(name="etat", type="string", length=250, nullable=false)
     */
    private $etat;

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
     * Set etat
     *
     * @param string $etat
     *
     * @return Demande
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
     * Set idGarderie
     *
     * @param \GarderieBundle\Entity\Garderies $idGarderie
     *
     * @return Demande
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

<?php


namespace GarderieBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="vote", indexes={@ORM\Index(name="IDX_5A108564C02AFAE6", columns={"idgarderie"})})
 * @ORM\Entity(repositoryClass="GarderieBundle\Repository\VoteRepository")
 */
class Vote
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
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var \GarderieBundle\Entity\Garderies
     * @ORM\ManyToOne(targetEntity="Garderies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idgarderie", referencedColumnName="id")
     * })
     */
    private $idgarderie;



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
     * Set rating
     *
     * @param integer $rating
     *
     * @return Vote
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
     * Set idgarderie
     *
     * @param \GarderieBundle\Entity\Garderies $idgarderie
     *
     * @return Vote
     */
    public function setIdgarderie(\GarderieBundle\Entity\Garderies $idgarderie = null)
    {
        $this->idgarderie = $idgarderie;
    
        return $this;
    }

    /**
     * Get idgarderie
     *
     * @return \GarderieBundle\Entity\Garderies
     */
    public function getIdgarderie()
    {
        return $this->idgarderie;
    }
}

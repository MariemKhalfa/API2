<?php


namespace FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Enfant
 *
 * @ORM\Table(name="enfant", indexes={@ORM\Index(name="pseudonyme", columns={"pseudonyme"}), @ORM\Index(name="cin", columns={"cin"})})
 * @ORM\Entity(repositoryClass="FrontBundle\Repository\EnfantRepository")
 */
class Enfant
{
    /**
     * @var string
     *
     * @ORM\Column(name="pseudonyme", type="string", length=250, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pseudonyme;

    /**
     * @var integer
     *
     * @ORM\Column(name="Age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="Sexe", type="string", length=20, nullable=false)
     */
    private $sexe;

    /**
     * @var \FrontBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cin", referencedColumnName="id")
     * })
     */
    private $cin;



    /**
     * Get pseudonyme
     *
     * @return string
     */
    public function getPseudonyme()
    {
        return $this->pseudonyme;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Enfant
     */
    public function setAge($age)
    {
        $this->age = $age;
    
        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Enfant
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    
        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set cin
     *
     * @param \FrontBundle\Entity\User $cin
     *
     * @return Enfant
     */
    public function setCin(\FrontBundle\Entity\User $cin = null)
    {
        $this->cin = $cin;
    
        return $this;
    }

    /**
     * Get cin
     *
     * @return \FrontBundle\Entity\User
     */
    public function getCin()
    {
        return $this->cin;
    }
}

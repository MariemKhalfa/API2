<?php
/**
 * Created by PhpStorm.
 * User: Mariem
 * Date: 24/04/2018
 * Time: 22:32
 */

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Voiture
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CarRepository")
 */
class Car
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="matricule", type="string", length=50 , nullable=false , unique=true)
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
     * @ORM\Column(name="couleur", type="string", length=50 , nullable=false)
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
     * car constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param string $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    /**
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param string $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @param string $modele
     */
    public function setModele($modele)
    {
        $this->modele = $modele;
    }

    /**
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param string $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    /**
     * @return int
     */
    public function getNbSieges()
    {
        return $this->nbSieges;
    }

    /**
     * @param int $nbSieges
     */
    public function setNbSieges($nbSieges)
    {
        $this->nbSieges = $nbSieges;
    }

    /**
     * @return mixed
     */
    public function getProprio()
    {
        return $this->proprio;
    }

    /**
     * @param mixed $covoitureur
     */
    public function setProprio($proprio)
    {
        $this->proprio = $proprio;
    }

}
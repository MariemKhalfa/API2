<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publicite
 *
 * @ORM\Table(name="publicite")
 * @ORM\Entity(repositoryClass="BackOfficeBundle\Repository\PubliciteRepository")
 */
class Publicite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="imagePub", type="string", length=255)
     */
    private $imagePub;

    /**
     * @var string
     *
     * @ORM\Column(name="NomEnsegne", type="string", length=255)
     */
    private $nomEnsegne;


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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Publicite
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set imagePub
     *
     * @param string $imagePub
     *
     * @return Publicite
     */
    public function setImagePub($imagePub)
    {
        $this->imagePub = $imagePub;

        return $this;
    }

    /**
     * Get imagePub
     *
     * @return string
     */
    public function getImagePub()
    {
        return $this->imagePub;
    }

    /**
     * Set nomEnsegne
     *
     * @param string $nomEnsegne
     *
     * @return Publicite
     */
    public function setNomEnsegne($nomEnsegne)
    {
        $this->nomEnsegne = $nomEnsegne;

        return $this;
    }

    /**
     * Get nomEnsegne
     *
     * @return string
     */
    public function getNomEnsegne()
    {
        return $this->nomEnsegne;
    }
}


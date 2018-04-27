<?php

namespace ELearningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnfantMalade
 *
 * @ORM\Table(name="enfant_malade")
 * @ORM\Entity(repositoryClass="ELearningBundle\Repository\EnfantMaladeRepository")
 */
class EnfantMalade
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionMaladie", type="string", length=255)
     */
    private $descriptionMaladie;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumn(name="idp", referencedColumnName="id")
     */
    private $idp;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumn(name="idm",referencedColumnName="id")
     */
    private $idm;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return EnfantMalade
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return EnfantMalade
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return EnfantMalade
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set descriptionMaladie
     *
     * @param string $descriptionMaladie
     *
     * @return EnfantMalade
     */
    public function setDescriptionMaladie($descriptionMaladie)
    {
        $this->descriptionMaladie = $descriptionMaladie;

        return $this;
    }

    /**
     * Get descriptionMaladie
     *
     * @return string
     */
    public function getDescriptionMaladie()
    {
        return $this->descriptionMaladie;
    }

    /**
     * Set idp
     *
     * @param integer $idp
     *
     * @return EnfantMalade
     */
    public function setIdp($idp)
    {
        $this->idp = $idp;

        return $this;
    }

    /**
     * Get idp
     *
     * @return int
     */
    public function getIdp()
    {
        return $this->idp;
    }

    /**
     * Set idm
     *
     * @param integer $idm
     *
     * @return EnfantMalade
     */
    public function setIdm($idm)
    {
        $this->idm = $idm;

        return $this;
    }

    /**
     * Get idm
     *
     * @return int
     */
    public function getIdm()
    {
        return $this->idm;
    }
}


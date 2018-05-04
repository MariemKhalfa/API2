<?php

namespace ELearningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeInscription
 *
 * @ORM\Table(name="demande_inscription")
 * @ORM\Entity(repositoryClass="ELearningBundle\Repository\DemandeInscriptionRepository")
 */
class DemandeInscription
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
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\Enfant")
     * @ORM\JoinColumn(name="enfant_id",referencedColumnName="pseudonyme")
     */
    private $enfantId;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumn(name="medecin_id",referencedColumnName="id")
     */
    private $medecinId;

    /**
     * @var string
     *
     * @ORM\Column(name="description_difficulte", type="string", length=255, nullable=true)
     */
    private $descriptionDifficulte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;
    /**
     * @var \string
     *
     * @ORM\Column(name="etat", type="string",length=255)
     */
    private $etat="ATTENTE";

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
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
     * Set idEnfant
     *
     * @param string $idEnfant
     *
     * @return DemandeInscription
     */
    public function setIdEnfant($idEnfant)
    {
        $this->idEnfant = $idEnfant;

        return $this;
    }

    /**
     * Set medecinId
     *
     * @param integer $medecinId
     *
     * @return DemandeInscription
     */
    public function setMedecinId($medecinId)
    {
        $this->medecinId = $medecinId;

        return $this;
    }

    /**
     * Get medecinId
     *
     * @return int
     */
    public function getMedecinId()
    {
        return $this->medecinId;
    }

    /**
     * Set descriptionDifficulte
     *
     * @param string $descriptionDifficulte
     *
     * @return DemandeInscription
     */
    public function setDescriptionDifficulte($descriptionDifficulte)
    {
        $this->descriptionDifficulte = $descriptionDifficulte;

        return $this;
    }

    /**
     * Get descriptionDifficulte
     *
     * @return string
     */
    public function getDescriptionDifficulte()
    {
        return $this->descriptionDifficulte;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return DemandeInscription
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = new \DateTime($dateDebut) ;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @return string
     */
    public function getEnfantId()
    {
        return $this->enfantId;
    }

    /**
     * @param string $enfantId
     */
    public function setEnfantId($enfantId)
    {
        $this->enfantId = $enfantId;
    }

}


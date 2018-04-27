<?php

namespace MedecinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="MedecinBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
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
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="picpath", type="string", length=255)
     */
    private $picpath;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre.
     *
     * @param string $titre
     *
     * @return Publication
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre.
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu.
     *
     * @param string $contenu
     *
     * @return Publication
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu.
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set picpath.
     *
     * @param string $picpath
     *
     * @return Publication
     */
    public function setPicpath($picpath)
    {
        $this->picpath = $picpath;

        return $this;
    }

    /**
     * Get picpath.
     *
     * @return string
     */
    public function getPicpath()
    {
        return $this->picpath;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Publication
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set idParent.
     *
     * @param \FrontBundle\Entity\User|null $idParent
     *
     * @return Publication
     */
    public function setIdParent(\FrontBundle\Entity\User $idParent = null)
    {
        $this->idParent = $idParent;

        return $this;
    }

    /**
     * Get idParent.
     *
     * @return \FrontBundle\Entity\User|null
     */
    public function getIdParent()
    {
        return $this->idParent;
    }
}

<?php

namespace MedecinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="MedecinBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @var \FrontBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="FrontBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     * })
     */
    private $idParent;
    /**
     * @var \MedecinBundle\Entity\Publication
     *
     * @ORM\ManyToOne(targetEntity="MedecinBundle\Entity\Publication")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pub", referencedColumnName="id")
     * })
     */
    private $idPub;
    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;


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
     * Set commentaire.
     *
     * @param string $commentaire
     *
     * @return Commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire.
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set idParent.
     *
     * @param \FrontBundle\Entity\User|null $idParent
     *
     * @return Commentaire
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

    /**
     * Set idPub.
     *
     * @param \MedecinBundle\Entity\Publication|null $idPub
     *
     * @return Commentaire
     */
    public function setIdPub(\MedecinBundle\Entity\Publication $idPub = null)
    {
        $this->idPub = $idPub;

        return $this;
    }

    /**
     * Get idPub.
     *
     * @return \MedecinBundle\Entity\Publication|null
     */
    public function getIdPub()
    {
        return $this->idPub;
    }
}

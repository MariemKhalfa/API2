<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Coupons
 *
 * @ORM\Table(name="coupons")
 * @ORM\Entity(repositoryClass="BackOfficeBundle\Repository\CouponsRepository")
 */
class Coupons
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
     * @Assert\NotBlank(message="Please, upload the product brochure as a image/jpeg file.")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     * @ORM\Column(name="image_Coupon", type="string", length=255)
     */
    private $imageCoupon;

    /**
     * @var string
     *
     * @ORM\Column(name="ensegne", type="string", length=255)
     */
    private $ensegne;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="codePromo", type="string", length=255)
     */
    private $codePromo;


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
     * @return Coupons
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
     * Set imageCoupon
     *
     * @param string $imageCoupon
     *
     * @return Coupons
     */
    public function setImageCoupon($imageCoupon)
    {
        $this->imageCoupon = $imageCoupon;

        return $this;
    }

    /**
     * Get imageCoupon
     *
     * @return string
     */
    public function getImageCoupon()
    {
        return $this->imageCoupon;
    }

    /**
     * Set ensegne
     *
     * @param string $ensegne
     *
     * @return Coupons
     */
    public function setEnsegne($ensegne)
    {
        $this->ensegne = $ensegne;

        return $this;
    }

    /**
     * Get ensegne
     *
     * @return string
     */
    public function getEnsegne()
    {
        return $this->ensegne;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Coupons
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Coupons
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

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
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Coupons
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set valeur
     *
     * @param float $valeur
     *
     * @return Coupons
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return float
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set codePromo
     *
     * @param string $codePromo
     *
     * @return Coupons
     */
    public function setCodePromo($codePromo)
    {
        $this->codePromo = $codePromo;

        return $this;
    }

    /**
     * Get codePromo
     *
     * @return string
     */
    public function getCodePromo()
    {
        return $this->codePromo;
    }
}


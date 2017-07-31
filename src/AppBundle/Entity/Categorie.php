<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="niveau", type="integer", nullable=true)
     */
    private $niveau;

    /**
     * @var bool
     *
     * @ORM\Column(name="aReviser", type="boolean")
     */
    private $aReviser;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="categorieParent", type="integer", nullable=true)
     */
    private $categorieParent;


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
     * @return Categorie
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
     * Set niveau
     *
     * @param integer $niveau
     *
     * @return Categorie
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set aReviser
     *
     * @param boolean $aReviser
     *
     * @return Categorie
     */
    public function setAReviser($aReviser)
    {
        $this->aReviser = $aReviser;

        return $this;
    }

    /**
     * Get aReviser
     *
     * @return bool
     */
    public function getAReviser()
    {
        return $this->aReviser;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Categorie
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set categorieParent
     *
     * @param integer $categorieParent
     *
     * @return Categorie
     */
    public function setCategorieParent($categorieParent)
    {
        $this->categorieParent = $categorieParent;

        return $this;
    }

    /**
     * Get categorieParent
     *
     * @return int
     */
    public function getCategorieParent()
    {
        return $this->categorieParent;
    }
}


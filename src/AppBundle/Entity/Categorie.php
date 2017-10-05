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
     * @ORM\Column(name="aReviser", type="boolean", nullable=true)
     */
    private $aReviser;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="idParent", type="integer", nullable=true)
     */
    private $idParent;


    /**
     * @ORM\OneToMany(targetEntity="Note", mappedBy="categorie")
     */
    private $notes;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     */
    private $children;


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
     * Constructor
     */
    public function __construct()
    {
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add note
     *
     * @param \AppBundle\Entity\Note $note
     *
     * @return Categorie
     */
    public function addNote(\AppBundle\Entity\Note $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \AppBundle\Entity\Note $note
     */
    public function removeNote(\AppBundle\Entity\Note $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }

  

    /**
     * Set idParent
     *
     * @param integer $idParent
     *
     * @return Categorie
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;

        return $this;
    }

    /**
     * Get idParent
     *
     * @return integer
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * Set children
     *
     * @param \AppBundle\Entity\Categorie $children
     *
     * @return Categorie
     */
    public function setChildren(\AppBundle\Entity\Categorie $children = null)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getChildren()
    {
        return $this->children;
    }


    public function to_json_encode()
    {
        $tab = [];

        $tab = [
            'id' => $this->getId(),
            'nom' => $this->getNom(),
            'idParent' => $this->getIdParent(),
        ];


        if($this->getChildren() != null) {
            foreach($this->getChildren() as $children)
            {
                $tab['children'][]= $children->to_json_encode();
            }
        }

        return $tab;
    }


}

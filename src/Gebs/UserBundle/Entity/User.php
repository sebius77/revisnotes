<?php

namespace Gebs\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Gebs\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var object
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Categorie", mappedBy="user", cascade={"remove", "persist"})
     */
    protected $categories;

    /**
     * @var object
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Parametres", cascade={"persist"})
     */
    private $parametres;


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
     * Set parametres
     *
     * @param \AppBundle\Entity\Parametres $parametres
     *
     * @return User
     */
    public function setParametres(\AppBundle\Entity\Parametres $parametres)
    {
        $this->parametres = $parametres;

        return $this;
    }

    /**
     * Get parametres
     *
     * @return \AppBundle\Entity\Parametres
     */
    public function getParametres()
    {
        return $this->parametres;
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Categorie $category
     *
     * @return User
     */
    public function addCategory(\AppBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Categorie $category
     */
    public function removeCategory(\AppBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function __construct()
    {
        parent::__construct();
        $this->parametres = new \AppBundle\Entity\Parametres();
        $this->addRole('ROLE_USER');
    }
}

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
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Note", mappedBy="user")
     */
    protected $notes;

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
     * Add note
     *
     * @param \AppBundle\Entity\Note $note
     *
     * @return User
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
     * Set parametres
     *
     * @param \AppBundle\Entity\Parametres $parametres
     *
     * @return User
     */
    public function setParametres(\AppBundle\Entity\Parametres $parametres = null)
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
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Parametres
 *
 * @ORM\Table(name="parametres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParametresRepository")
 */
class Parametres
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
     * @var int
     *
     * @ORM\Column(name="alerte", type="integer", nullable=true)
     */
    private $alerte;

    /**
     * @var int
     *
     * @ORM\Column(name="revoir", type="integer")
     */
    private $revoir = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="difficile", type="integer")
     */
    private $difficile = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="bien", type="integer")
     */
    private $bien = 3;

    /**
     * @var int
     *
     * @ORM\Column(name="parfait", type="integer")
     */
    private $parfait = 5;

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
     * Set alerte
     *
     * @param integer $alerte
     *
     * @return Parametres
     */
    public function setAlerte($alerte)
    {
        $this->alerte = $alerte;

        return $this;
    }

    /**
     * Get alerte
     *
     * @return int
     */
    public function getAlerte()
    {
        return $this->alerte;
    }

    /**
     * Set revoir
     *
     * @param integer $revoir
     *
     * @return Parametres
     */
    public function setRevoir($revoir)
    {
        $this->revoir = $revoir;

        return $this;
    }

    /**
     * Get revoir
     *
     * @return int
     */
    public function getRevoir()
    {
        return $this->revoir;
    }

    /**
     * Set difficile
     *
     * @param integer $difficile
     *
     * @return Parametres
     */
    public function setDifficile($difficile)
    {
        $this->difficile = $difficile;

        return $this;
    }

    /**
     * Get difficile
     *
     * @return int
     */
    public function getDifficile()
    {
        return $this->difficile;
    }

    /**
     * Set bien
     *
     * @param integer $bien
     *
     * @return Parametres
     */
    public function setBien($bien)
    {
        $this->bien = $bien;

        return $this;
    }

    /**
     * Get bien
     *
     * @return int
     */
    public function getBien()
    {
        return $this->bien;
    }

    /**
     * Set parfait
     *
     * @param integer $parfait
     *
     * @return Parametres
     */
    public function setParfait($parfait)
    {
        $this->parfait = $parfait;

        return $this;
    }

    /**
     * Get parfait
     *
     * @return int
     */
    public function getParfait()
    {
        return $this->parfait;
    }

    /**
     * @Assert\IsTrue()
     */
    public function isParametresValid()
    {
        $a = $this->getRevoir();
        $b = $this->getDifficile();
        $c = $this->getBien();
        $d = $this->getParfait();

        if ($a < $b) {
            if ($b < $c) {
                if ($c < $d) {
                    return true;
                }
            }
        }

        return false;
    }
}

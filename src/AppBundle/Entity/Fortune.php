<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fortune
 *
 * @ORM\Table(name="fortune")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FortuneRepository")
 */
class Fortune
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
     * @ORM\Column(name="citation", type="text")
     */
    private $citation;


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
     * Set citation
     *
     * @param string $citation
     *
     * @return Fortune
     */
    public function setCitation($citation)
    {
        $this->citation = $citation;

        return $this;
    }

    /**
     * Get citation
     *
     * @return string
     */
    public function getCitation()
    {
        return $this->citation;
    }
}


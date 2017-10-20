<?php
// src/AppBundle/Entity/Contact.php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    /**
     * @var
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    protected $subject;

    /**
     * @var
     * @Assert\NotBlank()
     * @Assert\Length(min=20)
     */
    protected $body;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
}

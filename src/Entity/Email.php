<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmailRepository")
 */
class Email
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eFrom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eTo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eSubject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eBody;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEFrom(): ?string
    {
        return $this->eFrom;
    }

    public function setEFrom(string $eFrom): self
    {
        $this->eFrom = $eFrom;

        return $this;
    }

    public function getETo(): ?string
    {
        return $this->eTo;
    }

    public function setETo(string $eTo): self
    {
        $this->eTo = $eTo;

        return $this;
    }

    public function getESubject(): ?string
    {
        return $this->eSubject;
    }

    public function setESubject(string $eSubject): self
    {
        $this->eSubject = $eSubject;

        return $this;
    }

    public function getEBody(): ?string
    {
        return $this->eBody;
    }

    public function setEBody(string $eBody): self
    {
        $this->eBody = $eBody;

        return $this;
    }
}

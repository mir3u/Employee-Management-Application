<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @ORM\Entity()
 * @ORM\Table(name="mail")
 */
class Mail
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $receiverName;

    /**
     * @ORM\Column(type="string")
     */
    private $receiverEmail;

    /**
     * @ORM\Column(type="string")
     */
    private $content;
    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="string")
     */
    private $awb;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAwb()
    {
        return $this->awb;
    }

    /**
     * @param mixed $awb
     */
    public function setAwb($awb): void
    {
        $this->awb = $awb;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getReceiverName()
    {
        return $this->receiverName;
    }

    /**
     * @param mixed $receiverName
     */
    public function setReceiverName($receiverName): void
    {
        $this->receiverName = $receiverName;
    }

    /**
     * @return mixed
     */
    public function getReceiverEmail()
    {
        return $this->receiverEmail;
    }

    /**
     * @param mixed $receiverEmail
     */
    public function setReceiverEmail($receiverEmail): void
    {
        $this->receiverEmail = $receiverEmail;
    }



}
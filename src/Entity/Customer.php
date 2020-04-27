<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @ORM\Table(name="customer")
 */
class Customer {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $details;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNo;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;
    /**
     * @ORM\Column(type="datetime", length=255, nullable=true)
     */
    private $dueDate;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feedBack;

    public function getId(): ?int {
        return $this->id;
    }

    public function getDetails(): ?string {
        return $this->details;
    }

    public function setDetails(?string $details): self {
        $this->details=$details;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void {
        $this->email=$email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNo() {
        return $this->phoneNo;
    }

    /**
     * @param mixed $phoneNo
     */
    public function setPhoneNo($phoneNo): void {
        $this->phoneNo=$phoneNo;
    }

    /**
     * @return mixed
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void {
        $this->location=$location;
    }

    /**
     * @return mixed
     */
    public function getDueDate() {
        return $this->dueDate;
    }

    /**
     * @param mixed $dueDate
     */
    public function setDueDate($dueDate): void {
        $this->dueDate=$dueDate;
    }

    /**
     * @return mixed
     */
    public function getFeedBack() {
        return $this->feedBack;
    }

    /**
     * @param mixed $feedBack
     */
    public function setFeedBack($feedBack): void {
        $this->feedBack=$feedBack;
    }

}

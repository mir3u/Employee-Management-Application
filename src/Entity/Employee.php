<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()able(name="employees")
 */
class Employee
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
    private $firstName;
    /**
     * @ORM\Column(type="string")
     */
    private $lastName;
    /**
     * @ORM\Column(type="string")
     */
    private $address;
    /**
     * @ORM\Column(type="string")
     */
    private $telephone;
    /**
     * @ORM\Column(type="string")
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     */
    private $certification;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityStart1;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityStart2;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityStart3;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityStart4;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityStart5;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityEnd1;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityEnd2;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityEnd3;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityEnd4;
    /**
     * @ORM\Column(type="datetime")
     */
    private $availabilityEnd5;
    /**
     * @ORM\Column(type="integer")
     */
    private $payment;
    /**
     * @ORM\Column(type="integer")
     */
    private $hours;

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
    }/**
 * @param mixed $id
 */
    public function setId($id): void
    {
        $this->id = $id;
    }/**
 * @return mixed
 */
    public function getFirstName()
    {
        return $this->firstName;
    }/**
 * @param mixed $firstName
 */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }/**
 * @return mixed
 */
    public function getLastName()
    {
        return $this->lastName;
    }/**
 * @param mixed $lastName
 */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }/**
 * @return mixed
 */
    public function getAddress()
    {
        return $this->address;
    }/**
 * @param mixed $address
 */
    public function setAddress($address): void
    {
        $this->address = $address;
    }/**
 * @return mixed
 */
    public function getTelephone()
    {
        return $this->telephone;
    }/**
 * @param mixed $telephone
 */
    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }/**
 * @return mixed
 */
    public function getEmail()
    {
        return $this->email;
    }/**
 * @param mixed $email
 */
    public function setEmail($email): void
    {
        $this->email = $email;
    }/**
 * @return mixed
 */
    public function getCertification()
    {
        return $this->certification;
    }/**
 * @param mixed $certification
 */
    public function setCertification($certification): void
    {
        $this->certification = $certification;

    }

    /**
     * @return mixed
     */
    public function getAvailabilityStart1()
    {
        return $this->availabilityStart1;
    }

    /**
     * @param mixed $availabilityStart1
     */
    public function setAvailabilityStart1($availabilityStart1): void
    {
        $this->availabilityStart1 = $availabilityStart1;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityStart2()
    {
        return $this->availabilityStart2;
    }

    /**
     * @param mixed $availabilityStart2
     */
    public function setAvailabilityStart2($availabilityStart2): void
    {
        $this->availabilityStart2 = $availabilityStart2;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityStart3()
    {
        return $this->availabilityStart3;
    }

    /**
     * @param mixed $availabilityStart3
     */
    public function setAvailabilityStart3($availabilityStart3): void
    {
        $this->availabilityStart3 = $availabilityStart3;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityStart4()
    {
        return $this->availabilityStart4;
    }

    /**
     * @param mixed $availabilityStart4
     */
    public function setAvailabilityStart4($availabilityStart4): void
    {
        $this->availabilityStart4 = $availabilityStart4;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityStart5()
    {
        return $this->availabilityStart5;
    }

    /**
     * @param mixed $availabilityStart5
     */
    public function setAvailabilityStart5($availabilityStart5): void
    {
        $this->availabilityStart5 = $availabilityStart5;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityEnd1()
    {
        return $this->availabilityEnd1;
    }

    /**
     * @param mixed $availabilityEnd1
     */
    public function setAvailabilityEnd1($availabilityEnd1): void
    {
        $this->availabilityEnd1 = $availabilityEnd1;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityEnd2()
    {
        return $this->availabilityEnd2;
    }

    /**
     * @param mixed $availabilityEnd2
     */
    public function setAvailabilityEnd2($availabilityEnd2): void
    {
        $this->availabilityEnd2 = $availabilityEnd2;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityEnd3()
    {
        return $this->availabilityEnd3;
    }

    /**
     * @param mixed $availabilityEnd3
     */
    public function setAvailabilityEnd3($availabilityEnd3): void
    {
        $this->availabilityEnd3 = $availabilityEnd3;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityEnd4()
    {
        return $this->availabilityEnd4;
    }

    /**
     * @param mixed $availabilityEnd4
     */
    public function setAvailabilityEnd4($availabilityEnd4): void
    {
        $this->availabilityEnd4 = $availabilityEnd4;
    }

    /**
     * @return mixed
     */
    public function getAvailabilityEnd5()
    {
        return $this->availabilityEnd5;
    }

    /**
     * @param mixed $availabilityEnd5
     */
    public function setAvailabilityEnd5($availabilityEnd5): void
    {
        $this->availabilityEnd5 = $availabilityEnd5;
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
    }/**
 * @return mixed
 */
    public function getPayment()
    {
        return $this->payment;
    }/**
 * @param mixed $payment
 */
    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }/**
 * @return mixed
 */
    public function getHours()
    {
        return $this->hours;
    }/**
 * @param mixed $hours
 */
    public function setHours($hours): void
    {
        $this->hours = $hours;
    }



}
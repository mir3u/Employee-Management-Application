<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Offer entity
 * @ORM\Entity()
 * @ORM\Table(name="offers")
 */
class Offer
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
    private $offerName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     */
    private $service;
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $service1;

//    /**
//     * @ORM\Column(type="string", nullable=true)
//     */
//    private $service2;
//
//    /**
//     * @ORM\Column(type="string", nullable=true)
//     */
//    private $service3;

    /**
     * @ORM\Column(type="string")
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    private $chosen;


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
    public function getOfferName()
    {
        return $this->offerName;
    }

    /**
     * @param mixed $offerName
     */
    public function setOfferName($offerName): void
    {
        $this->offerName = $offerName;
    }

//    /**
//     * @return mixed
//     */
//    public function getService1()
//    {
//        return $this->service1;
//    }
//
//    /**
//     * @param mixed $service1
//     */
//    public function setService1($service1): void
//    {
//        $this->service1 = $service1;
//    }

//     /**
//     * @return mixed
//     */
//    public function getService2()
//    {
//        return $this->service2;
//    }
//
//    /**
//     * @param mixed $service2
//     */
//    public function setService2($service2): void
//    {
//        $this->service2 = $service2;
//    }
//
//      /**
//     * @return mixed
//     */
//    public function getService3()
//    {
//        return $this->service3;
//    }
//
//    /**
//     * @param mixed $service3
//     */
//    public function setService3($service3): void
//    {
//        $this->service3 = $service3;
//    }

      /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getChosen()
    {
        return $this->chosen;
    }

    /**
     * @param mixed $chosen
     */
    public function setChosen($chosen): void
    {
        $this->chosen = $chosen;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service): void
    {
        $this->service = $service;
    }






}
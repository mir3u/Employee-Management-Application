<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table()able(name="companies")
 */
class Company
{  /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $companyName;
    /**
     * @ORM\Column(type="string")
     */
    private $service1;
    /**
     * @ORM\Column(type="string")
     */
    private $price1;
    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate1;
    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate1;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $service2;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $price2;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startDate2;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate2;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $service3;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $price3;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startDate3;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate3;

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
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName): void
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getService1()
    {
        return $this->service1;
    }

    /**
     * @param mixed $service1
     */
    public function setService1($service1): void
    {
        $this->service1 = $service1;
    }

    /**
     * @return mixed
     */
    public function getPrice1()
    {
        return $this->price1;
    }

    /**
     * @param mixed $price1
     */
    public function setPrice1($price1): void
    {
        $this->price1 = $price1;
    }

    /**
     * @return mixed
     */
    public function getStartDate1()
    {
        return $this->startDate1;
    }

    /**
     * @param mixed $startDate1
     */
    public function setStartDate1($startDate1): void
    {
        $this->startDate1 = $startDate1;
    }

    /**
     * @return mixed
     */
    public function getEndDate1()
    {
        return $this->endDate1;
    }

    /**
     * @param mixed $endDate1
     */
    public function setEndDate1($endDate1): void
    {
        $this->endDate1 = $endDate1;
    }

    /**
     * @return mixed
     */
    public function getService2()
    {
        return $this->service2;
    }

    /**
     * @param mixed $service2
     */
    public function setService2($service2): void
    {
        $this->service2 = $service2;
    }

    /**
     * @return mixed
     */
    public function getPrice2()
    {
        return $this->price2;
    }

    /**
     * @param mixed $price2
     */
    public function setPrice2($price2): void
    {
        $this->price2 = $price2;
    }

    /**
     * @return mixed
     */
    public function getStartDate2()
    {
        return $this->startDate2;
    }

    /**
     * @param mixed $startDate2
     */
    public function setStartDate2($startDate2): void
    {
        $this->startDate2 = $startDate2;
    }

    /**
     * @return mixed
     */
    public function getEndDate2()
    {
        return $this->endDate2;
    }

    /**
     * @param mixed $endDate2
     */
    public function setEndDate2($endDate2): void
    {
        $this->endDate2 = $endDate2;
    }

    /**
     * @return mixed
     */
    public function getService3()
    {
        return $this->service3;
    }

    /**
     * @param mixed $service3
     */
    public function setService3($service3): void
    {
        $this->service3 = $service3;
    }

    /**
     * @return mixed
     */
    public function getPrice3()
    {
        return $this->price3;
    }

    /**
     * @param mixed $price3
     */
    public function setPrice3($price3): void
    {
        $this->price3 = $price3;
    }

    /**
     * @return mixed
     */
    public function getStartDate3()
    {
        return $this->startDate3;
    }

    /**
     * @param mixed $startDate3
     */
    public function setStartDate3($startDate3): void
    {
        $this->startDate3 = $startDate3;
    }

    /**
     * @return mixed
     */
    public function getEndDate3()
    {
        return $this->endDate3;
    }

    /**
     * @param mixed $endDate3
     */
    public function setEndDate3($endDate3): void
    {
        $this->endDate3 = $endDate3;
    }



}
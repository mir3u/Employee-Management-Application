<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @ORM\Entity()
 * @ORM\Table(name="attendees_meeting")
 */
class AttendeesMeeting{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
      * @ORM\OneToMany(targetEntity="App\Entity\Employee", mappedBy="id")
      */
    private $attendees = [];

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Meeting", mappedBy="id")
     */
    private $meeting;



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
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * @param mixed $attendees
     */
    public function setAttendees($attendees): void
    {
        $this->attendees = $attendees;
    }


    /**
     * @return mixed
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * @param mixed $meeting
     */
    public function setMeeting($meeting): void
    {
        $this->meeting = $meeting;
    }






}
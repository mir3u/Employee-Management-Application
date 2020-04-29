<?php


namespace App\Controller;


use App\Entity\Meeting;
use Symfony\Component\HttpFoundation\Request;

class MeetingController
{
    public function createMeeting(Request $request){
        $bill = new Meeting();
        $time = new \DateTime();
        $timezone = new \DateTimeZone('Europe/Bucharest');
        $time->setTimezone($timezone);
        $time->format('H:i:s \O\n Y-m-d');
        $bill->setDeadline($time);
        $form =

        $form->handleRequest($request);

    }

}
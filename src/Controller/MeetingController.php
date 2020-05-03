<?php


namespace App\Controller;


use App\Entity\AttendeesMeeting;
use App\Entity\Availability;
use App\Entity\Employee;
use App\Entity\Meeting;
use App\Entity\User;
use App\Form\MeetingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MeetingController extends AbstractController
{
    public function createMeeting(Request $request){
        $session = $request->getSession();
        $companyName = $session->get('user');

        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $companyName]);
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        $meeting = new Meeting();
        $time = new \DateTime();
        $timezone = new \DateTimeZone('Europe/Bucharest');
        $time->setTimezone($timezone);
        $time->format('H:i:s \O\n Y-m-d');
        $meeting->setStart($time);
        $em = $this->getDoctrine()->getManager();
        $participantsAll  = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findBy(['user' => $company]);

        $form = $this->createFormBuilder($meeting)
            ->add('name', TextType::class)
            ->add('start',
                DateTimeType::class, array('attr' => array( 'required' => true)))
            ->add('location', TextType::class)
            ->add('hall', TextType::class)
            ->add('equipment', TextType::class)
//            ->add('attendees', ChoiceType::class, [
////                'class'=>Employee::class,
//                'choices' => $participantsAll,
//                'choice_label' => function ($participant) {
//                    return $participant->getFirstName().' '.$participant->getLastName();},
//                'required' => false,
//                'expanded' => true,
//                'multiple' => true
//            ])
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();
;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  Meeting $meeting */
            $meeting = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $meeting->setUser($company);
//            $bill->setPayment(0);
            $entityManager->persist($meeting);
            $entityManager->flush();

            return $this->redirectToRoute('addAttendees',['meetingId' => $meeting->getId()]);
        }
        return $this->render('newMeeting.html.twig', array('form'=>$form->createView()));

    }

    public function checkAvailability($participants, $startDate){
        $goodParticipants = [];
        $dayofweek = $startDate->format('l');

        /** @var Employee $participant */
        foreach ($participants as $participant) {
            /** @var  Availability $participantAv */
            $participantsAv = $this->getDoctrine()
                ->getRepository(Availability::class)
                ->findBy(['user' => $participant, 'day' => $dayofweek]);


            foreach ($participantsAv as $participantAv){

                if (($participantAv->getStartTime()->format('H:s:i') <= $startDate->format('H:s:i')) && ($participantAv->getEndTime()->format('H:s:i') > $startDate->format('H:s:i'))) {
                    $goodParticipants[] = $participant;
                }
            }
        }
        return $goodParticipants;


    }

    public function addAttendees(Request $request, $meetingId){
        $session = $request->getSession();
        $companyName = $session->get('user');

        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $companyName]);
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        $meeting =  $this->getDoctrine()
            ->getRepository(Meeting::class)
            ->findOneBy(['id' => $meetingId]);

        $participants  = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findBy(['user' => $company]);

        /** @var Employee[] $participantsAll */
        $participantsAll = $this->checkAvailability($participants, $meeting->getStart());

//        die(var_dump($participantsAll));
        $attendees = new AttendeesMeeting();
        $attendees->setMeeting($meeting);

        $form = $this->createFormBuilder($attendees)

            ->add('attendees', ChoiceType::class, [
//                'class'=>Employee::class,
                'choices' => $participantsAll,
                'choice_label' => function ($participant) {
                    return $participant->getFirstName().' '.$participant->getLastName();},
                'required' => false,
                'expanded' => true,
                'multiple' => true
            ])
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();
//        $form = $this->createForm();
//        die(var_dump($form));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  AttendeesMeeting $meeting */
            $meetingAt = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            if ($meetingAt->getAttendees()) {
                foreach ($meetingAt->getAttendees() as $attend) {

                    $attends = new AttendeesMeeting();
                    $attends->setMeeting($meetingAt->getMeeting());
                    $attends->setAttendees($attend);
                    $entityManager->persist($attends);
                    $entityManager->flush();
                }
            }

            return $this->redirectToRoute('listMeeting',['meetingId' => $meeting->getId()]);
        }
        return $this->render('newAttendees.html.twig', array('form'=>$form->createView()));

    }


    public function listMeeting(Request $request){
        $session = $request->getSession();
        $companyName = $session->get('user');

        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $companyName]);
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }

        $meetings =[];
        $meetingDB =  $this->getDoctrine()
            ->getRepository(Meeting::class)
            ->findBy(['user' => $company]);

        $count = 0;
//        die(var_dump($meetingDB));
        if($meetingDB) {
            foreach ($meetingDB as $meeting) {
                /** @var AttendeesMeeting $attendance */
                $attendance = $this->getDoctrine()
                    ->getRepository(AttendeesMeeting::class)
                    ->findBy(['meeting' => $meeting]);
                $participants = [];
                foreach ($attendance as $att) {
                    $employee = $this->getDoctrine()
                        ->getRepository(Employee::class)
                        ->findOneBy(['id' => $att->getAttendees()]);
                    $participants[] = $employee->getFirstName().$employee->getLastName();
                }
                $meetings[$count]['attendees'] = $participants;
                $meetings[$count]['details'] = $meeting;
                $count++;
            }
        }
        return $this->render('listMeeting.html.twig', ['meetings' => $meetings]);

    }

    public function editMeeting(Request $request, $id){
        $session = $request->getSession();
        $companyName = $session->get('user');

        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $companyName]);
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        $meeting = $this->getDoctrine()
            ->getRepository(Meeting::class)
            ->findOneBy(['id' => $id]);
        $em = $this->getDoctrine()->getManager();
        $participantsAll  = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findBy(['user' => $company]);

        $form = $this->createFormBuilder($meeting)
            ->add('name', TextType::class)
            ->add('start',
                DateTimeType::class, array('attr' => array( 'required' => true)))
            ->add('location', TextType::class)
            ->add('hall', TextType::class)
            ->add('equipment', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  Meeting $meeting */
            $meeting = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($meeting);
            $entityManager->flush();

            return $this->redirectToRoute('editAttendees',['meetingId' => $meeting->getId()]);
        }
        return $this->render('newMeeting.html.twig', array('form'=>$form->createView()));


    }

    public function editAttendees(Request $request, $meetingId){
        $session = $request->getSession();
        $companyName = $session->get('user');

        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $companyName]);
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        $meeting =  $this->getDoctrine()
            ->getRepository(Meeting::class)
            ->findOneBy(['id' => $meetingId]);

        $participants  = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findBy(['user' => $company]);

        $participantsOldDB  = $this->getDoctrine()
            ->getRepository(AttendeesMeeting::class)
            ->findBy(['meeting' => $meeting]);
        $participantsOld = [];
        foreach ($participantsOldDB as $att) {
            $employee = $this->getDoctrine()
                ->getRepository(Employee::class)
                ->findOneBy(['id' => $att->getAttendees()]);
            $participantsOld[] = $employee->getId();
        }

        /** @var Employee[] $participantsAll */
        $participantsAll = $this->checkAvailability($participants, $meeting->getStart());

        $attendees = new AttendeesMeeting();
        $attendees->setMeeting($meeting);

        $form = $this->createFormBuilder($attendees)

            ->add('attendees', ChoiceType::class, [
                'choices' => $participantsAll,
                'choice_label' => function ($participant) {
                    return $participant->getFirstName().' '.$participant->getLastName();},
                'required' => false,
                'expanded' => true,
                'multiple' => true
            ])
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  AttendeesMeeting $meeting */
            $meetingAt = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $idsMew = [];
            if ($meetingAt->getAttendees()) {
                foreach ($meetingAt->getAttendees() as $attend) {
                    $idsMew[] = $attend->getId();
                    if(!in_array($attend->getId(), $participantsOld)){
                        $attends = new AttendeesMeeting();
                        $attends->setMeeting($meetingAt->getMeeting());
                        $attends->setAttendees($attend);
                        $entityManager->persist($attends);
                        $entityManager->flush();
                    }
                }
                foreach ($participantsOld as $old){
                    if(!in_array($old, $idsMew)){
                        $em = $this->getDoctrine()->getManager();
                        $attend  = $this->getDoctrine()
                            ->getRepository(AttendeesMeeting::class)
                            ->findOneBy(['attendees' => $old]);
                        $em->remove($attend);
                        $em->flush();
                    }
                }
            }
            if(!$idsMew){
                foreach ($participantsOld as $old){
                        $em = $this->getDoctrine()->getManager();
                        $attend  = $this->getDoctrine()
                            ->getRepository(AttendeesMeeting::class)
                            ->findOneBy(['attendees' => $old]);
                        $em->remove($attend);
                        $em->flush();
                }
            }


            return $this->redirectToRoute('listMeeting',['meetingId' => $meeting->getId()]);
        }
        return $this->render('newAttendees.html.twig', array('form'=>$form->createView()));

    }

    public function deleteMeeting(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $meeting  = $em
            ->getRepository(Meeting::class)
            ->findOneBy(['id' => $id]);
        $participantsDB  = $this->getDoctrine()
            ->getRepository(AttendeesMeeting::class)
            ->findBy(['meeting' => $meeting]);
        if($participantsDB) {
            foreach ($participantsDB as $participant) {
                $em->remove($participant);
                $em->flush();
            }
        }
        $em->remove($meeting);
        $em->flush();

        return $this->redirectToRoute('listMeeting');
    }

}
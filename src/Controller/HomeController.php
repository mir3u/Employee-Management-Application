<?php


namespace App\Controller;


use App\Entity\Bill;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    public function index(Request $request){
        $session = $request->getSession();
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $session->get('user')]);

        $dueBills = $this->dueBills($company);
        return $this->render('home.html.twig' , ["dueBills"=>$dueBills]);
    }

    public function home(Request $request){
        $session = $request->getSession();
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $session->get('user')]);

        $dueBills = $this->dueBills($company);
        return $this->render('home.html.twig' , ["dueBills"=>$dueBills]);
        return $this->render('home.html.twig');
    }

    /**
     * @return bool
     * @throws \Exception
     * @var User $user
     */
    public function dueBills($user){
        $em = $this->getDoctrine()->getManager();
        $time = new \DateTime();
        $timezone = new \DateTimeZone('Europe/Bucharest');
        $time->setTimezone($timezone);
        $time->format('H:i:s \O\n Y-m-d');
        /** @var Bill $bills */
        $bills  = $em
            ->getRepository(Bill::class)
            ->findBy(['user' => $user]);

        /** @var Bill $bill */
        foreach ($bills as $bill){
            $interval = $time->diff($bill->getDeadline());
            $interval->format('%a days');
            if($interval->d<=3){
                return true;
            }
        }
        return false;
    }


}
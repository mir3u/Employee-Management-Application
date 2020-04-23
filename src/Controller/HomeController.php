<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    public function index(Request $request){
        $session = $request->getSession();
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        return $this->render('home.html.twig');
    }

    public function home(Request $request){
        $session = $request->getSession();
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        return $this->render('home.html.twig');
    }


}
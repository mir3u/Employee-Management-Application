<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;

class LogoutController extends AbstractController
{
    public function main(){
        $session = new Session();
        $session->clear('user');
        return $this->render('logout.html.twig');
    }

}
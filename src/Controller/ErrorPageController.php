<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ErrorPageController extends AbstractController
{
    public function main(Request $request){

        return $this->render('errorPage.html.twig',['error'=>$request->query->get('error')]);
    }
}
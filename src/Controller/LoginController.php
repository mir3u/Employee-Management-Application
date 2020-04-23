<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
class                                                                                                                                   LoginController extends  AbstractController
{
    public function login(Request $request){
        $login = new User();
        $form = $this->createFormBuilder($login)
            ->add('username',
                TextType::class, array('attr' => array('class' => 'password-field'), 'required' => true))
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, ['label' => 'Login'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $login = $form->getData();
            $userDB = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['username' => $login->getUsername()]);

            if(!$userDB){
                return $this->redirectToRoute('errorPage', [
                    'error' => "user does not exists"]);
            }
            elseif(strcmp($login->getPassword() , $userDB->getPassword() )){
                return $this->redirectToRoute('errorPage', [
                    'error' => "wrong password "]);
            }
            else{
                $session = new Session();
               //    $session->start();
                $session->set('user',$userDB->getUsername());

                return $this->redirectToRoute('home');
            }
        }
        else{

                return $this->render('login.html.twig', [
                    'form' => $form->createView(),
                ]);
        }
    }
}
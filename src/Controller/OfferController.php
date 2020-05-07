<?php


namespace App\Controller;


use App\Entity\Offer;
use App\Entity\Service;
use App\Entity\User;
use App\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class OfferController
    extends AbstractController
{
    public function add(Request $request)
    {
        $add = new Offer();
        $session = $request->getSession();
        $companyName = $session->get('user');

        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $companyName]);
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }
        $servicies = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findAll();

        $add->setService($servicies);

        $form = $this->createFormBuilder($add)
            ->add('offerName', TextType::class, ['label' => 'Offer Name' ,'required' => true])
            ->add('service', ChoiceType::class, [
                'choices' => $servicies,
                'choice_label' => function ($service) {
                    return $service->getName();},
                'required' => false,
                'expanded' => true,
                'multiple' => false
            ])
//            ->add('service2', TextType::class, ['label' => 'Service 2','required' => false])
//            ->add('service3', TextType::class, ['label' => 'Service 3','required' => false])
            ->add('price', TextType::class, ['label' => 'Price','required' => true])
            ->add('save', SubmitType::class, ['label' => 'Add Offer'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $add = $form->getData();

            $add->setService($add->getService()->getName());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($add);
            $entityManager->flush();
            return $this->redirectToRoute('listOffers');
        }


            return $this->render('addOffer.html.twig', [
                'form' => $form->createView(),
            ]);

    }

    public function listOffers(Request $request){
        /** @var Offer[] $offers */
        $offers = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->findAll();

//        $offers = [];
        /** @var Offer $offer */
//        foreach ($offersDB as $offer){
//            $offers[]["offers"] = $offer;
//            $offers[array_key_last($offers)]["service"]=$offer->getServices()->getValues();
//            die(var_dump($offers));
//        }

        $promote = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->findOneBy(array(),array('chosen' => 'ASC'));
        
        return $this->render('listOffers.html.twig', ['offers' => $offers, 'promote' => $promote]);

    }

    public function editOffer(Request $request, $id){
        $offer   = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->findOneBy(['id' => $id]);


        $servicies = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findAll();

        $form = $this->createFormBuilder($offer)
            ->add('offerName', TextType::class, ['label' => 'Offer Name' ,'required' => true])
            ->add('service', ChoiceType::class, [
                'choices' => $servicies,
                'choice_label' => function ($service) {
                    return $service->getName();},
                'required' => false,
                'expanded' => true,
                'multiple' => false
            ])
//            ->add('service2', TextType::class, ['label' => 'Service 2','required' => false])
//            ->add('service3', TextType::class, ['label' => 'Service 3','required' => false])
            ->add('price', TextType::class, ['label' => 'Price','required' => true])
            ->add('save', SubmitType::class, ['label' => 'Add Offer'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offer = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('listOffers');
        }
        return $this->render('addOffer.html.twig', array('form'=>$form->createView()));

    }

    public function deleteOffer(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $offer  = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->findOneBy(['id' => $id]);
        $em->remove($offer);
        $em->flush();

        return $this->redirectToRoute('listOffers');
    }

    public function chooseOffer(Request $request, $id){
 
    $em = $this->getDoctrine()->getManager();
    $product = $em->getRepository(Offer::class)->find($id);

    if (!$product) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }
    $c = $product->getChosen() + 1;
    $product->setChosen( $c );
    $em->flush();

    return $this->redirectToRoute('listOffers');

    }


    // public function chooseOffer(Offer $offer, $id)
    // {
    //     return $this
    //     ->getDoctrine()->getManager()
    //         ->createQueryBuilder('e')
    //         ->update()
    //         ->set('e.chosen', 'e.chosen + 1')
    //         ->where('e.id = :id')
    //         ->setParameter('id', $id)
    //         ->getDQL()
    //         ->bind_param()
    //         ->execute();
    // }

}
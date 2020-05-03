<?php


namespace App\Controller;


use App\Entity\Offer;
use App\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class OfferController
    extends AbstractController
{
    public function add(Request $request)
    {
        $add = new Offer();

        $form = $this->createFormBuilder($add)
            ->add('offerName', TextType::class, ['label' => 'Offer Name' ,'required' => true])
            ->add('service1', TextType::class, ['label' => 'Service 1','required' => true])
            ->add('service2', TextType::class, ['label' => 'Service 2','required' => false])
            ->add('service3', TextType::class, ['label' => 'Service 3','required' => false])
            ->add('price', TextType::class, ['label' => 'Price','required' => true])
            ->add('save', SubmitType::class, ['label' => 'Add Offer'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $add = $form->getData();

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

        $promote = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->findOneBy(array(),array('chosen' => 'ASC'));
        
        return $this->render('listOffers.html.twig', ['offers' => $offers, 'promote' => $promote]);

    }

    public function editOffer(Request $request, $id){
        $offer   = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->findOneBy(['id' => $id]);

        $form =  $form = $this->createForm(OfferType::class, $offer);

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
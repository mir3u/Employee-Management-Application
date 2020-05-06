<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends AbstractController
{

    public function newPdf()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isHtml5ParserEnabled', TRUE);
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        /** @var \App\Entity\Customer[] $companies */
        $customers=$this->getDoctrine()
            ->getRepository(\App\Entity\Customer::class)
            ->findAll();
        
        // Retrieve the HTML generated in our twig file
        $html = $this->render('newPdf.html.twig', [
            'title' => "Welcome to our PDF",'customers'=>$customers
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        // $dompdf->stream("newPdf.pdf", [
        //     "Attachment" => false
        // ]);


        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->getParameter('kernel.project_dir') . '/public'; 
        //$publicDirectory = $this->parameterBag->get('kernel.project_dir') . '/public';
        // e.g /var/www/project/public/mypdf.pdf
        date_default_timezone_set("Europe/Bucharest");
        $c_date = date("m-d-Y_h-i");
        $pdfFilepath =  $publicDirectory . '/profitable_clients_' . $c_date . '.pdf';
        
        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);


        $dompdf->stream($pdfFilepath, [
             "Attachment" => true
         ]);
        // Send some text response
        //return new Response("The PDF file has been successfully generated !");

        exit;

    }
}
<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

class ExcelController extends AbstractController
{

    public function newExcel()
    {
        $spreadsheet = new Spreadsheet();

         /** @var \App\Entity\Customer[] $companies */
         $customers=$this->getDoctrine()
         ->getRepository(Customer::class)
         ->findAll();

         $i = 2;
        
        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Customer details');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Phone number');
        $sheet->setCellValue('D1', 'Location');
        $sheet->setCellValue('E1', 'Due date');
        $sheet->setCellValue('F1', 'Feedback');
        $sheet->setTitle("My First Worksheet");

        foreach( $customers as $customer ){
            $sheet->setCellValue('A' . $i, $customer->getDetails());
            $sheet->setCellValue('B' . $i, $customer->getEmail());
            $sheet->setCellValue('C' . $i, $customer->getPhoneNo());
            $sheet->setCellValue('D' . $i, $customer->getLocation());
            $sheet->setCellValue('E' . $i, $customer->getDueDate());
            $sheet->setCellValue('F' . $i, $customer->getFeedBack());
            $i++;
        }
        
        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);
        
        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->getParameter('kernel.project_dir') . '/public';
        // e.g /var/www/project/public/my_first_excel_symfony4.xlsx
        date_default_timezone_set("Europe/Bucharest");
        $c_date = date("m-d-Y_h-i");
        $excelFilepath =  $publicDirectory . '/profitable_clients_' . $c_date . '.xlsx';
        $fileName = 'profitable_clients_' . $c_date . '.xlsx';
        
        // Create the file
        $writer->save($excelFilepath);
        
        // Return a text response to the browser saying that the excel was succesfully created
        //return new Response("Excel generated succesfully");
        return $this->file($excelFilepath, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);

    }
}
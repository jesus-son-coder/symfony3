<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Data;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\Response;

class ExcelController extends Controller
{
    /**
     * @Route("/excel_import", name="excel_import_home")
     */
    public function indexAction(Request $request)
    {
        $template_path = $this->get('kernel')->getProjectDir() . '/web/files/template_customers_data.xlsx'; 

        return $this->render('excel/index.html.twig', [
            'template_path' => $template_path,
        ]);
    }


    /**
     * @Route("/excel_import_action", name="excel_import_action")
     */
    public function importAction(Request $request)
    { 
        if (!empty($request->files->get('excel_file'))) {
            $file = $request->files->get('excel_file');
            $tmpFilePath = $file->getPathName();
            $fileName = $file->getClientOriginalName();
            $this->get('session')->set('excel_file_name', $fileName);
            $fileExtension = $file->getClientOriginalExtension(); 

            if($fileExtension == "xlsx") {

                $manager = $this->getDoctrine()->getManager();

                $objPHPExcel = IOFactory::load($tmpFilePath);

                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            
                    $highestRow = $worksheet->getHighestRow();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $data = new Data();
                        $data->setCustomerId($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                        $data->setCustomerName($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                        $data->setAddress($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                        $data->setCity($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                        $data->setPostalCode($worksheet->getCellByColumnAndRow(5, $row)->getValue());
                        $data->setCountry($worksheet->getCellByColumnAndRow(6, $row)->getValue());

                        $listOfData[] = $data;
                        $manager->persist($data);
                    } 
                }

                $manager->flush();

                return $this->render('excel/table-imported.html.twig', [
                    'listData' => isset($listOfData) ? $listOfData : array(),
                    'filename' => $fileName
                ]);
            }
            else {
                return new Response("<label class='text-danger'>Invalid file</label>");
            }
        }
        
        return new Response("<label class='text-danger'>No file inserted</label>");


    }
}

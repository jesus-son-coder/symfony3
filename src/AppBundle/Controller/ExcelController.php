<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Data;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    /**
     * @Route("/excel_import", name="excel_import_home")
     */
    public function indexAction(Request $request)
    {
        $path = $this->get('kernel')->getRootDir() . '/../web/files';
        $inputFileName = $path . '/data.xlsx'; 

        $objPHPExcel = IOFactory::load($inputFileName);

        $manager = $this->getDoctrine()->getManager();

        $listOfData = array();

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            
            $highestRow = $worksheet->getHighestRow();
            for ($row = 2; $row <= $highestRow; $row++) {
                $data = new Data();
                $data->setName($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $data->setEmail($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $listOfData[] = $data;
                $manager->persist($data);
            } 
        }
        $manager->flush();

        return $this->render('excel/index.html.twig', [
            'listData' => $listOfData
        ]);
    }

}

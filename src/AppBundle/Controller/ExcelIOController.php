<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ExcelData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelIOController extends Controller
{
    /**
     * @Route("/excel_io", name="excel_io_home")
     */
    public function indexAction(Request $request)
    {
        // $path = realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR . '../web/files';
        $path = $this->get('kernel')->getRootDir() . '/../web/files';

        $inputFileType = 'Xlsx';
        $inputFileName = $path . '/figures.xlsx';   

        $reader = IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($inputFileName);

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        //dump($sheetData);die();

        $manager = $this->getDoctrine()->getManager();
        
        foreach($sheetData as $i => $item) {
            // On élimine les en-têtes du tableau Excel:
            if($i == 1) continue;
            
            $data = new ExcelData();
            foreach($item as $j => $value) {
                if ($j == 'A') $data->setSerial($value);
                if ($j == 'B') $data->setName($value);
                if ($j == 'C') $data->setDescription($value);
            }
            $manager->persist($data);
        }
        $manager->flush();

        // die('Success: All Excel Data have been imported to the Database !');

        return $this->render('excelio/index.html.twig', [
            
        ]);
    }
}

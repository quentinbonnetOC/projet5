<?php
use mikehaertl\pdftk\Pdf;

class PdfController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        // Fill form with data array
        $pdf = new Pdf(BASE_PATH . '/test_pdf.pdf');
        $pdf->fillForm([
                'CD'=>'test',
                'Club' => 'testclub',
            ])
            ->needAppearances();

        // Check for errors
        if (!$pdf->saveAs('demande_license.pdf')) {
            $error = $pdf->getError();
        } else {
            //redirection vers le document pdf créé
            header("Location: ../demande_license.pdf");

        }
    }
}


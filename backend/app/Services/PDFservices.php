<?php 
namespace App\Services;

// use \tecnickcom\tcpdf as TCPDF;
use TCPDF;
class PDFservices {
    protected  $pdf  ;

   public function configPDF() {
            // set document information
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Nicola Asuni');
        $this->pdf->SetTitle('TCPDF Example 014');
        $this->pdf->SetSubject('TCPDF Tutorial');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 014', PDF_HEADER_STRING);

        // set header and footer fonts
        $this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
   }

    public function printPDF() {
      

       $this->pdf= new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $this->configPDF();

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $this->pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // IMPORTANT: disable font subsetting to allow users editing the document
            $this->pdf->setFontSubsetting(false);

            // set font
            $this->pdf->SetFont('helvetica', '', 10, '', false);

            // add a page
            $this->pdf->AddPage();

            /*
            It is possible to create text fields, combo boxes, check boxes and buttons.
            Fields are created at the current position and are given a name.
            This name allows to manipulate them via JavaScript in order to perform some validation for instance.
            */

            // set default form properties
            $this->pdf->setFormDefaultProp(array('lineWidth'=> 1 , 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 200), 'strokeColor'=>array(255, 128, 128)));

            $this->pdf->SetFont('helvetica', 'BI', 18);
            $this->pdf->Cell(0, 5, 'Example of Form', 0, 1, 'C');
            $this->pdf->Ln(10);

            $this->pdf->SetFont('helvetica', '', 12);

            // First name
            $this->pdf->Cell(35, 5, 'First name:');
            $this->pdf->TextField('firstname', 35, 5, array('lineWidth'=>1), array('v'=>'Lorem ipsum dolor sit', 'dv'=>'dfsdfsdf'));
            // $this->pdf->SetFormValue('firstname', 'Your Value Here');
            $this->pdf->Ln(6);

            // Last name
            $this->pdf->Cell(35, 5, 'Last name:');
            $this->pdf->TextField('lastname', 50, 5);
            $this->pdf->Ln(6);

            // Gender
            $this->pdf->Cell(35, 5, 'Gender:');
            $this->pdf->ComboBox('gender', 30, 5, array(array('', '-'), array('M', 'Male'), array('F', 'Female')));
            $this->pdf->Ln(6);

            // Drink
            $this->pdf->Cell(35, 5, 'Drink:');
            //$this->pdf->RadioButton('drink', 5, array('readonly' => 'true'), array(), 'Water');
            $this->pdf->RadioButton('drink', 5, array(), array(), 'Water');
            $this->pdf->Cell(35, 5, 'Water');
            $this->pdf->Ln(6);
            $this->pdf->Cell(35, 5, '');
            $this->pdf->RadioButton('drink', 5, array(), array(), 'Beer', true);
            $this->pdf->Cell(35, 5, 'Beer');
            $this->pdf->Ln(6);
            $this->pdf->Cell(35, 5, '');
            $this->pdf->RadioButton('drink', 5, array(), array(), 'Wine');
            $this->pdf->Cell(35, 5, 'Wine');
            $this->pdf->Ln(6);
            $this->pdf->Cell(35, 5, '');
            $this->pdf->RadioButton('drink', 5, array(), array(), 'Milk');
            $this->pdf->Cell(35, 5, 'Milk');
            $this->pdf->Ln(10);

            // Newsletter
            $this->pdf->Cell(35, 5, 'Newsletter:');
            $this->pdf->CheckBox('newsletter', 5, true, array(), array(), 'OK');

            $this->pdf->Ln(10);


            // Address
            $this->pdf->Cell(35, 5, 'Address:');
            $this->pdf->TextField('address', 60, 18, array('multiline'=>true, 'lineWidth'=>0, 'borderStyle'=>'none'), array('v'=>'Lorem ipsum dolor sit', 'dv'=>'dfsdfsdf'));
            $this->pdf->Ln(19);

            // Listbox
            $this->pdf->Cell(35, 5, 'List:');
            $this->pdf->ListBox('listbox', 60, 15, array('', 'item1', 'item2', 'item3', 'item4', 'item5', 'item6', 'item7'), array('multipleSelection'=>'true'));
            $this->pdf->Ln(20);

            // E-mail
            $this->pdf->Cell(35, 5, 'E-mail:');
            $this->pdf->TextField('email', 50, 5);
            $this->pdf->Ln(6);

            // Date of the day
            $this->pdf->Cell(35, 5, 'Date:');
            $this->pdf->TextField('date', 30, 5, array(), array('v'=>date('Y-m-d'), 'dv'=>date('Y-m-d')));
            $this->pdf->Ln(10);

            $this->pdf->SetX(50);

            // Button to validate and print
            $this->pdf->Button('print', 30, 10, 'Print', 'Print()', array('lineWidth'=>2, 'borderStyle'=>'beveled', 'fillColor'=>array(128, 196, 255), 'strokeColor'=>array(64, 64, 64)));

            // Reset Button
            $this->pdf->Button('reset', 30, 10, 'Reset', array('S'=>'ResetForm'), array('lineWidth'=>2, 'borderStyle'=>'beveled', 'fillColor'=>array(128, 196, 255), 'strokeColor'=>array(64, 64, 64)));

            // Submit Button
            $this->pdf->Button('submit', 30, 10, 'Submit', array('S'=>'SubmitForm', 'F'=>'http://localhost:8000/capture', 'Flags'=>array('ExportFormat')), array('lineWidth'=>2, 'borderStyle'=>'beveled', 'fillColor'=>array(128, 196, 255), 'strokeColor'=>array(64, 64, 64)));

            // Form validation functions
            $js = <<<EOD
            function CheckField(name,message) {
                var f = getField(name);
                if(f.value == '') {
                    app.alert(message);
                    f.setFocus();
                    return false;
                }
                return true;
            }
            function Print() {
                if(!CheckField('firstname','First name is mandatory')) {return;}
                if(!CheckField('lastname','Last name is mandatory')) {return;}
                if(!CheckField('gender','Gender is mandatory')) {return;}
                if(!CheckField('address','Address is mandatory')) {return;}
                print();
            }
            EOD;

            // Add Javascript code
            $this->pdf->IncludeJS($js);

            // ---------------------------------------------------------

            //Close and output this->pdf document
            $this->pdf->Output('example_014.this->pdf', 'D');
                }
}
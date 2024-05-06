<?php

namespace App\Http\Controllers;

use App\Services\PDFservices;
use Exception;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Log;

class PDFController extends Controller
{
    public function printPDF(PDFservices $PDFservice){
       return  $PDFservice->printPDF();
    }

    public function capture(Request $request) {
            $fileContents = file_get_contents('php://input');         

                        // Split the file contents into lines
            $lines = explode("\n", $fileContents);

            $formData = [];
            foreach ($lines as $line) {
                // Look for lines containing form field data (e.g., /FieldName (Value))
                if (preg_match('/\/T \((.*?)\) \/V \((.*?)\)/', $line, $matches)) {
                     Log::info($line);

                    // Extract field name and value
                    $fieldName = trim($matches[1]);
                    $fieldValue = trim($matches[2]);
                    $fieldValue = str_replace("\0", "", $fieldValue);

                    // Store field name and value in an associative array
                    $formData[$fieldName] = $fieldValue;
                }else{
                    //  Log::info($line);

                }
            }
            Log::info($formData);
            // var_dump($lines);
            return $fileContents;

 


   
  



    }
}

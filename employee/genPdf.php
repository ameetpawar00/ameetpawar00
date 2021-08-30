<?php
//error_reporting(0);
   $my_html = $_POST['html'];
   $name = $_POST['name'].'.pdf';
    include("../include/phpToPDF.php");

    //Your HTML in a variable
  
    //Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
    $pdf_options = array(
      "source_type" => 'html',
      "source" => $my_html,
      "action" => 'save',
      "save_directory" => 'my_pdfs',
      "file_name" => $name);

    //Code to generate PDF file from options above
    phptopdf($pdf_options);
    header("location:my_pdfs/".$name."");
?>
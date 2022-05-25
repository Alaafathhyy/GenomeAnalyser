<?php

if ($_FILES['uploadedfile']['error'] == UPLOAD_ERR_OK              
&& is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) 
{ 
$file =  file_get_contents($_FILES['uploadedfile']['tmp_name']); 
}
$sequence = process_fasta($file);

echo $sequence;


function process_fasta($fasta_sequence)
{
    $fasta_lines = explode("\n", $fasta_sequence);
    $header = "";
    $sequence = "";
    foreach ($fasta_lines as $line) {
        $line = trim($line);
        if (preg_match("/^>/", $line)) {
            $Line_split = explode(" ", $line);
            $header = $Line_split[0];
        } elseif ($line != "") {
            $sequence = $sequence . $line;
        }
    }

    echo $sequence;
}

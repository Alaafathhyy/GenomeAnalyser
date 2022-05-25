<?php 
function revcomp($sequence, $mode="revcomp"){
    $complement_dict = array(
    "A" => "T",
    "T" => "A",
    "G" => "C",
    "C" => "G",
    );
    $nucleotides = str_split($sequence,1);
    $complement_sequence = "";
    foreach($nucleotides as $nucleotide){
        if (isset($complement_dict[$nucleotide])) {
            $complement_sequence = $complement_sequence.$complement_dict[$nucleotide];
        }
    }
    $revcomp_sequence = strrev($complement_sequence); 
    $reverse_sequence = strrev($sequence); 
    if($mode == "revcomp"){
        return $revcomp_sequence;
    }
    elseif($mode == "comp"){
        return $complement_sequence;
    }
    elseif($mode == "rev"){
        return $reverse_sequence;
    }
    else{  
        return "WARNING=> revcomp mode not supported";
    }
}
function Transcribe($sequence){
    $RNA = str_replace('T', 'U', $sequence);    
    return $RNA;
}
function Translate($sequence){
    $table = array(
        'ATA'=>'I', 'ATC'=>'I', 'ATT'=>'I', 'ATG'=>'M',
        'ACA'=>'T', 'ACC'=>'T', 'ACG'=>'T', 'ACT'=>'T',
        'AAC'=>'N', 'AAT'=>'N', 'AAA'=>'K', 'AAG'=>'K',
        'AGC'=>'S', 'AGT'=>'S', 'AGA'=>'R', 'AGG'=>'R',                 
        'CTA'=>'L', 'CTC'=>'L', 'CTG'=>'L', 'CTT'=>'L',
        'CCA'=>'P', 'CCC'=>'P', 'CCG'=>'P', 'CCT'=>'P',
        'CAC'=>'H', 'CAT'=>'H', 'CAA'=>'Q', 'CAG'=>'Q',
        'CGA'=>'R', 'CGC'=>'R', 'CGG'=>'R', 'CGT'=>'R',
        'GTA'=>'V', 'GTC'=>'V', 'GTG'=>'V', 'GTT'=>'V',
        'GCA'=>'A', 'GCC'=>'A', 'GCG'=>'A', 'GCT'=>'A',
        'GAC'=>'D', 'GAT'=>'D', 'GAA'=>'E', 'GAG'=>'E',
        'GGA'=>'G', 'GGC'=>'G', 'GGG'=>'G', 'GGT'=>'G',
        'TCA'=>'S', 'TCC'=>'S', 'TCG'=>'S', 'TCT'=>'S',
        'TTC'=>'F', 'TTT'=>'F', 'TTA'=>'L', 'TTG'=>'L',
        'TAC'=>'Y', 'TAT'=>'Y', 'TAA'=>'_', 'TAG'=>'_',
        'TGC'=>'C', 'TGT'=>'C', 'TGA'=>'_', 'TGG'=>'W',
    );
        $nucleotides = str_split($sequence,3);
        $Portein = "";
        foreach($nucleotides as $nuc){
            if (isset($table[$nuc])) {
                 $Portein = $Portein.$table[$nuc];
            }
        }
    return $Portein;
}
function GC($sequence){
    $length = strlen($sequence); 
    $gcPercent =  substr_count($sequence, 'C')+substr_count($sequence, 'G');
    $percent = ($gcPercent/$length)*100 ;
    return $percent;
}
function DNAMeltingTemperature($sequence){
    $GC =  substr_count($sequence, 'C')+substr_count($sequence, 'G');
    $AT =  substr_count($sequence, 'A')+substr_count($sequence, 'T');
    $Temp = 2*$AT + 4*$GC;
    return $Temp;
}
?>
<?php
    $hari = date("l");
    $tgl = date("d");
    $bln = date("F");
    $thn = date("Y");
    // Pick Hari
	if($hari=="Sunday"){$hari = "Minggu, ";}
	else if($hari=="Monday"){$hari = "Senin, ";}
	else if($hari=="Tuesday"){$hari = "Selasa, ";}
	else if($hari=="Wednesday"){$hari = "Rabu, ";}
	else if($hari=="Thursday"){$hari = "Kamis, ";}
	else if($hari=="Friday"){$hari = "Jum'at, ";}
	else if($hari=="Saturday"){$hari = "Sabtu, ";}
    // Pick Bulan
    if($bln=="January"){ $bulan = "Januari ";}
    else if($bln=="February"){ $bulan = "Februari ";}
    else if($bln=="March"){ $bulan = "Maret ";}
    else if($bln=="April"){ $bulan = "April ";}
    else if($bln=="May"){ $bulan = "Mei ";}
    else if($bln=="June"){ $bulan = "Juni ";}
    else if($bln=="July"){ $bulan = "Juli ";}
    else if($bln=="August"){ $bulan = "Agustus ";}
    else if($bln=="September"){ $bulan = "September ";}
    else if($bln=="October"){ $bulan = "Oktober ";}
    else if($bln=="November"){ $bulan = "November ";}
    else if($bln=="December"){ $bulan = "Desember ";}
    
    $today = $hari.$tgl." ".$bulan.$thn;
?>
<?php

function formatTanggalIndo($tanggal) {
    $bulan = [
        1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    $waktu = strtotime($tanggal);
    $hari  = date("j", $waktu);
    $bln   = (int) date("n", $waktu);
    $thn   = date("Y", $waktu);
    return $hari . " " . $bulan[$bln] . " " . $thn;
}

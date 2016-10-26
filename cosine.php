<?php


function cosinusTokens(array $tokensA, array $tokensB) {
    $dotProduct = $normA = $normB = 0;
    $uniqueTokensA = $uniqueTokensB = array();
    $uniqueMergedTokens = array_unique(array_merge($tokensA, $tokensB));

    foreach ($tokensA as $token) $uniqueTokensA[$token] = 0;
    foreach ($tokensB as $token) $uniqueTokensB[$token] = 0;

    foreach ($uniqueMergedTokens as $token) {
        $x = isset($uniqueTokensA[$token]) ? 1 : 0;
        $y = isset($uniqueTokensB[$token]) ? 1 : 0;
        $dotProduct += $x * $y;
        $normA += $x;
        $normB += $y;
    }

    return ($normA * $normB) != 0
        ? $dotProduct / sqrt($normA * $normB)
        : 0;
}
$kiri = "pembahasan soal darah pada wanita yaitu haid nifas dan istihadhah adalah pembahasan yang paling sering dipertanyakan oleh kaum wanita";
$explode_kiri = explode(" ", $kiri);
$kanan =  "pembahasan soal darah pada wanita yaitu haid nifas dan istihadhah adalah pembahasan yang paling sering dipertanyakan oleh kaum wanita";
$explode_kanan = explode(" ", $kanan);
// usage:
//echo cosinusTokens($explode_kiri, $explode_kanan);

$nilai = 0.035805743701972;

$hasil = str_replace("0.","",number_format($nilai,3,".",","));
echo $hasil;
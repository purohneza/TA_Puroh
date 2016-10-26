<?php

class mmr {

  public $journal = array(
    0 => array (
      'result' => "Tempo interaktif, london: hubungan mesra antara chelsea dengan didier drogba tampaknya akan segera berakhir. Striker pantai gading itu kemungkinan akan mendapat denda 100,000 poundstering (rp 1,5 miliar) akibat mengkritik klub yang menurutnya tidak mendukung performanya di stamford bridge musim ini. Nilai denda itu setara gaji sepekan yang diterima drogba. Dia juga mengaku tidak berminat untuk kembali bermain setelah dibekap cedera lutut dan mengkritik gaya pemilihan pemain yang ditunjukkan luiz felipe scolari. Komentarnya jelas membuat big phil dan ceo the blues peter kenyon marah. Atas aksinya ini klub telah memanggil drogba yang mungkin memilih mengakhiri kariernya bersama chelsea yang dimulainya sejak 2004 setelah hengkang dari marseille"
    ) ,
    1 => array(
      'result' => "blabla bla bla chelsea bla blabla"
    ) 
  );
  private $query = "chelsea denda drogba";

  private $terms = array();
  private $kalimat = array();
  private $idf = array();
  private $tf = array();
  private $W = array();
  private $cs = array(); // cosine similarity
  private $mmr_result = array();

  public function __construct() {
    echo 'Isi dokumen<pre>'; print_r($this->journal); echo '</pre>';
    echo 'Query<pre>'; print_r($this->query); echo '</pre>';
  }

  private function prepareQuery() {

    $terms = explode(" ", $this->query);
    foreach ($terms as $keyTerm => $termValue) {
      $term = preg_replace('@[?:;,+=!~#()0-9]+@', "", strtolower($termValue));
      $terms[$keyTerm] = $term;
    }
    $this->terms = $terms;

    return true;
  }

  public function prepareDoc() {
    $currentDoc = $this->journal[0]['result'];

    $pecahanKalimat = explode(".", $currentDoc);
    $tokens = array();
    $arr_kalimat = array();
    foreach ($pecahanKalimat as $keyKal => $kalimat) {

      /* 2. case folding */
      $kal = preg_replace('@[?:;,+=!~#()0-9]+@', "", strtolower($kalimat));
      array_push($arr_kalimat, $kal);
      //echo '<br><strong>S' . ($keyKal+1) . '</strong>: ' . $kal;

      /* 3. tokenizing */
      $tokenPart = explode(" ", trim($kal));
      $tokens = array();
      foreach ($tokenPart as $part) {
        if (!in_array(trim($part), $tokens)) {
          array_push($tokens, $part);
        }
      }

      /* 4. filtering */
      /* Silahkan query kata2 yang akan di filter */

      /* 5. stemming */
      /* Silahkan query kata2 yang akan di stem */

    }

    $this->kalimat = $arr_kalimat;
    //echo 'Kalimat <pre>'; print_r($this->kalimat); echo '</pre>';
    foreach ($this->kalimat as $key => $kalimat) {
      echo 'kalimat ('.($key+1).') = ' . $kalimat . '</br>';
    }

    return true;
  }

  private function tfidf() {

    $idf = array();
    foreach ($this->terms as $term) {

      $D = 0;
      $dfi = 0;
      foreach ($this->kalimat as $kalKey => $kalimat) {
        $this->tf[$kalKey][$term] = 0;

        $found = false;
        $string = explode(" ", $kalimat);
        foreach ($string as $str) {
          if (strcmp($str, $term) == 0) {
            $this->tf[$kalKey][$term]++;
            $dfi++;
            $found = true;
          }
        }

        //if ($found) {
          $D++;
        //}

      }

      echo '<br>dfi = ' . $dfi;
      echo '<br>D = ' . $D;
      $idf[$term] = 0;
      if ($dfi > 0) {
        $idf[$term] = log10($D / $dfi);
      }
      echo '<br>IDF ('.$term.') = log('.$D.' / '.$dfi.') = ' . $idf[$term];

    }

    $this->idf = $idf;

    /*
    $D = 0;
    $dfi = 0;
    foreach ($this->kalimat as $kalKey => $kalimat) {
      foreach ($this->terms as $term) {
        $this->tf[$kalKey][$term] = 0;
      }

      $found = false;
      $string = explode(" ", $kalimat);
      foreach ($string as $str) {
        foreach ($this->terms as $term) {
          if (strcmp($str, $term) == 0) {
            $this->tf[$kalKey][$term]++;
            $dfi++;
            $found = true;
          }
        }
      }

      if ($found) {
        $D++;
      }
    }
    echo '<pre>'; print_r($this->tf); echo '</pre>';

    echo 'dfi = ' . $dfi;
    echo '<br>D = ' . $D;
    if ($dfi > 0) {
      $idf = log($D / $dfi);
    }
    echo '<br>IDF = log('.$D.' / '.$dfi.') = ' . abs($idf);

    $this->idf = abs($idf);
    */
    return true;
	echo '<br>idf = ' . $idf;
  }

  private function queryRelevance() {
    echo '<br>';
    $denom = 0;
    $tf = $this->tf;
    $idf = $this->idf;

    $denom_idf = 0;
    foreach ($this->terms as $term) {
      $denom_idf += ($idf[$term] * $idf[$term]);

    }
echo '<br>term = ' .$term;
echo '<br>denom_idf = ' . $denom_idf;
//echo '<br>idf = '
    $denom_idf = sqrt($denom_idf);

    foreach ($this->kalimat as $keyKal => $kalimat) {
      echo '<br>W (S'.($keyKal+1).') = ';
      $denom_kal = 0;
      $nom = 0;
      foreach ($this->terms as $term) {
        $denom_kal += ($tf[$keyKal][$term] * $tf[$keyKal][$term]);
        $nom += ($idf[$term] * $tf[$keyKal][$term]);
      }
echo '<br>denom_kal= ' . $denom_kal;
echo '<br>keyKal= ' . $keyKal;
      $denom_kal = sqrt($denom_kal);

      $denom = $denom_idf * $denom_kal;
      echo '('.$nom.' / '.$denom.') = ';

      if ($denom != 0) {
        $this->W[$keyKal] = $nom / $denom;
      } else {
        $this->W[$keyKal] = 0;
      }
      echo $this->W[$keyKal];
    }
echo '<br>nom = ' . $nom;

    return true;
  }

  private function cosineSim() {
    echo '<br>';
    $cs = array();
    $tf = $this->tf;

    $denom_base = array();
    foreach ($this->kalimat as $key => $kal) {
      $denom_kal = 0;
      foreach ($this->terms as $term) {
        $denom_kal += ($tf[$key][$term] * $tf[$key][$term]);
      }
      $denom_kal = sqrt($denom_kal);
      $denom_base[$key] = $denom_kal;
    }

    foreach ($this->kalimat as $keyX => $kalX) {
      foreach ($this->kalimat as $keyY => $kalY) {
        $nom = 0;
        $denom_kal = 0;
        foreach ($this->terms as $term) {
          $denom_kal += ($tf[$keyY][$term] * $tf[$keyY][$term]);
          $nom += ($tf[$keyX][$term] * $tf[$keyY][$term]);
        }
        $denom_kal = sqrt($denom_kal);

        $denom = $denom_base[$keyX] * $denom_kal;

        if ($denom != 0) {
          $cs[$keyX][$keyY] = $nom / $denom;
        } else {
          $cs[$keyX][$keyY] = 0;
        }

      }

    }

    /*
    $tf = $this->tf;
    $cs = array();
    foreach ($this->W as $x => $Wx) {
      foreach ($this->W as $y => $Wy) {
        $ttf = $tf[$x] + $tf[$y];
        if ($tf[$x] != 0 && $tf[$y] != 0) {
          $cs[$x][$y] = $ttf / (sqrt($tf[$x] * $tf[$x]) * sqrt($tf[$y] * $tf[$y]));
        } else {
          $cs[$x][$y] = 0;
        }
      }
    } */
    //echo '<pre>'; print_r($cs); echo '</pre>';
    $this->cs = $cs;

    echo '<br>Cosine Similarity<br>';
    echo '<table border=1>';
    echo '<tr><th>&nbsp;</th>';
    foreach ($this->cs as $n => $cs) {
      echo '<th>S'.($n+1).'</th>';
    }
    echo '</tr>';

    foreach ($this->cs as $x => $cx) {
      echo '<tr><td>S'.($x+1).'</td>';
      foreach ($cx as $y => $cy) {
        echo '<td>'.$cy.'</td>';
      }
      echo '</tr>';
    }

    echo '</table>';

    return true;
  }

  public function generateMmr() {
    $h = 0.7;
    $h1 = 1 - $h;

    $mmr = array();
    $smax = 0;
    $arr_smax = array();
    $arr_smax_value = array();

    /* first iteration */
    $itr = array();
    $next = false;
    $max = 0;
    foreach ($this->W as $key => $w) {
      if ($key == $smax) {
        $itr[$key] = 0;
        continue;
      }

      $val = ($h * $w) - ($h1 * 0);
      $itr[$key] = $val;
      if ($val > $max) {
        $max = $val;
        $smax = $key;
        $next = true;
      }
    }

    /* next iteration */
    while ($next) {
      array_push($arr_smax, $smax);
      array_push($mmr, $itr);
      array_push($arr_smax_value, $max);

      $sbase = $this->W[$smax];
      $cs = $this->cs[$smax];

      $itr = array();
      $max = 0;
      $next = false;
      foreach ($this->W as $key => $w) {
        if (in_array($key, $arr_smax) || $key == $smax) {
          $itr[$key] = 0;
          continue;
        }

        $val = ($h * $w) - ($h1 * $cs[$key]);
        $itr[$key] = $val;
        if ($val > $max) {
          $max = $val;
          $smax = $key;
          $next = true;
        }
      }

    }
    //echo '<pre>'; print_r($arr_smax); echo '</pre>';
    //echo '<pre>'; print_r($mmr); echo '</pre>';

    $this->mmr_result = array(
      'order' => $arr_smax,
      'value' => $arr_smax_value,
      'mmr' => $mmr
    );

    echo '<br>Hasil iterasi MMR<table border=1>';
    echo '<tr><th>iterasi</th>';
    foreach ($this->W as $key => $w) {
      echo '<th>S'.($key+1).'</th>';
    }
    echo '</tr>';
    $ctr = 0;
    foreach ($mmr as $itr => $mmr_itr) {
      echo '<tr><td>'.($ctr+1).'</td>';
      foreach ($mmr_itr as $mmr_value) {
        echo '<td>'.$mmr_value.'</td>';
      }
      echo '</tr>';
      $ctr++;
    }
    echo '</table>';

  }

  public function generate() {

    $this->prepareDoc();

    $this->prepareQuery();

    $this->tfidf();

    $this->queryRelevance();

    $this->cosineSim();

    $this->generateMmr();

    /* RESULT */
    echo '<br>Hasil bobot maksimum MMR<table border=1>';
    echo '<tr><th>iterasi</th><th>kalimat ke-</th><th>nilai mmr</th><th>isi kalimat</th></tr>';
    foreach ($this->mmr_result['order'] as $key => $mmr_order) {
      $mmr = $this->mmr_result['value'][$key];
      echo '<tr><td>'.($key+1).'</td><td>'.($mmr_order+1).'</td><td>'.$mmr.'</td><td>'.$this->kalimat[$mmr_order].'</td></tr>';
    }
    echo '</table>';

  }

}

$mmr = new mmr();
$mmr->generate();

?>

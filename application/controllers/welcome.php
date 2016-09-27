<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('tabel');
		$this->load->library('Algoritma');
		$this->load->library('Preprocessing');
		$this->load->library('simple_html_dom');
	}

	
	public function index()
	{
		$this->load->view('welcome_message');
		
	}
	public function profil()
	{
		$this->load->view('profil');
		
	}
	public function pencarian()
	{
		$q = $this->input->post('query');
		$explode = explode(" ",$q);
		$pettern 	= end($explode);
		$render = $this->algoritma->render($q,$pettern);
		$data = $this->tabel->searching($pettern);

		if($render == 0){
			echo "Algoritma Bayermore tidak menemukan text yang cocok";
			exit();
		}

		if(empty($data)){
				echo "Tidak ada data";
				exit();
			}
		echo "<table class='table'>
			<tr>
				<td>No</td>
				<td>Source</td>
				<td>Description</td>
				<td>Detail</td>
			</tr>
			";
			$no =  1;
			
			//print_r($data['desc']);
		foreach ($data as $key => $value) {
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".htmlspecialchars($value->link)."</td>";
			echo "<td>".htmlspecialchars($value->desc)."</td>";
			
			echo "<td><a id='detail' onclick='details(this);' data-query='".$q."' data-link='".$value->link."' href='#'>Detail</a></td>";
			echo "</tr>";
			$no++;
		}
		echo "</table>";
	}

	public function details(){
		$details 	= $this->input->post('details');
		$link 		= $this->input->post('link');
		
		/*scrapping Dimulai*/		
		$data 	= $this->__curl($link);

		$ret = $data->find('div[.post-single-content box mark-links]'); 
		/*jika ketemu datanya dari web makan proses text processing dimulai*/
		
		$casefolding =  $this->preprocessing->casefolding($ret);
		$tokenizing  =  $this->preprocessing->tokenizing($ret);
	}
	
	public function test(){
		$text 		= "WAKTU NIFAS";
		$pettern 	= "NIFAS";
		$render = $this->algoritma->render($text,$pettern);
		print_r($render);

	}

	public function textprocessing(){
		echo "Kata Pencarian : haid";
		$kata_pencarian = "";
		echo $kata_pencarian." <br/>";

		echo "Text : ";
		$kalimat = "Pembahasan soal darah pada wanita yaitu haid, nifas, dan istihadhah adalah pembahasan yang paling sering dipertanyakan oleh kaum wanita. Dan pembahasan ini juga merupakan salah satu bahasan yang tersulit dalam masalah fiqih, sehingga banyak yang keliru  dalam memahaminya. Bahkan meski pembahasannya telah berulang-ulang kali disampaikan, masih banyak wanita Muslimah yang belum memahami kaidah dan perbedaan dari ketiga darah ini. Mungkin ini dikarenakan darah tersebut keluar dari jalur yang sama namun pada setiap wanita tentulah keadaannya tidak selalu sama, dan berbeda pula hukum dan penanganannya.

HAID

Haidh atau haid (dalam ejaan bahasa Indonesia) adalah darah yang keluar dari rahim seorang wanita pada waktu-waktu tertentu yang bukan karena disebabkan oleh suatu penyakit atau karena adanya proses persalinan, dimana keluarnya darah itu merupakan sunnatullah yang telah ditetapkan oleh Allah kepada seorang wanita. Sifat darah ini berwarna merah kehitaman yang kental, keluar dalam jangka waktu tertentu, bersifat panas, dan memiliki bau yang khas atau tidak sedap.

Haid adalah sesuatu yang normal terjadi pada seorang wanita, dan pada setiap wanita kebiasaannya pun berbeda-beda. Ada yang ketika keluar haid ini disertai dengan rasa sakit pada bagian pinggul, namun ada yang tidak merasakan sakit. Ada yang lama haidnya 3 hari, ada pula yang lebih dari 10 hari. Ada yang ketika keluar didahului dengan lendir kuning kecoklatan, ada pula yang langsung berupa darah merah yang kental. Dan pada setiap kondisi inilah yang harus dikenali oleh setiap wanita, karena dengan mengenali masa dan karakteristik darah haid inilah akar dimana seorang wanita dapat membedakannya dengan darah-darah lain yang keluar kemudian.

Wanita yang haid tidak dibolehkan untuk shalat, puasa, thawaf, menyentuh mushaf, dan berhubungan intim dengan suami pada kemaluannya. Namun ia diperbolehkan membaca Al-Qur’an dengan tanpa menyentuh mushaf langsung (boleh dengan pembatas atau dengan menggunakan media elektronik seperti komputer, ponsel, ipad, dll), berdzikir, dan boleh melayani atau bermesraan dengan suaminya kecuali pada kemaluannya.

Allah Ta’ala berfirman:

وَيَسْأَلُونَكَ عَنِ الْمَحِيضِ قُلْ هُوَ أَذًى فَاعْتَزِلُواْ النِّسَاء فِي الْمَحِيضِ وَلاَ تَقْرَبُوهُنَّ حَتَّىَ يَطْهُرْنَ فَإِذَا تَطَهَّرْنَ فَأْتُوهُنَّ مِنْ حَيْثُ أَمَرَكُمُ اللّهُ

“Mereka bertanya kepadamu tentang (darah) haid. Katakanlah, “Dia itu adalah suatu kotoran (najis)”. Oleh sebab itu hendaklah kalian menjauhkan diri dari wanita di tempat haidnya (kemaluan). Dan janganlah kalian mendekati mereka, sebelum mereka suci (dari haid). Apabila mereka telah bersuci (mandi bersih), maka campurilah mereka itu di tempat yang diperintahkan Allah kepada kalian.” (QS. Al-Baqarah: 222)

Dari Aisyah radhiyallahu ‘anha berkata:

كَانَ يُصِيبُنَا ذَلِكَ فَنُؤْمَرُ بِقَضَاءِ الصَّوْمِ وَلَا نُؤْمَرُ بِقَضَاءِ الصَّلَاةِ

“Kami dahulu juga mengalami haid, maka kami diperintahkan untuk mengqadha puasa dan tidak diperintahkan untuk mengqadha shalat.” (HR. Al-Bukhari No. 321 dan Muslim No. 335)

 Batasan Haid :

    Menurut Ulama Syafi’iyyah batas minimal masa haid adalah sehari semalam, dan batas maksimalnya adalah 15 hari. Jika lebih dari 15 hari maka darah itu darah Istihadhah dan wajib bagi wanita tersebut untuk mandi dan shalat. 
    Imam Ibnu Taimiyah rahimahullah dalam Majmu’ Fatawa mengatakan bahwa tidak ada batasan yang pasti mengenai minimal dan maksimal masa haid itu. Dan pendapat inilah yang paling kuat dan paling masuk akal, dan disepakati oleh sebagian besar ulama, termasuk juga Syaikh Ibnu Utsaimin rahimahullah juga mengambil pendapat ini. Dalil tidak adanya batasan minimal dan maksimal masa haid :

Firman Allah Ta’ala.

وَيَسْأَلُونَكَ عَنِ الْمَحِيضِ ۖ قُلْ هُوَ أَذًى فَاعْتَزِلُوا النِّسَاءَ فِي الْمَحِيضِ ۖ وَلَا تَقْرَبُوهُنَّ حَتَّىٰ يَطْهُرْنَ

“Mereka bertanya kepadamu tentang haid. Katakanlah : “Haid itu adalah suatu kotoran”. Oleh sebab itu, hendaklah kamu menjauhkan diri dari wanita di waktu haid, dan janganlah kamu mendekatkan mereka, sebelum mereka suci…” [QS. Al-Baqarah : 222]

Ayat ini menunjukkan bahwa Allah memberikan petunjuk tentang masa haid itu berakhir setelah suci, yakni setelah kering dan terhentinya darah tersebut. Bukan tergantung pada jumlah hari tertentu. Sehingga yang dijadikan dasar hukum atau patokannya adalah keberadaan darah haid itu sendiri. Jika ada darah dan sifatnya dalah darah haid, maka berlaku hukum haid. Namun jika tidak dijumpai darah, atau sifatnya bukanlah darah haid, maka tidak berlaku hukum haid padanya. Syaikh Ibnu Utsaimin rahimahullah menambahkan bahwa sekiranya memang ada batasan hari tertentu dalam masa haid, tentulah ada nash syar’i dari Al-Qur’an dan Sunnah yang menjelaskan tentang hal ini.

Syaikhul Islam Ibnu Taimiyah rahimahullah mengatakan : “Pada prinsipnya, setiap darah yang keluar dari rahim adalah haid. Kecuali jika ada bukti yang menunjukkan bahwa darah itu istihadhah.”

Berhentinya haid :

Indikator selesainya masa haid adalah dengan adanya gumpalan atau lendir putih (seperti keputihan) yang keluar dari jalan rahim. Namun, bila tidak menjumpai adanya lendir putih ini, maka bisa dengan mengeceknya menggunakan kapas putih yang dimasukkan ke dalam vagina. Jika kapas itu tidak terdapat bercak sedikit pun, dan benar-benar bersih, maka wajib mandi dan shalat.

Sebagaimana disebutkan bahwa dahulu para wanita mendatangi Aisyah radhiyallahu ‘anha dengan menunjukkan kapas yang terdapat cairan kuning, dan kemudian Aisyah mengatakan :

لاَ تَعْجَلْنَ حَتَّى تَرَيْنَ القَصَّةَ البَيْضَاءَ

“Janganlah kalian terburu-buru sampai kalian melihat gumpalan putih.” (Atsar ini terdapat dalam Shahih Bukhari).

NIFAS

Nifas adalah darah yang keluar dari rahim wanita setelah seorang wanita melahirkan. Darah ini tentu saja paling mudah untuk dikenali, karena penyebabnya sudah pasti, yaitu karena adanya proses persalinan. Syaikh Ibnu Utsaimin rahimahullah mengatakan bahwa darah nifas itu adalah darah yang keluar karena persalinan, baik itu bersamaan dengan proses persalinan ataupun sebelum dan sesudah persalinan tersebut yang umumnya disertai rasa sakit. Pendapat ini senada dengan pendapat Imam Ibnu Taimiyah yang mengemukakan bahwa darah yang keluar dengan rasa sakit dan disertai oleh proses persalinan adalah darah nifas, sedangkan bila tidak ada proses persalinan, maka itu bukan nifas.

Batasan nifas : 

Tidak ada batas minimal masa nifas, jika kurang dari 40 hari darah tersebut berhenti maka seorang wanita wajib mandi dan bersuci, kemudian shalat dan dihalalkan atasnya apa-apa yang dihalalkan bagi wanita yang suci. Adapun batasan maksimalnya, para ulama berbeda pendapat tentangnya.

    Ulama Syafi’iyyah mayoritas berpendapat bahwa umumnya masa nifas adalah 40 hari sesuai dengan kebiasaan wanita pada umumnya, namun batas maksimalnya adalah 60 hari. 
    Mayoritas Sahabat seperti Umar bin Khattab, Ali bin Abi Thalib, Ibnu Abbas, Aisyah, Ummu Salamah radhiyallahu ‘anhum dan para Ulama seperti Abu Hanifah, Imam Malik, Imam Ahmad, At-Tirmizi, Ibnu Taimiyah rahimahumullah bersepakat bahwa batas maksimal keluarnya darah nifas adalah 40 hari, berdasarkan hadits Ummu Salamah dia berkata, “Para wanita yang nifas di zaman Rasulullah -shallallahu alaihi wasallam-, mereka duduk (tidak shalat) setelah nifas mereka selama 40 hari atau 40 malam.” (HR. Abu Daud no. 307, At-Tirmizi no. 139 dan Ibnu Majah no. 648). Hadits ini diperselisihkan derajat kehasanannya. Namun, Syaikh Albani rahimahullah menilai hadits ini Hasan Shahih. Wallahu a’lam.
    Ada beberapa ulama yang berpendapat bahwa tidak ada batasan maksimal masa nifas, bahkan jika lebih dari 50 atau 60 hari pun masih dihukumi nifas. Namun, pendapat ini tidak masyhur dan tidak didasari oleh dalil yang shahih dan jelas.

Wanita yang nifas juga tidak boleh melakukan hal-hal yang dilakukan oleh wanita haid, yaitu tidak boleh shalat, puasa, thawaf, menyentuh mushaf, dan berhubungan intim dengan suaminya pada kemaluannya. Namun ia juga diperbolehkan membaca Al-Qur’an dengan tanpa menyentuh mushaf langsung (boleh dengan pembatas atau dengan menggunakan media elektronik seperti komputer, ponsel, ipad, dll), berdzikir, dan boleh melayani atau bermesraan dengan suaminya kecuali pada kemaluannya.

Tidak banyak catatan yang membahas perbedaan sifat darah nifas dengan darah haid. Namun, berdasarkan pengalaman dan pengakuan beberapa responden, umumnya darah nifas ini lebih banyak dan lebih deras keluarnya daripada darah haid, warnanya tidak terlalu hitam, kekentalan hampir sama dengan darah haid, namun baunya lebih kuat daripada darah haid.

 

ISTIHADHAH

Istihadhah adalah darah yang keluar di luar kebiasaan, yaitu tidak pada masa haid dan bukan pula karena melahirkan, dan umumnya darah ini keluar ketika sakit, sehingga sering disebut sebagai darah penyakit. Imam Nawawi rahimahullah dalam Syarah Muslim mengatakan bahwa istihadhah adalah darah yang mengalir dari kemaluan wanita yang bukan pada waktunya dan keluarnya dari urat.

Sifat darah istihadhah ini umumnya berwarna merah segar seperti darah pada umumnya, encer, dan tidak berbau. Darah ini tidak diketahui batasannya, dan ia hanya akan berhenti setelah keadaan normal atau darahnya mengering.

Wanita yang mengalami istihadhah ini dihukumi sama seperti wanita suci, sehingga ia tetap harus shalat, puasa, dan boleh berhubungan intim dengan suami.
Imam Bukhari dan Imam Muslim telah meriwayatkan dari Aisyah radhiyallahu ‘anha :
 جَاءَتَ فاَطِمَةُ بِنْتُ اَبِى حُبَيْشٍ اِلَى النَّبِيُّ صَلَّى اللهُ عَلَيْهِ وَسَلَّمَ وَقَلَتْ ياَرَسُوْلُ اللهِ اِنِّى امْرَاَةٌ اُسْتَحَاضُ فَلاَ اَطْهُرُ، اَفَاَدَعُ الصَّلاَةَ؟ فَقَالَ ياَرَسُوْلُ اللهِ صَلَّى اللهُ عَلَيْهِ وَسَلَّمَ: لاَ، اِنَّمَا ذَلِكَ عِرْقٌ وَلَيْسَ بِالْحَيْضَةِ فَاِذَااَقْبَلَتِ الْحَيْضَةُ فَاتْرُكِى الصَّلاَةَ، فَاِذَا ذَهَبَ قَدْرُهَا فاَغْسِلِى عَنْكِ الدَّمَ وَصَلِّى
Fatimah binti Abi Hubaisy telah datang kepada Nabi shallallahu ‘alaihi wa sallam lalu berkata: “Ya Rasulullah, sesungguhnya aku adalah seorang wania yang mengalami istihadhah, sehingga aku tidak bisa suci. Haruskah aku meninggalkan shalat?” Maka jawab Rasulullah SAW: “Tidak, sesungguhnya itu (berasal dari) sebuah otot, dan bukan haid. Jadi, apabila haid itu datang, maka tinggalkanlah shalat. Lalu apabila ukuran waktunya telah habis, maka cucilah darah dari tubuhmu lalu shalatlah.”
Wallahu a’lam.";
		//echo $kalimat." <br/>";
		echo " <br/>";

		//echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
		$casefolding =  $this->preprocessing->casefolding($kalimat);
		echo "<b>Casefolding :</b>";
		echo "<pre>";
		print_r($casefolding);
		echo "</pre>";

		$tokenizing =  $this->preprocessing->tokenizing($kalimat);
		echo " <br/>";
		echo "<b>Tokenizing :</b>";
		echo "<pre>";
		print_r($tokenizing);
		echo "</pre>";

			
	}
	

	private function __curl($uri) {

	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_HEADER, false);
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($curl, CURLOPT_URL, $uri);
	    curl_setopt($curl, CURLOPT_REFERER, $uri);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
	    $str = curl_exec($curl);
	    curl_close($curl);

	    // Create a DOM object
	    $dom = new simple_html_dom();
	    // Load HTML from a string
	    $dom->load($str);

	    return $dom;
	}

}
?>
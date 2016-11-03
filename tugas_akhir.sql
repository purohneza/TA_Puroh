-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 03. Nopember 2016 jam 12:27
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `query_search`
--

CREATE TABLE IF NOT EXISTS `query_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `tags` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `query_search`
--

INSERT INTO `query_search` (`id`, `code`, `name`, `tags`) VALUES
(1, 'Haid', 'Haid', 'haid|nifas|istihadhah'),
(2, 'Puasa', 'Puasa', 'puasa|shaum|hukum puasa|obat pencegah sakit saat berpuasa'),
(3, 'Alis', 'Alis', 'alis|halis|berhias|berdandan|bercermin'),
(4, 'Shalat', 'Shalat', 'shalat|hukum shalat|batal shalat|qadha shalat'),
(5, 'Aurat', 'Aurat', 'aurat|pakaian|perhiasan|berhias'),
(6, 'KB', 'KB', 'kb|Keluarga Berencana|obat pencegah|obat pencegah|hukum kb'),
(7, 'Kutek', 'Kutek', 'kutek|cat kuku|berhias');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resource_hadist`
--

CREATE TABLE IF NOT EXISTS `resource_hadist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arabic_source` text,
  `indonesian_source` text,
  `id_query_search` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `resource_hadist`
--

INSERT INTO `resource_hadist` (`id`, `arabic_source`, `indonesian_source`, `id_query_search`) VALUES
(1, NULL, 'Dari urwah dari fatimah binti Abi Jahsy, bahwa ia mengeluarkan darah, maka bersabdalah nabi kepada nya: "kalau itu darah haid, maka warna nya kelihatan hitam. Bila demikin hal nya maka berhentilah kamu shlat"', 2),
(2, NULL, 'Dari Aisyah r.a dia berkata Fatimah binti Abi Hubaisy pernah datang kepada rasulallah saw lalu betanya sesungguhnya saya menderita istihadah hingga aku tak kunjung bersih, haruskah aku meninggalkan shalat? Maka sabda rasul kepadanyya: jangan! Tinggalkan shalat hanya pada hari-hari basanya kau haid saja, kemudan mandilah dan berwudhu tiap ali hendak shalat. kemudian tetaplah shalat sekalipun darah menetes pada tikar (At-Tirmidzi, Abu daud, A-Nasa''i, Ibu majah, Ahmad dan Ibnu Hibban)', 2),
(5, 'لاَ تَعْجَلْنَ حَتَّى تَرَيْنَ القَصَّةَ البَيْضَاءَ', 'Janganlah kalian terburu-buru sampai kalian melihat gumpalan putih. (Atsar ini terdapat dalam Shahih Bukhari).', 2),
(6, NULL, 'Dari Abu Hurairah r.a bahwa nabi sa bersabda : " satu hari pun wanita tak boleh berpuasa bila suami nya ada di rumah tanpa seizinnya, kecuali bulan Ramadhan.', 2),
(7, NULL, 'Ibnu Abbas mengatakan " ayat ini termasuk mansukh, karena ia ditujukan kepada orang yang sudah lanjut usia nya dan wanita yang tak mampu berpuasa, maka bolehlah ia memberi makan (H.R Al-Bukhari)', 1),
(8, NULL, 'Kami dahulu juga mengalami haid, maka kami diperintahkan untuk mengqadha puasa dan tidak diperintahkan untuk mengqadha shalat.” (HR. Al-Bukhari No. 321 dan Muslim No. 335)', 1),
(9, NULL, 'Dari Aisyah r.a dia berkata Fatimah binti Abi Hubaisy pernah datang kepada rasulallah saw lalu betanya sesungguhnya saya menderita istihadah hingga aku tak kunjung bersih, haruskah aku meninggalkan shalat? Maka sabda rasul kepadanyya: jangan! Tinggalkan shalat hanya pada hari-hari basanya kau haid saja, kemudan mandilah dan berwudhu tiap ali hendak shalat. kemudian tetaplah shalat sekalipun darah menetes pada tikar (At-Tirmidzi, Abu daud, A-Nasa''i, Ibu majah, Ahmad dan Ibnu Hibban)', 2),
(10, NULL, 'Allah mengutuk perempuan - perempuan penato dan mereka minta di tato, perempuan - perempuan yang mecukur alis dan mereka yang minta di cukur alisnya, peremuan-perempuan yang mengikir giginya agar lebih indah dan mereka yang merubah ciptaan allah (Ibnu Mas''ud r.a)', 3),
(11, NULL, 'Shalat berjamaah itu lebih utama daripada shalat sendirian, dengan dua puluh derajat) Al-Bukhari (645), dan Muslim (650))', 4),
(12, NULL, 'Aku mengerjakan shalat, bershaf bersama seorang anak yatim, di belakang Nabi Saw. sedang ibuku-Ummu Sulaim-berdiri di belakang kami (H.R.Bukhari (727), Muslim(658), Abu Dawud (612), dan An-Nasa’i(2/85))', 4),
(13, NULL, 'Dari Ummu Athiyyah, dia berkata, “ Kami diperintah untuk keluar pada hari Id, bahkan kami mengajak keluar gadis perawan dan wanita haid dengan menempatkan mereka di belakang jamaah lainnya, lantas mereka bertakbir dan berdoa bersama kaum muslimin serta mengharapkan berkah dan kesucian hari itu (Al-Bukhari (971),Muslim (890), dan Abu Dawud (1136))', 4),
(14, NULL, 'Ummu Athiyyah berkata :” Wahai Rasulullah, berdosakan seorang perempuan yang tidak shalat ‘Id karena tidak memiliki jilbab?”Rasulullah menjawab, Hendaklah teman perempuannya meminjamkan jilbabnya kepada temannya yang tidak punya jilbab agar mereka dapat menghadiri acra kebaikan dan doanya orang-orang yang beriman (H.R. Bukhari (980))', 4),
(15, NULL, 'Janganlah dia menghentikan shalatnya sampai dia mendengar suaranya atau mencium baunya(H.R. Bukhari (197),  Muslim (361))', 4),
(16, NULL, 'Nabi SAW. bersabda : “Makanlah kalian, minumlah, bersedekahlah, dan berpakaianlah dengan tidak berlebih-lebihan dan tanpa kesombongan.” (H.R Al-Bukhari)', 4),
(17, NULL, 'Dari ‘Aisyah r.a bahwa Nabi SAW.bersabda : Artinya :”Allah takkan menerima shalat wanita yang telah dewasa kecuali bila memakai tutup kepala (H.R Lima Perawi selain An-Nasa’i, begitu pula dikeluarkan oleh Ibnu Khuzaimah)', 4),
(18, NULL, 'Nabi SAW. melaknat wanita yang mencukur bulu alisnya dan wanita yang minta dicukur bulu alisnya (H.R Al-Bukhari dan Muslim dan selain mereka)', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `similarity`
--

CREATE TABLE IF NOT EXISTS `similarity` (
  `id` int(15) NOT NULL,
  `kata` varchar(200) NOT NULL,
  `tf` varchar(500) NOT NULL,
  `idf` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `source_uri`
--

CREATE TABLE IF NOT EXISTS `source_uri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) DEFAULT NULL,
  `id_query_search` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `source_uri`
--

INSERT INTO `source_uri` (`id`, `uri`, `id_query_search`) VALUES
(1, 'http://www.fiqihwanita.com/hukum-shalat-bagi-orang-yang-menjalani-operasi-dan-pingsan/', 4),
(2, 'http://www.fiqihwanita.com/batalkah-shalat-jika-kentut-dari-kemaluan/', 4),
(3, 'http://www.fiqihwanita.com/tata-cara-mengqadha-shalat-yang-terlupa/', 4),
(4, 'http://www.fiqihwanita.com/hukum-memakai-wig-di-hadapan-suami/', 5),
(5, 'http://www.fiqihwanita.com/hukum-memakai-sepatu-berhak-tinggi-high-heels-wedges/', 5),
(6, 'http://www.fiqihwanita.com/pengertian-haid-nifas-dan-istihadhah/', 1),
(7, 'http://www.fiqihwanita.com/hukum-minum-obat-pencegah-haid-agar-dapat-berpuasa/', 2),
(8, 'http://www.fiqihwanita.com/hukum-mencukur-alis/', 3),
(9, 'http://www.fiqihwanita.com/hukum-kb-dalam-pandangan-islam/', 6),
(10, 'http://www.fiqihwanita.com/wudhunya-wanita-yang-kukunya-menggunakan-kutek/', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$TSHLPnxDt8LE1m6zqezsBeuxWC3J.b8hEnLtwyAKII.sim2juO0cm', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1478052513, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'puroh', '$2y$08$GS5d1w7KfVNkipkXqKsvQ.3x9UNzI9WicQuzzm1kwIeUAjKoIBAQi', NULL, 'puroh@gmail.com', NULL, NULL, NULL, NULL, 1477987397, 1478052485, 1, 'neneng', 'sapuroh', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(4, 1, 2),
(5, 2, 2);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

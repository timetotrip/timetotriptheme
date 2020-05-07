<?php
	define( '_C_LIST', '1.0.0' );
	
	$countrylist = array();
	$categorylist = array(
		"immi" => "入国",
		"move" => "移動",
		"stay" => "宿泊",
		"clot" => "衣服",
		"food" => "食事",
		"play" => "遊び",
	);
	
	class city {
		private $name = '';
		private $pict = '';
		
		public function __construct($name,$pict) {
			$this->setName($name);
			$this->setPict($pict);
		}
		
		public function setName($name) {
			$this->name = (string)filter_var($name);
		}
		public function setPict($pict) {
			$this->pict = (string)filter_var($pict);
		}
		public function getName() {
			return $this->name;
		}
		public function getPict() {
			return $this->pict;
		}
	}
		
	
	class country {
		private $name = '';
		private $desc = '';
		private $pict = '';
		private $citys;
		
		public function __construct($name,$desc,$pict) {
			$this->setName($name);
			$this->setDesc($desc);
			$this->setPict($pict);
			$this->citys = array();
		}
		
		public function setName($name) {
			$this->name = (string)filter_var($name);
		}
		public function setDesc($desc) {
			$this->desc = (string)filter_var($desc);
		}
		public function getName() {
			return $this->name;
		}
		public function getDesc() {
			return $this->desc;
		}
		public function setPict($pict) {
			$this->pict = (string)filter_var($pict);
		}
		public function getPict() {
			return $this->pict;
		}
		public function setCity($slag,$name,$pict) {
			$this->citys += array( $slag => new city( $name,$pict ) );
		}
		public function getCitys() {
			return $this->citys;
		}
	}
	
	/*
	 *
	 *  カナダ
	 *
	 * * * * * * * * * * * * * * * * */
	 
	$countrylist += array(
		"canada" => new country(
			"カナダ",
			"欧米文化と大自然、アクティビティが魅力のカナダは人気の留学先。",
			"canada.jpg"
		),
	);
	
	$countrylist["canada"]->setCity(
		"toronto",
		"トロント",
		"toronto.jpg"
	);
	$countrylist["canada"]->setCity(
		"vancouver",
		"バンクーバー",
		"vancouver.jpg"
	);
	$countrylist["canada"]->setCity(
		"whistler ",
		"ウィスラー",
		"whistler.jpg"
	);
	$countrylist["canada"]->setCity(
		"princeedwardisland ",
		"プリンスエドワード島",
		"princeedwardisland.jpg"
	);
	$countrylist["canada"]->setCity(
		"nelson ",
		"ネルソン",
		"nelson.jpg"
	);
	
	
	/*
	 *
	 *  メキシコ
	 *
	 * * * * * * * * * * * * * * * * */
	$countrylist += array(
		"mexico" => new country(
			"メキシコ",
			"太陽の国で刺激にあふれた旅。文化、食事、歴史、エキサイティング。",
			"mexico.jpg"
		),
	);
	$countrylist["mexico"]->setCity(
		"dcmx",
		"ニューメキシコ",
		"dcmx.jpg"
	);
	$countrylist["mexico"]->setCity(
		"guanajuato",
		"グァナファト",
		"guanajuato.jpg"
	);
	$countrylist["mexico"]->setCity(
		"sanmigueldeallende",
		"サンミゲルアジェンデ",
		"sanmigueldeallende.jpg"
	);
	$countrylist["mexico"]->setCity(
		"guadalajara",
		"グアダラハラ",
		"guadalajara.jpg"
	);
	$countrylist["mexico"]->setCity(
		"sanluispotosí",
		"サンルイスポトシ",
		"sanluispotosí.jpg"
	);
	$countrylist["mexico"]->setCity(
		"playamaruata",
		"プラヤマルアタ",
		"playamaruata.jpg"
	);
	$countrylist["mexico"]->setCity(
		"taxco",
		"タクソ",
		"taxco.jpg"
	);
		/*
	 *
	 *  スペイン
	 *
	 * * * * * * * * * * * * * * * * */
	$countrylist += array(
		"spain" => new country(
			"スペイン",
			"情熱のラテンとヨーロッパ文化を楽しく美味しく美しく。",
			"spain.jpg"
		),
	);
	$countrylist["spain"]->setCity(
		"barcelona",
		"バルセロナ",
		"barcelona.jpg"
	);
	$countrylist["spain"]->setCity(
		"valencia",
		"バレンシア",
		"valencia.jpg"
	);
		/*
	 *
	 *  フィリピン
	 *
	 * * * * * * * * * * * * * * * * */
	$countrylist += array(
		"philippine" => new country(
			"フィリピン",
			"南国で気軽に英語留学。ビーチリゾートも満喫しよう。",
			"philippine.jpg"
		),
	);
	$countrylist["philippine"]->setCity(
		"cebu",
		"セブ",
		"cebu.jpg"
	);
	$countrylist["philippine"]->setCity(
		"manila",
		"マニラ",
		"manila.jpg"
	);
	$countrylist["philippine"]->setCity(
		"siargao",
		"シャルガオ",
		"siargao.jpg"
	);

?>


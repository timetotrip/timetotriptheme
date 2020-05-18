<?php
	define( '_F_TALK', '1.0.0' );
	
	class character {
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
	
	function putTalk( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'who' => 'taco',
			'where' => 'l',
		), $atts ) );
		
		$characterlist = array(
			"taco" => new character( "タコ", "tacoicon.png" ),
			"ika" => new character( "イカ", "ikaicon.png" )
		);
		
		$div = "";
		
		$div .= '<p>' . $content . '</p>';
		$div .= '<img src="' . getImagePath($characterlist["taco"]->getPict()) . '"></img>';
		
		return $div;
	}
	add_shortcode('talk', 'putTalk');
	
	
?>
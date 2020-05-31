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
	
	function putTalkScript(){
		
		$spt = '<script>'
					. 'var timeoutId = 0;'
					. 'window.addEventListener( "scroll",function (){'
						. 'if ( timeoutId ) return ;'
						. 'timeoutId = setTimeout( function () {'
							. 'timeoutId = 0 ;'
							. 'document.querySelectorAll(".talk-base").forEach((ts) => {'
								. 'var imgPosTop = ts.offsetTop;'
								. 'var imgPosBot = imgPosTop + ts.offsetHeight;'
								. 'var scroll = this.scrollY;'
								. 'var windowHeight = this.innerHeight;'
								. 'if ((scroll > imgPosTop - windowHeight + (windowHeight/10)*2)&&(scroll < imgPosBot - windowHeight + (windowHeight/10)*8)){'
									. 'ts.classList.add("tk-appeared");'
								. '}'
								. 'else{'
									. 'ts.classList.remove("tk-appeared");'
								. '}'
							. '});'
						. '},250)'
					. '});'
					. '</script>';
		return $spt;
	}
	
	function putTalk( $atts, $content = null ) {
		$atts = shortcode_atts( array(
			'who' => 'taco',
			'where' => 'l',
		), $atts );
		
		$characterlist = array(
			"taco" => new character( "タコ", "tacoicon.png" ),
			"ika"  => new character( "イカ", "ikaicon.png" )
		);
		
		$direct ='';
		if ( $atts['where'] =='l' ):
			$direct = ' tkdr-lr';
		elseif( $atts['where'] =='r' ):
			$direct = ' tkdr-rl';
		endif;
		
		
		$content = str_replace( '<br />', '\n', $content );
		$content = str_replace( '<p>', '\n', $content );
		$content = str_replace( '</p>', '\n', $content );
		$content = str_replace( '\t', '', $content );
		$content = str_replace( '  ', ' ', $content );
		$clist = explode("\n",$content);
		
		$div = "";
		
		//$div .= '<div class="talk-area">';
		$div .= '<div class="talk-base '. $direct .'">';
			$div .= '<div class="tk-charactor">';
				$div .= '<img src="' 
							. getImagePath($characterlist[$atts['who']]->getPict()) 
							. '" loading="lazy" alt="">';
				$div .= '<p>' . $characterlist[$atts['who']]->getName() . '</p>';
			$div .= '</div>';
			$div .= '<div class="tk-puff'. $direct	. '">';
				$div .= '<span class="tk-triangle'. $direct	.'"></span>';
				$div .= '<div class="tk-content'. $direct	. '">';
					foreach($clist as $c):
						
						$c = str_replace( '\n', '', $c );
						
						switch($c):
							case '':
							case ' ':
							case '</br>':
							case '<br />':
							case '\n':
								break;
							case 0 === strncmp( $c, '<', 1 ):
								$div .= $c;
								break;
							default:
								$div .= '<p class="tkc-p">' . $c . '</p>';
								break;
						endswitch;
					endforeach;
				$div .=  '</div>';
			$div .=  '</div>';
		$div .= '</div>';
		//$div .= '</div>';
		return $div;
	}
	add_shortcode('talk', 'putTalk');
	
	
?>
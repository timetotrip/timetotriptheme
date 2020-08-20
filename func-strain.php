<?php
    add_action( 'init', 'create_strain' );
    function create_strain() {
        register_post_type( 'strain', [ // 投稿タイプ名の定義
            'labels' => [
                'name'          => '銘柄', // 管理画面上で表示する投稿タイプ名
                'singular_name' => 'strain',    // カスタム投稿の識別名
            ],
            'public'        => true,  // 投稿タイプをpublicにするか
            'has_archive'   => false, // アーカイブ機能ON/OFF
            'menu_position' => 5,     // 管理画面上での配置場所
            'show_in_rest'  => true,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'revisions',
                'excerpt',
                'custom-fields',
                )
        ]);
    }
    
    add_action( 'init', 'add_strain_taxonomy' );
    function add_strain_taxonomy() {
        register_taxonomy(
            'strain-cat',
            'strain',
            array(
                'label' => '銘柄の種別',
                'singular_label' => '銘柄の種別',
                'labels' => array(
                    'all_items' => '種別一覧',
                    'add_new_item' => '種別を追加'
                ),
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'hierarchical' => true
            )
        );
    }
    function putStrainContent(){
        $div = "";
        wp_reset_query();
        $div .= putH1Index("");
        
        $name_e =   get_field('name_english');
        $name_j =   get_field('name_japanese');
        $name_aka = get_field('aka');
        $origin =   get_field('origin');
        $sih = NULL;
        $updown = 50;

        if(get_field('item')=='marijuana'){
            $blevel= get_field('blevel');
            $updown =   $blevel['updown'];
            $sih =      $blevel['sih'];
            $thc =      $blevel['thc'];
            $cbd =      $blevel['cbd'];
            $rare =     $blevel['rare'];
            $terpenes = $blevel['terpenes'];

        }

        $div .= putStrainHeader($name_e,$name_j,$updown,$sih);

        $div .= breadcrumb();

        $div .= "<article>";

        $div .= putH2IndexS($name_e."とは","strbase");

        $div .= putStrainBaseInfo($name_j,$name_aka,$origin);

        $div .= putH2IndexS("ブリブリレベル","strlebel");

        $div .= putStrainBLevel($thc,$cbd,$updown,$rare,$terpenes);

        $div .= "</article>";
        return $div;
    }
    function putStrainHeader($name_e,$name_j,$updown,$sih){
        $div = "";
        $huedeg = 0;
        $desc = "";

        if($updown>50){
            $huedeg = 120 * (($updown - 50)/50) * -1;
        }
        else if($updown<50){
            $huedeg = 120 * ((50 - $updown)/50);
        }

        if($sih != NULL){
            $desc = $sih->name . '大麻の銘柄';
        }
        else{
            $desc = '大麻の銘柄';
        }


        $div .= '<div class="s-firstview strhead sdw_card">';
        $div .=     '<div class="sf-inner strhead--inner">';
        $div .=         '<div class="strhead--bgcol" style="--huedeg:'.$huedeg.'deg;"></div>';
        $div .=         '<img class="strhead--bgimg" src="'.getImagePath("strain-bg.jpg").'" alt="" loading="lazy" >';
        $div .=         '<div class="sf-title strhead--title sdw_card">';
        $div .=             '<h1 class="sf-h1 strhead--h1">';
        $div .=                 $name_e  ;
        $div .=             '</h1>';
        $div .=             '<p class="strhead--p">';
        $div .=                 $name_j;
        $div .=             '</p>';
        if($desc!=""){
            $div .=         '<p class="strhead--p">';
            $div .=             $desc;
            $div .=         '</p>';
        }
        $div .=         '</div>';
        $div .=     '</div>';
        $div .= '</div>';
        return $div;
    }
    function putStrainBaseInfo($name_j,$name_aka,$origin){
        $div = "";
        $div .=     '<div class="strbase">';
        $div .=         putH3pairStr("和名",$name_j);
        $div .=         putH3pairStr("別名",$name_aka);
        if(!empty($origin)){
            $div .=     putH3pairStr("由来",$origin);
        }
        $div .=     '</div>';
        return $div;
    }
    function putStrainBLevel($thc,$cbd,$updown,$rare,$terpenes){
        $div = "";
        $div .=     '<div class="strlevel">';
        $div .=         putH3pairStr("THC",$thc . '%',
                            putTalk( array('who'=>'taco','where'=>'l', 'always' => 'true'),
                            'THCが高いほどブリブリが強いぞ'
                        ));
        $div .=         putH3pairStr("CBD",$cbd . '%',
                            putTalk( array('who'=>'ika','where'=>'r', 'always' => 'true'),
                            'CBDは医療効果の高いカンナビノイドなんだ'
                        ));
        $div .=         putUpDown($updown,
                            putTalk( array('who'=>'taco','where'=>'l', 'always' => 'true'),
                            '↑UP系はハイが強い  ↓DOWN系はチルが強い'
                        ));
        $div .=         putH3pairStr("TP",'<i class="far fa-question-circle"></i><i class="far fa-question-circle"></i>');
        $div .=     '</div>';
        return $div;
    }
    function putUpDown($updown,$info=""){
        
        $huedeg = 0;
        if($updown>50){
            $huedeg = 120 * (($updown - 50)/50) * -1;
        }
        else if($updown<50){
            $huedeg = 120 * ((50 - $updown)/50);
        }


        $div = "";
        $div .= '<div class="strupdown">';
        $div .=     '<div class="no--pairline--title">';
        $div .=         '<h3 class="">DOWN or UP</h3>';
        $div .=         putInfo("downorup",$info);;
        $div .=     '</div>';
        $div .=     '<div class="pairline">';
        $div .=         '<p class="pairline--l strupdown--l">↓</p>';
        $div .=         '<span class="pairline--bar strupdown--bar">';
        $div .=             '<i class="fas fa-cannabis strupdown--icon" style="--huedeg:'.$huedeg.'deg; --left:'.$updown.'%;"></i>';
        $div .=         '</span>';
        $div .=         '<p class="pairline--r strupdown--r">↑</p>';
        $div .=     '</div>';
        $div .= '</div>';
        return $div;
    }
    function isHTML( $str ) { return preg_match( "/\/[a-z]*>/i", $str ) != 0; }
    function putH3pairStr($left,$right,$info=""){
        $div = "";
        if(isHTML($right) || mb_strlen($right)<=12){
            $div .=     '<div class="pairline">';
            $div .=         '<div class="pairline--l">';
            $div .=             '<h3 class="pairline--l--h3">'.$left.'</h3>';
            $div .=             putInfo($left,$info);
            $div .=         '</div>';
            $div .=         '<span class="pairline--bar"></span>';
            $div .=         '<p class="pairline--r">'.$right.'</p>';
            $div .=     '</div>';
        }
        else{
            $div .=     '<div class="no--pairline--title">';
            $div .=         '<h3 class="">'.$left.'</h3>';
            $div .=         putInfo($left,$info);
            $div .=     '</div>';
            $div .=     '<p class="">'.$right.'</p>';
        }
        return $div;
    }
    function putInfo($id,$info=""){
        $div = "";
        if($info!=""){
            $div .=     '<div class="infobox">';
            $div .=         '<input type="checkbox" id="infobox--on--'.$id.'" class="infobox--on">';
            $div .=         '<label class="infobox--toggle" for="infobox--on--'.$id.'" >';
            $div .=             '<i class="infobox--icon"></i>';
            $div .=         '</label>';
            $div .=         '<div class="infobox--area">';
            $div .=             $info;
            $div .=         '</div>';
            $div .=     '</div>';
        }
        return $div;
    }
    function putInfoScript(){
        
        $spt = ""
        . '<script>'
        .   'document.querySelectorAll(".infobox--on").forEach((icb) => {'
        .       'icb.addEventListener("click", (e) => {'
        .           'if(e.target.checked){'
        .               'setTimeout( (e) => {e.target.checked=false;} ,3000,e)'
        .           '}'
        .       '} );'
        .    '});'
        . '</script>';
        return $spt;
    }

    
?>
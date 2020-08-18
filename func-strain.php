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
        $huedeg = 0;
        $desc = "";

        if(get_field('item')=='marijuana'){
            $blevel= get_field('blevel');
            
            $updown = $blevel['updown'];
            if($updown>50){
                $huedeg = 120 * (($updown - 50)/50) * -1;
            }
            else if($updown<50){
                $huedeg = 120 * ((50 - $updown)/50);
            }

            //var_dump($blevel);
            //var_dump($blevel['sih']);
            if($blevel['sih']!=false){
                $desc = $blevel['sih']->name . '大麻の銘柄';
            }
            else{
                $desc = '大麻の銘柄';
            }
        }

        $div .= putStrainHeader($name_e,$name_j,$desc,$huedeg);

        $div .= breadcrumb();
        $div .= "<article>";
        $div .= putH2IndexS("銘柄の基本情報","str-base");

        $div .= "</article>";
        return $div;
    }
    function putStrainHeader($name_e,$name_j,$desc,$huedeg){
        $div = "";
        $div .= '<div class="s-firstview strhead sdw_card">';
        $div .=     '<div class="sf-inner strhead--inner">';
        $div .=         '<div class="strhead--bgcol" style="--huedeg:'.$huedeg.'deg;"></div>';
        $div .=         '<img class="strhead--bgimg" src="'.getImagePath("strain-bg.jpg").'" alt="" loading="lazy" >';
        $div .=         '<div class="sf-title strhead--title sdw_card">';
        $div .=             '<h1 class="sf-h1 strhead--h1">';
        $div .=                 $name_e  ;
        $div .=             '</h1>';
        $div .=             '<p class="strhead--h1">';
        $div .=                 $name_j;
        $div .=             '</p>';
        if($desc!=""){
            $div .=         '<p class="strhead--h1">';
            $div .=             $desc;
            $div .=         '</p>';
        }
        $div .=         '</div>';
        $div .=     '</div>';
        $div .= '</div>';
        return $div;
    }
?>
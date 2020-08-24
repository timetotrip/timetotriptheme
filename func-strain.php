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
                'show_in_rest' => true,
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
        $looks =    get_field('looks');
        $tastes =   get_field('tastes');
        $award =    get_field('award');
        $reference =get_field('reference');
        $sih = NULL;
        $updown = 50;
        

        if(get_field('item')=='marijuana'){
            $blevel= get_field('blevel');
            $updown =   $blevel['updown'];
            $sih =      $blevel['sih'];
            $thc =      $blevel['thc'];
            $cbd =      $blevel['cbd'];
            $rare =     $blevel['rare'];

            $parents =  get_field('parents');

            $terpenes = [];
            $terpenes[] = $blevel['terpenes'][1];
            $terpenes[] = $blevel['terpenes'][2];
            $terpenes[] = $blevel['terpenes'][3];

            
            $feeling = [];
            $feeling[] = get_field('effect')['feeling'][1];
            $feeling[] = get_field('effect')['feeling'][2];
            $feeling[] = get_field('effect')['feeling'][3];

            $medical = [];
            $medical[] = get_field('effect')['medical'][1];
            $medical[] = get_field('effect')['medical'][2];
            $medical[] = get_field('effect')['medical'][3];

            $negative = [];
            $negative[] = get_field('effect')['negative'][1];
            $negative[] = get_field('effect')['negative'][2];
            $negative[] = get_field('effect')['negative'][3];

            $grow= get_field('grow');
            $difficult = $grow["difficult"];
            $highness = $grow["highness"];
            $yield = $grow["yield"];
            $period = $grow["period"];
        }

        $div .= putStrainHeader($name_e,$name_j,$updown,$sih);

        $div .= breadcrumb();

        $div .= "<article>";


        if(get_field('item')=='marijuana'){
            $div .= putStrainBaseInfo($name_e,$name_j,$name_aka,$origin,$looks,$tastes,$award);
            $div .= putStrainBLevel($thc,$cbd,$updown,$rare);
            $div .= putContent(do_shortcode(get_the_content()));
            $div .= putStrainBFamily($parents);
            $div .= putStrainBStatus($terpenes,$feeling,$medical,$negative);
            $div .= putGrowInfo($difficult,$highness,$yield,$period);
            $div .= putReference($reference);
        }
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
            $desc .= $sih->name;
        }
        $desc .= '大麻の銘柄';


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
    function putStrainBaseInfo($name_e,$name_j,$name_aka,$origin,$looks,$tastes,$award){
        $div = "";
        $div .= putH2IndexS($name_e."とは","strbase");
        $div .=     '<div class="strbase">';
        $div .=         putH3pairStr("和名",$name_j);
        $div .=         putH3pairStr("別名",$name_aka);
        if(!empty($origin)){
            $div .=     putH3pairStr("由来",$origin);
        }
        if(!empty($looks)){
            $div .=     putH3pairStr("外観",$looks);
        }
        if(!empty($tastes)){
            $div .=     putH3pairStr("外観",$tastes);
        }
        if(!empty($award)){
            $awardlist = "";
            $a_arrow=explode ( ',' , $award);
            for($i=0;$i<count($a_arrow);$i++){
                $awardlist .= '<p class="strbase--award">' .$a_arrow[$i] . '</p>';
            }
            if(count($a_arrow)==1){
                $div .=     putH3pairStr("受賞歴",$awardlist);
            }
            else{
                $div .=     putH3pairList("受賞歴",$awardlist);
            }
        }
        $div .=     '</div>';
        return $div;
    }
    function putContent($content){
        $div = "";
        if(!empty($content)){
            $div .= putH2IndexS("ブリブリトーク","content");
            $div .= $content;
        }
        return $div;
    }
    function putStrainBLevel($thc,$cbd,$updown,$rare){
        $div = "";
        $div .= putH2IndexS("ブリブリレベル","strlebel");
        $div .=     '<div class="strlevel">';
        if($thc != 0){
            $div .=     putH3pairStr("THC",$thc . '%',
                            putTalk( array('who'=>'taco','where'=>'l', 'always' => 'true'),
                            'ラボ測定の参考値だ、実際は育て方で増減するぞ'
                        ));
        }
        if($cbd != 0){
            $div .=     putH3pairStr("CBD",$cbd . '%',
                            putTalk( array('who'=>'ika','where'=>'r', 'always' => 'true'),
                            'CBDは医療効果の高いカンナビノイドだいか'
                        ));
        }
        $div .=         putUpDown($updown,
                            putTalk( array('who'=>'taco','where'=>'l', 'always' => 'true'),
                            '↑UP系はハイが強い  ↓DOWN系はチルが強い'
                        ));
        if(!empty($rare)){
            $div .=     putH3pairStr("レアカンナビノイド",implode ( " " , $rare),
                            putTalk( array('who'=>'ika','where'=>'r', 'always' => 'true'),
                            'THCやCBDとはまた違った効果があるいか'
            ));
        }
        $div .=     '</div>';
        return $div;
    }
    function putStrainBFamily($parents){
        $childlen=[];
        $thisid= get_the_ID();

        $args = Array(
                    'post_type' => 'strain',
                    'posts_per_page' => -1,
                );
        $the_query = new WP_Query($args);
        if($the_query -> have_posts()):
            while($the_query -> have_posts()): $the_query -> the_post();
                $tmpparent = get_field('parents');
                if(!empty($tmpparent)){
                    for($i = 0; $i < count($tmpparent); $i++){
                        if ($tmpparent[$i] == $thisid){
                            $childlen[] = get_the_ID();
                        }
                    }
                }
            endwhile;
        endif;
        wp_reset_postdata();

        $div = "";
        if( ((!empty($parents))&&(count($parents) != 0)) || ((!empty($childlen))&&(count($childlen) != 0)) ){
            $div .= putH2IndexS("ファミリー","family");
            $div .= '<div class="strfam">';
            if( ((!empty($parents))&&(count($parents) > 0))){

                $links = "";
                for($i = 0; $i < count($parents); $i++){
                    $links .= '<a class="strfam--link" href="'
                    . get_the_permalink($parents[$i]) . '" ' . putGtagLink("fm_".$thisid) . '>' 
                    .   get_the_title($parents[$i])
                    . '</a>';
                }

                if(count($parents)==1 && mb_strlen(get_the_title($parents[0]))<=14){
                    $div .=     putH3pairStr("親銘柄",$links);
                }
                else{
                    $div .=     putH3pairList("親銘柄",$links);
                }

            }
            if( ((!empty($childlen))&&(count($childlen) > 0))){
                $links = "";
                for($i = 0; $i < count($childlen); $i++){
                    $links .= '<a class="strfam--link" href="'
                    . get_the_permalink($childlen[$i]) . '" ' . putGtagLink("fm_".$thisid) . '>' 
                    .   get_the_title($childlen[$i])
                    . '</a>';
                }

                if(count($childlen)==1 && mb_strlen(get_the_title($childlen[0]))<=12){
                    $div .=     putH3pairStr("子銘柄",$links);
                }
                else{
                    $div .=     putH3pairList("子銘柄",$links);
                }
            }
            $div .= '</div>';
        }
        return $div;
    }
    function putStrainBStatus($terpenes,$feeling,$medical,$negative){
        $div = "";
        if($terpenes[0]!='unknown'||$feeling[0]!='unknown'||$medical[0]!='unknown'||$negative[0]!='unknown'){
            $div .= putH2IndexS("ブリステータス","strstate");
        }

        if($terpenes[0]!='unknown'){
            $div .= putH3pairList("テルペン",putTerpenes($terpenes),putTalk( array('who'=>'taco','where'=>'l', 'always' => 'true'),
            'テルペンの割合で、味や香りだけじゃなく、ブリりかたや医療効果が変わってくるんだ'
        ));
        }
        if($feeling[0]!='unknown'){
            $div .= putH3pairList("ブリタイプ",putEffect($feeling,C_feeling));
        }
        if($medical[0]!='unknown'){
            $div .= putH3pairList("医療効果",putEffect($medical,C_medical));
        }
        if($negative[0]!='unknown'){
            $div .= putH3pairList("ネガティブ",putEffect($negative,C_negative));
            
        }
        return $div;
    }
    function putGrowInfo($difficult,$highness,$yield,$period){
        $div = "";
        if((!empty($difficult))&&($difficult!='unknown')
          ||(!empty($highness))&&($highness!='unknown')
          ||(!empty($yield))&&($yield!='unknown')
          ||(!empty($period))&&($period!='unknown')){
            $div .= putH2IndexS("グロウインフォ","growinfo");
        }
        if((!empty($difficult))&&($difficult!='unknown')){
            $div .= putH3pairStr("難易度",C_difficult[$difficult]);
        }
        if((!empty($highness))&&($highness!='unknown')){
            $div .= putH3pairStr("高さ",C_highness[$highness]);
        }
        if((!empty($yield))&&($yield!='unknown')){
            $div .= putH3pairStr("収穫量",C_yield[$yield],putTalk( array('who'=>'ika','where'=>'r', 'always' => 'true'),
                '0.25㎡あたりの平均だいか'
            ));
        }
        if((!empty($period))&&($period!='unknown')){
            $div .= putH3pairStr("開花周期",C_period[$period]);
        }
        return $div;
    }
    function putReference($reference){
        $div = "";
        //echo 'ref --' . $reference."--";
        if(!empty($reference)){
            //echo 'ref';
            $div .= putH2IndexS("引用元","reference");
            $div .= '<div class="strref">';
            $div .=     putH3pairList("URL",'<a class="strref--url" href="'.$reference.'">'.$reference.'</a>');
            $div .= '</div>';
        }
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

        $ud = "";
        $ud .=     '<div class="pairline strupdown--line">';
        $ud .=         '<p class="pairline--l strupdown--l">↓</p>';
        $ud .=         '<span class="pairline--bar strupdown--bar">';
        $ud .=             '<i class="fas fa-cannabis strupdown--icon" style="--huedeg:'.$huedeg.'deg; --left:'.$updown.'%;"></i>';
        $ud .=         '</span>';
        $ud .=         '<p class="pairline--r strupdown--r">↑</p>';
        $ud .=     '</div>';

        $div = "";
        $div .= '<div class="strupdown">';
        $div .=     putH3pairList("DOWN or UP",$ud,$info);
        $div .= '</div>';
        return $div;
    }

    function putTerpenes($terpenes){
        $div = "";
        for($i = 0; $i < 3; $i++){
            $div .= putStrRank($i+1,
                '<div class="terp">'
            .       '<div class="terp--view">'
            .           '<i class="terp--icon strrank--'.(string)($i+1).C_terpenes_icon[$terpenes[$i]].'" style="--cbase:'.C_terpenes_color[$terpenes[$i]].';"></i>'
            .           '<p class="terp--kind strrank--'.(string)($i+1).'">'.C_terpenes_kind[$terpenes[$i]].'</p>'
            .       '</div>'
            .   '</div>'
            );
        }
        return $div;
    }
    function putEffect($effect,$ebase){
        $div = "";
        for($i = 0; $i < 3; $i++){
            $div .= putStrRank($i+1,
                '<p class="strrank--text strrank--'.(string)($i+1).'">'.$ebase[$effect[$i]].'</p>'
            );
        }
        return $div;
    }
    function putStrRank($rank,$value){

        $div = "";
        //$div .= '<div class="strrank">';
        $div .=     '<div class="pairline strrank">';
        $div .=         '<p class="pairline--l strank--ranknum strrank--'.$rank.'">'.$rank.'</p>';
        $div .=         '<span class="pairline--bar"></span>';
        $div .=         '<span class="pairline--r">'.$value.'</span>';
        $div .=     '</div>';
        //$div .= '</div>';
        return $div;
    }
    function putH3pairStr($left,$right,$info=""){
        $div = "";
        if(mb_strlen($right)<=14 || isHTML($right)){
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
            $div .=     putH3pairList($left,'<p class="fromline">'.$right.'</p>',$info);
        }
        return $div;
    }
    function putH3pairList($left,$list,$info=""){
        $div = "";
        $div .= '<div class="pairlist">';
        $div .=     '<div class="pairlist--title">';
        $div .=         '<h3 class="">'.$left.'</h3>';
        $div .=         putInfo($left,$info);
        $div .=     '</div>';
        $div .=     '<div class="pairlist--list">';
        $div .=         $list;
        $div .=     '</div>';
        $div .= '</div>';
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

    define('C_terpenes_kind', [
        'myrcene' => 'ハーブ',
        'pinene' => 'フォレスト',
        'caryophyllene' => 'ペッパー',
        'limonene' => 'シトラス',
        'terpinolene' => 'フルーティ',
        'humulene' => 'アース',
        'ocimene' => 'スイート',
        'linalool' => 'フラワー'
    ]);
    define('C_terpenes_name', [
        'myrcene' => 'ハーブ',
        'pinene' => 'フォレスト',
        'caryophyllene' => 'ペッパー',
        'limonene' => 'シトラス',
        'terpinolene' => 'フルーティ',
        'humulene' => 'アース',
        'ocimene' => 'スイート',
        'linalool' => 'フラワー'
    ]);
    define('C_terpenes_icon', [
        'myrcene' => ' fas fa-leaf',
        'pinene' => ' fas fa-tree',
        'caryophyllene' => ' fas fa-mortar-pestle',
        'limonene' => ' fas fa-lemon',
        'terpinolene' => ' fas fa-apple-alt',
        'humulene' => ' fas fa-globe-asia',
        'ocimene' => ' fas fa-candy-cane',
        'linalool' => ' fas fa-spa'
    ]);
    define('C_terpenes_color', [
        'myrcene' => '#233c98',
        'pinene' => '#01ae81',
        'caryophyllene' => '#b6016a',
        'limonene' => '#f2ea0b',
        'terpinolene' => '#f46f22',
        'humulene' => '#96ca4f',
        'ocimene' => '#ee255c',
        'linalool' => '#583f99'
    ]);

    define('C_feeling', [
        'aroused' => '覚醒',
        'creative' => 'クリエイティブ',
        'energetic' => 'パワフル',
        'euphoric' => 'うっとり',
        'sleepy' => 'ストーン',
        'focused' => '集中',
        'happy' => 'ハッピー',
        'hungry' => 'マンチ',
        'relaxed' => 'リラックス',
        'talkative' => 'おしゃべり',
        'uplifted' => 'アゲアゲ'
    ]);
    
    define('C_medical', [
        'stress' => '抗ストレス',
        'anxiety' => '抗不安',
        'pain' => '鎮痛',
        'eyepressure' => '眼圧',
        'nausea' => '吐き気',
        'depression' => '抗うつ',
        'insomnia' => '安眠',
        'appetite' => '食欲増進',
        'fatigue' => '疲労回復'
    ]);
    
    define('C_negative', [
        'anxious' => '不安',
        'dizzy' => 'めまい',
        'dryeyes' => 'ドライアイ',
        'drymouth' => 'ドライマウス',
        'giggly' => 'ちくちく',
        'headache' => '頭痛',
        'paranoid' => '被害妄想',
        'sleepy' => '眠くなる',
        'tingly' => 'ぞくぞくする'
    ]);
    
    define('C_difficult', [
        'hard' => 'プロ級',
        'normal' => 'ふつう',
        'easy' => '簡単'
    ]);
    
    define('C_highness', [
        'high' => '2m以上',
        'middle' => '75cm~2m',
        'low' => '75cm以下'
    ]);
    
    define('C_yield', [
        'few' => '100g以下',
        'some' => '100g-300g',
        'many' => '300g以上'
    ]);
    
    define('C_period', [
        'long' => '13週間以上',
        'normal' => '10-12週間',
        'short' => '7-9週間'
    ]);
    
?>
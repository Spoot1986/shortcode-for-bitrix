function get_news_by_id($id){

    if(CModule::IncludeModule("iblock")){

        $res = CIBlockElement::GetByID($id);

        if($ar_res = $res->GetNext()){
            $title = $ar_res['NAME'];
            $img = CFile::GetPath($ar_res['PREVIEW_PICTURE']);
            $link = $ar_res['DETAIL_PAGE_URL'];

        }   

        $result = '<div class="news_el" style="width: 200px; float: left; margin: 5px">';
        $result .= '<img src='.$img.' style="width: 200px">';
        $result .= '<a href='.$link.'>'.$title.'</a>';
        $result .= '</div>';

        return $result;

    }

}

function get_additional_news($text){
    $text_arr = explode('id=', $text);
    
    for ($i=0; $i < count($text_arr); $i++) { 
        $pos = strpos($text_arr[$i], ']');

        if ($pos !== false) {
            $tmp_id = $text_arr[$i];
            $tmp_arr =  explode(']', $tmp_id);
            $news_id = $tmp_arr[0]; 

            $news = get_news_by_id($news_id);
            $text = str_replace('[news id='.$news_id.']', $news, $text);
        }
    }

    return $text; 
}

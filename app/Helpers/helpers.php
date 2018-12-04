<?php
function form_errors($errors){
    $error_list = '';
    foreach($errors->all() as $error){
        $error_list .= '- '.$error.'<br/>';
    }
    $errorsHtml = '<div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$error_list.'
                            </div>
                        </div>
                  </div>';
    return $errorsHtml;
}
function set_admin_menu_active($path, $active = 'open') {
    return \Request::is($path.'/*') || \Request::is($path) ? $active : '';
}
function message(){
    $level = Session('success') != '' ? 'success' : 'danger';
    $message = Session('success') != '' ? Session('success') : Session('error');
    $msghtml = '<div class="alert alert-'. $level .'">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Message: </strong>'.$message.'</div>';
    return $msghtml;
}
function form_buttons(){
    $buttons = '<button type="submit" data-rel="tooltip" data-placement="top" title="save" class="btn active btn-success pull-left"><i class="fa fa-save"></i> Save</button>
                <button type="button" data-rel="tooltip" data-placement="top" title="close" data-dismiss="modal" class="btn active btn-danger pull-right"> <i class="fa fa-times"></i> Close</button>';
    return $buttons;
}
function show_btn($route, $id){
    $btn = '<a class="btn btn-primary" href="'.route($route, $id).'" title="View"><i class="fa fa-eye"></i></a>';
    return $btn;
}
function show_detail_btn($route, $id){
    $btn = '<a class="btn btn-primary" data-toggle="ajax-modal" href="'.route($route, $id).'" title="View Detail"><i class="fa fa-eye"></i></a>';
    return $btn;   
}
function edit_btn($route, $id){
    $btn = '<a class="btn  active btn-success" data-toggle="ajax-modal" href="'.route($route, $id).'" title="Edit"><i class="fa fa-pencil"></i></a>';
    return $btn;
}
function delete_btn($route, $id){
    $btn = Form::open(array("method"=>"DELETE", "route" => array($route, $id), 'class' => 'form-inline', 'style'=>'display:inline')).'
           <a class="btn btn-danger active btn-delete" data-rel="tooltip" data-placement="top" title="delete"><i class="fa fa-trash"></i></a>'.Form::close();
    return $btn;
}
function format_amount($amount,$symbol = false){
    $settings = App\Entities\Setting::first();
    if($settings && $settings->currency != ''){
        return $symbol ? $settings->currency.' '.number_format($amount,2,'.',',') : number_format($amount,2,'.',',') ;
    }else{
        return $symbol ? 'USD'.' '.number_format($amount,2,'.',',') : number_format($amount,2,'.',',') ;
    }
}
function array_multi_subsort($array, $subkey){
    $b = array(); $c = array();
    foreach ($array as $k => $v) {
        $b[$k] = strtolower($v[$subkey]);
    }
    asort($b);
    foreach ($b as $key => $val) {
        $c[] = $array[$key];
    }
    return $c;
}
function limit_words($string, $word_count = 10){
    return Illuminate\Support\Str::words(strip_tags($string),$word_count);
}
function get_settings(){
    $settings = App\Entities\Setting::first();
    return $settings;
}
function social_links(){
    $settings = App\Entities\SocialSetting::first();
    return $settings;
}
function timeDiff($starttime, $endtime){
    $timespent = strtotime( $endtime)-strtotime($starttime);
    $days = floor($timespent / (60 * 60 * 24));
    $remainder = $timespent % (60 * 60 * 24);
    $hours = floor($remainder / (60 * 60));
    $remainder = $remainder % (60 * 60);
    $minutes = floor($remainder / 60);
    $seconds = $remainder % 60;
    $TimeInterval = '';
    if($hours < 0) $hours=0;
    if($hours != 0)
    {
        $TimeInterval = ($hours == 1) ? $hours.' hour' : $hours.' hours';
    }
    if($minutes < 0) $minutes=0;
    if($seconds < 0) $seconds=0;
    $TimeInterval .= $minutes.' minutes '. $seconds.' seconds ';
    return $TimeInterval;
}
function format_date($date){
    $settings = App\Entities\Setting::first();
    $date_format = $settings && $settings->date_format != '' ? $settings->date_format : 'd-m-Y';
    return date($date_format, strtotime($date));
}
function defaultCurrency(){
    $settings = App\Entities\Setting::first();
    if($settings && $settings->currency != ''){
        return $settings->currency;
    }else{
        return 'USD';
    }
}
function currencies(){
    $currencies = array(
        'AUD' => '$',
        'BRL' => 'R$',
        'CAD' => '$',
        'CZK' => 'Kč',
        'DKK' => 'kr',
        'EUR' => '€',
        'HKD' => '$',
        'HUF' => 'Ft',
        'ILS' => '₪',
        'JPY' => '¥',
        'MYR' => 'RM',
        'MXN' => '$',
        'NOK' => 'kr',
        'NZD' => '$',
        'PHP' => '₱',
        'PLN' => 'zł',
        'GBP' => '£',
        'RUB' => '₽',
        'SGD' => '$',
        'SEK' => 'kr',
        'CHF' => 'CHF',
        'TWD' => 'NT$',
        'THB' => '฿',
        'USD' => '$'
    );
    return $currencies;
}
function unique_random($table, $col, $chars = 15){
    $unique = false;
    // Store tested results in array to not test them again
    $tested = [];
      do{
        // Generate random string of characters
        $random = str_random($chars);
        // Check if it's already testing
        // If so, don't query the database again
        if( in_array($random, $tested) ){
            continue;
        }
        // Check if it is unique in the database
        $count = DB::table($table)->where($col, '=', $random)->count();
        // Store the random character in the tested array
        // To keep track which ones are already tested
        $tested[] = $random;
        // String appears to be unique
        if( $count == 0){
          // Set unique to true to break the loop
          $unique = true;
        }
        // If unique is still false at this point
        // it will just repeat all the steps until
        // it has generated a random string of characters
      }
      while(!$unique);
      return $random;
}

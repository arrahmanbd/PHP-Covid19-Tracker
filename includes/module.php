<?php
$result = array();
$result = fetch_data();
$report = array_column($result,'cases')[0];
$death = array_column($result,'deaths')[0];          
$recover = array_column($result,'recovered')[0];
$todayCases = array_column($result,'todayCases')[0];
$todayDeaths = array_column($result,'todayDeaths')[0];
$critical = array_column($result,'critical')[0];
usort($result, 'cmp');   

function change_country($data, $geochart_country){
    $i = 0;
    foreach($data as $each){
        if(array_key_exists($each['country'], $geochart_country)){
            $data[$i]['country'] = $geochart_country[$each['country']];
        }
        $i++;
    }
    return $data;
}

function change_image_url($data, $img_url){
    $i = 0;
    foreach($data as $each){
        if(array_key_exists($each['country'], $img_url)){
            $data[$i]['image'] = $img_url[$each['country']];
        }else{
            $data[$i]['image'] = $each['country'];
        }
        $i++;
    }
    return $data;
}

function cmp($a, $b){
    if($a['cases'] == $b['cases']){
        return 0;
    }else{
        return ($a['cases'] < $b['cases']) ? 1 : -1;
    }
}

function fetch_data(){
    $geochart_country = array(
        "USA" => "US",
        "UK" => "United Kingdom",
        "S. Korea" => "South Korea",
        "UAE" => "United Arab Emirates",
        "CAR" => "Central African Republic",
        "Congo" => "Congo - Kinshasa",
        "South Sudan" => "SS",
        "Czechia" => "Czech Republic",
        "North Macedonia" => "Macedonia");
    $img_url = array( 
        "US" => "United States",
        "UK" => "United Kingdom", 
        "S. Korea" => "South Korea", 
        "Czechia" => "Czech Republic", 
        "UAE" => "United Arab Emirates", 
        "Diamond Princess" => "United Kingdom",
        "Bosnia and Herzegovina" => "Bosnia Herzegovina",
        "North Macedonia" => "Macedonia",
        "Réunion" => "France",
        "Faeroe Islands" => "Faroe Islands",
        "Channel Islands" => "Jersey",
        "DRC" => "Denmark",
        "Guinea-Bissau" => "Guinea Bissau",
        "Isle of Man" => "Ireland",
        "Macao" => "China",
        "Saint Martin" => "France",
        "Eswatini" => "Swaziland",
        "Curaçao" => "Curacao",
        "Cabo Verde" => "Cape Verde",
        "Timor-Leste" => "East Timor",
        "Congo" => "Democratic Republic Congo Brazzaville"
    );
    $data = array();
    $contents = file_get_contents("https://api.nodetent.com/covid19/countries");
    if($contents === false){
        $resultJSON = NULL;
    }else{
        $data = json_decode($contents,true);
    }
    $data = change_country($data, $geochart_country);
    $data = change_image_url($data, $img_url);
    return $data;
}
?>
<?php

class CheckDatas{

    public static function city(string $city, string $zipcode): string|false
    {
        $ch = curl_init("https://apicarto.ign.fr/api/codes-postaux/communes/$zipcode");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cities = json_decode(curl_exec($ch));
        $cities = array_column($cities, 'nomCommune');
        if (!in_array($city, $cities)) {
            return false;
        } else {
            return $city;
        }
    }

    public static function getErrors(array $datas): array{

        $errors = [];
        foreach ($datas as $input => $value) {
            if($value === false){
                $errors[$input] = 'Veuillez respecter le format attendu pour :' . $input;
            }
        }
        return $errors;
    }
}
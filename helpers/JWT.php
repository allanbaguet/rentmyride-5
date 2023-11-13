<?php

class JWT{


    public static function create(object $payload):string{

        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        $payload->iat = time();
        $payload = json_encode($payload);
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, SECRET_KEY, true);

        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

        return $jwt;
    }

    public static function get(string $jwt): object|false{
        
        $jwtArray = explode('.', $jwt);
        
        $base64UrlHeader = $jwtArray[0];
        $header = json_decode(base64_decode($base64UrlHeader));

        $base64UrlPayload = $jwtArray[1];
        $payload = json_decode(base64_decode($base64UrlPayload));

        if(($payload->iat + TIME_TO_EXPIRE <= time() )){
            $isExpired = true;
        } else {
            $isExpired = false;
        }

        $signatureFromURL = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, SECRET_KEY, true);
        $base64SignatureFromURL = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signatureFromURL));

        $base64UrlSignature = $jwtArray[2];

        if($isExpired || $base64SignatureFromURL !== $base64UrlSignature){
            return false;
        } else {
            return $payload;
        }
        
        
        
        
        

        // $header = json_decode();

    }

}
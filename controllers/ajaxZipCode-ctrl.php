<?php

$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT);

$ch = curl_init("https://apicarto.ign.fr/api/codes-postaux/communes/$zipcode");

curl_exec($ch);

curl_close($ch);
<?php
define('NAME', '^[a-zA-Z0-9 éèàêîôù\-]*$');
define('REGISTRATION', '^[a-zA-Z0-9\-]*$');
define('MILEAGE', '^[0-9 ]*$');
define('PHONE', '^(?:\+33|0)[1-9](?:(?:\d{2}){4}|\d{8})$');
define('ZIPCODE', '^\d{5}$');
define('DATE', '^(?:\d{4}-\d{2}-\d{2})$');
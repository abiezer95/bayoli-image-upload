<?php

require 'vendor/autoload.php';

use PayPal\Rest\ApiContext;
Use PayPal\Auth\OAuthTokenCredential;

$clientId = 'AX_1xQYZ9u7R-HeoARZvtuOyenwccS8EcalKvENSEbihWcRB4WBDoYONIG2Gc7oEXNe_SafXKhOxiFDq';
$clientSecret = 'ECnbNOVzqdC-gv4_sbMPWjWUqIda731fdloVih8Q3VcGivRqLf3GvE3_7r3XX8ijk6OeWHow6n6o1mct';

$apiContext = new ApiContext(
new OAuthTokenCredential(
    $clientId,
    $clientSecret
));

$apiContext->setConfig(
      array(
        'log.LogEnabled' => false,
        // 'log.FileName' => 'PayPal.log',
        // 'log.LogLevel' => 'DEBUG',
        'mode' => 'live'
      )
);
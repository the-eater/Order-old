<?php

$law = $which($env('fqdn'), [
    '/main\..*/i' => 'node/main.php',
    '/^WIN-/' => 'node/dev.php'
]);


include($law);
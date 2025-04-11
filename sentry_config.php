<?php
require_once __DIR__ . '/vendor/autoload.php';

use Sentry\init;

// Initialiser Sentry avec votre DSN
\Sentry\init([
    'dsn' => 'https://69b2102f2eb5d20adf64216248cd1985@o4509119456477184.ingest.de.sentry.io/4509125566136400', // Remplacez par votre DSN
    'environment' => 'development', // Vous pouvez changer en 'production' plus tard
    'release' => 'mglsi-news@1.0.0', // Version de votre application
]);
?>
<?php

echo passthru(
<<<<<<< HEAD
  str_replace('/', DIRECTORY_SEPARATOR, __DIR__ . '/vendor/bin/phpunit --bootstrap ' . __DIR__ . '/vendor/autoload.php test --strict-coverage --stop-on-failure')
);
=======
  __DIR__ . '/vendor/bin/phpunit --bootstrap ' . __DIR__ . '/vendor/autoload.php test'
);
>>>>>>> 6ee0c7afb91e063cca3bd63ccf8e1e6de632dcd9

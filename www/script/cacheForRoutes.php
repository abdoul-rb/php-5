<?php

// Récuper le fichier de routes yaml
$listOfRoutes = yaml_parse_file("../routes.yml");

// Création un fichier php dans le dossier cache contenant toutes les routes sous forme d'array
// Le fichier devra s'appeler "routes.cache.php"
$data = var_export($listOfRoutes, true);

file_put_contents("../cache/routes.cache.php", "<?php " . $data);

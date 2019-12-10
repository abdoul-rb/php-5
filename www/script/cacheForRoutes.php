<?php

//Récupération du fichier de routes yaml
$listOfRoutes = yaml_parse_file("../routes.yml");

//Création un fichier php dans le dossier cache Contenant toutes les routes sous forme d'array
$data = var_export($listOfRoutes, true);
file_put_contents("../cache/routes.cache.php", "<?php " . $data);

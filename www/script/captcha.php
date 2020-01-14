<?php

// Créer une véritable image
// entête : informations | descriptions complémentaires sur un fichier
// Modifier l'entête le content-type : image/png via le header('Content-type : ')
// utilisr une fonction php imagepng() retranscrit une image imagecreate(400, 100) et afficher l'image

header('Content-type: image/png');

$image = imagecreate(500, 400);

$black = imagecolorallocate($image, 0, 0, 0);

// Génération de texte aléatoire entre 5 et 7 caractères.
function randomText($length)
{
    $string = '';
    $alphabet='azertyuiopqsdfghjklmwxcvbn1234567890AZERTYUIOPQSDFGHJKLMWXCVBN';
    $max = mb_strlen($alphabet, '8bit') - 1;

    for ($i = 0; $i < $length; $i++) {
        $string .= $alphabet[random_int(0, $max)];
    }
    return $string;
}

$text = randomText(rand(5, 7));

// Fonction parcourant une chaines et affectant à chacun des ses caracteres une proprietés aléatoires.

// Charger une nouvelle police utilisateur
//imageloadfont( . 'ttf');
$arrayFonts = glob(__DIR__."/fonts/*.ttf");
//$arrayFonts = ['./fonts/Lobster-Regular.ttf', './fonts/Roboto-Regular.ttf', './fonts/Montserrat-SemiBold.ttf'];
$generateFont = rand(0, count($arrayFonts) - 1);




for($i = 0; $i < strlen($text); $i++)
{
    $randFont = $arrayFonts[array_rand($arrayFonts)];
    
    $x = rand(0,400/1.5);
    $y = rand(0,200/1.5);

    imagepolygon($image, [
        rand(0,400/1.5), rand(0, 200/1.5),
        rand(0,400/1.5), rand(0, 200/1.5),
        rand(0,400/1.5), rand(0, 200/1.5),
    ], 2, imagecolorallocate($image, rand(1, 255), rand(1, 255), rand(1, 255)));
    //file_put_contents("./rand.txt", print_r(["x"=>$x,"y"=>$y], true), FILE_APPEND);
    // git remote set-url origin git@github.com:abdoul-rb/php-5.git
    imagettftext($image, rand(11, 28), rand(0, 360), $x, $y, imagecolorallocate($image, rand(1, 255), rand(1, 255), rand(1, 255)), $randFont , $text[$i]);
}

imagepng($image);

// Consigne
// Inserer le texte dans l'image avec une police aléatoire par caractère provenant d'un dossier fonts avec des fichier ttf
// Attention : pouvoir ajouter une police dans le dossier et que ça marche automatiquement
// -> Le code PHP parcours le dossier et récupère la police
// -> Un angle, une couleur, une taille, une position, un nombre de forme géométrique aléatoire par caractère
// Le captcha doit ëtre lisible.

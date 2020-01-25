<?php

/**
 * Génerer automatiquement des constantes à partir des fichiers d'environnements : .env, .dev, .prod.
 *
 * @since 1.0
 *
 * @param string $text Contient toutes les variables d'environnements donc en plus
 * du .env contiendra soit le .dev ou le .prod.
 * @param string $extend Fichier d'extension qui vient completé le .env en fonction de 
 * l'environnement sur lequel on se trouve. | Ce sera soit le .prod, soit le .dev
 */
class ConstLoader
{
    private $extend;
    private $text;

    /**
     * __construct
     *
     * @param  mixed $extend fichier d'extension qui vient completé  le .ENV
     *
     * @return void
     */
    public function __construct($extend = "dev")
    {
        $this->extend = $extend;
        $this->checkFiles();
        $this->getFilesEnv();
        $this->load();
    }

    /**
     * Vérifie si les fichiers d'environnements existent
     * 
     * @return void
     */
    public function checkFiles()
    {
        if (!file_exists(".env")) {
            die("Le fichier env n'existe pas");
        } elseif (!file_exists("." . $this->extend)) {
            die("Le fichier " . $this->extend . " n'existe pas");
        }
    }

    /**
     * Ira chercher deux fichier le .env .dev ou .prod
     * 
     * @return void
     */
    public function getFilesEnv()
    {
        //.dev ou .prod
        $this->text = trim(file_get_contents("." . $this->extend));

        //.env
        $this->text .= "\n" . trim(file_get_contents(".env"));
    }

    /**
     * Transforme le contenu de nos fichiers en constantes
     * 
     * @return void
     */
    public function load()
    {
        $lines = explode("\n", $this->text);

        foreach ($lines as $line) {
            $data = explode("=", $line);

            if (!defined($data[0]) && isset($data[1])) {
                define($data[0], $data[1]);
            }
        }
    }
}

<?php

//Génerer automatiquement des constantes a partir des .env .dev
class ConstLoader
{
    private $extend;
    //Contient tout le contenu de .env et de .dev
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

    public function checkFiles()
    {
        if (!file_exists(".env")) {
            die("Le fichier env n'existe pas");
        } elseif (!file_exists("." . $this->extend)) {
            die("Le fichier " . $this->extend . " n'existe pas");
        }
    }

    // Ira chercher deux fichier le
    // .env
    // .dev ou .prod
    public function getFilesEnv()
    {
        //.dev ou .prod
        $this->text = trim(file_get_contents("." . $this->extend));

        //.env
        $this->text .= "\n" . trim(file_get_contents(".env"));
    }

    // Transforme le contenu de nos fichiers en Constantes
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

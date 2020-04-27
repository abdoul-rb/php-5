<?php
namespace App\Core;

class View
{
    private $view;
    private $template;
    // Tableau de données pour passer des paramètres à nos vues
    private $data = [];
    
    public function __construct($view, $template="back")
    {
        $this->setTemplate($template);
        $this->setView($view);
    }
    
    public function setTemplate($template)
    {
        $this->template = strtolower(trim($template));

        if (!file_exists("views/templates/" . $this->template . ".layout.php")) {
            die("Le template n'existe pas");
        }
    }
    
    public function setView($view)
    {
        $this->view = strtolower(trim($view));
        
        if (!file_exists("views/" . $this->view . ".view.php")) {
            die("La vue n'existe pas");
        }
    }

    /**
     * assign permet de passer des paramètres à une vue
     *
     * @param  mixed $key
     * @param  mixed $value
     *
     * @return void
     */
    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * addModal permet d'intégrer un modal dans une vue
     * Modal : Capacité de recentraliser un ensemble de fonctionnalité dont on pourra réutiliser
     *
     * @param  mixed $modal
     * @param  mixed $data
     *
     * @return void
     */
    public function addModal($modal, $data)
    {
        if (!file_exists("views/modals/" . $modal . ".mod.php")) {
            die("Le modal " . $modal . " n'existe pas");
        }
        
        include "views/modals/".$modal.".mod.php";
    }
    
    public function __destruct()
    {
        extract($this->data);

        include "views/templates/" . $this->template . ".layout.php";
    }
}

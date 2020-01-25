<?php 

/**
 * Classes conténant des méthodes statiques pour valider les données qui seront envoyées.
 */
class Validator 
{

    /**
     * Valider un formulaire
     * $config contient la confirguration du formulaire
     * $data les données envoyées
     */
    public static function formValidate($config, $data){
        // Taleau qui va conténir les erreurs trouvé dans le formulaire.
        $listOfErrors = [];

        //Vérification du bon nb de input
        if( count($config["fields"]) == count($data) )
        {
            foreach($config["fields"] as $name => $configField)
            {
                //Vérifier que les names existent et Vérifier les required
                if( isset($data[$name]) && ($configField["required"] && !empty($data[$name])))
                {
                    //Vérifier minlength
                    //Vérifier maxlength

                    //Vérifier le format de l'email
                    if($configField["type"]=="email")
                    {
                        if( self::emailValidate($data[$name]))
                        {
                            //vérifier l'unicté de l'email
                        }

                        else
                        {
                            $listOfErrors[] = $configField["errMsg"];
                        }
                    }

                    elseif($configField["type"]="password"){

                    //Vérifier le format du pwd
                    //Vérifier la confirmation du pwd
                    }

                    //Vérifier le captcha
                }
                else
                {
                    return ["Tentative de hack !!!"];
                }
            }
        }

        else
        {
            return ["Tentative de hack !!!"];
        }

        return $listOfErrors;
    }

    public static function emailValidate($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
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

        // Vérif du nombre de input
        if( count($config['fields']) == count($data))
        {
            foreach( $config['fields'] as $name => $configField )
            {
                if( isset($data[$name] ) && ( $configField['required'] && !empty( $data[$name] ) ) )
                {

                    // Vérifier le format de l'email
                    if( $configField['email'] == 'email')
                    {
                        if( self::emailValidate( $data[$name] ) )
                        {
                            // Vérifier l'unicité de l'email
                        }
                        else 
                        {
                            $listOfErrors[] = $configField['errMsg'];
                        }
                    }
                    elseif($configField[''])
                    {

                    }
                }
            }
        }
        else
        {
            return ['Tentative de hack !!!'];
            // Mettre l'Ip et la géo peut être
        }

            // Vérifier que les names existent et les required

        // Vérif que les names existent

        

        // Vérifier le minlength
        // Vérifier le maxlength

        
        
        // Vérifier l'unicité de l'email


        // Vérif le captcha

        return $listOfErrors;
    }

    public static function emailValidate($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
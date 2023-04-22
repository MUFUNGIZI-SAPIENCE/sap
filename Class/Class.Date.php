<?php
/**
 * class Date retourne la date complete, soit une année; un mois ou un jour
 */
class Date{
    /**
     * @var $annee int retourne la valeur d'une année en numérique
     * @var $mois int retourne la valeur du mois d'une année en numérique
     * @var $jour int retourne la valeur du jour d'un mois en numérique
     */
    private static $annee ;
    private static $moisChiffre;
    private static $mois;
    private static $jour;
    public function __construct(){
        self::$annee = date("Y");
        self::$moisChiffre = date("m");
        self::$jour = date("d") ;
        
    }
    // Retourner une annee complete
    /**
     * @method dateComplete() : renvoie la date complete au format français
     */
    public static function dateComplete(){
        switch(self::$moisChiffre){
        case 1:
            self::$mois = "Janvier";
        break;
        case 2:
            self::$mois = "Février";
        break;
        case 3:
            self::$mois = "Mars";
        break;
        case 4:
            self::$mois = "Avril";
        break;
        case 5:
            self::$mois = "Mai";
        break;
        case 6:
            self::$mois = "Juin";
        break;
        case 7:
            self::$mois = "Juillet";
        break;
        case 8:
            self::$mois = "Août";
        break;
        case 9:
            self::$mois = "Septembre";
        break;
        case 10:
            self::$mois = "Octobre";
        break;
        case 11:
            self::$mois = "Novembre";
        break;
        case 12:
            self::$mois = "Décembre";
        break;
        default :
            die("Erreur");        
        }
        return self::$jour." ".self::$mois." ".self::$annee;
    }
    // fonction qui retourne juste une annee
    /**
     *@method function annee() retoure une année quelconque
     */
    public static function annee()
    {
        return self::$annee;
    }
    // fonction qui retourne juste un mois
    /**
     *@method int mois() retoure le mois d'année quelconque
     */
    public static function moisEnLettre()
    {
        switch(self::$moisChiffre){
            case 1:
                self::$mois = "Janvier";
            break;
            case 2:
                self::$mois = "Février";
            break;
            case 3:
                self::$mois = "Mars";
            break;
            case 4:
                self::$mois = "Avril";
            break;
            case 5:
                self::$mois = "Mai";
            break;
            case 6:
                self::$mois = "Juin";
            break;
            case 7:
                self::$mois = "Juillet";
            break;
            case 8:
                self::$mois = "Août";
            break;
            case 9:
                self::$mois = "Septembre";
            break;
            case 10:
                self::$mois = "Octobre";
            break;
            case 11:
                self::$mois = "Novembre";
            break;
            case 12:
                self::$mois = "Décembre";
            break;
            default :
                die("Erreur");        
            }
        return self::$mois;
    }
// Cette fonction prend un parametre en string et retourne le numero qui correspond au mois
/**
 * @method int mois_de_Lettre_en_Chiffre() Il prend en parametre le mois en lettre et retourne sa valeur en chiffre.
 * @param string $mois_en_lettre prend un mois en letrre
 */
public static function mois_de_Lettre_en_Chiffre($mois_en_lettre)
{
    switch($mois_en_lettre){
        case "Janvier":
            self::$mois = 1;
        break;
        case "Février":
            self::$mois = 2;
        break;
        case "Mars":
            self::$mois = 3;
        break;
        case "Avril":
            self::$mois = 4;
        break;
        case "Mai":
            self::$mois = 5;
        break;
        case "Juin":
            self::$mois = 6;
        break;
        case "Juillet":
            self::$mois = 7;
        break;
        case  "Août":
            self::$mois = 8;
        break;
        case "Septembre":
            self::$mois = 9;
        break;
        case "Octobre":
            self::$mois = 10;
        break;
        case "Novembre":
            self::$mois = 11;
        break;
        case "Décembre":
            self::$mois = 12;
        break;
        default :
            die("Erreur");        
        }
    return self::$mois;
}

    // fonction qui retourne juste un jour
    /**
     *@method jour() retoure le jour du mois
     */
    public static function jour(){
            return self::$jour;
    }
    public static function moisEnChiffre(){
        return self::$moisChiffre;
    }
    // Fonction qui prend la valeur en chiffre correspondant a un moiss
    /**
     * @method string valeur_Mois_en_Chiffre() Est une methode qui prend un chiffre ou nombre entier correspondant au numero du mois
     * dans une annee.
     * @param int $valeur_Mois_en_chiffre le parametre de la methode, prend des valeurs comprises entre 0 et 13.
     */
    public static function valeur_Mois_en_Chiffre($valeur_Mois_en_chiffre)
    {
        switch($valeur_Mois_en_chiffre){
                case 1:
                    self::$mois = "Janvier";
                break;
                case 2:
                    self::$mois = "Février";
                break;
                case 3:
                    self::$mois = "Mars";
                break;
                case 4:
                    self::$mois = "Avril";
                break;
                case 5:
                    self::$mois = "Mai";
                break;
                case 6:
                    self::$mois = "Juin";
                break;
                case 7:
                    self::$mois = "Juillet";
                break;
                case 8:
                    self::$mois = "Août";
                break;
                case 9:
                    self::$mois = "Septembre";
                break;
                case 10:
                    self::$mois = "Octobre";
                break;
                case 11:
                    self::$mois = "Novembre";
                break;
                case 12:
                    self::$mois = "Décembre";
                break;
                default :
                    die("Erreur");        
            
            }
        return self::$mois;
    }

}
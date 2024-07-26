<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function parametre($rub,$srub){
        return (array_key_exists(1,session('menus')[$rub][1][$srub]))?session('menus')[$rub][1][$srub][1]:[];
    }
    public function parametre_exists($rub,$srub,$param){
        return (in_array($param,$this->parametre($rub,$srub)))?true:false;
    }

    public function newFormButton($rub,$srub,$lien){
        if (Auth::user()->profil->nomProfil=='Root'){
            $vue = '';
            $route = 'route';
            if(array_key_exists(1,session('menus')[$rub][1][$srub]) && in_array("Créer",session('menus')[$rub][1][$srub][1])){
                $vue .= '<a href="'.$route($lien).'/'.$rub.'/'.$srub.'">';
                $vue .= '<input value="Nouveau" type="button" class="btn btn-primary btnEnregistrer" style="float:right">';
                $vue .= '</a>';
           } 
           return $vue;
        }else{
            $vue = '';
            $route = 'route';
            if(array_key_exists(1,session('menus')[$rub][1][$srub]) && in_array("Créer",session('menus')[$rub][1][$srub][1])){
                //dd(session('menus'));
                $vue .= '<a href="'.$route($lien).'/'.$rub.'/'.$srub.'">';
                $vue .= '<input value="Nouvelle demande" type="button" class="btn btn-primary btnEnregistrer" style="float:right">';
                $vue .= '</a>';
        } 
            return $vue;
       }               
    }

    public function crudheader($rub,$srub){
        $head = '';
        if(array_key_exists(1,session('menus')[$rub][1][$srub])){
            if(in_array("Modifier",session('menus')[$rub][1][$srub][1])){
                $head .= '<th class="sorting_disabled"></th>';
            }
            if(in_array("Supprimer",session('menus')[$rub][1][$srub][1])){
                $head .= '<th class="sorting_disabled"></th>';
            }
        }
        return $head;
    } 
    public function crudbody($rub,$srub,$route,$lienm,$liens,$id,$type=null){
        //dd($id);
        $lienpay = 'procedure.updateStatut';
        $lienmouvement = 'procedure.updateMouvement';
        //public function crudbody($rub,$srub,$route,$lienm,$liens,$id,$type=null){
        $body = '';
        if(array_key_exists(1,session('menus')[$rub][1][$srub])){
            if(array_key_exists(1,session('menus')[$rub][1][$srub])){
                if(in_array("Modifier",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    $body .= '<a href=" '.$route($lienm,$id).'/'.$rub.'/'.$srub.'" title="Modifier infos"> <i class="fas fa-pencil-alt" style="color: #060" ></i></a> &nbsp;&nbsp;';
                    //$body .= '<a href=" '.$route($lienm,$id).'/'.$rub.'/'.$srub.'" >  <i class="fas fa-pencil-alt" style="color: #060" ></i></a>';
                    // $body .= '</td>';                        
                }
                if(in_array("Supprimer",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Supprimer(this.id,\'\');return false;"> <i class="fas fa-trash-alt" style="color: #F00" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
                if(in_array("Activer_Desactiver",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Activer(this.id);return false;"> <i class="fas fa-send-alt" style="color: #F00" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
                if(in_array("Payer",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($lienpay,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Payer(this.id,\'\');return false;"> <i class="fas fa-dollar-sign" style="color: blue" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
                if(in_array("Commenter",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Mouvement(this.id,\'\');return false;"> <i class="fas fa-envelope" style="color: green" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
                if(in_array("Transferer",session('menus')[$rub][1][$srub][1])){
                    $body .= '<td style="text-align: right" class="actionTd">';
                    $body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($lienmouvement,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Mouvement(this.id,\'\');return false;"> <i class="fas fa-paper-plane" style="color: black" ></i> </a> &nbsp;&nbsp;';
                    $body .= '</td>';
                }
            }
        }
        return $body;
    }


    public function crudbody_metier($rub,$srub,$route,$lienm,$liens,$id){
        //dd($id);
        $lienpay = 'procedure.updateStatut';
        $lienmouvement = 'procedure.updateMouvement';
        //public function crudbody($rub,$srub,$route,$lienm,$liens,$id,$type=null){
        $body = '';
        if(array_key_exists(1,session('menus')[$rub][1][$srub])){
            if(array_key_exists(1,session('menus')[$rub][1][$srub])){
                
                if(in_array("Supprimer",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Supprimer(this.id,\'\');return false;"> <i class="fas fa-trash-alt" style="color: #F00" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
                if(in_array("Activer_Desactiver",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Activer(this.id);return false;"> <i class="fas fa-send-alt" style="color: #F00" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
                if(in_array("Payer",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($lienpay,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Payer(this.id,\'\');return false;"> <i class="fas fa-dollar-sign" style="color: blue" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
                if(in_array("Commenter",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Mouvement(this.id,\'\');return false;"> <i class="fas fa-envelope" style="color: green" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
                if(in_array("Transferer",session('menus')[$rub][1][$srub][1])){
                    // $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($lienmouvement,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Mouvement(this.id,\'\');return false;"> <i class="fas fa-paper-plane" style="color: black" ></i> </a> &nbsp;&nbsp;';
                    // $body .= '</td>';
                }
            }
        }
        return $body;
    }

    public function crudbodyAlt($rub,$srub,$route,$lienm,$liens,$id){
        $body = '';
        if(array_key_exists(1,session('menus')[$rub][1][$srub])){
            if(array_key_exists(1,session('menus')[$rub][1][$srub])){
                if(in_array("Modifier",session('menus')[$rub][1][$srub][1])){
                    $body .= '<td style="text-align: right" class="actionTd">';
                    $body .= '<a  href="#" id="'.$route($lienm,$id).'/'.$rub.'/'.$srub.'"';
                    $body .= 'onclick="getModification(this.id,\'zoneSaisie\');"> <i class="fas fa-pencil-alt" style="color: #060" ></i> </a>';
                    $body .= '</td>';
                }
                if(in_array("Supprimer",session('menus')[$rub][1][$srub][1])){
                    $body .= '<td style="text-align: right" class="actionTd">';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Supprimer(this.id,\'\');"> <i class="fas fa-trash-alt" style="color: #F00" ></i> </a>';
                    $body .= '</td>';
                }

                if(in_array("Activer_Desactiver",session('menus')[$rub][1][$srub][1])){
                    $body .= '<td style="text-align: right" class="actionTd">';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Activer(this.id);"> <i class="fas fa-trash-alt" style="color: #F00" ></i> </a>';
                    $body .= '</td>';
                }
            }
        }
        return $body;
    }


    public function newFormButtonDropdown($rub,$srub,$lien){
        $vue = '';
        $route = 'route';
        if(array_key_exists(1,session('menus')[$rub][1][$srub]) && in_array("Créer",session('menus')[$rub][1][$srub][1])){

            $vue .= '<div class="dropdown pull-right">';
            $vue .=    '<button class="btn btn-primary btnEnregistrer dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $vue .=        'Ajouter';
            $vue .=    '</button>';
            $vue .=    '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
            $vue .=        '<div class="dropdown-divider"></div>';
            $vue .=            '<a class="dropdown-item" href="'.$route($lien).'/reg/'.$rub.'/'.$srub.'">Région</a>';
            $vue .=        '<div class="dropdown-divider"></div>';
            $vue .=            '<a class="dropdown-item" href="'.$route($lien).'/prov/'.$rub.'/'.$srub.'">Province</a>';
            $vue .=        '<div class="dropdown-divider"></div>';
            $vue .=            '<a class="dropdown-item" href="'.$route($lien).'/com/'.$rub.'/'.$srub.'">Commune</a>';
            $vue .=        '<div class="dropdown-divider"></div>';
            $vue .=            '<a class="dropdown-item" href="'.$route($lien).'/vil/'.$rub.'/'.$srub.'">Ville/village</a>';
            $vue .=        '<div class="dropdown-divider"></div>';
            $vue .=    '</div>';
            $vue .= '</div>';

        }
        return $vue;
    }


    public function enleveAccent($chaine){
        $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
        $chaine = str_replace($search, $replace, $chaine);
        return trim($chaine);
    }

    public function creerUneChaineDonneDeBase($chaine){
        $text=$this->enleveAccent($chaine);
        $chaine = preg_replace("#[^A-Z0-9]#i", "", $text);
        return $chaine;
    }

    public function slug($chaine){
        $text=$this->enleveAccent($chaine);
        $chaine = preg_replace("#[^A-Z0-9]#i", "", $text);
        return strtolower($chaine) ;
    }

    public function verifierSupp($table,$element_id,$valeur_id){
        $flag=0;
        $verification=DB::select('select * from '.$table.' where '.$element_id.'= ? AND deleted_at IS NULL', [$valeur_id]);
        if(count($verification)>0){
            $flag=1;
        }
        return $flag;
    }

    public function dateToInteger($date){
        $date = ($date instanceof \DateTime)?$date:new \DateTime($date);
        return $date->getTimestamp();
    }

    public function integerToDate($integer){
        $date = new DateTime();
        return $date->setTimestamp($integer)->format('d-m-Y');
    }


    //Ajout
    public function crudbodySpecific($rub,$srub,$route,$lienm,$liens,$id){
        //dd($id);
        $lienpay = 'procedure.updateStatut';
        $lienmouvement = 'procedure.updateMouvement';
        $body = '';
        if(array_key_exists(1,session('menus')[$rub][1][$srub])){
            if(array_key_exists(1,session('menus')[$rub][1][$srub])){
                
                if(in_array("Commenter",session('menus')[$rub][1][$srub][1])){
                    $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($liens,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Mouvement(this.id,\'\');return false;"> <i class="fas fa-envelope" style="color: green" ></i> </a>';
                    $body .= '</td>';
                }
                if(in_array("Transferer",session('menus')[$rub][1][$srub][1])){
                    $body .= '<td style="text-align: right" class="actionTd">';
                    //$body .= '<a href="#" id="'.$route($liens,$id).'?type='.$type.'& rub='.$rub.'& srub='.$srub.'"';
                    $body .= '<a  href="#" id="'.$route($lienmouvement,$id).'?rub='.$rub.'& srub='.$srub.'"';
                    $body .= 'onclick="Mouvement(this.id,\'\');return false;"> <i class="fas fa-paper-plane" style="color: black" ></i> </a>';
                    $body .= '</td>';
                }
            }
        }
        return $body;
    }
}

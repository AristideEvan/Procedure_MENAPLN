<?php

namespace App\Http\Controllers\Ajax;

use App\Dev\S_codevaleur;
use App\Dev\S_localite;
use App\Etablissement\Etablissement;
use App\Etablissement\Niveau;
use App\Etablissement\Specialite;
use App\Etablissement\StatutEtablissement;
use App\Http\Controllers\Controller;
use App\Localisation\Commune;
use App\Localisation\Province;
use App\Localisation\Region;
use App\Models\Params\Localite;
use App\Params\S_structure;
use App\Params\Secteur;
use App\Sortants\Apprenant;
use App\Sortants\Inscription;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément!';
    private $operation='Opération éffectuée avec succès';
    /**
     * controller pour le traitement de toutes les actions en ajax
     */

    public function getLocalitesFils($idparent){
        $localites=Localite::where('parent_id',$idparent)->get();
        var_dump($localites);
        if(count($localites)>0){
            echo '<option value=""></option>';
            foreach($localites as $localite){
                echo '<option  value="'.$localite->id.'">'.$localite->libelleLocalite.'</option>';
            }
        }else{
            echo '<option value="">Aucune donnée trouvée</option>';
        }
    }

    public function getListeLocalite($idregion,$idprovince){
        $allLocalite=array();
        if($idprovince!=0){
            $listLocalite=DB::select('SELECT * FROM listelocalite WHERE idprov=?',[$idprovince]);
        }else if ($idregion!=0) {
            $listLocalite=DB::select('SELECT * FROM listelocalite WHERE idreg=?',[$idregion]);
        }else{
            $listLocalite=DB::select('SELECT * FROM listelocalite');
        }

        $allLocalite=json_decode (json_encode ($listLocalite), FALSE);
        return view('localite.liste')->with(['localites'=>$allLocalite]);
    }
    /**
     * fonction retourne le code de l'établissement selection lors de l'enregitrement d'un apprenant
     */
    public function getCodeEtablissement($idEtab){
        $etablissement=Etablissement::find($idEtab);
        echo '<label for="codeEtab">Code de l\'établissement</label>
            <input type="text" id="codeEtab" name="codeEtab" value="'.$etablissement->codeEtab.'" class="form-control" readonly>';

    }

    public function getEtablissement($idCom){
        //$structures=S_structure::where(['isActive'=>TRUE,'localiteId'=>$idCom,'parentId'=>NULL])->get();
        $structures=DB::select('select * from listeetablissement where "localite_id"=?',[$idCom]);

        return view('bourse.listeAffEt')->with(['etablissements'=>$structures]);
    }
    

    public function getFilieres($idSecteur){
        $secteur=Secteur::find($idSecteur);
        $datas = $secteur->filieres;
        if(count($datas)>0){
            echo '<option value=""></option>';
            foreach($datas as $data){
                echo '<option  value="'.$data->id.'">'.$data->libelleFiliere.'</option>';
            }
        }else{
            echo '<option value="">Aucune donnée trouvée</option>';
        }
    }
    

    public function getStructure($idCom){
        $datas=DB::select('select * from listeetablissement where "localite_id"=?',[$idCom]);
        if(count($datas)>0){
            echo '<option value=""></option>';
            foreach($datas as $data){
                echo '<option  value="'.$data->id.'">'.$data->libelleEtablissement.'</option>';
            }
        }else{
            echo '<option value="">Aucune donnée trouvée</option>';
        }
    }
}

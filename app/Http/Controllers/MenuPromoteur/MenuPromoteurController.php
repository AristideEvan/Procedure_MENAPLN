<?php

namespace App\Http\Controllers\MenuPromoteur;

use App\Http\Controllers\Controller;
use App\Models\Params\Localite;
use App\Models\Params\Secteur;
use App\Models\Params\Typeenseignement;
use App\Models\Params\Typepromoteur;
use App\Models\Procedure\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MenuPromoteurController extends Controller
{
    public function makeRequest(){
        $user = Auth::user();
            if($user->niveauAction == null){ 
              //  dd($user->id);
                $demandes = DB::table('demandes as dem')
                ->select('dem.*',
                        'village.id as village_id',
                        'village.slug as nom_village',
                        'commune.id as commune_id',
                        'commune.slug as nom_commune',
                        'province.id as province_id',
                        'province.slug as nom_province',
                        'region.id as region_id',
                        'region.slug as nom_region',
                        'typeEn.id as typeEns_id',
                        'typeEn.libelle')
                ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                ->where('dem.user_id', '=', $user->id)
                ->get();
            }else{
                //Niveau DEP
                if($user->niveauAction == 1){
                    $stat = "DEP";
                    $demandes = DB::table('demandes as dem')
                    ->select('dem.*',
                            'village.id as village_id',
                            'village.slug as nom_village',
                            'commune.id as commune_id',
                            'commune.slug as nom_commune',
                            'province.id as province_id',
                            'province.slug as nom_province',
                            'region.id as region_id',
                            'region.slug as nom_region',
                            'typeEn.id as typeEns_id',
                            'typeEn.libelle')
                    ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                    ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                    ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                    ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                    ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                    ->where('dem.statut', '=', $stat)
                    ->orWhere('dem.statut', '=', 'Signé')
                    ->get();
        }
                //Niveau Region
                else if($user->niveauAction == 2){
                    $stat = "Region";
                    $demandes = DB::table('demandes as dem')
                            ->select('dem.*',
                                    'village.id as village_id',
                                    'village.slug as nom_village',
                                    'commune.id as commune_id',
                                    'commune.slug as nom_commune',
                                    'province.id as province_id',
                                    'province.slug as nom_province',
                                    'region.id as region_id',
                                    'region.slug as nom_region',
                                    'typeEn.id as typeEns_id',
                                    'typeEn.libelle')
                            ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                            ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                            ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                            ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                            ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                            ->where('region.id', '=', $user->region_id)
                            ->where('dem.statut', '=', $stat)
                            ->orWhere('dem.statut', '=', 'Signé')
                            ->get();
                }
                // Niveau Province
                
                else if($user->niveauAction == 3){
                    $stat = "Paye";
                    $demandes = DB::table('demandes as dem')
                            ->select('dem.*',
                                    'village.id as village_id',
                                    'village.slug as nom_village',
                                    'commune.id as commune_id',
                                    'commune.slug as nom_commune',
                                    'province.id as province_id',
                                    'province.slug as nom_province',
                                    'region.id as region_id',
                                    'region.slug as nom_region',
                                    'typeEn.id as typeEns_id',
                                    'typeEn.libelle')
                            ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                            ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                            ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                            ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                            ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                            ->where('province.id', '=', $user->province_id)
                            ->where('dem.statut', '=', $stat)
                            ->orWhere('dem.statut', '=', 'Signé')
                            ->orWhere('dem.statut', '=', 'Province')
                            ->get();
                }

                // Niveau SG
                else if($user->niveauAction == 0){
                    $stat = "SG";
                    $demandes = DB::table('demandes as dem')
                            ->select('dem.*',
                                    'village.id as village_id',
                                    'village.slug as nom_village',
                                    'commune.id as commune_id',
                                    'commune.slug as nom_commune',
                                    'province.id as province_id',
                                    'province.slug as nom_province',
                                    'region.id as region_id',
                                    'region.slug as nom_region',
                                    'typeEn.id as typeEns_id',
                                    'typeEn.libelle')
                            ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                            ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                            ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                            ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                            ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                            ->where('dem.statut', '=', $stat)
                            ->get();
                }
            }
        return view('procedure/index',[
            'demandes'=>$demandes,
            'controler'=>$this,
            'rub'=>10,'srub'=>13
        ]);
    }

    public function followRequest(){
        return view('menu/followRequest');
    }

    public function contacts(){
        return view('menu/contacts');
    }


    /* chercher une reference */
    public function findFollowRequest(Request $request){
        $demande=Demande::where('reference',$request->input('reference'))->first();
        $submit = true;
        $input =$request->input('reference');
        return view('menu/followRequest',compact('demande','submit','input'));
    }

    public function requestTest(){
        /* 1re requete qui permet d'afficher le nom d'etablissement et la reference */
        //$data=Demande::all(['nomEtablissement','reference']);

        /* 2e requete qui permet d'afficher la localite, le nom d'etablissement et la reference */
        /* $data=DB::table('demandes AS d')
        ->join('localites AS l','d.localite_id','=','l.id')
        ->select('l.libelleLocalite','d.nomEtablissement','d.reference')
        ->get(); */

        /* 3e requete qui permet d'afficher le typeenseignement, la localite, le nom d'etablissement et la reference */
        /* $data=DB::table('demandes AS d')
        ->Join ('localites AS l','d.localite_id','=','l.id')
        ->Join ("typeenseignements AS t","d.typeenseignement_id","=","t.id")
        ->Join ("users AS u","d.user_id","=","u.id")
        ->select('t.*','d.*','l.*','u.*')
        ->orderBy('d.nomEtablissement','ASC')
        ->get();
        return view('menu/contacts',compact('data')); */
    }

    //compteur des demandes traitees
    public function countRequestTreat(){
                      $data = DB::table('demandes')
                     ->select(DB::raw('statut,count(*) as nbredemandestraitees'))
                     ->where('statut', '=', 'Signé','and')->orWhere('statut', '=', 'Paye') 
                     ->groupBy('statut')
                     ->get();
        //dd($data);
        return view('menu/contacts',compact('data'));
    }  

    //compteur des demandes en cours
    public function countRequestProgress(){
                $data1 = DB::table('demandes AS d')
                ->join('users AS u','u.id','=','d.user_id')
                //->join('profils AS p','p.id','=','u.profil_id')
                ->select(DB::raw('d.statut, count(*) as nbredemandesencours'))
                //->where('p.id', '=', 2,'and')->orWhere('d.user_id', '=', 30,'and')
                ->where('u.profil_id', '=', 2,'and')->orWhere('u.id', '=', 30,'and')
                ->orWhere('d.statut', '=', 'Non Paye')
                ->groupBy('d.statut')
                ->get();
                //dd($data1);
                return view('menu/contacts',compact('data1'));
    }

    /* public function countRequestProgress(){
       $data1 = DB::table('demandes')
       ->select(DB::raw('statut,count(*) as nbredemandesencours'))
       ->where('statut', '=', 'Non Paye') 
       ->groupBy('statut')
       ->get();
        dd($data1);
        return view('menu/contacts',compact('data1'));
    }  
 */

    
    //compteur des demandes totales
    
    public function countRequestTotal(){
        $data2 = DB::table('demandes')
        ->select(DB::raw('statut, COUNT(statut) as nbredemandestotal'))
        ->where('statut', '=', 'Non Paye','and')->orWhere('statut', '=', 'Paye','and')
        ->orWhere('statut', '=', 'Signé','and')->orWhere('statut', '=', 'Pour Modification')
        ->groupBy('statut')
        ->get();
        //dd($data2);
        return view('menu/contacts',compact('data2'));
    }

    //compteur des demandes à modifier
    public function countRequestEdit(){
        $data3 = DB::table('demandes')
        ->select(DB::raw('statut, COUNT(statut) as nbredemandesmodification'))
        ->where('statut', '=', 'Pour Modification')
        ->groupBy('statut')
        ->get();
        //dd($data3);
        return view('menu/contacts',compact('data3'));
    } 

    
}

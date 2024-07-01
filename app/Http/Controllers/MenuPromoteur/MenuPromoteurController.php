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


        /* $typePromoteur = Typepromoteur::where('id', Auth::user()->promoteur->typePromoteur_id)->get();

        $pieceJointes = DB::table('documents')
            ->join('typedocuments', 'documents.typedocument_id', '=', 'typedocuments.id')
            ->join('documenttypepromoteurs', 'documents.id', '=', 'documenttypepromoteurs.document_id')
            ->join('typepromoteurs', 'documenttypepromoteurs.typepromoteur_id', '=', 'typepromoteurs.id')
            ->where('typepromoteurs.id', '=', Auth::user()->promoteur->typePromoteur_id)
            ->select('documents.id as docs_id','documents.libelleDocument',
                    'documents.typedocument_id','typedocuments.id as typeDocs_id',
                    'typedocuments.libelle')
            ->get();
           // dd($pieceJointes);
            $nbr_ele = intdiv(count($pieceJointes),2) + 1;
            $typesAndDocuments = [];
            foreach ($pieceJointes as $pieceJointe) {
                $typeDocumentId = $pieceJointe->typeDocs_id;
                // Vérifiez si le type de document existe dans le tableau
                if (!array_key_exists($typeDocumentId, $typesAndDocuments)) {
                    $typesAndDocuments[$typeDocumentId]['typeDocument'] = [
                        'typeDocs_id' => $pieceJointe->typeDocs_id,
                        'libelle' => $pieceJointe->libelle,
                ];
                $typesAndDocuments[$typeDocumentId]['documents'] = [];
                }
                // Ajoutez le document associé au type de document
                $typesAndDocuments[$typeDocumentId]['documents'][] = [
                    'docs_id' => $pieceJointe->docs_id,
                    'libelleDocument' => $pieceJointe->libelleDocument,
                ];
            } */
            // ['demandes'=>$demandes,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]
        return view('procedure/index',[
            'controler'=>$this,
            'regions' => Localite::where('parent_id',NULL)->orderby('libelleLocalite','asc')->get(),
            'libelle' => Typeenseignement::orderBy('created_at','DESC')->get(),
            'secteurs' => Secteur::orderBy('id', 'ASC')->get(),
            'demandes' => Auth::user()->demandes,
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

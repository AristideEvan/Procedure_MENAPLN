<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Users\makeRequest;

class UserController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément!';
    private $operation='Opération éffectuée avec succès';
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rub = null, $srub=null)
    {
        //dd(session('menus'));
        $users = User::orderBy('created_at','DESC')->get();

        $users = DB::table('users')
            ->select('profils.*','users.*')
            ->join('profils','profils.id','=','users.profil_id')
            ->get();
        return view('user.index')->with(['users'=>$users,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('auth.registerBack');
         return redirect('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $user->delete();
        return redirect()->back()->with(['success'=>$this->operation]);
    }

    public function compteNonValide($rub = null, $srub=null){

        $users = User::where('actif',false)->orderBy('created_at','DESC')->get();
        return view('user.nonvalider')->with(['users'=>$users,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    public function changerEtatCompte($id){
        $user = User::find($id);
        if($user->actif==true){
            $user->actif=false;
        }else{
            $user->actif=true;
        }

        $user->save();

        return redirect()->back()->with(['success'=>$this->operation]);
    }

    //fonction accueil metier et promoteur
    public function acceuilUser(Request $request)
    {
        if (Auth::user()->promoteur_id) {
            return $this->acceuilPromoteur();
        }else{
            return $this->acceuilMetier();
        }

    }
    
    public function acceuilMetier()
    {
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

        ///////////////////////////////////////////////////////
        $user_niv = Auth::user()->niveauAction;
        $data0 = 0;
        $data1 = 0;
        $data2 = 0;
        $data3 = 0;
        switch ($user_niv) {
            case 0:
                $data0 = DB::table('demandes AS d')
                ->where('d.statut', '=', 'SG')
                ->count();
                break;
            case 1:
                $data0 = DB::table('demandes AS d')
                ->where('d.statut', '=', 'DEP')
                ->count();
                break;
            case 2:
                $data0 = DB::table('demandes AS d')
                ->where('d.statut', '=', 'Region')
                ->count();
                break;
            case 3:
                    $data0 = DB::table('demandes AS d')
                    ->where('d.statut', '=', 'Province')
                    ->count();
                break;    
            case 4:
                $data0 = DB::table('demandes AS d')
                ->where('d.statut', '=', 'Paye')
                ->count();
                break;
            default:
                break;
        }

    //compteur des demandes traitées
        $data1 = DB::table('demandes')
        ->where('statut', '=', 'Signé') 
        ->count();

    //compteur des demandes à modifier
        $data2 = DB::table('demandes')
            ->where('statut', '=', 'Pour Modification')
            ->count();

    //compteur des demandes totales
        // $data3 = DB::table('demandes')
        // ->where('statut', '<>', 'Non Paye',)
        // ->count();
        ////////////////////////////////////////////
    return view('procedure/index',[
        'demandes'=>$demandes,
        'data0'=>$data0,
        'data1'=>$data1,
        'data2'=>$data2,
        'data3'=>$data3,
        'controler'=>$this,
        'rub'=>10,'srub'=>13
    ]);





        //compteur des demandes en cours
//         $user_niv = Auth::user()->niveauAction;
//         $data0 = 0;
//         switch ($user_niv) {
//             case 0:
//                 $data0 = DB::table('demandes AS d')
//                 ->where('d.statut', '=', 'SG')
//                 ->count();
//                 break;
//             case 1:
//                 $data0 = DB::table('demandes AS d')
//                 ->where('d.statut', '=', 'DEP')
//                 ->count();
//                 break;
//             case 2:
//                 $data0 = DB::table('demandes AS d')
//                 ->where('d.statut', '=', 'Region')
//                 ->count();
//                 break;
//             case 3:
//                     $data0 = DB::table('demandes AS d')
//                     ->where('d.statut', '=', 'Province')
//                     ->count();
//                 break;    
//             case 4:
//                 $data0 = DB::table('demandes AS d')
//                 ->where('d.statut', '=', 'Paye')
//                 ->count();
//                 break;
//             default:
//                 break;
//         }
// //compteur des demandes en cours
// $user_niv = Auth::user()->niveauAction;
// $data0 = 0;
// switch ($user_niv) {
//     case 0:
//         $data0 = DB::table('demandes AS d')
//         ->where('d.statut', '=', 'SG')
//         ->count();
//         break;
//     case 1:
//         $data0 = DB::table('demandes AS d')
//         ->where('d.statut', '=', 'DEP')
//         ->count();
//         break;
//     case 2:
//         $data0 = DB::table('demandes AS d')
//         ->where('d.statut', '=', 'Region')
//         ->count();
//         break;
//     case 3:
//             $data0 = DB::table('demandes AS d')
//             ->where('d.statut', '=', 'Province')
//             ->count();
//         break;    
//     case 4:
//         $data0 = DB::table('demandes AS d')
//         ->where('d.statut', '=', 'Paye')
//         ->count();
//         break;
//     default:
//         break;
// }

//         //compteur des demandes traitées
//             $data1 = DB::table('demandes')
//             ->where('statut', '=', 'Signé') 
//             ->count();

//         //compteur des demandes à modifier
//             $data2 = DB::table('demandes')
//                 ->where('statut', '=', 'Pour Modification')
//                 ->orWhere('statut', '=', 'Non Paye')
//                 ->count();

//         //compteur des demandes totales
//             $data3 = DB::table('demandes')
//             ->where('statut', '<>', 'Non Paye',)
//             ->count();

//             // dd($data0,$data1,$data2,$data3);
//         return view('user.accueil', compact('data0','data1','data2','data3'));
    }

    public function acceuilPromoteur()
    {
        ///function makeRequest();

    //     //compteur des demandes en cours
    //         $user_id = Auth::user()->id;            
    //         $data0 = DB::table('demandes AS d')
    //             ->where('d.user_id', '=', $user_id)
    //             ->where(function (Builder $query){
    //                 $query->where('d.statut', '=', 'SG')
    //                 ->orWhere('d.statut', '=', 'DEP')
    //                 ->orWhere('d.statut', '=', 'Region')
    //                 ->orWhere('d.statut', '=', 'Paye');
    //             })->count();

    //     //compteur des demandes traitées
    //         $data1 = DB::table('demandes')
    //             ->where('user_id', '=', $user_id)
    //             ->where('statut', '=', 'Signé')
    //             ->count();

    //     //compteur des demandes à modifier
    //         $data2 = DB::table('demandes')
    //             ->where('user_id', '=', $user_id)
    //             ->where('statut', '=', 'Pour Modification')
    //             ->orWhere('statut', '=', 'Non Paye')
    //             ->count();

    //     //compteur des demandes totales
    //         $data3 = DB::table('demandes')
    //             ->where('user_id', '=', $user_id)
    //             ->count();

    //         // dd($data0,$data1,$data2,$data3);
    //     return view('user.accueil', compact('data0','data1','data2','data3'));
    // }

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
}


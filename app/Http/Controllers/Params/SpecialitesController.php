<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use App\Models\Params\Filiere;
use App\Models\Params\Secteur;
use App\Models\Params\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialitesController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $libelle='Spécialité';
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
    public function index($rub=null, $srub=null)
    {
        $datas = DB::table('specialites')
            ->select('specialites.*','filieres.libelleFiliere','secteurs.libelleSecteur')
            ->join('filieres','filieres.id','=','specialites.filiere_id')
            ->join('secteurs','secteurs.id','=','filieres.secteur_id')
            ->get();
        return view('params.specialite.index')->with(['datas'=>$datas,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub=null, $srub=null)
    {
        $secteurs = Secteur::orderBy('libelleSecteur','ASC')->get();
        
        return view("params.specialite.create")->with(['secteurs'=>$secteurs,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'libelleFiliere' => ['required', 'integer'],
            'libelleSpecialite' => ['required', 'string'],
        ]);
        $specialite = new Specialite();
        $specialite->filiere_id=request('libelleFiliere');
        $specialite->libelleSpecialite=request('libelleSpecialite');
        $specialite->slug=$this->slug(request('libelleSpecialite'));
        $specialite->user_id= Auth()->user()->id;
        $specialite->save();
        return redirect('specialite/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$rub=null, $srub=null)
    {
        $specialite = Specialite::find($id);
        $secteurs = Secteur::orderBy('libelleSecteur','ASC')->get();
        $filiere = Filiere::find($specialite->filiere_id);
        $secteur = $filiere->secteur;
        $filieres = $secteur->filieres;
        return view("params.specialite.edit")->with(['specialite'=>$specialite,'secteurs'=>$secteurs,
        'filieres'=>$filieres,'sect'=>$secteur,'filiere'=>$filiere,
        'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);

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
        $this->validate($request,[
            'libelleFiliere' => ['required', 'integer'],
            'libelleSpecialite' => ['required', 'string'],
        ]);
        $specialite = Specialite::find($id);
        $specialite->filiere_id=request('libelleFiliere');
        $specialite->libelleSpecialite=request('libelleSpecialite');
        $specialite->slug=$this->slug(request('libelleSpecialite'));
        $specialite->user_id= Auth()->user()->id;
        $specialite->save();
        return redirect('specialite/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vSupp = $this->verifierSupp('etablissement_specialites','specialite_id', $id);
        if($vSupp==0){
            $specialite = Specialite::find($id);
            $specialite->deleted_by = Auth()->user()->id;
            $specialite->save();
            $specialite->delete();
            return redirect()->back()->with(['success'=>$this->operation,'controler'=>$this]);
        }else{
            return redirect()->back()->with(['error'=>$this->msgerror,'controler'=>$this]);
        }
        
    }
}

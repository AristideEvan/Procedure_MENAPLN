<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use App\Models\Params\Filiere;
use App\Models\Params\Secteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiliereController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $libelle='Filière';
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
        $datas = DB::table('filieres')
            ->select('filieres.*','secteurs.libelleSecteur')
            ->join('secteurs','secteurs.id','=','filieres.secteur_id')
            ->get();
        return view('params.filiere.index')->with(['datas'=>$datas,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub=null, $srub=null)
    {
        $secteurs = Secteur::orderBy('libelleSecteur','ASC')->get();
        return view("params.filiere.create")->with(['secteurs'=>$secteurs,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
        
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
            'libelleFiliere' => ['required', 'string'],
            'libelleSecteur' => ['required', 'integer'],
        ]);
        $filiere = new Filiere();
        $filiere->secteur_id=request('libelleSecteur');
        $filiere->libelleFiliere=request('libelleFiliere');
        $filiere->slug=$this->slug(request('libelleFiliere'));
        $filiere->user_id= Auth()->user()->id; 
        $filiere->save();
        return redirect('filiere/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
    
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
        $filiere = Filiere::find($id);
        $secteurs = Secteur::orderBy('libelleSecteur','ASC')->get();
        return view("params.filiere.edit")->with(['filiere'=>$filiere,'secteurs'=>$secteurs,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);

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
            'libelleFiliere' => ['required', 'string'],
            'libelleSecteur' => ['required', 'integer'],
        ]);
        $filiere = Filiere::find($id);
        $filiere->secteur_id=request('libelleSecteur');
        $filiere->libelleFiliere=request('libelleFiliere');
        $filiere->slug=$this->slug(request('libelleFiliere'));
        $filiere->user_id= Auth()->user()->id;
        $filiere->save();
        return redirect('filiere/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vSupp = $this->verifierSupp('specialites','filiere_id', $id);
        if($vSupp==0){
            $filiere = Filiere::find($id);
            $filiere->deleted_by = Auth()->user()->id;
            $filiere->save();
            $filiere->delete();
            return redirect()->back()->with(['success'=>$this->operation,'controler'=>$this]);
        }else{
            return redirect()->back()->with(['error'=>$this->msgerror,'controler'=>$this]);
        }
        
    }
}

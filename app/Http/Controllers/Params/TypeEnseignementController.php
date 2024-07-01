<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use App\Models\Params\Typeenseignement;
use Illuminate\Http\Request;

class TypeEnseignementController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $libelle='Type Enseignement';

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
    public function index($rub=null,$srub=null)
    {
        $enseignements = Typeenseignement::orderBy('created_at','DESC')->get();
        return view("params.typeenseignement.index")->with(['datas'=>$enseignements,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub=null,$srub=null)
    {
        return view("params.typeenseignement.create")->with(['controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
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
            'libelle' => ['required', 'string'],
        ]);
        $secteur = new Typeenseignement();
        $secteur->libelle=request('libelle');
        $secteur->user_id= Auth()->user()->id;
        $secteur->save();
        return redirect('enseignement/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
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
    public function edit($id,$rub=null,$srub=null)
    {
        $secteur = Typeenseignement::find($id);
        return view("params.typeenseignement.edit")->with(['secteur'=>$secteur,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
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
            'libelleSecteur' => ['required', 'string'],
        ]);
        $secteur = Typeenseignement::find($id);
        $secteur->libelle=request('libelle');
        $secteur->user_id= Auth()->user()->id;
        $secteur->save();
        return redirect('enseignement/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vSupp = $this->verifierSupp('filieres','secteur_id', $id);
        if($vSupp==0){
            $Secteur = Typeenseignement::find($id);
            $Secteur->deleted_by = Auth()->user()->id;
            $Secteur->save();
            $Secteur->delete();
            return redirect()->back()->with(['success'=>$this->operation,'controler'=>$this]);
        }else{
            return redirect()->back()->with(['error'=>$this->msgerror,'controler'=>$this]);
        }
    }
}

<?php

namespace App\Http\Controllers\Params;

//use App\Dev\S_codevaleur;
//use App\Dev\S_localite;
use App\Http\Controllers\Controller;
//use App\Imports\LocaliteImport;
use App\Models\Params\Localite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Facades\Excel;
ini_set('memory_limit', '-1');

class LocaliteController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
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
        $regions=Localite::where('parent_id',NULL)->orderby('libelleLocalite','asc')->get();
        return view('localite.index')->with(['regions'=>$regions,'controler'=>$this,'rub'=>$rub,'srub'=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($loc,$rub = null, $srub=null)
    {
        $visibleReg=false;
        $visibleProv=false;
        $visibleCom=false;
        $libelle = 'Région';
        switch ($loc){
            case 'prov': $visibleReg=true; $libelle = 'Province';
            break;
            case 'com': $visibleReg=true; $visibleProv=true; $libelle = 'Commune';
            break;
            case 'vil': $visibleReg=true; $visibleProv=true;$visibleCom=true; $libelle = 'Ville/Village';
            break;
        }
             
        $regions=Localite::where('parent_id',NULL)->orderby('libelleLocalite','asc')->get();
       
        return view('localite.create')->with(['regions'=>$regions,'rub'=>$rub,'srub'=>$srub,'libelle'=>$libelle,
            'visibleReg'=>$visibleReg,'visibleProv'=>$visibleProv,'visibleCom'=>$visibleCom]);
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
            'newLoc' => ['required', 'string'], 
        ]);

        $region=$request->input('region');
        $province=$request->input('province');
        $commune=$request->input('commune');
        $newLoc=strtoupper($request->input('newLoc'));

        $localite=new Localite();
        if($region==""){
            $localite->libelleLocalite=$newLoc;
            $localite->typeLocalite='Region';
            $localite->slug=$this->slug($newLoc);
            $localite->user_id=Auth()->user()->id;
        }else{
            if($province==""){
                $localite->parent_id=$region;
                $localite->libelleLocalite=$newLoc;
                $localite->typeLocalite='Province';
                $localite->slug=$this->slug($newLoc);
                $localite->user_id=Auth()->user()->id;
            }else{
                if($commune==""){
                    $localite->parent_id=$province;
                    $localite->libelleLocalite=$newLoc;
                    $localite->typeLocalite='Commune';
                    $localite->slug=$this->slug($newLoc);
                    $localite->user_id=Auth()->user()->id;
                }else{
                    $localite->parent_id=$commune;
                    $localite->libelleLocalite=$newLoc;
                    $localite->typeLocalite='Ville-Village';
                    $localite->slug=$this->slug($newLoc);
                    $localite->user_id=Auth()->user()->id;
                }
            }
        }

        $localite->save();
        return redirect('localite/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
        //
    }

    public function import(Request $request){
        Excel::import(new LocaliteImport, $request->file('select_file'));
        return back()->with(['success'=>$this->operation]);
    }

    public function formImport(){
        return view('localite.importModal');
    }
}

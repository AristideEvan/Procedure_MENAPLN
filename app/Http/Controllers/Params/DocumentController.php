<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use App\Models\Params\Document;
use App\Models\Params\Typedocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $libelle='Document';
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
        $datas = DB::table('documents')
            ->select('documents.*','typedocuments.libelle')
            ->join('typedocuments','typedocuments.id','=','documents.typedocument_id')
            ->get();
        return view('params.document.index')->with(['datas'=>$datas,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub=null, $srub=null)
    {
        $typeDocuments = Typedocument::orderBy('libelle','ASC')->get();
        return view("params.document.create")->with(['typeDocuments'=>$typeDocuments,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
        
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
            'libelleDocument' => ['required', 'string'],
        ]);
        $document = new Document();
        $document->typedocument_id=request('libelle');
        $document->libelleDocument=request('libelleDocument');
        $document->user_id= Auth()->user()->id;
        $document->save();
        return redirect('document/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
    
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
        $document = Document::find($id);
        $typeDocument = Typedocument::orderBy('libelle','ASC')->get();
        return view("params.document.edit")->with(['documents'=>$document,'typeDocuments'=>$typeDocument,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);

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
            'libelle' => ['required', 'string'],
            'libelleDocument' => ['required', 'integer'],
        ]);
        $filiere = Document::find($id);
        $filiere->typedocument_id=request('libelle');
        $filiere->libelle=request('libelleDocument');
        $filiere->user_id= Auth()->user()->id;
        $filiere->save();
        return redirect('document/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
    
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
            $filiere = Document::find($id);
            $filiere->deleted_by = Auth()->user()->id;
            $filiere->save();
            $filiere->delete();
            return redirect()->back()->with(['success'=>$this->operation,'controler'=>$this]);
        }else{
            return redirect()->back()->with(['error'=>$this->msgerror,'controler'=>$this]);
        }
        
    }
}

<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Params\Documenttypepromoteur;
use App\Models\Params\Typepromoteur;
use App\Models\Params\Typedocument;
use Illuminate\Support\Facades\DB;

class TypePromoteurController extends Controller
{
    //
    
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
        $typepromoteurs = Typepromoteur::orderBy('created_at','DESC')->get();
        return view('params.typepromoteur.index')->with(['typepromoteurs'=>$typepromoteurs,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub = null, $srub = null)
{
    $tableau = [];

    $typeDocuments = Typedocument::orderBy('id', 'ASC')->get();

    foreach ($typeDocuments as $typeDocument) {
        $documents = DB::table('documents')
            ->select('documents.*')
            ->join('typedocuments', 'typedocuments.id', '=', 'documents.typedocument_id')
            ->where('documents.typedocument_id', $typeDocument->id)
            ->get();

        $tableau[$typeDocument->libelle]['type'] = $typeDocument;
        $tableau[$typeDocument->libelle]['documents'] = $documents;
    }
//dd($tableau);
    return view('params.typepromoteur.create')->with(['documents' => $tableau, "rub" => $rub, "srub" => $srub]);
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typepromoteur=new Typepromoteur();
        $typepromoteur->libelle=$request->input('typeprom');
        $typepromoteur->save();
        $typepromoteurId=$typepromoteur->id;
        $tableau=$request->input('document');
        if(!empty($tableau)){
            foreach($tableau as $tab){
                $documentTypePromot=new Documenttypepromoteur();
                $documentTypePromot->document_id=$tab;
                $documentTypePromot->typepromoteur_id=$typepromoteurId;
                $documentTypePromot->save();
               
            }
        }

        return redirect('typePromoteur/'.$request['rub'].'/'.$request['srub'])->with(['success'=>$this->operation]);
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
    public function edit($id,$rub = null, $srub=null)
    {
        $tableau = [];
        $selectedTypeDocuments = [];
        $selectedDocuments = [];
        $typePromoteur = Typepromoteur::find($id);
        $typeDocuments = Typedocument::orderBy('id', 'ASC')->get();
        
        $selectedTypeDocuments = DB::table('typedocuments')
                            ->select('typedocuments.*')
                            ->join('documents', 'documents.typedocument_id', '=', 'typedocuments.id')
                            ->join('documenttypepromoteurs', 'documenttypepromoteurs.document_id', '=', 'documents.id')
                            ->where('documenttypepromoteurs.typepromoteur_id', '=', $id)
                            ->get();
        
        $selectedDocuments = DB::table('documents')
                        ->select('documents.*')
                        ->join('documenttypepromoteurs', 'documents.id', '=', 'documenttypepromoteurs.document_id')
                        ->where('documenttypepromoteurs.typepromoteur_id', $id)
                        ->get();

        foreach ($typeDocuments as $typeDocument) {
            $documents = DB::table('documents')
                ->select('documents.*')
                ->join('typedocuments', 'typedocuments.id', '=', 'documents.typedocument_id')
                ->where('documents.typedocument_id', $typeDocument->id)
                ->get();
    
            $tableau[$typeDocument->libelle]['type'] = $typeDocument;
            $tableau[$typeDocument->libelle]['documents'] = $documents;
        }
        
           //dd($tableau);
        return view('params.typepromoteur.edit')->with(['typePromoteur'=>$typePromoteur,'documents' => $tableau,'selectedTypeDocuments' => $selectedTypeDocuments,'selectedDocuments' => $selectedDocuments,"rub"=>$rub,"srub"=>$srub]);
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
        $typepromoteur=Typepromoteur::find($id);
        $typepromoteur->libelle=$request->input('typeprom');
        $typepromoteur->save();
        $typepromoteurId=$typepromoteur->id;

        $tableau=$request->input('document');
        if(!empty($tableau)){
            DB::delete('delete from documenttypepromoteurs where typepromoteur_id=?',[$typepromoteurId]);
            foreach($tableau as $tab){
                $documentTypePromot=new Documenttypepromoteur();
                $documentTypePromot->document_id=$tab;
                $documentTypePromot->typepromoteur_id=$typepromoteurId;
                $documentTypePromot->save();
               
            }
        }
        return redirect('typePromoteur/'.$request['rub'].'/'.$request['srub'])->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profil=Profil::find($id);
        $profil->delete();
        return redirect()->back()->with(['success'=>$this->operation]);
    }
}

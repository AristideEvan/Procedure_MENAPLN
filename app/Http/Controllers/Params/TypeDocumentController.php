<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Params\Typedocument;
use Illuminate\Support\Facades\Auth;

class TypeDocumentController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    private $libelle='Type Document';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rub=null,$srub=null)
    {
        $piecesjointes = Typedocument::orderBy('created_at','DESC')->get();
        return view("params.typedocument.index")->with(['datas'=>$piecesjointes,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub=null,$srub=null)
    {
        return view("params.typedocument.create")->with(['controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
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
            //'description' => ['required', 'string'],
        ]);
        $pieceJointes = new Typedocument();
        $pieceJointes->libelle=request('libelle');
        $pieceJointes->user_id= Auth()->user()->id;
        $pieceJointes->save();
        return redirect('typeDocument/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
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
        $pieceJointes = Typedocument::find($id);
        return view("params.typedocument.edit")->with(['pieceJointes'=>$pieceJointes,'controler'=>$this,'rub'=>$rub,'srub'=>$srub,'libelle'=>$this->libelle]);
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
            'description' => ['required', 'string'],
        ]);
        $pieceJointes = Typedocument::find($id);
        $pieceJointes->libelle=request('libelle');
        $pieceJointes->description=request('description');
        $pieceJointes->user_id= Auth()->user()->id;
        $pieceJointes->save();
        return redirect('typeDocument/'.request('rub').'/'.request('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pieceJointes = Typedocument::find($id);
        $pieceJointes->deleted_by = Auth()->user()->id;
        $pieceJointes->save();
        $pieceJointes->delete();
        return redirect()->back()->with(['success'=>$this->operation,'controler'=>$this]);
    }
}

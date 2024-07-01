<?php

namespace App\Http\Controllers\Developeur;

use App\Models\Developeur\Action;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActionController extends Controller
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
        $actions=Action::orderby('created_at','desc')->get();
        return view('action.index')->with(['actions'=>$actions,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub = null, $srub=null)
    {
        return view('action.create')->with(["rub"=>$rub,"srub"=>$srub]);
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
            'action' => ['required', 'string'],
        ]);

        $action = new Action();
        $action->nomAction=$request->input('action');
        $action->save();

        return redirect('action/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
        $action=Action::find($id);
        return view('action.edit')->with(['action'=>$action,"rub"=>$rub,"srub"=>$srub]);
        
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
            'action' => ['required', 'string'],
        ]);

        $action = Action::find($id);
        $action->nomAction=$request->input('action');
        $action->save();

        return redirect('action/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $action=Action::find($id);
        $action->delete();
        return back();
        //return redirect('action/'.$request['rub'].'/'.$request['srub']);
    }
}

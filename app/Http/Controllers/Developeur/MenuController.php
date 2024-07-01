<?php

namespace App\Http\Controllers\Developeur;

use App\Models\Developeur\Action;
use App\Models\Developeur\Actionmenu;
use App\Http\Controllers\Controller;
use App\Models\Developeur\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
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
        $menus=Menu::orderby('created_at','desc')->get();
        $ListeMenus=array();
        foreach($menus as $menu){
            if($menu->parent_id!=Null){
                $menu['nomParent']=Menu::find($menu->parent_id)->nomMenu;
            }else{
                $menu['nomParent']="";
            }
            array_push($ListeMenus,$menu);
        }

        //dd($ListeMenus);
        return view('menu.index')->with(['listeMenus'=>$ListeMenus,'controler'=>$this,'rub'=>$rub,'srub'=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rub = null, $srub=null)
    {
        $menuParent=Menu::all();//where('parent_id',Null)->get();
        $actions=Action::all();
        return view('menu.create')->with(['parents'=>$menuParent,'actions'=>$actions,"rub"=>$rub,"srub"=>$srub]);
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
            'menu' => ['required', 'string'],
        ]);

        $menu = new Menu();

        $menu->parent_id=$request->input('parent');
        $menu->nomMenu=$request->input('menu');
        $menu->lien=$request->input('lien');
        $menu->icon=$request->input('icone');
        $menu->ordre=$request->input('ordre');
        //$menu->profondeur=$request->input('collap');
        $menu->save();
        $this->saveMenuAction($menu->id,$request);
        return redirect('menu/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
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
        $menuParent=Menu::all();
        $actions=Action::all();
        $menuConcerne=Menu::find($id);
        $tabAction=$menuConcerne->menuActions;
        

        //dd($actions);
        return view('menu.edit')->with(['parents'=>$menuParent,'actions'=>$actions,
        'menuConcerne'=>$menuConcerne,'tabAction'=>$tabAction,"rub"=>$rub,"srub"=>$srub]);
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
            'menu' => ['required', 'string'],
            //'lien' => ['required', 'string'],
        ]);

        $menu = Menu::find($id);

        $menu->parent_id=$request->input('parent'); 
        $menu->nomMenu=$request->input('menu');
        $menu->lien=$request->input('lien');
        $menu->icon=$request->input('icone');
        $menu->ordre=$request->input('ordre');
        //$menu->profondeur=$request->input('collap');
        $menu->save();

        $actionMenu=$menu->menuActions;
        DB::delete('delete from actionmenus where menu_id=?',[$id]);
        $this->saveMenuAction($id,$request);

        return redirect('menu/'.$request->input('rub').'/'.$request->input('srub'))->with(['success'=>$this->operation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return back()->with(['success'=>$this->operation]);

    }


    public function saveMenuAction($idMenu,$request){
        $tabId=$request->input('action');
        foreach($tabId as $idAction){
         $actionMenu= new Actionmenu();
          $actionMenu->menu_id=$idMenu;
          $actionMenu->action_id=$idAction;
          $actionMenu->save();
        }
    }
}

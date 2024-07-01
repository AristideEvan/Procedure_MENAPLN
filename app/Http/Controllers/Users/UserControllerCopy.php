<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Params\TypePromoteur;
use App\Models\Procedure\Promoteur;
use App\Models\Procedure\PromoteurMorale;
use App\Models\Procedure\PromoteurPhysique;
use App\Models\Procedure\ResponsablePhysique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserControllerCopy extends Controller
{
    private $msgerror='Impossible de supprimer cet élément!';
    private $operation='Opération éffectuée avec succès';
     /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
       $this->middleware('auth');
        
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rub = null, $srub=null)
    {
        //dd(session('$users '));
        $users = User::orderBy('created_at','DESC')->get();

        $users = DB::table('users')
            ->select('profils.*','users.*')
            ->join('profils','profils.id','=','users.profil_id')
            ->get();
           // dd($users);
        return view('user.index')->with(['users'=>$users,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typePromoteur= DB::table('typepromoteurs')
        ->select('*')
        //->where('profils.nomProfil', 'Promoteur')
        ->get();   
       // TypePromoteur::all();
        $profil= DB::table('profils')
        ->select('profils.*')
        ->where('profils.nomProfil', 'Promoteur')
        ->get();        
        return view('user.register')->with(['typePromoteur'=>$typePromoteur,
        'profils'=>$profil]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {
       // var_dump($request);
      /*  if ($request->input('password') !== $request->input('confirm_password')) {
            return redirect()->back()->withInput()->withErrors(['Les mots de passe ne correspondent pas.']);
        }else{
            $request->validate([
                'profil_id' => 'required',
                'email' => 'nullable|email|unique:users,email',
                'password' => 'required|min:8',
            ]);*/
           // dd($request);
            $promoteur = new Promoteur();
            $promoteur->typePromoteur_id = $request->input('type_promoteur');
            $promoteur->save();
            
            $promoteurId = $promoteur->id;
            $promoteurTypeId = $promoteur->typePromoteur_id;
            if($promoteur->typePromoteur_id == 1 || $promoteur->typePromoteur_id == "1"){
                $promoteurP = new PromoteurPhysique();
                $promoteurP->promoteur_id = $promoteurId;
                $promoteurP->nom = $request->input('nom');
                $promoteurP->prenom = $request->input('prenom');
                $promoteurP->email = $request->input('username');
                $promoteurP->telephone = $request->input('telephone');
                $promoteurP->save();
            }else if($promoteur->typePromoteurId == 2 || $promoteur->typePromoteur_id == "2"){
                $promoteurM = new PromoteurMorale();
                $promoteurM->promoteur_id = $promoteurId;
                $promoteurM->save();

                $promoteurMId = $promoteurM->id;

                $responsableP = new ResponsablePhysique();
                $responsableP->promoteur_id = $promoteurMId;
                $responsableP->nom = $request->input('nom');
                $responsableP->prenom = $request->input('prenom');
                $responsableP->email = $request->input('username');
                
                $responsableP->telephone = $request->input('telephone');
                $responsableP->save();

            }
        $user = new User();
        $user->profil_id = $request->input('profil');
        $user->promoteur_id = $promoteurId;
        $user->email = $request->input('username');
        $user->username = $request->input('username');
      //  dd($user);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        // Validation des données du formulaire
        Auth::login($user);
        return redirect('/adminPromo?email=' . urlencode($user->email) . '&profil=' . urlencode($user->profil_id) . '&promoteur_id=' . urlencode($user->promoteur_id) .'&promoteurtype_id=' . urlencode($promoteurTypeId));
        
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
    public function acceuilUser(Request $request)
    {
        return view('user.accueil');
    }
}

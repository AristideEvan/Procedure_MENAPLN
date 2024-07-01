<?php

namespace Illuminate\Foundation\Auth;

use App\Models\Params\Localite;
use App\Models\User\Profil;
use App\Models\User\User;
use App\Models\Params\TypePromoteur;
use App\Models\Procedure\Promoteur;
use App\Models\Procedure\PromoteurMorale;
use App\Models\Procedure\PromoteurPhysique;
use App\Models\Procedure\ResponsablePhysique;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

trait RegistersUsers
{
    use RedirectsUsers;
    use AuthenticatesUsers;
    //private $operation='';
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm($rub = null, $srub=null)
    {
        $profils=Profil::all();
        $regions=Localite::where('parent_id',NULL)->get();
        //dd($regions);
        return view('auth.registerBack')->with(['profils'=>$profils,'regions'=>$regions,'rub'=>1,'srub'=>3]);
    }

    public function showClientRegistrationForm($rub = null, $srub=null)
    {
        $typePromoteur= DB::table('typepromoteurs')
        ->select('*')
        //->where('profils.nomProfil', 'Promoteur')
        ->get(); 
        return view('auth.register')->with(['typePromoteur'=>$typePromoteur,'rub'=>1,'srub'=>3]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    public function clientRegister(Request $request)
    { 

             //validation
            $request->validate([
                "type_promoteur"=>"required",
                'nom'=>"required",
                'prenom'=>"required",
                'identifiant'=>"required",
                'password'=>"required",
                'email'=>"required",
                'telephone'=>"required",
                'libelle'=>"required",
                'reference'=>"required",
            ]);

            // enregistrement d'un type promoteur
            $promoteur = new Promoteur();
            $promoteur->typePromoteur_id = $request->input('type_promoteur');
            $promoteur->save();

            $promoteurId = $promoteur->id;
            $promoteurTypeId = $promoteur->typePromoteur_id;
            if($promoteur->typePromoteur_id == 1 || $promoteur->typePromoteur_id == "1"){
                $promoteurP = new PromoteurPhysique();
                $promoteurP->promoteur_id = $promoteurId;
                $promoteurP->civilite = $request->input('civilite');
                $promoteurP->nom = $request->input('nom');
                $promoteurP->prenom = $request->input('prenom');
                $promoteurP->email = $request->input('email');
                $promoteurP->telephone = $request->input('telephone');
                $promoteurP->save();
            }else if($promoteur->typePromoteurId == 2 || $promoteur->typePromoteur_id == "2"){
                $promoteurM = new PromoteurMorale();
                $promoteurM->promoteur_id = $promoteurId;
                $promoteurM->libelle = $request->input('libelle');
                $promoteurM->reference = $request->input('reference');
                $promoteurM->email = $request->input('email');
                $promoteurM->telephone = $request->input('telephone');
                $promoteurM->save();
            }
        $user = new User();
        $user->profil_id = $request->input('profil');
        $user->promoteur_id = $promoteurId;
        $user->email = $request->input('email');
        $user->username = $request->input('identifiant');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        Auth::login($user);
        $tableau=[];
        $regions=[];
        $provinces=[];
        $communes=[];
        $idBon='';
        $localisation = [];
        $menus=DB::table('menus')
            ->select('menus.*')
            ->join('profilmenus','profilmenus.menu_id','=','menus.id')
            ->where('profilmenus.profil_id',Auth()->user()->profil_id)
            ->orderBy('ordre','ASC')
            ->get();
            foreach($menus as $parent){
                if($parent->parent_id==NULL){
                    $tableau[$parent->id][0]=$parent;
                }else{
                    $tableau[$parent->parent_id][1][$parent->id][0]=$parent;
                    $actionMenu=DB::table('actions')
                        ->select('actions.*')
                        ->join('profilmenuactions','profilmenuactions.action_id','=','actions.id')
                        ->where(['profilmenuactions.menu_id'=>$parent->id,
                        'profilmenuactions.profil_id'=>Auth()->user()->profil_id])
                        ->get();
                    $actions=[];
                    foreach($actionMenu as $action){
                        $actions[] = $action->nomAction;
                    }
                    $tableau[$parent->parent_id][1][$parent->id][1]=$actions;
                }
            }
        $user=User::find(Auth()->user()->id);
        $localisation[4]='('.$idBon.')';
        Session::put('menus', $tableau);
        Session::put('user', $user);
        //return redirect($this->redirectPath());
        return redirect('procedure/'.$request['rub'].'/'.$request['srub'])->with(['success'=>'Opération effectuée avec succès']);
      
    
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}

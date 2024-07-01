<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeControllercopy extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //  dd($session);
        
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $profil = Auth::user()->profil_id;
        $promoteurId = Auth::user()->promoteur_id;
            $results = DB::table('demandes')
            ->join('localites', 'localites.id', '=', 'demandes.localite_id')
            ->where('demandes.promoteur_id', '=', $promoteurId)
            ->select('demandes.*', 'localites.*')
            ->get();
        
        $typePromot = DB::table('promoteurs')
        ->where('promoteurs.id', '=', $promoteurId)
        ->select('promoteurs.*')
        ->get();
        $promoteureType = $typePromot[0]->typePromoteur_id;
//dd($typePromot);
       // $typeProm = $typePromot->typePromoteur_id;
        Session::put('typeProm', $promoteureType);
        //echo $typePromot[0]->typePromoteur_id;
        //echo $user->id;
        //return redirect()->intended($this->redirectPath());
        //var_dump($results);
        //$user = Auth::user();
        //dd($user);
       return view('procedure.acceuilPromoteur', ['email' => $email, 'profil' => $profil,'results' => $results]);
       // return view('home');
    }
}

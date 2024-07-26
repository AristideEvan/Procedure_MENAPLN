<?php

namespace App\Http\Controllers\Procedure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Params\Localite;
use App\Models\Params\Typepromoteur;
use App\Models\Procedure\Demande;
use App\Models\Procedure\Commentaire;
use App\Models\Procedure\Demandedocument;
use App\Models\Procedure\ResponsablePhysique;
use App\Models\Params\Typeenseignement;
use App\Models\Params\Document;
use App\Models\Params\Secteur;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Fonction\Fonction;
use Codedge\Fpdf\Fpdf\Fpdf;
use DateTime;


class PDF extends FPDF
{
    private $region;

    public function setRegion($valeur) {
        $this->region = $valeur;
    }

    public function getRegion() {
        return $this->region;
    }
    // En-tête
    function Header()
	{
        $this->SetFont('Arial','',11);
        $this->Ln(7);
        $this->Cell(100,4,'MINISTERE DE L\'EDUCATION NATIONALE, DE',0,0,'C');
        $this->Cell(40);
        $this->Cell(20,4,'BURKINA FASO',0,1,'C');
        $this->Cell(100,4,'L\'ALPHABETISATION ET DE LA PROMOTION',0,0,'C');
        $this->Cell(40);
        $this->Cell(20,4,'----------',0,1,'C');
        $this->Cell(100,4,'DES LANGUES NATIONALES',0,0,'C');
        $this->Cell(40);
        $this->SetFont('Arial','I',11);
        $this->Cell(20,4,utf8_decode('Unité - Progrès - Justice'),0,1,'C');
        $this->SetFont('Arial','',11);
        $this->Cell(100,4,'----------',0,1,'C');
        $this->Cell(100,4,'SECRETARIAT GENERAL',0,1,'C');
        $this->Cell(100,3,'----------',0,1,'C');
        $this->Cell(100,4,'DIRECTION DE L\'ADMINISTRATION',0,1,'C');
        $this->Cell(100,4,'DES FINANCES',0,1,'C');
        $this->Cell(100,7,'----------',0,1,'C');
        $this->Ln(5);
    }
    public function dateFormateLettre(DateTime $d){
        $mois = [1=>"janvier",2=>"février",3=>"mars",4=>"avril",5=>"mai",6=>"juin",7=>"juillet",8=>"août",9=>"septembre",10=>"octobre",11=>"novembre",12=>"décembre"];
        return $d->format('d')." ".utf8_decode($mois[$d->format('n')])." ".$d->format('Y');
    }
    public function setPages($id){
        $fonction= new Fonction(); 
        $demandes = DB::table('demandes as dem')
                ->select('dem.*',
                        'village.id as village_id',
                        'village.slug as nom_village',
                        'commune.id as commune_id',
                        'commune.slug as nom_commune',
                        'province.id as province_id',
                        'province.slug as nom_province',
                        'region.id as region_id',
                        'region.slug as nom_region',
                        'typeEn.id as typeEns_id',
                        'typeEn.libelle')
                ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                ->where('dem.id', '=', $id)
                ->get();
              //  dd($demandes);
        $etablissement = $demandes[0]->nomEtablissement;
        $reference = $demandes[0]->reference;
        $superficie = $demandes[0]->superficie;
        $region = $demandes[0]->nom_region;
        $province = $demandes[0]->nom_province;
        $commune = $demandes[0]->nom_commune;
        $village = $demandes[0]->nom_village;
        $dateLettre = $demandes[0]->datelettre;
        $this->setRegion($demandes[0]->nom_region);
        //Le Propriétaire de la demande
        $utilisat = DB::table('users')
        ->where('users.id','=',$demandes[0]->user_id)
        ->select('users.*')
        ->get();
        // Type Promoteur
        $typePromot = DB::table('promoteurs')
        ->where('promoteurs.id', '=', $utilisat[0]->promoteur_id)
        ->select('promoteurs.*')
        ->get();
        $promoteurType = $typePromot[0]->typePromoteur_id;
        if($promoteurType == 1){
            $promotP = DB::table('promoteur_physiques')
                ->where('promoteur_physiques.promoteur_id', '=', $utilisat[0]->promoteur_id)
                ->select('promoteur_physiques.*')
                ->get();
               //dd($promotP);
            $civilite = $promotP[0]->civilite;
            $nom = $promotP[0]->nom;
            $prenom = $promotP[0]->prenom;
            $telephone = $promotP[0]->telephone;
        }else if($promoteurType == 2){
            $promotM = DB::table('promoteur_morales')
                ->where('promoteur_morales.id', '=', $utilisat[0]->promoteur_id)
                ->select('promoteur_morales.*')
                ->get();
            $responsab = DB::table('responsable_physiques')
            ->where('responsable_physiques.demande_id', '=', $id)
            ->select('responsable_physiques.*')
            ->get();
            $civilite = $responsab[0]->civilite;
            $nom = $responsab[0]->nom;
            $prenom = $responsab[0]->prenom;
            $telephone = $responsab[0]->telephone;
        }
            $d= new DateTime();
            $lastNum=$fonction->recupLastNum();
            $number=$lastNum+1;
            $valerSuiv=$fonction->mettreNumero($id,$number);
            $numero=$fonction->genererNumero($valerSuiv);
        
             $this->AddPage();
             $this->SetFont('Arial','',11);
             $this->Cell(100,7,utf8_decode('N° ').$d->format('Y').'-'.$numero.' MENAPLN/SG/DG-AEF/DEP',0,0,'C');
             $this->Cell(40);
             $this->Cell(20,4,'LE MINISTRE',0,1,'C');
             $this->Ln(8); 
             $this->Cell(140);
             $this->Cell(20,4,' A',0,1,'C');
             $this->Ln(8);
             $this->Cell(145);
             $this->Cell(20,4,utf8_decode($civilite).' '.$nom. ' '.$prenom,0,1,'C');
             $this->Ln(3);
             $this->Cell(145);
             $this->Cell(20,4,utf8_decode('Télephone :').$telephone.' ',0,1,'C');
             $this->Ln(10);
             $this->SetFont('Arial','BU',10);
             $this->Cell(15);
             $this->Cell(5,7,utf8_decode('Objet : '),0,0,'C');
             $this->Cell(3);
             $this->SetFont('Arial', '', 10); // Définir le style normal
             $this->Cell(0, 7, utf8_decode('Autorisation de création d\'un établissement'), 0, 1, 'L'); // Utiliser 'L' pour aligner à gauche
             
             $this->SetFont('Arial','',10);
             $this->Cell(50);
             $this->Cell(40,7,utf8_decode('privé d\'enseignement post-primaire et secondaire général'),0,1,'C');
             $this->SetFont('Arial','',11);
             $this->Cell(50);
             $this->Cell(80,10, utf8_decode($civilite),0,1,'L');
             $this->SetFont('Arial','',10);
             $this->Cell(20);
             $this->MultiCell(0, 6, utf8_decode('Comme suite à votre lettre du '.$dateLettre.' relative à une autorisation de création d\'un établissement privé d\'enseignement post-primaire et secondaire général dénommé '.$etablissement.' sur un terrain d\'une superficie de '.$superficie.' m², sis '.strtoupper($village).' , commune de '.strtoupper($commune).', province '.strtoupper($province).', région '.strtoupper($region).', j\'ai l\'honneur de vous informer que je marque mon accord à votre requête.'), 0, 'L');
             $this->SetFont('Arial','',10);
             $this->Ln(2);
             $this->Cell(20);
             $this->MultiCell(0, 5, utf8_decode('
             Toutefois, j\'attire particulièrement votre attention sur le fait que cette autorisation de création, d\'une validité de trois (3) ans renouvelable une fois à un mois avant son expiration, ne permet pas à votre établissement de fonctionner. L\'autorisation d\'ouverture fait l\'objet d\'un autre dossier dont la composition est consignée dans le cahier des charges des établissements privés d\'enseignement post-primaire et secondaire général formel et non formel.'),0,'L');
             $this->SetFont('Arial','',10);
             $this->Ln(2);
             $this->Cell(20);
             $this->MultiCell(0, 5, utf8_decode('
             Par conséquent, je vous invite à prendre attache avec la Direction Générale de l\'Accès à l\'Education Formelle pour les formalités de mise en oeuvre de votre projet.'),0,'L');
             $this->SetFont('Arial','',10);
             $this->Ln(2);
             $this->Cell(20);
             $this->MultiCell(0, 10, utf8_decode('Je vous prie de croire,'.$civilite.' , en l\'assurance de ma considération distinguée.'),0,'L');
             $this->Cell(20);
             //$this->Image($chemin."/".$nomCode.".png",180,200,20);
             
         }
             
    


    // Pied de page
    function Footer(){
        $this->SetY(-65);
        $this->SetFont('Arial','BI',11);
        $this->Cell(15);
        $this->Cell(0,10,'Ampliations',0,1,'L');
        $this->Cell(15); 
        $this->Multicell(65,5,"1-DG-AEF ",0);
        $this->Cell(15); 
        $this->Multicell(65,5,utf8_decode('2-DREPS '.strtoupper($this->getRegion())),0);
     
     
            $this->SetY(-65);
            $this->Cell(120);
            $this->SetFont('Arial','BI',11);
            $this->Cell(0,5,utf8_decode('Pour le Ministre et par délégation,'),0,1,'L');
            $this->Cell(130);
            $this->Cell(0,5,utf8_decode('le secrétaire général'),0,1,'L');
        //    $signataire1 = (count($this->signataires()) == 2)?$this->signataires()[1] : $this->signataires()[0];
            
            $this->Cell(120);
           // $this->Multicell(0,5,utf8_decode($this->article($signataire1->sexe)." ".((!is_null($signataire1->fonction))?$signataire1->fonction:$signataire1->fonctionBis)),0);
            $this->SetY(-30);
            $this->Cell(130);
            $this->SetFont('Arial','BUI',11);
            $this->Cell(0,7,'Ibrahima SANON',0,1,'L');
            $this->SetFont('Arial','I',10);
            $this->Cell(126);
            $this->Cell(0,5,'Officier de l\'Ordre de l\'Etalon',0,1,'L');
       // }
    }
}


class ProcedureController extends Controller
{
    private $msgerror='Impossible de supprimer cet élément car il est utilisé!';
    private $operation='Opération effectuée avec succès';
    public function __construct()
        {
        $this->middleware('auth');
            
        }
 

public function genererAutorisation($id,Request $request){
    $this->fpdf = new PDF();
    //$this->fpdf->AddPage();
    $this->fpdf->setPages($id);
    $this->fpdf->Output('','autorisation_creation_etablissement.pdf');
    exit;
}

public function genererAutorisationAvec($id,Request $request){
    //dd($request->input('titreRepondant'));
    
    $dateReq = $request->input('dateLettre');
    $titre = $request->input('titreRepondant');
    $responsables = ResponsablePhysique::where('demande_id', $id)->first();
   // $responsables->civilite = $titre;
    //$responsables->save();

    $demande = Demande::find($id);
    $demande->datelettre = $dateReq;
    $demande->save();
    
    $this->fpdf = new PDF();
    //$this->fpdf->AddPage();
    $this->fpdf->setPages($id);
    $this->fpdf->Output('','autorisation_creation_etablissement.pdf');
    exit;
}
public function index($rub = null, $srub=null)
        {
            $user = Auth::user();
            //$demandes=Demande::orderby('created_at','desc')->get();
            if($user->niveauAction == null){ 
              //  dd($user->id);
                $demandes = DB::table('demandes as dem')
                ->select('dem.*',
                        'village.id as village_id',
                        'village.slug as nom_village',
                        'commune.id as commune_id',
                        'commune.slug as nom_commune',
                        'province.id as province_id',
                        'province.slug as nom_province',
                        'region.id as region_id',
                        'region.slug as nom_region',
                        'typeEn.id as typeEns_id',
                        'typeEn.libelle')
                ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                ->where('dem.user_id', '=', $user->id)
                ->get();

              //  $demandes = DB::table('demandes')
               // ->join('localites', 'localites.id', '=', 'demandes.localite_id')
              //  ->join('typeenseignements', 'typeenseignements.id', '=', 'demandes.typeenseignement_id')
              ///  ->where('demandes.user_id', '=', $user->id)
              //  ->select('demandes.*', 'localites.*','typeenseignements.*')
              //   ->get();
            }else{
                //Niveau DEP
                if($user->niveauAction == 1){
                    $stat = "DEP";
                    $demandes = DB::table('demandes as dem')
                    ->select('dem.*',
                            'village.id as village_id',
                            'village.slug as nom_village',
                            'commune.id as commune_id',
                            'commune.slug as nom_commune',
                            'province.id as province_id',
                            'province.slug as nom_province',
                            'region.id as region_id',
                            'region.slug as nom_region',
                            'typeEn.id as typeEns_id',
                            'typeEn.libelle')
                    ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                    ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                    ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                    ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                    ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                    ->where('dem.statut', '=', $stat)
                    ->orWhere('dem.statut', '=', 'Signé')
                    ->get();
        }
                //Niveau Region
                else if($user->niveauAction == 2){
                    $stat = "Region";
                    $demandes = DB::table('demandes as dem')
                            ->select('dem.*',
                                    'village.id as village_id',
                                    'village.slug as nom_village',
                                    'commune.id as commune_id',
                                    'commune.slug as nom_commune',
                                    'province.id as province_id',
                                    'province.slug as nom_province',
                                    'region.id as region_id',
                                    'region.slug as nom_region',
                                    'typeEn.id as typeEns_id',
                                    'typeEn.libelle')
                            ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                            ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                            ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                            ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                            ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                            ->where('region.id', '=', $user->region_id)
                            ->where('dem.statut', '=', $stat)
                            ->orWhere('dem.statut', '=', 'Signé')
                            ->get();
                }
                // Niveau Province
                
                else if($user->niveauAction == 3){
                    $stat = "Paye";
                    $demandes = DB::table('demandes as dem')
                            ->select('dem.*',
                                    'village.id as village_id',
                                    'village.slug as nom_village',
                                    'commune.id as commune_id',
                                    'commune.slug as nom_commune',
                                    'province.id as province_id',
                                    'province.slug as nom_province',
                                    'region.id as region_id',
                                    'region.slug as nom_region',
                                    'typeEn.id as typeEns_id',
                                    'typeEn.libelle')
                            ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                            ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                            ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                            ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                            ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                            ->where('province.id', '=', $user->province_id)
                            ->where('dem.statut', '=', $stat)
                            ->orWhere('dem.statut', '=', 'Signé')
                            ->orWhere('dem.statut', '=', 'Province')
                            ->get();
                }

                // Niveau SG
                else if($user->niveauAction == 0){
                    $stat = "SG";
                    $demandes = DB::table('demandes as dem')
                            ->select('dem.*',
                                    'village.id as village_id',
                                    'village.slug as nom_village',
                                    'commune.id as commune_id',
                                    'commune.slug as nom_commune',
                                    'province.id as province_id',
                                    'province.slug as nom_province',
                                    'region.id as region_id',
                                    'region.slug as nom_region',
                                    'typeEn.id as typeEns_id',
                                    'typeEn.libelle')
                            ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                            ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                            ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                            ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                            ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                            ->where('dem.statut', '=', $stat)
                            ->get();
                }
            }
            //dd($demandes);
            return view('procedure.index')->with(['demandes'=>$demandes,'controler'=>$this,"rub"=>$rub,"srub"=>$srub]);
        }

public function create($rub = null, $srub=null)
    {
        $typePromot = DB::table('promoteurs')
        ->where('promoteurs.id', '=', Auth::user()->promoteur_id)
        ->select('promoteurs.*')
        ->get();
        $promoteurType = $typePromot[0]->typePromoteur_id;
        $typePromoteurNom = Typepromoteur::where('id',$promoteurType)->get();
        $regions=Localite::where('parent_id',NULL)->get();
        $enseignement=Typeenseignement::orderBy('id','ASC')->get();
        $secteur=Secteur::orderBy('id','ASC')->get();
        $pieceJointes = DB::table('documents')
            ->join('typedocuments', 'documents.typedocument_id', '=', 'typedocuments.id')
            ->join('documenttypepromoteurs', 'documents.id', '=', 'documenttypepromoteurs.document_id')
            ->join('typepromoteurs', 'documenttypepromoteurs.typepromoteur_id', '=', 'typepromoteurs.id')
            ->where('typepromoteurs.id', '=', $promoteurType)
            ->select('documents.id as docs_id','documents.libelleDocument',
                    'documents.typedocument_id','typedocuments.id as typeDocs_id',
                    'typedocuments.libelle')
            ->get();
           // dd($pieceJointes);
            $nbr_ele = intdiv(count($pieceJointes),2) + 1;
            $typesAndDocuments = [];
            foreach ($pieceJointes as $pieceJointe) {
                $typeDocumentId = $pieceJointe->typeDocs_id;
                // Vérifiez si le type de document existe dans le tableau
                if (!array_key_exists($typeDocumentId, $typesAndDocuments)) {
                    $typesAndDocuments[$typeDocumentId]['typeDocument'] = [
                        'typeDocs_id' => $pieceJointe->typeDocs_id,
                        'libelle' => $pieceJointe->libelle,
                    ];
                    $typesAndDocuments[$typeDocumentId]['documents'] = [];
                }

                // Ajoutez le document associé au type de document
                $typesAndDocuments[$typeDocumentId]['documents'][] = [
                    'docs_id' => $pieceJointe->docs_id,
                    'libelleDocument' => $pieceJointe->libelleDocument,
                ];
            }
             //dd($typesAndDocuments);
        return view('procedure.create')->with(['regions'=>$regions,'enseignements'=>$enseignement,'secteurs'=>$secteur,'typesAndDocuments'=>$typesAndDocuments,'nbre_file'=>count($pieceJointes), 'nbr_ele'=>$nbr_ele,'typePromoteur'=>$typePromoteurNom,"rub"=>$rub,"srub"=>$srub]);
    }

public function store(Request $request)
    {   
        // Type Promo
        $typePromot = DB::table('promoteurs')
        ->where('promoteurs.id', '=', Auth::user()->promoteur_id)
        ->select('promoteurs.*')
        ->get();
        $promoteurType = $typePromot[0]->typePromoteur_id;
        //Localite
        $localite = Localite::find($request->input('village'));

        $fct = new Fonction();
        $currentYear = Carbon::now()->year;
        $generatedString = $currentYear . '_' . $localite->slug . '_'. Auth::user()->id;
        $statut = "Non Paye";
        $village = $request->input('village');
        $enseignement = $request->input('enseignement');
        $etablissement = $request->input('etablissement');
        $superficie = $request->input('superficie');
        $documents = $request->file('files');
       // dd($request->input('nomRepresentant'));
        
        //Info Demande
        $demande = new Demande();
        $demande->user_id = Auth::user()->id;
        $demande->reference = $generatedString;
        $demande->localite_id = $village;
        $demande->nomEtablissement = $etablissement;
        $demande->superficie = $superficie;
        $demande->typeenseignement_id = $enseignement;
        $demande->statut = $statut;
        $demande->save();

        $demandeId = $demande->id;

        if($promoteurType == 2 || $promoteurType == "2"){
            //Representant
            $nomRep = $request->input('nomRepresentant');
            $prenomRep = $request->input('prenomRepresentant');
            $emailRep = $request->input('emailRepresentant');
            $telRep = $request->input('telephoneRepresentant');
            $repre = new ResponsablePhysique();
            $repre->nom = $nomRep;
            $repre->prenom = $prenomRep;
            $repre->email = $emailRep;
            $repre->telephone = $telRep; 
            $repre->promoteur_id = Auth::user()->promoteur_id;
            $repre->demande_id = $demandeId;
            $repre->save();
            //dd($request->input('nomRepresentant'));
        }

        $tableFile = $request->file('piece');
        $tableFile_id = $request->input('documents');
        //$tableFile_id = $request->input('piece_id');
        //dd($tableFile_id);
        foreach ($tableFile as $key => $file) {
            $extension=$file->extension();
            $nomFichierUser=$file->getClientOriginalName();
            $nomGenerer=$fct->genererNom();
            $nomFichier=$file->storeAs(Auth::user()->id,$nomGenerer.".".$extension,'public');
            if(PHP_OS=="Linux"){
                $file=storage_path().'/app/public/'.$nomFichier;
            }else{
                $nom= str_replace ("/" ,"\\", $nomFichier);
                $file=storage_path().'\\app\public\\'.$nom;
            }  
            $document = new DemandeDocument();
            $document->demande_id = $demandeId;
            $document->chemin=$file;
            $document->nom_fichier=$nomFichierUser;
            $document->nom_generer=$nomGenerer;
            $document->document_id=$tableFile_id[$key];
            $document->user_id=Auth()->user()->id;
            $document->save();
            
        }
        return redirect('procedure/'.$request['rub'].'/'.$request['srub'])->with(['success'=>$this->operation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function updateStatut($id,Request $request)
    {
    // Mise à jour du document existant
    $demande = Demande::find($id);
    //dd($demande);
    if ($demande) {
        if ($demande->statut == 'Non Paye' || $demande->statut == 'A Corriger') {
            $demande->update(['statut' => 'Paye']);
        } elseif ($demande->statut == 'Paye') {
            $demande->update(['statut' => 'Region']);
        } elseif ($demande->statut == 'Region') {
            $demande->update(['statut' => 'DEP']);
        } elseif ($demande->statut == 'DEP') {
            $demande->update(['statut' => 'SG']);
        } elseif ($demande->statut == 'SG') {
            $demande->update(['statut' => 'Signé']);
        }
        return redirect('procedure/'.$request['rub'].'/'.$request['srub'])->with(['success'=>$this->operation]);
    } else {
        return redirect('procedure/'.$request['rub'].'/'.$request['srub'])->with(['success'=>$this->operation]);
    }
}

public function updateMouvement($id,Request $request)
    {
    // Mise à jour du document existant
    $fct = new Fonction();
    $demande = Demande::find($id);
    $commentaire = $request->input('comment');
    $status = $request->input('status');
    $file = $request->file('document');
   // dd($request);
    
    if ($demande && $status) {
        $demande->update(['statut' => $status]);
        if($file){
            $extension=$file->extension();
            $nomFichierUser=$file->getClientOriginalName();
            $nomGenerer=$fct->genererNom();
            $nomFichier=$file->storeAs(Auth::user()->id,$nomGenerer.".".$extension,'public');
            if(PHP_OS=="Linux"){
                $file=storage_path().'/app/public/'.$nomFichier;
            }else{
                $nom= str_replace ("/" ,"\\", $nomFichier);
                $file=storage_path().'\\app\public\\'.$nom;
            }
            $comment = new Commentaire();
            $comment->demande_id = $demande->id;
            $comment->commentaire = $commentaire;
            $comment->chemin=$file;
            $comment->nom_generer=$nomGenerer;
            $comment->nom_fichier=$nomFichierUser;
            $comment->user_id=Auth()->user()->id;
            $comment->save();
        }else{
            $comment = new Commentaire();
            $comment->demande_id = $demande->id;
            $comment->commentaire = $commentaire;
           // $comment->chemin=$file;
           // $comment->nom_fichier=$nomFichierUser;
            $comment->user_id=Auth()->user()->id;
            $comment->save();
        }
        
        return redirect('procedure/'.$request['rub'].'/'.$request['srub'])->with(['success'=>$this->operation]);
    } else {
        return redirect('procedure/'.$request['rub'].'/'.$request['srub'])->with(['success'=>$this->operation]);
    }
}

/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function show($id)
    {
        //Le Propriétaire de la demande
        
        //La demande
        $demandes = DB::table('demandes as dem')
                ->select('dem.*',
                        'village.id as village_id',
                        'village.slug as nom_village',
                        'commune.id as commune_id',
                        'commune.slug as nom_commune',
                        'province.id as province_id',
                        'province.slug as nom_province',
                        'region.id as region_id',
                        'region.slug as nom_region',
                        'typeEn.id as typeEns_id',
                        'typeEn.libelle')
                ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
                ->join('localites as village', 'village.id', '=', 'dem.localite_id')
                ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
                ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
                ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
                ->where('dem.id', '=', $id)
                ->get();

        $utilisat = DB::table('users')
        ->where('users.id','=',$demandes[0]->user_id)
        ->select('users.*')
        ->get();
        //dd($utilisat);
        $typePromot = DB::table('promoteurs')
        ->where('promoteurs.id', '=', $utilisat[0]->promoteur_id)
        ->select('promoteurs.*')
        ->get();
      //  dd($typePromot);
        $promoteurType = $typePromot[0]->typePromoteur_id;
        if($promoteurType == 2){
            $promotM = DB::table('promoteur_morales')
                ->where('promoteur_morales.promoteur_id', '=',  $typePromot[0]->id)
                ->select('promoteur_morales.*')
                ->get();
               // dd($promotM);
            $responsab = DB::table('responsable_physiques')
            ->where('responsable_physiques.demande_id', '=', $id)
            ->select('responsable_physiques.*')
            ->get();
           // dd($responsab);
        }else{
            $responsab =[];
        }
        
         
    // Les document de la demande

        $documents=DB::table('demandedocuments as demdoc')
        ->select('demdoc.id','demdoc.document_id','demdoc.demande_id','demdoc.chemin','demdoc.nom_fichier','demdoc.nom_generer','demdoc.user_id as user','docs.*','typedocuments.*')
        ->join('documents as docs', 'docs.id', '=', 'demdoc.document_id')
        ->join('typedocuments', 'docs.typedocument_id', '=', 'typedocuments.id')
        ->where('demdoc.demande_id', '=', $id)
        ->get();
        $commentaires=DB::table('commentaires as comment')
        ->select('comment.*')
        ->where('comment.demande_id', '=', $id)
        ->get();
            return view('procedure.show')->with(['commentaires'=>$commentaires,'documents'=>$documents,
            'data'=>$demandes,'typePromo'=>$typePromot,'respons'=>$responsab]);
        
 }

  public function showPdf($pdfUrl)
    {
        return view('procedure.showPdf', compact('pdfUrl'));
    }

 public function edit($id,$rub=null,$srub=null)
    {
        // dd($id,$rub,$srub);
    $regions = Localite::where('parent_id', NULL)->get();
    $enseignements = Typeenseignement::orderBy('id', 'ASC')->get();
    $secteurs = Secteur::orderBy('id', 'ASC')->get();
    //La demande
    $oldDemande = DB::table('demandes as dem')
    ->select('dem.*',
            'village.id as village_id',
            'village.slug as nom_village',
            'commune.id as commune_id',
            'commune.slug as nom_commune',
            'province.id as province_id',
            'province.slug as nom_province',
            'region.id as region_id',
            'region.slug as nom_region',
            'typeEn.id as typeEns_id',
            'typeEn.libelle')
    ->join('typeenseignements as typeEn', 'typeEn.id', '=', 'dem.typeenseignement_id')
    ->join('localites as village', 'village.id', '=', 'dem.localite_id')
    ->leftJoin('localites as commune', 'commune.id', '=', 'village.parent_id')
    ->leftJoin('localites as province', 'province.id', '=', 'commune.parent_id')
    ->leftJoin('localites as region', 'region.id', '=', 'province.parent_id')
    ->where('dem.id', '=', $id)
    ->get();

    // Les document de la demande

    $oldDocuments=DB::table('demandedocuments as demdoc')
    ->select('demdoc.*','docs.*')
    ->join('documents as docs', 'docs.id', '=', 'demdoc.document_id')
    ->where('demdoc.demande_id', '=', $id)
    ->where('demdoc.deleted_at', null)
    ->get();

    $pieces=[];
        if($oldDocuments->count()>0)
        {
        foreach ($oldDocuments as $oldDocument){
            $pieces[$oldDocument->document_id]=$oldDocument;
        }    
    }

    //dd($oldDocuments);
    $typePromot = DB::table('promoteurs')
        ->where('promoteurs.id', '=', Auth::user()->promoteur_id)
        ->select('promoteurs.*')
        ->get();
        $promoteurType = $typePromot[0]->typePromoteur_id;
        $typePromoteurNom = Typepromoteur::where('id',$promoteurType)->get();
    $pieceJointes = DB::table('documents')
            ->join('typedocuments', 'documents.typedocument_id', '=', 'typedocuments.id')
            ->join('documenttypepromoteurs', 'documents.id', '=', 'documenttypepromoteurs.document_id')
            ->join('typepromoteurs', 'documenttypepromoteurs.typepromoteur_id', '=', 'typepromoteurs.id')
            ->where('typepromoteurs.id', '=', $promoteurType)
            ->select('documents.id as docs_id','documents.libelleDocument',
                    'documents.typedocument_id','typedocuments.id as typeDocs_id',
                    'typedocuments.libelle')
            ->get();
           // dd($pieceJointes);
            $nbr_ele = intdiv(count($pieceJointes),2) + 1;
            $typesAndDocuments = [];
            foreach ($pieceJointes as $pieceJointe) {
                $typeDocumentId = $pieceJointe->typeDocs_id;
                // Vérifiez si le type de document existe dans le tableau
                if (!array_key_exists($typeDocumentId, $typesAndDocuments)) {
                    $typesAndDocuments[$typeDocumentId]['typeDocument'] = [
                        'typeDocs_id' => $pieceJointe->typeDocs_id,
                        'libelle' => $pieceJointe->libelle,
                ];
                $typesAndDocuments[$typeDocumentId]['documents'] = [];
                }
                // Ajoutez le document associé au type de document
                $typesAndDocuments[$typeDocumentId]['documents'][] = [
                    'docs_id' => $pieceJointe->docs_id,
                    'libelleDocument' => $pieceJointe->libelleDocument,
                ];
            }
            //dd($oldDocuments);
           //dd($oldDemande[0]->typeenseignement_id);
    // Utilisez la vue appropriée pour l'édition en passant les données nécessaires
    // dd($oldDemande,$regions,$typePromoteurNom,$typesAndDocuments,$enseignements,$oldDocuments,$rub,$srub);
    return view('procedure.edit')->with(['oldDemande'=>$oldDemande,
                                         'regions'=>$regions,
                                         'typePromoteur'=>$typePromoteurNom,
                                         'typesAndDocuments'=>$typesAndDocuments,
                                         'enseignements'=>$enseignements,
                                         'oldDocuments'=>$oldDocuments,
                                         'pieces'=>$pieces,
                                         'rub'=>$rub,
                                         'srub'=>$srub]);
    }

public function destroy($id,$rub=null,$srub=null)
    {
        // Suppression du document
        DemandeDocument::where('demande_id', $id)->delete();
        Commentaire::where('demande_id', $id)->delete();
        Demande::where('id', $id)->delete();
        return back()->with(['success'=>'Procedure Supprimée avec succès']);
    }
    
public function update(Request $request,$id)
    {
        $fct = new Fonction();
        $currentYear = Carbon::now()->year;
        $village = $request->input('village');
        $enseignement = $request->input('enseignement');
        $etablissement = $request->input('etablissement');
        $superficie = $request->input('superficie');
       

        $demande = Demande::find($id);
        $demande->localite_id = $village;
        $demande->nomEtablissement = $etablissement;
        $demande->superficie = $superficie;
        $demande->typeenseignement_id = $enseignement;
        //
        $tableFile = $request->file('piece');
        $tableFile_id = $request->input('documents');
        $pieceSelect_id = $request->input('pieceSelect_id');
        if($request->hasFile('piece')){
            //dd($tableFile);
            foreach ($tableFile as $key => $file) {
                //dd($pieceSelect_id);
                DemandeDocument::where(['document_id'=>$pieceSelect_id[$key],'demande_id'=>$id])->delete();
                $extension=$file->extension();
                $nomFichierUser=$file->getClientOriginalName();
                $nomGenerer=$fct->genererNom();
                $nomFichier=$file->storeAs(Auth::user()->id,$nomGenerer.".".$extension,'public');
                if(PHP_OS=="Linux"){
                    $file=storage_path().'/app/public/'.$nomFichier;
                }else{
                    $nom= str_replace ("/" ,"\\", $nomFichier);
                    $file=storage_path().'\\app\public\\'.$nom;
                }
                $document = new DemandeDocument();
                $document->demande_id = $id;
                $document->chemin=$file;
                $document->nom_generer=$nomGenerer;
                $document->nom_fichier=$nomFichierUser;
                $document->document_id=$tableFile_id[$key];
                $document->user_id=Auth()->user()->id;
                $document->save();
            }
            
        }else{
           // ne fait rien
            //dd("est null");
        }
        $demande->save();
        return redirect('procedure/'.$request['rub'].'/'.$request['srub'])->with(['success'=>$this->operation]);
    }

    
}


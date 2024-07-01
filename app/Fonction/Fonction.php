<?php
namespace App\Fonction;

use App\Demandestage;
use App\Entreprise\Entreprise;
use Codedge\Fpdf\Fpdf\Fpdf;
use DateTime;
use App\Models\Procedure\Demande;
use Illuminate\Support\Facades\DB;

class Fonction
{
    private $fpdf;

    /**
     * fonction de vérification avant suppression
     */
    public function verifierSupp($table,$element_id,$valeur_id, $del=false){
        $flag=0;
        if($del){
            $verification=DB::select('select * from '.$table.' where '.$element_id.'= ? AND deleted_at IS NULL', [$valeur_id]);
        }else{
            $verification=DB::select('select * from '.$table.' where '.$element_id.'= ?', [$valeur_id]);
        }

        if(count($verification)>0){
            $flag=1;
        }
        return $flag;
    }

        /**
     * fonction pour éliminer les caractère accentués
     * 
     */
    public function enleveAccent($chaine){
        $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
        $chaine = str_replace($search, $replace, $chaine);
        return trim($chaine);
    }

    public function creerUneChaineDonneDeBase($chaine){
        $text=$this->enleveAccent($chaine);
        $chaine = preg_replace("#[^A-Z0-9]#i", "", $text);
        return $chaine;
    }

    public function creerUneChaineSain($chaine){
        $text=$this->enleveAccent($chaine);
        $chaine = preg_replace("#[^A-Z0-9]#i", "", $text);
        return strtolower($chaine) ;
    }

    public function dateFormateLettre(DateTime $d){
        $mois = [1=>"janvier",2=>"février",3=>"mars",4=>"avril",5=>"mai",6=>"juin",7=>"juillet",8=>"août",9=>"septembre",10=>"octobre",11=>"novembre",12=>"décembre"];
        return $d->format('d')." ".utf8_decode($mois[(integer)$d->format('m')])." ".$d->format('Y');
    }

    public function export($table){
        $entete=array();
        $head=DB::select('select column_name, ordinal_position
            from information_schema.columns 
            where table_name =\''.$table.'\'
            order by 2 asc');

        if(count($head)!=0){
            foreach($head as $h){
                array_push($entete,$h->column_name);
            }
            $req=DB::select('select * from '.$table.' order by 1 asc ');
            $f = fopen("php://memory","w");
            $del = ";";
            fputcsv($f,$entete,$del);
            foreach($req as $ep){
                $rep=(array)$ep;
                fputcsv($f,$rep,$del);
            }
            fseek($f,0);
            $filename = $table."_".date('Y-m-d') . ".csv";
            header('Content-Type: application/csv;charset=UTF-8'); 
            header('Content-Disposition: attachment; filename="'.$filename.'";');
            fpassthru($f);
        }else{
            echo '<span style="color:#F00">Aucune table de ce nom trouvée!</span>';
        }
		exit;
	}
    
    
    /**
     * fonction de concatenation de fichiers PDF en un seul fichier
     */

    public function ConcatPdf($racine,$pv){

        if(PHP_OS=="Linux"){
            $cheminDossier=storage_path().'/app/public/'.$racine;
            $pathdir = $cheminDossier.'/';
        }else{
            $racineRenommer= str_replace ("/" ,"\\", $racine);
            $cheminDossier=storage_path().'\\app\public\\'.$racineRenommer;
            $pathdir = $cheminDossier.'\\';
        }


        $merger = \PDFMerger::init();
        
        $merger->addPathToPDF($pathdir.'certicatNat.pdf', 'all','P');
        $merger->addPathToPDF($pathdir.'releveNote.pdf', 'all','P');
        $merger->addPathToPDF($pathdir.'certifScolaire.pdf', 'all','P');
        $merger->addPathToPDF($pathdir.'extraitNaiss.pdf', 'all','P');
        $merger->addPathToPDF($pathdir.'forRensCertifie.pdf', 'all','P');
        $merger->addPathToPDF($pathdir.'bulPere.pdf', 'all','P');
        $merger->addPathToPDF($pathdir.'bulMere.pdf', 'all','P');

        if(file_exists($pathdir.'certifDecesPere.pdf')){
            $merger->addPathToPDF($pathdir.'certifDecesPere.pdf', 'all','P');
        }

        if(file_exists($pathdir.'certifDecesMere.pdf')){
            $merger->addPathToPDF($pathdir.'certifDecesMere.pdf', 'all','P');
        }

        if(file_exists($pathdir.'certifHandi.pdf')){
            $merger->addPathToPDF($pathdir.'certifHandi.pdf', 'all','P');
        }

        $merger->merge();
        $merger->save($pathdir.$pv.'.pdf');

    }


    public function dateToInteger($date){
        $date = ($date instanceof \DateTime)?$date:new \DateTime($date);
        return $date->getTimestamp();
    }

    public function integerToDate($integer){
        $date = new DateTime();
        return $date->setTimestamp($integer)->format('d-m-Y');
    }

    public function genererNom($length = 10, $bChLower = true, $bChUpper = true, $bChNumber = true, $bChEscape = false,
    $bChSimpleSpecial = false, $bChExtSpecial = false, $bChHigh = false)
{
    $chars = array(
        'escape' => array('min' => 0, 'max' => 31),
        'simpleSpecial' => array('min' => 32, 'max' => 47),
        'number' => array('min' => 48, 'max' => 57),
        'extSpecial1' => array('min' => 58, 'max' => 64),
        'upper' => array('min' => 65, 'max' => 90),
        'extSpecial2' => array('min' => 91, 'max' => 96),
        'lower' => array('min' => 97, 'max' => 122),
        'extSpecial3' => array('min' => 123, 'max' => 126),
        'high' => array('min' => 127, 'max' => 255),
    );

    $charsForThisPassword = array(); 
    if($bChLower) $charsForThisPassword[] = $chars['lower'];
    if($bChUpper) $charsForThisPassword[] = $chars['upper'];
    if($bChEscape) $charsForThisPassword[] = $chars['escape'];
    if($bChSimpleSpecial) $charsForThisPassword[] = $chars['simpleSpecial'];
    if($bChHigh) $charsForThisPassword[] = $chars['high'];
    if($bChNumber) $charsForThisPassword[] = $chars['number'];
    if($bChExtSpecial)
    {
        $charsForThisPassword[] = $chars['extSpecial1'];
        $charsForThisPassword[] = $chars['extSpecial2'];
        $charsForThisPassword[] = $chars['extSpecial3'];
    }

    $password = '';
    for ($i = 0; $i < $length; $i++)
    {
        $alt = mt_rand(0, count($charsForThisPassword)-1);
        $password .= chr(mt_rand($charsForThisPassword[$alt]['min'], $charsForThisPassword[$alt]['max']));
    }
    return $password;
}

public function recupLastNum(){
    //$lastNum=Participant::orderBy('numero','desc')->first();
    $lastNum=DB::select('SELECT max("numero") FROM demandes');
    return $lastNum[0]->max;
}

public function mettreNumero($id,$numero){
    $demande = Demande::find($id);
    if($demande->numero==NULL){
        $demande->numero=$numero;
        $demande->save();

        return $demande->numero;
    }else{
        return $demande->numero;
    }
}

public function genererNumero($numOrdre){

    if($numOrdre<10){
        return '000'.$numOrdre;
    }else{
        if($numOrdre<100){
            return '00'.$numOrdre;
        }else{
            if($numOrdre<1000){
                return '0'.$numOrdre;
            }else{
                if($numOrdre<10000){
                    return $numOrdre;
                }else{
                    /* Retourner une valeur pour dire que le nombre est trop elevé */
                }
            }
        }
    }
}
}
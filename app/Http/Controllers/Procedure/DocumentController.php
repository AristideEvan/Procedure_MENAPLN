<?php

namespace App\Http\Controllers\Procedure;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\Procedure\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', ['documents' => $documents]);
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'libelle' => 'required',
            'type_fichier' => 'nullable',
            'description' => 'required',
        ]);

        // Création d'un nouveau document
        Document::create($request->all());

        return redirect()->route('documents.index')->with('success', 'Document ajouté avec succès');
    }

    public function edit($id)
    {
        $document = Document::find($id);
        return view('documents.edit', ['document' => $document]);
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $request->validate([
            'libelle' => 'required',
            'type_fichier' => 'nullable',
            'description' => 'required',
        ]);

        // Mise à jour du document existant
        $document = Document::find($id);
        $document->update($request->all());

        return redirect()->route('documents.index')->with('success', 'Document mis à jour avec succès');
    }

    public function destroy($id)
    {
        // Suppression du document
        Document::destroy($id);

        return redirect()->route('documents.index')->with('success', 'Document supprimé avec succès');
    }
}

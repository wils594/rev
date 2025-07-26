<?php

namespace App\Http\Controllers;

use App\Models\Femme;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class FemmeController extends Controller
{
    /**
     * Affiche la page de création d’une femme.
     */
    public function create()
    {
        return view('femmes.create');
    }

    /**
     * Affiche la liste des femmes enregistrées.
     */
    public function index()
    {
        $femmes = Femme::all();
        return view('femmes.index', compact('femmes'));
    }

    /**
     * Affiche la fiche d’une femme spécifique (vue admin avec actions).
     */
    public function show($id)
    {
        $femme = Femme::findOrFail($id);
        return view('femmes.show', compact('femme'));
    }

    /**
     * Affiche la fiche publique (vue lecture seule pour QR code).
     */
    public function fichePublique($id)
    {
        $femme = Femme::findOrFail($id);
        return view('femmes.fiche_publique', compact('femme'));
    }

    /**
     * Enregistre une nouvelle femme avec QR code et photo.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'activite' => 'required|string|max:255',
            'sexe' => 'required|string|in:femme',
            'telephone' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $filename = $request->file('photo')->store('photos', 'public');
            $data['photo'] = basename($filename);
        }

        $femme = Femme::create($data);

        // Générer le QR code pointant vers la fiche publique
        $this->generateQrCode($femme);

        return view('qr.affichage', [
            'simple' => Storage::disk('public')->get($femme->qr_code_path),
            'femme' => $femme,
        ]);
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit($id)
    {
        $femme = Femme::findOrFail($id);
        return view('femmes.edit', compact('femme'));
    }

    /**
     * Met à jour les données d’une femme.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'activite' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'sexe' => 'required|string|in:femme',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $femme = Femme::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($femme->photo && Storage::disk('public')->exists('photos/' . $femme->photo)) {
                Storage::disk('public')->delete('photos/' . $femme->photo);
            }

            $filename = $request->file('photo')->store('photos', 'public');
            $data['photo'] = basename($filename);
        }

        $femme->update($data);

        return redirect()->route('femmes.show', $femme->id)->with('success', 'Informations mises à jour.');
    }

    /**
     * Supprime une femme et ses fichiers.
     */
    public function destroy($id)
    {
        $femme = Femme::findOrFail($id);

        if ($femme->photo && Storage::disk('public')->exists('photos/' . $femme->photo)) {
            Storage::disk('public')->delete('photos/' . $femme->photo);
        }

        if ($femme->qr_code_path && Storage::disk('public')->exists($femme->qr_code_path)) {
            Storage::disk('public')->delete($femme->qr_code_path);
        }

        $femme->delete();

        return redirect()->route('femmes.index')->with('success', 'Femme supprimée avec succès.');
    }

    /**
     * Marque une femme comme "à jour" dans le paiement.
     */
    public function updatePaiement($id)
    {
        $femme = Femme::findOrFail($id);
        $femme->statut_paiement = 'à jour';
        $femme->save();

        return redirect()->route('femmes.show', $id)->with('success', 'Paiement mis à jour.');
    }

    /**
     * Formulaire de paiement.
     */
    public function showPaiementForm($id)
    {
        $femme = Femme::findOrFail($id);
        return view('femmes.paiement', compact('femme'));
    }

    /**
     * Régénère le QR code (ex: si domaine changé).
     */
    public function regenerateQr($id)
    {
        $femme = Femme::findOrFail($id);

        if ($femme->qr_code_path && Storage::disk('public')->exists($femme->qr_code_path)) {
            Storage::disk('public')->delete($femme->qr_code_path);
        }

        $this->generateQrCode($femme);

        return redirect()->route('femmes.show', $femme->id)->with('success', 'QR code régénéré.');
    }

    /**
     * Régénère tous les QR codes existants (utile si domaine ou route changée).
     */
    public function regenerateAllQrCodes()
    {
        $femmes = Femme::all();

        foreach ($femmes as $femme) {
            $this->generateQrCode($femme);
        }

        return redirect()->route('femmes.index')->with('success', 'Tous les QR codes ont été régénérés.');
    }

    /**
     * Génère et enregistre un QR code SVG dans le dossier public,
     * pointant vers la fiche publique avec IP locale fixe.
     */
    private function generateQrCode(Femme $femme)
    {
        $ip = '192.168.0.245';  // Remplace par ton IP locale
        $port = 8000;           // Le port utilisé avec php artisan serve

        $url = "http://{$ip}:{$port}/femmes/fiche-publique/{$femme->id}";
        $qrSvg = QrCode::format('svg')->size(200)->generate($url);

        $path = 'qrcodes/femme_' . $femme->id . '.svg';
        Storage::disk('public')->put($path, $qrSvg);

        $femme->qr_code_path = $path;
        $femme->save();
    }
}

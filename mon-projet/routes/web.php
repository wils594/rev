<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRcodeGenerateController;
use App\Http\Controllers\FemmeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [QRcodeGenerateController::class, 'qrcode'])->name('accueil');

// Routes Femmes (CRUD complet)
Route::resource('femmes', FemmeController::class);

// Route GET pour afficher un formulaire ou une page de paiement
Route::get('/femmes/{id}/paiement', [FemmeController::class, 'showPaiementForm'])->name('femmes.paiement.get');

// Route POST pour mettre à jour le paiement
Route::post('/femmes/{id}/paiement', [FemmeController::class, 'updatePaiement'])->name('femmes.paiement');

// Route pour régénérer le QR code
Route::post('/femmes/{id}/regenqr', [FemmeController::class, 'regenerateQr'])->name('femmes.regenqr');
Route::get('/femmes/{id}/fiche', [FemmeController::class, 'fichePublique'])->name('femmes.fiche.publique');

Route::get('/admin/regenerate-qr-codes', [FemmeController::class, 'regenerateAllQrCodes'])->name('admin.regenerateQRCodes');

Route::get('/femmes/{id}/fiche-publique', [FemmeController::class, 'fichePublique'])->name('femmes.fiche_publique');

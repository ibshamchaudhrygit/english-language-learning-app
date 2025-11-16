<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display a listing of the user's certificates.
     * Spec 5.C
     */
    public function index()
    {
        $certificates = Certificate::where('user_id', Auth::id())
                                    ->with('lesson')
                                    ->orderBy('issued_at', 'desc')
                                    ->get();

        return view('certificates.index', [
            'certificates' => $certificates
        ]);
    }

    /**
     * Show a specific certificate.
     */
    public function show(Certificate $certificate)
    {
        // Ensure user can only view their own certificate
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        return view('certificates.show', [
            'certificate' => $certificate
        ]);
    }
}
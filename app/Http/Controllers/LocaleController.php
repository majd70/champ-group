<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Persist the chosen locale in the session and redirect back.
     * Ignores any locale not registered in config/app.php available_locales.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $available = array_keys(config('app.available_locales', []));

        if (in_array($locale, $available, true)) {
            $request->session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}

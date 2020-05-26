<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;

class HomeController extends Controller
{

    public function index(ImageRepository $repository)
    {
        $images = $repository->getAllImages ();

        return view ('home', compact ('images'));
    }


  
    public function language(String $locale)
    {
        $locale = in_array ($locale, config ('app.locales')) ? $locale : config ('app.fallback_locale');

        session (['locale' => $locale]);

        return back ();
    }
}

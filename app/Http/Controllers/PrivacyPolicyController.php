<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

class PrivacyPolicyController extends Controller
{

    public function show(Request $request)
    {
        return Inertia::render('PrivacyPolicy', [
            'policy' => view('privacy-policy')->render(),
        ]);
    }

}

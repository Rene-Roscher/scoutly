<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

class ImprintController extends Controller
{

    public function show(Request $request)
    {
        $policyFile = Jetstream::localizedMarkdownPath('imprint.md');

        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        return Inertia::render('Imprint', [
            'imprint' => (new CommonMarkConverter([], $environment))->convertToHtml(file_get_contents($policyFile)),
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TraefikConfigController extends Controller
{
    public function __invoke(Request $request)
    {
        $exampleFile = resource_path('library/traefik/Traefik.example.yml');
        $filePath = storage_path('app/sidecar/Traefik.yml');

        if (! File::exists($filePath)) {
            File::put($filePath, $exampleFile);
        }

        return File::get($filePath);
    }
}

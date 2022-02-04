<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageViewerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $imageName
     * @return Response
     * @throws FileNotFoundException
     */
    public function __invoke($imageName): Response
    {
        $noImagePath = public_path('noImage.jpg');
        $contents = file_get_contents($noImagePath);

        if(Storage::disk('products')->exists($imageName)) {
            $contents = Storage::disk('products')->get($imageName);
            return response($contents)->header('Content-type','image/png');
        }

        return response($contents)->header('Content-type','image/png');
    }
}

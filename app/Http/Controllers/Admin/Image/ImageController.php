<?php

namespace App\Http\Controllers\Admin\Image;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Zxing\QrReader;
use thiagoalessio\TesseractOCR\TesseractOCR;




class ImageController extends Controller
{
    public function image(Request $request)
    {
        $imageFile = $request->image;
        if (isset($imageFile)) {
//            $contentFile = file_get_contents($imageFile);

            $dir = 'admin-assets'.DIRECTORY_SEPARATOR.'images'.random_int(1,11111111).'.jpg';
            $sImage = Image::make($imageFile)->save($dir, 100, 'jpg');

//           $arrayColor = $sImage->pickColor(700, 1000, 'hex');

            $ocr = new TesseractOCR();
            $ocr->image($dir);
            $ocr->run();
            dd($ocr);
            $qrcode = new QrReader($imageFile);
            $text = $qrcode->text();

            $palette = new \BrianMcdo\ImagePalette\ImagePalette(public_path($dir));
//            $colors = $palette->getColors(5 ); // array of Color objects

            $par=array([$arrayColor,$text]);
            return back()->with('msg', $par);


        } else {
            return back()->with('toast-error', 'تصویری انتخاب نشده است.');
        }

    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class NftController extends Controller
{
    public function upload_nft_image(Request $request)
    {
        $image = $request->image; // This will be base64 string
        $folder = $request->folder;
        $base64_str = substr($image, strpos($image, ",") + 1);
        $decoded = base64_decode($base64_str);
        $imageName = $request->token . '.png';
        $path = "/upload/nft/$folder/";
        $destinationPath = public_path($path);
        file_put_contents($destinationPath . '/' . $imageName, $decoded);
        $imageUrl = asset($path . $imageName);

        return response()->json(['url' => $imageUrl]);
    }

    public function create_json_nft(Request $request)
    {
        $json = $request->json;
        $token = $request->token;
        $folder = $request->folder;
        $filename = $token . '.json';
        $path = public_path("upload/nft/$folder/" . $filename);
        $url = URL::to("upload/nft/$folder/" . $filename);
        $jsonString = json_encode($json);
        file_put_contents($path, $jsonString);
        return $url;
    }
    public function store(Request $request)
    {
        $nft = Nft::create([
            "user_id" => $request->id,
            "type" => $request->type,
            "token" => $request->token,
            "url" => $request->url,
            "hash" => $request->hash ?? '',
        ]);
        return response()->json($nft);
    }
}

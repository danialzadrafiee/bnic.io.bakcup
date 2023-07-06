<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SignCert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    public function getUserJsonByEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return response()->json($user);
    }

    public function getUserJson(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        return response()->json($user);
    }

    public function getUserCategoriesJson(Request $request)
    {
        // return $request;
        $categrories = User::where('id', $request->user_id)->first()->categories()->get();
        return response()->json($categrories);
    }
    public function getUserSubCategoriesJson(Request $request)
    {
        $sub_categories = Category::where('id', $request->category_id)->first()->subCats()->get();
        return response()->json($sub_categories);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->update($request->all());
        $user->save();
        return response()->json($user);
    }



    public function update_publicity(Request $request)
    {
        $user = User::find($request->id);
        $columns = Schema::getColumnListing($user->getTable());
        foreach ($columns as $column) {
            if (Str::startsWith($column, 'i_pub_')) {
                $user->{$column} = $request->has($column) && $request->input($column) == 1 ? 1 : 0;
            }
        }
        $user->save();
        return response()->json($user);
    }
    public function upload(Request $request)
    {
        $location = 'profile';

        $request->location != null ?  $location = $request->location : $location = 'profile';

        if ($request->hasFile('image')) {
            $imageData = $request->file('image');
            $filename = $request->filename . '.png';
            $uploadPath = public_path("upload/nft/$location/");
            if ($imageData->move($uploadPath, $filename)) {
                $imageUrl = URL::to("/upload/nft/$location/" . $filename);
                return response()->json($imageUrl);
            }
        }
        return response()->json('Upload failed. No image file received or an error occurred.', 400);
    }

    public function upload_banner(Request $request)
    {

        if ($request->hasFile('image')) {
            $imageData = $request->file('image');
            $filename = Str::random(40) . '.png';
            $uploadPath = public_path("upload/documents/banners/");
            if ($imageData->move($uploadPath, $filename)) {
                $imageUrl = URL::to("/upload/documents/banners/" . $filename);
                return response()->json($imageUrl);
            }
        }
        return response()->json('Upload failed. No image file received or an error occurred.', 400);
    }


    public function uploadJson(Request $request)
    {
        $jsonData = $request->json;
        $filename = $request->filename . '.json';
        $location = $request->location ?? 'certificates';
        $uploadPath = public_path("upload/nft/$location/$filename");
        File::put($uploadPath, json_encode($jsonData));
        $uploadUrl = URL::to("upload/nft/$location/$filename");
        return  response()->json($uploadUrl);
    }


    public function public_dashboard($id)
    {
        $user = User::where('id', $id)->first();
        return view('dashboard.index', compact('user'));
    }

    public function public_invidual_dashboard($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->user_type == 'invidual') {
            return view('invidual.dashboard', compact('user'));
        }
        if ($user->user_type == 'corporation') {
            $corporation = $user;
            return view('corporation.dashboard', compact('corporation'));
        }
    }

    public function public_corporation_dashboard($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->user_type == 'corporation') {
            return view('corporation.dashboard', compact('user'));
        }
        if ($user->user_type == 'corporation') {
            $corporation = $user;
            return view('corporation.dashboard', compact('corporation'));
        }
    }


    public function get_certificate(Request $request)
    {
        $cert = SignCert::find($request->cert_id);
        return $cert;
    }
    public function get_certificates(Request $request)
    {
        $user = User::find($request->id);
        $im_reciver = SignCert::where('reciver', $user->email)->get();
        $im_creator = SignCert::where('corporation_id', $user->id)->get();
        $im_requester = SignCert::where('user_id', $user->id)->get();
        $certificates = (object)[];
        $certificates->reciver = $im_reciver;
        $certificates->creator = $im_creator;
        $certificates->requester = $im_requester;
        return $certificates;
    }



    public function add_category_to_user(Request $request)
    {

        $user = User::where('id', $request->user_id)->first();
        $category = $user->categories()->create($request->all());
        return $category;
    }

    public function update_certificate(Request $request)
    {
        $cert = SignCert::where('id', $request->cert_id)->first();
        if ($cert === null) {
            return response()->json([
                'error' => 'No matching certificate found'
            ], 404);
        }
        $columns = Schema::getColumnListing($cert->getTable());
        $updateArray = array_intersect_key($request->all(), array_flip($columns));
        $cert->update($updateArray);

        return $cert;
    }

    public function delete_category(Request $request)
    {
        $category = Category::where('id', $request->category_id)->first();
        $category->delete();
        $certs = SignCert::where('category_id', $request->category_id);
        $certs->update([
            'category_id' => 0
        ]);
        return true;
    }

    public function trust_user(Request $request)
    {
        $truster = User::find($request->truster_id);
        $trusted =  User::find($request->trusted_id);
        $truster->trusteds()->attach($trusted->id);
        return redirect()->back();
    }
    public function untrust_user(Request $request)
    {
        $truster = User::find($request->truster_id);
        $trusted =  User::find($request->trusted_id);
        $truster->trusteds()->detach($trusted->id);
        return redirect()->back();
    }

    public function search_corporation(Request $request)
    {
        $search = $request->get('term');
        $corporations = User::where('user_type', 'corporation')
            ->where(function ($query) use ($search) {
                $query->where('corp_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            })
            ->get();
        return response()->json($corporations);
    }
}

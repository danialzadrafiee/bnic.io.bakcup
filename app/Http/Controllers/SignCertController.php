<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSignCertRequest;
use App\Http\Requests\UpdateSignCertRequest;
use App\Models\SignCert;
use Auth;
use Illuminate\Http\Request;

class SignCertController extends Controller
{

    public function verify(Request $request)
    {

        $cert = SignCert::where('id', $request->id)->first();
        if ($request->watcher_mod == 'reciver') {
            $cert->update([
                'reciver_verify' => 1
            ]);
        }
        if ($request->watcher_mod == 'creator') {
            $cert->update([
                'creator_verify' => 1
            ]);
        }
        return redirect()->route('cert.pub_show', ['id' => $request->id, 'success' => 'Certificate has been verified']);
    }
    public function sign(Request $request)
    {


        $validation = $request->validate([
            'document_id' => 'required|integer',
            'corporation_id' => 'required|integer',
            'data' => 'required|string',
            'reciver' => 'string',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'ad_email' => 'nullable|array',
            'ad_role' => 'nullable|array',
            'ad_describe' => 'nullable|array',
        ]);


        $cert = Auth::user()->signcerts()->create([
            'document_id' => $request->input('document_id'),
            'corporation_id' => $request->input('corporation_id'),
            'data' => $request->input('data'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
            'reciver' => $request->input('reciver'),
            'ad_email' => json_encode($request->input('ad_email')),
            'ad_role' => json_encode($request->input('ad_role')),
            'ad_describe' => json_encode($request->input('ad_describe')),
        ]);

        return redirect()->route('cert.show', ['id' => $cert->id, 'success' => 'Certificate has been signed']);
    }

    public function show(Request $request)
    {

        $cert = SignCert::where('id', $request->id)->first();

        $watcher = auth()->user();
        if ($watcher->id == $cert->corporation_id) {
            $watcher_rule = "creator";
        } elseif ($watcher->email == $cert->reciver) {
            $watcher_rule = "reciver";
        } elseif ($watcher->id == $cert->user_id) {
            $watcher_rule = "requester";
        } else {
            $watcher_rule = "stranger";
        }


        $success = $request->success;
        // if ($success == true) {
            return view('cert.show', compact('cert', 'success', 'watcher_rule'));
        // }
        // return view('cert.show', compact('cert'));
    }

    public function pub_show(Request $request)
    {
        $mode = "public";
        $watcher = auth()->user();

        $cert = SignCert::where('id', $request->id)->first();

        if ($watcher->id == $cert->corporation_id) {
            $watcher_rule = "creator";
        } elseif ($watcher->email == $cert->reciver) {
            $watcher_rule = "reciver";
        } elseif ($watcher->id == $cert->user_id) {
            $watcher_rule = "requester";
        } else {
            $watcher_rule = "stranger";
        }


        return view('cert.show', compact('cert', 'mode', 'watcher', 'watcher_rule'));
    }

    public function list($user_id, $category_id)
    {
        $categories = SignCert::where('user_id', $user_id);
        if ($category_id != 0) {
            $categories->where('category_id', $category_id);
        }
        return $categories->get();
    }
}

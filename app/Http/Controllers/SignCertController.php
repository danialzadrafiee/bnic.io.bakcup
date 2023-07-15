<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSignCertRequest;
use App\Http\Requests\UpdateSignCertRequest;
use App\Models\SignCert;
use App\Models\User;
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

        $fullname = auth()->user()->user_type == 'invidual' ? auth()->user()->first_name . ' ' . auth()->user()->last_name : auth()->user()->corp_name;

        $controller = app()->make(MailController::class);



        $data1 = [
            "type" => 'cert_is_signed',
            'url' => route('cert.show', ['id' => $cert->id]),
            "sender_full_name" => $fullname,
            'reciver_email' => $request->reciver
        ];

        $data2 = [
            "type" => 'cert_is_signed',
            'url' => route('cert.show', ['id' => $cert->id]),
            "sender_full_name" => $fullname,
            'reciver_email' => User::find($request->corporation_id)->email,
        ];


        $data3 = [
            "type" => 'cert_is_signed',
            'url' => route('cert.show', ['id' => $cert->id]),
            "sender_full_name" => $fullname,
            'reciver_email' => Auth::user()->email
        ];

        $controller->send_other_mails($data1);
        $controller->send_other_mails($data2);
        $controller->send_other_mails($data3);




        return redirect()->route('cert.show', ['id' => $cert->id, 'success' => 'Certificate has been signed']);
    }

    public function show(Request $request)
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
        $success = $request->success;
        return view('cert.show', compact('cert', 'mode', 'watcher', 'watcher_rule', 'success'));
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
        $success = $request->success;
        return view('cert.show', compact('cert', 'mode', 'watcher', 'watcher_rule', 'success'));
    }

    public function list($user_id, $category_id)
    {
        $categories = SignCert::where('user_id', $user_id);
        if ($category_id != 0) {
            $categories->where('category_id', $category_id);
        }
        return $categories->get();
    }
    public function category_update(Request $request)
    {
        SignCert::where('id', $request->certificate_id)->update([
            "category_id" => $request->category_id,
            "sub_cat_id" => $request->sub_cat_id,
        ]);
        return redirect()->back()->with('success', 'certificate updated');
    }

    public function attach_document(Request $request)
    {
        return SignCert::where('id', $request->certificate_id)->update([
            "attachment" => $request->attachment,
        ]);
    }


    public function attach_read(Request $request)
    {

        return SignCert::find($request->certificate_id);
    }
}

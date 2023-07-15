<?php

namespace App\Http\Controllers;

use App\Models\Corporation;
use App\Models\Document;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function create(Request $request)
    {
        $modal_users = User::where('user_type', 'invidual')->get();
        $user = Auth::user();
        return view('document.create', compact('modal_users'));
    }
    public function show(Request $request)
    {
        $modal_users = User::where('user_type', 'invidual')->get();
        $document = Document::find($request->document);
        return view('document.show', compact('document', 'modal_users'));
    }
    public function store(Request $request)
    {

        $user = Auth::user();
        $fullname = $user->user_type == 'invidual' ? $user->first_name . ' ' . $user->last_name : $user->corp_name;
        $document = Document::create([
            'corporation_id' => $user->id,
            'name' => $request->name ?? 'name',
            'reciver' => $request->reciver ?? '0',
            'description' => $request->description ?? 'describe',
            'group_id' => $request->group_id ?? '0',
            'image' => $request->image ?? 'https://api.dicebear.com/6.x/initials/svg?seed=' . Str::random(10),
            'content' => $request->content,
        ]);


        if ($request->reciver) {
            $controller = app()->make(MailController::class);
            $data = [
                "type" => 'hey_reciver_document_created',
                'url' => route('document.show', ['document' => $document->id]),
                "sender_full_name" => $fullname,
                'reciver_email' => $request->reciver
            ];
            $controller->send_other_mails($data);
        }


        return ($document);
    }
    public function sign(Request $request)
    {
        $document = new Document;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;




class WalletConnectController extends Controller
{



    // utill begin
    public function seed_cat($user)
    {
        $catTemp = [
            'user_id' => $user->id,
            'name' => 'temp-name',
            'icon' => 'temp-icon',
            'publicity' => 1,
        ];
        $categories = [
            ['name' => 'Travel', 'icon' => 'fa-plane']  + $catTemp,
            ['name' => 'Services', 'icon' => 'fa-umbrella-beach']  + $catTemp,
            ['name' => 'Education', 'icon' => 'fa-user-graduate']  + $catTemp,
            ['name' => 'Nationality', 'icon' => 'fa-passport']  + $catTemp,
            ['name' => 'Business', 'icon' => 'fa-chart-simple']  + $catTemp,
            ['name' => 'Financial', 'icon' => 'fa-building-columns']  + $catTemp,
            ['name' => 'Sports', 'icon' => 'fa-medal']  + $catTemp,
            ['name' => 'Medical', 'icon' => 'fa-file-medical']  + $catTemp,
            ['name' => 'Other', 'icon' => 'fa-border-all']  + $catTemp
        ];

        foreach ($categories as $category) {
            $category = $user->categories()->create($category);
        }
    }

    // utill end

    public function index()
    {
        return view('auth.index');
    }

    public function showRegistrationForm(Request $request)
    {

        $wallet_address = $request->wallet_address;
        $user = User::where('wallet', $wallet_address)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard.index');
        }

        return view('auth.register', ['wallet_address' => $wallet_address]);
    }


    public function showRegistrationForm_corp(Request $request)
    {
        $wallet_address = $request->wallet_address;
        $user = User::where('wallet', $wallet_address)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard.index');
        }

        return view('auth.register_corp', ['wallet_address' => $wallet_address]);
    }


    public function register(Request $request)
    {
        $data = $request->validate([
            'birthday' => 'required|date',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'country_primary' => 'required|string|max:2',
            'state_primary' => 'string|max:255',
            'country_secondary' => 'string|max:2',
            'state_secondary' => 'string|max:255',
            'gender' => 'required|string',
            'wallet' => 'required|string|max:255',
            'edu_country.*' => 'string|max:255',
            'edu_univercity.*' => 'required|string|max:255',
            'edu_field.*' => 'string|max:255',
            'edu_degree.*' => 'string|max:255',
            'profession.*' => 'required|string|max:255',
            'skill.*' => 'string|max:255',
            'language.*' => 'required|string|max:2',
            'cv' => 'nullable|string|max:5000',
            'website' => 'nullable|url',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
        ]);
        $data['user_type'] = 'invidual';
        $data['edu_country'] = json_encode($request->input('edu_country'));
        $data['edu_univercity'] = json_encode($request->input('edu_univercity'));
        $data['edu_field'] = json_encode($request->input('edu_field'));
        $data['edu_degree'] = json_encode($request->input('edu_degree'));
        $data['profession'] = json_encode($request->input('profession'));
        $data['skill'] = json_encode($request->input('skill'));
        $data['language'] = json_encode($request->input('language'));


        $user = User::create($data);
        $maxToken = DB::table('users')->max('token');
        $user->token = $maxToken ? $maxToken + 1 : 10000;
        $user->save();
        $this->seed_cat($user);

        auth()->login($user);

        return redirect()->route('dashboard.index');
    }

    public function register_corp(Request $request)
    {
        $data = $request->validate([
            'user_type' => 'required|string',
            'corp_name' => 'required|string|max:255',
            'corp_establishment' => 'nullable|string|max:255',
            'corp_cat_pri' => 'nullable|string|max:255',
            'corp_cat_sec' => 'nullable|string|max:255',
            'corp_type' => 'nullable|string|max:255',
            'corp_country_pri' => 'nullable|string|max:255',
            'corp_state_pri' => 'nullable|string|max:255',
            'corp_country_sec' => 'nullable|string|max:255',
            'corp_state_sec' => 'nullable|string|max:255',
            'corp_form' => 'nullable|string|max:255',
            'corp_link' => 'nullable|string|max:255',
            'corp_cv' => 'nullable|string|max:2500',
            'email' => 'required|email|unique:users',
            'wallet' => 'required|string|max:255',
            'website' => 'nullable|url',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
        ]);
        $data['user_type'] = 'corporation';
        $user = User::create($data);
        auth()->login($user);
        return redirect()->route('dashboard.index');
    }


    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email',
            'country_primary' => 'nullable|string',
            'state_primary' => 'nullable|string',
            'country_secondary' => 'nullable|string',
            'state_secondary' => 'nullable|string',
            'edu_country' => 'nullable|array',
            'edu_country.*' => 'nullable|string',
            'edu_univercity' => 'nullable|array',
            'edu_univercity.*' => 'nullable|string',
            'edu_field' => 'nullable|array',
            'edu_field.*' => 'nullable|string',
            'edu_degree' => 'nullable|array',
            'edu_degree.*' => 'nullable|string',
            'profession' => 'nullable|array',
            'profession.*' => 'nullable|string',
            'skill' => 'nullable|array',
            'skill.*' => 'nullable|string',
            'language' => 'nullable|array',
            'language.*' => 'nullable|string',
            'cv' => 'nullable|string',
            'website' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'youtube' => 'nullable|string',
            'telegram' => 'nullable|string',
        ]);
        $user = User::findOrFail($request->user_id);
        $user->update($validatedData);
        $user->save();

        return redirect()->route('dashboard.index')->with('success', 'User updated successfully.');
    }


    public function edit(Request $request)
    {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    public function update_user(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string',
            'country_primary' => 'nullable|string',
            'state_primary' => 'nullable|string',
            'country_secondary' => 'nullable|string',
            'state_secondary' => 'nullable|string',
            'edu_country' => 'nullable|array',
            'edu_country.*' => 'nullable|string',
            'edu_univercity' => 'nullable|array',
            'edu_univercity.*' => 'nullable|string',
            'edu_field' => 'nullable|array',
            'edu_field.*' => 'nullable|string',
            'edu_degree' => 'nullable|array',
            'edu_degree.*' => 'nullable|string',
            'profession' => 'nullable|array',
            'profession.*' => 'nullable|string',
            'skill' => 'nullable|array',
            'skill.*' => 'nullable|string',
            'language' => 'nullable|array',
            'language.*' => 'nullable|string',
            'cv' => 'nullable|string',
            'website' => 'nullable|string',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'youtube' => 'nullable|string',
            'telegram' => 'nullable|string',
        ]);

        $user = Auth::user();
        $columns = Schema::getColumnListing($user->getTable());
        $updateArray = array_intersect_key($request->all(), array_flip($columns));
        $user->update($updateArray);

        return view('dashboard.inbox');
    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('email');
        $users = User::where('email', 'LIKE', "%{$searchTerm}%")->get();

        return response()->json($users);
    }
    public function search_invidual(Request $request)
    {
        $searchTerm = $request->input('term');

        $users = User::where('user_type', 'invidual')
            ->where(function ($query) use ($searchTerm) {
                $query->where('email', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('first_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('last_name', 'LIKE', "%{$searchTerm}%");
            })
            ->get();

        return response()->json($users);
    }
}

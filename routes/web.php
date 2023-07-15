<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletConnectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SignCertController;
use App\Http\Middleware\CheckWalletConnection;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NftController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\BallotController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubCatController;

Route::get('/', [WalletConnectController::class, 'index'])->middleware([CheckWalletConnection::class])->name('index');
Route::get('/logout', [WalletConnectController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'walletconnect', 'middleware' => CheckWalletConnection::class], function () {
    Route::get('/', [WalletConnectController::class, 'index'])->name('walletconnect.index');
    Route::get('/register', [WalletConnectController::class, 'showRegistrationForm'])->name('walletconnect.showRegistrationForm');
    Route::get('/register/corporation', [WalletConnectController::class, 'showRegistrationForm_corp'])->name('walletconnect.showRegistrationForm_corp');
    Route::post('/register/corporation', [WalletConnectController::class, 'register_corp'])->name('walletconnect.register_corp');
    Route::post('/register', [WalletConnectController::class, 'register'])->name('walletconnect.register');
});

Route::group(['prefix' => 'walletconnect'], function () {
    Route::get('/edit', [WalletConnectController::class, 'edit'])->name('walletconnect.edit');
    Route::get('/update', [WalletConnectController::class, 'update'])->name('walletconnect.update');
    Route::post('/update_user', [WalletConnectController::class, 'update_user'])->name('walletconnect.update_user');
    Route::get('/search', [WalletConnectController::class, 'search'])->name('walletconnect.search');
    Route::any('/search_invidual', [WalletConnectController::class, 'search_invidual'])->name('walletconnect.search_invidual');
});

Route::post('/update', [WalletConnectController::class, 'update'])->name('walletconnect.update');
Route::group(['prefix' => 'dashboard', 'middleware' => Authenticate::class], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/public/{user_id}', [DashboardController::class, 'public_index'])->name('dashboard.public_index');
    Route::get('/setting', [DashboardController::class, 'setting'])->name('dashboard.setting');
    Route::get('/inbox', [DashboardController::class, 'inbox'])->name('dashboard.inbox');
});


//documents
Route::group(['prefix' => 'document'], function () {
    Route::post('/store', [DocumentController::class, 'store'])->name('document.store');
    Route::get('/create', [DocumentController::class, 'create'])->name('document.create');
    Route::get('/show', [DocumentController::class, 'show'])->name('document.show');
});

//certificates
Route::group(['prefix' => 'cert'], function () {
    Route::post('/sign', [SignCertController::class, 'sign'])->name('cert.sign');
    Route::get('/verify', [SignCertController::class, 'verify'])->name('cert.verify');
    Route::get('/show', [SignCertController::class, 'show'])->name('cert.show');
    Route::get('/pub_show', [SignCertController::class, 'pub_show'])->name('cert.pub_show');
    Route::get('/list/user/{user_id}/category/{category_id}', [SignCertController::class, 'list'])->name('cert.list'); //can be pv usin auth->user
    Route::any('/category/update/', [SignCertController::class, 'category_update'])->name('cert.category_update'); //can be pv usin auth->user
    Route::any('/attach_document', [SignCertController::class, 'attach_document'])->name('cert.attach_document'); //can be pv usin auth->user
    Route::any('/attach_read', [SignCertController::class, 'attach_read'])->name('cert.attach_read'); //can be pv usin auth->user
});

//documents
Route::group(['prefix' => 'action'], function () {
    Route::any('/search_invi_by_name', [ActionController::class, 'search_invi_by_name'])->name('actions.search_invi_by_name');
    Route::any('/search_corp_by_name', [ActionController::class, 'search_corp_by_name'])->name('actions.search_corp_by_name');
});


Route::group(['prefix' => 'category'], function () {
    Route::any('/', [CategoryController::class, 'index'])->name('category.index');
    Route::any('/select', [CategoryController::class, 'select'])->name('category.select');
});


Route::group(['prefix' => 'sub_cat'], function () {
    Route::any('/select/{sub_cat_id}', [SubCatController::class, 'select'])->name('sub_cat.select');
});


Route::group(['prefix' => 'nft'], function () {
    Route::post('/create_json_nft', [NftController::class, 'create_json_nft'])->name('nft.create_json_nft');
    Route::post('/store', [NftController::class, 'store'])->name('nft.store');
    Route::post('/upload_nft_image', [NftController::class, 'upload_nft_image'])->name('nft.upload_nft_image');
});


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('inbox', [DashboardController::class, 'inbox'])->name('dashboard.inbox');
});


Route::group(['prefix' => 'event'], function () {
    Route::get('/index', [EventController::class, 'index'])->name('event.index');
    Route::get('/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/show', [EventController::class, 'show'])->name('event.show');
});


//ballot routes
Route::get('/ballots', [BallotController::class, 'index'])->name('ballots.index');
Route::get('/ballots/create', [BallotController::class, 'create'])->name('ballots.create');
Route::get('/ballots/{ballot}', [BallotController::class, 'show'])->name('ballots.show');
Route::get('/ballots/{ballot}/votes', [BallotController::class, 'getVotes'])->name('votes.get_votes');
Route::post('/ballots', [BallotController::class, 'store'])->name('ballots.store');
Route::delete('/ballots/{ballot}', [BallotController::class, 'destroy'])->name('ballots.destroy');


//vote routes
Route::post('/ballots/{ballot}/votes', [VoteController::class, 'store'])->name('votes.store');
Route::post('/options', [OptionController::class, 'store'])->name('options.store');
Route::put('/options/{option}', [OptionController::class, 'update'])->name('options.update');
Route::delete('/options/{option}', [OptionController::class, 'destroy'])->name('options.destroy');
Route::post('/votes', [VoteController::class, 'store'])->name('vote.store');


//petition
Route::get('/petitions', [PetitionController::class, 'index'])->name('petitions.index');
Route::get('/petitions/create', [PetitionController::class, 'create'])->name('petitions.create');
Route::post('/petitions', [PetitionController::class, 'store'])->name('petitions.store');
Route::get('/petitions/{petition}', [PetitionController::class, 'show'])->name('petitions.show');
Route::post('/petitions/{petition}/sign', [PetitionController::class, 'sign'])->name('petitions.sign');
Route::delete('/petitions/{petition}', [PetitionController::class, 'destroy'])->name('petitions.destroy');



Route::get('/mail', function () {
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'mail.developerpie.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '_mainaccount@developerpie.com';
        $mail->Password   = 'WTFIS0124WTFIS0124';
        $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;
        $mail->Port       = 587;
        $mail->setFrom('develop1@developerpie.com', 'Develop1');
        $mail->addAddress('subdanial@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'Hello';
        $mail->Body    = view('emails.test');
        $mail->send();
        echo 'Message has been sent';
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
});

Route::post("/mail/invite", [MailController::class, "send_invite_mail"])->name('mail.send_invite_mail');
Route::get('/x', function () {
    return  "<a href='http://localhost:8000/x?email=" . request()->get('email') . "'>" . base64_encode(request()->get('email')) . "</a>";
});
Route::any('/git', function () {
    $output = shell_exec('cd /var/www/bnic.io');
    echo "<pre>$output</pre>";
});

Route::any("/admin", [AdminController::class, "index"])->name('admin.index');
Route::any("/admin/userUpdate", [AdminController::class, "userUpdate"])->name('admin.userUpdate');



Route::any('/e1', function () {
    return view('emails.invite');
});
Route::any('/e2', function () {
    return view('emails.hey_reciver_document_created');
});

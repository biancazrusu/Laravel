<?php
use App\Helpers\EmailToSend;
use App\Helpers\PDFHelper;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\EstimateController;
use App\Http\Controllers\UserController;
use App\User;
use App\Helpers\RequestCountries;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('visual', function () {
//     // return URL::to('/');
//     return App::getLocale();
//     return view('backend.pages.visual');
// });

Route::get('api-test', function () {
    return view('frontend.pages.api-test');
});

Route::get('/admin/login', function () {
    if (Auth::check() && Auth::user()->isAdmin()) {
        return redirect()->intended(URL::route('admin.index'));
    }
    return view('backend.pages.login');
})->name('admin.login');

Route::get('/admin/logout', function () {
    Auth::logout();
    return redirect()->intended(URL::route('admin.login'));
})->name('admin.logout');

Route::post('/admin/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');
    $user = User::where('name', $username)
                ->orWhere('email', $username)
                ->first();
    if( $user->confirmed == 1){
        if ($username && $password && Auth::attempt(['name' => $username, 'password' => $password])) {
            return redirect()->intended(URL::route('admin.index'));
        }else if($username && $password && Auth::attempt(['email' => $username, 'password' => $password])){
            return redirect()->intended(URL::route('admin.index'));
        }
    }else{
        \Session::flash('confirmedFirst', true);
        return redirect()->back();
    }
    return redirect()->back()->with('error', 'Invalid username or password');
})->name('admin.loginPost');

Route::resource('register', 'Auth\RegisterController');

Route::resource('map', 'MapController');

Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('backend.pages.users');
    })->name('admin.index');

    Route::resource('questions', 'QuestionController');
    Route::get('destroy/{id}', 'QuestionController@destroy')->name('question_destroy');
    Route::get('store', 'QuestionController@store')->name('questions_store');
    Route::get('/new-question', function () {
        return view('backend.pages.create_question');
    })->name('create_question');
    Route::get('delete', 'QuestionController@delete')->name('questions_delete');
    Route::resource('answers', 'AnswerController');
    Route::resource('estimates', 'EstimatesController');
    Route::get('estimates/{id}/estimateEdit/{questionId?}', 'EstimatesController@estimateEdit')
        ->name('estimate.estimateEdit');

    Route::resource('websites', 'WebsiteController');
});

Route::get('/', function (Request $request) {
    $countries = RequestCountries::getCountries();
    // dump($countries);
    $request->session()->put('countries', $countries);
    if (session()->has('name') || Auth::user()) {
        return view('frontend.pages.index');
    }
    return view('frontend.pages.index_nologin');
})->name('frontend_index');

Route::get('cities/{country}', function ($country) {
    $cities = RequestCountries::getCities($country);
    return $cities;
})->name('cities');

Route::get('/skip-intro', function(Request $request) {
    if(!Session::get('name'))
        session(['name' => 'Guest']);
    return redirect()->route('frontend_index');
})->name('frontend_skip_intro');

Route::post('/set-name', function (Request $request) {
    if (isset($request->name) && !empty($request->name)) {
        $name = $request->name;
        session(['name' => $name]);
    }
    return redirect()->route('frontend_index');
})->name('frontend_index_enter_name');

Route::get('/index-nologin', function () {
    return view('frontend.pages.index_nologin');
})->name('frontend_index_nologin');

Route::get('/blog', function () {
    return view('frontend.pages.blog');
})->name('blog');

Route::get('/about', function () {
    return view('frontend.pages.about');
})->name('about');

Route::get('/privacy-policy', function () {
    return view('frontend.pages.privacy_policy');
})->name('privacy_policy');

Route::get('confirm/{confirmationCode}', 'Auth\RegisterController@confirm'
)->name('confirmation_account');

Route::post('/login', function (Request $request) {
    $username = $request->input('email');
    $password = $request->input('password');
    $user = User::where(function ($query) use ($username) {
                $query->where('name', '=', $username)
                      ->orWhere('email', '=', $username); });
    if( $user->first() != null && $user->first()->confirmed == 1){
        if ($username && $password && Auth::attempt(['name' => $username, 'password' => $password])) {
            return redirect()->intended(URL::route('frontend_index'));
        }else if($username && $password && Auth::attempt(['email' => $username, 'password' => $password])){
            return redirect()->intended(URL::route('frontend_index'));
        }
    }else if( $user->first() != null ){
        \Session::flash('confirmedFirst', true);
    }

    \Session::flash('badLogin', true);
    \Session::flash('isNotLoggedIn', true);
    return redirect()->back();
})->name('loginPost');

Route::post('/forgot-password', function (Request $request) {
    $dataEmail['email']   = $request->input('reset-email');
    $dataEmail['subject'] = '[Lori] Forgot Password';
    if ( $dataEmail['email'] && User::where('email',  $dataEmail['email'])->first()) {
        $sendEmail = new EmailToSend();
        $sendEmail->sendEmail($dataEmail);
        return redirect()->intended(URL::route('frontend_index'));
    }
    \Session::flash('noUserWithEmail', true);
    \Session::flash('isNotLoggedIn', true);
    return redirect()->back();

})->name('forgotPassword');

Route::group(['middleware' => ['isLoggedIn', 'website.locale']], function () {

    Route::resource('users', 'UserController');

    Route::get('/history/estimate/{id}', function (Request $request) {
        $url        = $request->path();
        $url        = explode('/', $url);
        $estimateId = $url[2];
        $estimates  = PDFHelper::printAllIstoric($estimateId);

        if($estimates == '403'){
            return view('frontend.pages.error_page');
        }
        if ($estimateId != 0) {
            $estimate[0] = $estimates;
        } else {
            $estimate = $estimates;
        }
        PDFHelper::printPdf($estimate);
    })->name('estimate.history');

    Route::get('/history', function (Request $request) {
        $estimates = PDFHelper::printAllIstoric();
        return view('frontend.pages.estimates', ['estimates' => $estimates]);
    })->name('history');

});

Route::post('/changePassword', function (Request $request){
    $status = ForgotPasswordController::changePassword($request);
    $dataEmail['subject']          = '[Lori] Reset Password';
    $dataEmail['name']             = Auth::user()->name;
    $dataEmail['email']            = Auth::user()->email;
        switch ($status) {
            case 1:
                $sendEmail = new EmailToSend();
                $sendEmail->sendEmail($dataEmail);
                return redirect()->route('frontend_index');
                break;
            case 2:
                \Session::flash('passMatch', true);
                \Session::flash('error', true);
                return redirect()->back();
                break;
            case 3:
                \Session::flash('wrongOldPass', true);
                \Session::flash('error', true);
                return redirect()->back();
                break;
    }
})->name('changePassword');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->intended(URL::route('frontend_index'));
})->name('logout');

Route::group(['middleware' => ['isLoggedIn', 'website.locale']], function () {
    Route::get('estimates', 'Frontend\EstimateController@index')->name('calculate.index');
    Route::post('finalStep/estimate/{id}', 'Frontend\EstimateController@update')->name('calculate.finalStep');
    Route::get('estimateSucces', function () {
        return view('frontend.pages.estimate-succes');
    })->name('estimateSucces');
    Route::get('calculate/{estimate}', 'Frontend\EstimateController@show')->name('calculate.show');
    Route::get('calculate/{estimate}/final', 'Frontend\EstimateController@finalStep')->name('calculate.final');
    Route::get('calculate/{estimate}/get-proposal', 'Frontend\EstimateController@getProposal')->name('calculate.get_porposal');

    // Route::get('calculate/{estimate}/summary', function (Estimate $estimate) {
    //     return view('frontend.pages.estimate-summary', ['estimate' => $estimate]);
    // })->name('estimate.summary');

    // Route::get('calculate/{estimate}/get-proposal', function (Estimate $estimate) {
    //     return view('frontend.pages.estimate-proposal', ['estimate' => $estimate]);
    // })->name('estimate.proposal');
});

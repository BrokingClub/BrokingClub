<?php



/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends BaseController
{

    public function __construct()
    {
       /*$this->beforeFilter('auth', ['except' => 'create', 'store', 'login', 'doLogin', 'confirm',
                                        'forgotPassword', 'doForgotPassword']);*/
    }

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
       // return View::make(Config::get('confide::signup_form'));
        if (Confide::user()) {
            return Redirect::to('/')->withError('You are already logged in.');
        }

        $this->setTitle('Register');

        return $this->makeView('pages.lockscreen.register');
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            $newPlayer = new Player();
            $newPlayer->user_id = $user->id;
            $newPlayer->level = 1;
            $newPlayer->balance = 50000;
            $newPlayer->save();

            return Redirect::action('UsersController@login')
                ->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {
            $error = $user->errors()->all(':message');

            return Redirect::action('UsersController@create')
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function login()
    {

        if (Confide::user()) {
            return Redirect::to('/');
        } else {
            //return View::make(Config::get('confide::login_form'));
            return $this->makeView('pages.lockscreen.login');
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        $login = $repo->login($input);

        if ($login) {
            return Redirect::to('dashboard')->withMessage('You are now logged in.');
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UsersController@login')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::action('UsersController@doForgotPassword')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UsersController@resetPassword', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {
        Confide::logout();

        return Redirect::route('login')->withInfo('You are now logged out.');
    }


    public function edit(){

        $this->setTitle('Edit');

        $this->data['user'] = Confide::user();
        $this->data['player'] = $this->data['user']->player;

        return $this->makeView('pages.game.user.edit');
    }

    /**
     * Update the specified resource in storage.
     * PUT /users/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    public function changePassword(){

        $rules = array(
            'old_password'                  => 'required',
            'new_password'                  => 'required|confirmed|different:old_password',
            'new_password_confirmation'     => 'required|different:old_password|same:new_password'
        );

        $user = User::find(Auth::user()->id);
        $validator = Validator::make(Input::all(), $rules);

        //Is the input valid? new_password confirmed and meets requirements
        if ($validator->fails()) {
            Session::flash('validationErrors', $validator->messages());
            return Redirect::back()->withInput();
        }

        //Is the old password correct?
        if(!Hash::check(Input::get('old_password'), $user->password)){
            return Redirect::back()->withInput()->withError('Password is not correct.');
        }

        //Set new password to user
        $user->password = Input::get('new_password');
        $user->password_confirmation = Input::get('new_password_confirmation');

        $user->touch();
        $save = $user->save();

        return Redirect::to('logout')->withMessage('Password has been changed.');

    }

    public function delete($id){
        User::canEditOrFail($id);

        $this->setTitle('Delete your account');

        $this->data['user'] = User::find($id);

        return $this->makeView('pages.lockscreen.delete');
    }

    public function doDelete($id){
        User::canEditOrFail($id);


        $user = User::find(Confide::user()->id);

        Confide::logout();

        $user->delete();

        return Redirect::to('register')->withMessage('Your account was removed.');
    }

}

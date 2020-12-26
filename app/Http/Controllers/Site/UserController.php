<?php

namespace App\Http\Controllers\Site;

use App\Entity\DeliveryAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;
    private $user;
    private $deliveryAddress;
    public function __construct(User $user,DeliveryAddress $deliveryAddress)
    {
        $this->user = $user;
        $this->deliveryAddress = $deliveryAddress;
    }

    public function username()
    {
        return 'email';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function register()
    {
        return view('site.users.register');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        //
        return view('site.users.login');
    }
    public function loginPost(Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $url_redirect= session('url_redirect');
        // dd(session('url_redirect'));
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
       
        if(!empty($url_redirect)){
            return redirect()->intended($url_redirect);
        }else{
            $user_id = Auth::user()->id;
            $role = DB::table('role_user')->where('user_id',$user_id)->first();
            if ($role->role_id == 10) {
                return redirect()->route('admin.dashboard');

            }else{
            return redirect()->route('index');
            }
        }
        
    }
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function createUser(array $data)
    {
        return $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $this->validator($request->all())->validate();
        try {
            DB::beginTransaction();
            $user = $this->createUser($request->all());
            $data = [
                'user_id' => $user->id,
                'role_id' => 1,
            ];
            DB::table('role_user')->insert($data);
            DB::commit();
            return redirect()->route('users.register');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
    protected function loggedOut(Request $request)
    {
        //
    }

    public function saveDeliveryAddress(Request $request){
        try{
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $data['status'] = 0;
            $createAddress = DeliveryAddress::create($data);
            $address = $this->deliveryAddress->getDeliverAddressDetail($createAddress->id,$data['user_id']);
            $string_address = $address->name .'- '.$address->phone .'- '.  $address->address .'- '. $address->commune_name.'- '. $address->district_name.'- '. $address->province_name;
            $htmlAddress ='<div class="content-address row" >';
                $htmlAddress .='<div class="col-1 d-flex align-items-center justify-content-between">';
                $htmlAddress .='<div class="icheck-primary d-inline">';
                $htmlAddress .='<input type="radio" class="getDelivery"  delivery="'.$address->id.'"  id="radioPrimary'.$address->id.'" name="status" >';
                $htmlAddress .='<label for="radioPrimary'.$address->id.'">';
                $htmlAddress .='</label>';
                $htmlAddress .=' </div>';
                $htmlAddress .='</div>';
                $htmlAddress .='<div class="col-10 align-items-center col-10 d-flex justify-content-start">';
                   
                $htmlAddress .=$string_address;
                $htmlAddress .='</div>';
            $htmlAddress .='</div>';
            return response()->json([
                'status' => 200,
                'address' =>  $htmlAddress,
            ]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return [
                'status' => 500,
            ];
        }
       
    }
    public function updateDeliveryAddress(Request $request){
        $user_id = Auth::user()->id;
        $delivery_id = $request->delivery_id;
        
        $this->deliveryAddress->resetDeliveryAddresses($user_id);
        $this->deliveryAddress->updateDeliveryAddress($delivery_id,$user_id);
        $addressUpdated = $this->deliveryAddress->getDeliverAddressDetail($request->delivery_id,$user_id);
        return response()->json([
            'status' => '200',
            'data' => $addressUpdated,
        ]);
    }
}

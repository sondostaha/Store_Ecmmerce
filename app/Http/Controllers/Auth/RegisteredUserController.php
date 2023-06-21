<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Services\SMSServices;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\SMSGetways\VectoryLinkSms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Services\VerificationServices;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    protected $smsServices ;
    public function __construct(VerificationServices $smsServices)
    {
        $this->smsServices = $smsServices ;
    }
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // try 
        // {
            DB::beginTransaction();

            $verafication = [] ;

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'mobile' => ['required', 'numeric', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            // dd($request->all());
    
            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
            ]);
            
            $verafication['user_id'] = $user->id ;
            $veraficationcode =$this->smsServices->setVerificationCode($verafication);
            $message = $this->smsServices->getSMSVerifyMessageByAppName($veraficationcode->code);
            app(VectoryLinkSms::class)->sendSms($user->mobile ,$message);

            DB::commit();
            event(new Registered($user));
    
            Auth::login($user);
    
            return redirect(RouteServiceProvider::HOME);
        // }
        // catch(Exception $ex)
        // {
        //     DB::rollBack();

        //     return redirect()->back();
        // }

    }
}

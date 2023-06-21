<?php

namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyRequest;
use App\Http\Services\VerificationServices;
use Illuminate\Http\Request;

class VerificationCodeController extends Controller
{
    protected $verificationServices ;
    public function __construct(VerificationServices $verificationServices)
    {
        $this->verificationServices = $verificationServices ;
    }
    public function verifyPage()
    {
        return view('auth.verify-email');
    }
   public function verify(VerifyRequest $request)
   {
        $check = $this->verificationServices->checkOTPCode($request->code);

        if(!$check)
        {
            return redirect()->back()->with('code','your code verification is not correct');
        }
        $this->verificationServices->removeVerifyCode($request->code);
 
        return redirect()->route('home');
   }
}

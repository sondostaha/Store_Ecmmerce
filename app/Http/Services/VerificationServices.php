<?php
namespace App\Http\Services;

use App\Models\User;
use App\Models\UserVerificationCode;
use Illuminate\Support\Facades\Auth;

class VerificationServices
{
    public function setVerificationCode($data)
    {
        $code  = mt_rand(1000000,9999999);
        $data['code'] = $code ;
        UserVerificationCode::whereNotNull('user_id')->where('user_id',$data['user_id'])->delete();
        
        return UserVerificationCode::create($data);
    }
    public function getSMSVerifyMessageByAppName( $code)
    {
            $message = " is your verification code for your account";
             return $code.$message;
    }

    public function checkOTPCode($code)
    {
        if(Auth::guard()->check())
        {
            $verificationData = UserVerificationCode::where('user_id',Auth::id())->first();
            // dd($verificationData);
            if($verificationData->code == $code)
            {
                User::where('id',Auth::id())->update([
                    'email_verified_at' => now()
                ]);
                return true;
            }
            return false;

        }
        return false;

    }

    public function removeVerifyCode($code)
    {
        UserVerificationCode::where('code',$code)->delete();
    }
}
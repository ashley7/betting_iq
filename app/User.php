<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function sendEmail($to,$subject,$sms,$reply,$replyName,$customerName,$cc) {

        try {
            
            \Mail::send(['text'=>'layouts.mail'], ['email'=>$sms],

               function($message) use ($to,$subject,$reply,$replyName,$customerName,$cc) {

               $message->to($to, $customerName)
                       ->replyTo($reply,$replyName)
                       ->cc($cc)
                       ->subject($subject);

                $message->from(env("MAIL_FROM_ADDRESS"),env("APP_NAME"));

           });

        } catch (\Exception $e) {}

    }

}

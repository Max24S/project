<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','surname','patronymic','address','number','sex','role','birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.rr
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function  prepareFromCreate($user)

    {
        if($this->uniqueEmail($user['email']))
        {
            $user['password'] = bcrypt(Str::random(12));

            $dbUser = User::create($user);

            if($dbUser->role=='Ученик'){

                $student = ['user_id'=>$dbUser->id,'grade_id'=>$user['grade_id']];
                Student::create($student);
            }

            return ['response'=>'created'];
        }
        else {

            return ['response'=>'emailDuplicate'];
        }

    }

    public function uniqueEmail($email)
    {
        $check = User::where('email',$email)->first();

        if($check){

            return false;
        }

        return true;
    }
}

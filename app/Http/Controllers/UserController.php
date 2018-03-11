<?php

namespace App\Http\Controllers;

use App\User;
use App\Contracts\Notify;
use Illuminate\Http\Request;
use App\Contracts\SocialPostContract;
use App\Entities\UserTypeFactory;

class UserController extends Controller
{

    private $notify;
    private $social;

    public function __construct(Notify $notify, SocialPostContract $social)
    {
        $this->notify = $notify;
        $this->social = $social;
    }

    public function sendmail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->notify->send('Reminder!', 'emails.reminder', $user);
    }

    public function post(Request $request)
    {
        $this->social->post();
    }

    public function discount($type)
    {
        $customer = UserTypeFactory::make($type);
        echo $type."[discount]: ".$customer->discount();
    }

    public function bonus($type)
    {
        $customer = UserTypeFactory::make($type);
        echo $type."[bonus]: ".$customer->bonus();
    }
}

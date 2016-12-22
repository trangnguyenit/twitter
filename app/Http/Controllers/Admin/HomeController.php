<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Twitter;
use App\User;

use Illuminate\Http\Request;

/**
 * HomeController
 */
class HomeController extends Controller
{
    /**
     * home page
     *
     * @return  [type]
     */
    public function index()
    {
        //dd(Auth::check());
        if (Auth::check()) {
            $name = Auth::user()->name;
            return view('twitter', compact('name'));
        }
        return redirect('/admin/login');
    }

    public function getLogout() {
    
        Auth::guard($this->getGuard())->logout();
        // Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/admin/login');
    }

    public function twitt(Request $request) {
        
        if (Auth::check()) {
            if (isset($request['content']) && $request['content']) {
                $content = $request['content'];
                $user_id = Auth::user()->id;

                $twitter = new Twitter();
                $twitter->content = $content;
                $twitter->user_id = $user_id;

                $twitter->save();
                //return "OK";
                $twitt = Twitter::orderBy('id', 'desc')->take(1)->get()->toArray();
                foreach ($twitt as $key => $value) {
                    $user = User::find($value['user_id']);
                    $twitt[$key]['userName'] = $user->name;
                }
                echo json_encode($twitt);
            } else {
                return 'error';
            }
        } else {
            redirect("/admin/login");
        }
        
    }

    public function load(Request $request) 
    {
        $count = $request['count'];
        if ($count < 0) {
            $count = 3;
        }
        $offset = $request['offset'];
        if ($offset < 0) {
            $offset = 0;
        }

        $twitters = Twitter::orderBy('created_at', 'desc')->take($count-1)->skip($offset)->get()->toArray();
        foreach ($twitters as $key => $value) {
            $user = User::find($value['user_id']);
            $twitters[$key]['userName'] = $user->name;
        }
        echo json_encode($twitters);
        //return $twitters->toJson();
    }

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
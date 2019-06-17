<?php
/**
 * Created by PhpStorm.
 * User: Tadas
 * Date: 12/5/2018
 * Time: 12:16 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Integer;

class UsersListController extends Controller
{
    protected $repository;

    public function __construct(UsersListRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
        ]);
    }

    public function index()
    {
        $users = $this->repository->getAllUsers();

        return view('user.usersList', compact('users'));
    }

    public function getByID($id)
    {
        $user = $this->repository->getByID($id);

        return view('user.userEdit', compact('user'));
    }

    public function updateUserByID($id, Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required|email'
        ]);

        $status = $this->repository->updateUserByID($id, $request);

        if ($status == true) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Vartotojas buvo sėkmingai redaguotas');

            return redirect('/userslist');
        }
        else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Vartotojas nebuvo redaguotas');
        }
    }

}
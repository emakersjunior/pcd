<?php 
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Redirect;
class RegisterControllerAdmin extends Controller
{
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'name'  => 'required|max:255',
        'email' => 'required|email|unique:users',
      ]);
      // If validator fails, short circut and redirect with errors
      if($validator->fails()){
        return back()
          ->withErrors($validator)
          ->withInput();
      }
      //generate a password for the new users
      $pw = User::generatePassword();
      //add new user to database
      $user = new User;
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = $pw;
      $user->save();
      User::sendWelcomeEmail($user);
      return redirect()->back()->with('msg', "Conta criada com sucesso!");
//      return Redirect::to('/home/register');
  }
}

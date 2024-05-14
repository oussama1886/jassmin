<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'adress' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:20'],
    ]);
}


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Récupérer le fichier photo téléchargé
        $image = $data['photo'];

        // Générer un nouveau nom de fichier unique
        $newName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Définir le dossier de destination pour stocker l'image
        $destinationPath = 'dashassets/img/client';

        // Déplacer le fichier téléchargé vers le dossier de destination avec le nouveau nom
        $image->move(public_path($destinationPath), $newName);

        // Enregistrer l'utilisateur avec le chemin de la photo
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'photo' => $newName, // Enregistrer le nom de fichier de la photo
            'adress' => $data['adress'], // Enregistrement de l'adresse
            'phone' => $data['phone'], // Enregistrement du numéro de téléphone
        ]);
    }

    protected function registered($request, $user)
{
    if (session()->has('previous_url')) {
        return redirect(session('previous_url'));
    }

    return redirect('/');
}


public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'adress' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Si une nouvelle photo est téléchargée
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $newName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'dashassets/img/client';
            $image->move(public_path($destinationPath), $newName);
            $user->photo = $newName;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->adress = $request->input('adress');
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->back()->with('success', 'Profil mis à jour avec succès');
    }
}


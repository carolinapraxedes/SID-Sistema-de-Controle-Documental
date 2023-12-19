<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $users = User::with('roles')->get();

        return view('admin.index', compact('users'));
    }

    public function show(User $user)
    {

        return view('admin.show', compact('user'));
    }

    public function edit(User $user)
    {

        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        dd($request);
        // Atualiza os dados do usuário
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            // Outros campos que você precisa atualizar
        ]);

        // Redireciona de volta à página do admin ou para onde desejar
        return redirect()->route('admin.index')->with('success', 'Usuário atualizado com sucesso.');
    }
    public function delete(User $user)
    {
        $users = User::with('roles')->get();
        // dd($users);
        return view('admin.index', compact('users'));
    }
}

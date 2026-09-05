<?php

namespace App\Livewire\Admin\Authentication;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $this->remember)) {
            $this->addError('email', 'The provided credentials are incorrect.');

            return;
        }

        session()->regenerate();

        return redirect()->intended(route('admin.quizzes.index'));
    }

    public function render()
    {
        return view('components.admin.auth.login');
    }
}
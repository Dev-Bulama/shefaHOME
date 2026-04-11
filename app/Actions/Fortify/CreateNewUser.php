<?php
namespace App\Actions\Fortify;
use App\Models\{User, ClientProfile};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers {
    use PasswordValidationRules;

    public function create(array $input): User {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'] ?? null,
            'portal' => 'client',
            'is_active' => true,
            'is_verified' => false,
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole('client');

        // Auto-create client profile
        $clientId = 'CLT-' . str_pad(ClientProfile::count() + 1, 5, '0', STR_PAD_LEFT);
        ClientProfile::create(['user_id' => $user->id, 'client_id' => $clientId]);

        return $user;
    }
}

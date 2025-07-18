<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Validator;

class UpdateAdminProfileInformation implements UpdatesUserProfileInformation
{
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validate();

        $user->forceFill([
            'name' => $input['name'],
        ])->save();
    }
}

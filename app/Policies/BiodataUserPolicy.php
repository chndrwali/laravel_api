<?php

namespace App\Policies;

use App\Models\BiodataUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BiodataUserPolicy
{
    public function modify(User $user, BiodataUser $biodataUser): Response
    {
        return $user->id === $biodataUser->user_id
            ? Response::allow()
            : Response::deny('You do not own this post');
    }

}

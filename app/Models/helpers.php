<?php



use App\Models\User;

function getBuyerName($buyer_id)
{
    $user = User::find($buyer_id);
    return $user->name;
}

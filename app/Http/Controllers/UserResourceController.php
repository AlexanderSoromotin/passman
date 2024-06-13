<?php

namespace App\Http\Controllers;

use App\Models\UserResource;
use Illuminate\Http\Request;

class UserResourceController extends Controller
{
    public function destroy($id)
    {
        $item = UserResource::find($id);

        if ($item) {
            $item->delete();
        }

        return response(['message' => 'Deleted']);
    }
}

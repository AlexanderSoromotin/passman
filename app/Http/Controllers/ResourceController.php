<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $items = Resource::getAll($request);

        $breadScrumbs = [];
        if ($request->has('group_id')) {
            $groupId = $request->group_id;
            while ($resource = Resource::getResourceById($groupId)) {
                $breadScrumbs[] = ['name' => $resource->name, 'id' => $resource->id];

                $groupId = $resource->group_id;
            }
        }
        $breadScrumbs = array_reverse($breadScrumbs);
        array_unshift($breadScrumbs, 'Все ресурсы');
        $breadScrumbs = array_values($breadScrumbs);

        return response(['data' => $items, 'bread_scrumbs' => $breadScrumbs]);
    }

    public function show(Request $request, $id)
    {
        $resource = Resource::getResourceById($id);

        if (!$resource) {
            return response(['message' => 'Resource not found'], 404);
        }

        $resource->load(['webhook', 'users.user']);

        $resource->user_status = 'does not has access';
        if (UserResource::where('user_id', Auth::user()->id)->where('resource_id', $id)->first()) {
            $resource->user_status = 'has access';
        }
        if ($resourceRequest = \App\Models\Request::where('user_id', Auth::user()->id)->where('resource_id', $id)->first()) {
            $resource->user_status = 'waiting access';
        }

        return response(['data' => $resource]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:255',
            'is_group' => 'required|integer|in:0,1',
            'group_id' => 'nullable|integer|exists:resources,id',
            'login' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'expiration_at' => 'nullable|date:d.m.Y',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        if ($request->has('expiration_at') and $request->expiration_at != null) {
            $request = $request->merge([
                'expiration_at' => Carbon::createFromFormat('d.m.Y', $request->expiration_at)->startOfDay()->format('Y-m-d H:i:s')
            ]);
        }

        $resource = Resource::createResource($request->all());

        return response(['message' => 'Resource created', 'data' => $resource]);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'content' => 'nullable|string|max:255',
            'is_group' => 'integer|in:0,1',
            'group_id' => 'nullable|integer|exists:resources,id',
            'login' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'expiration_at' => 'nullable|date:d.m.Y',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        if ($request->has('expiration_at') and $request->expiration_at != null) {
            $request = $request->merge([
                'expiration_at' => Carbon::createFromFormat('d.m.Y', $request->expiration_at)->startOfDay()->format('Y-m-d H:i:s')
            ]);
        }

        $resource = Resource::getResourceById($id);
        if (!$resource) {
            return response(['message' => 'Resource not found'], 404);
        }

        $resource->updateResource($request->all());

        return response(['message' => 'Resource updated', 'data' => $resource]);
    }

    public function destroy(Request $request, $id)
    {
        $resource = Resource::getResourceById($id);
        if (!$resource) {
            return response(['message' => 'Resource not found'], 404);
        }

        $resource->deleteResource();

        return response(['message' => 'Resource deleted']);

    }
}

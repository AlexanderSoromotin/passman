<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function index(Request $request)
    {
        $items = \App\Models\Request::getAll($request);
        if ($request->has('head')) {
            $items = \App\Models\Request::where('head_specialist_id', Auth::user()->id)->where('status', 'Заявка ожидает подтверждения')->get();
        }

        if ($request->has('senior')) {
            $items = \App\Models\Request::where('senior_specialist_id', Auth::user()->id)->get();
        }

        if ($request->has('user')) {
            $items = \App\Models\Request::where('user_id', Auth::user()->id)->get();
        }

        $items->load(['headSpecialist.role', 'seniorSpecialist.role', 'resource', 'user.role']);

        return response(['data' => $items]);
    }

    public function show(Request $request, $id)
    {
        $localRequest = \App\Models\Request::getRequestById($id);

        $localRequest->load(['headSpecialist.role', 'seniorSpecialist.role', 'resource', 'user.role']);

        return response(['data' => $localRequest]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resource_id' => 'required|integer|exists:resources,id',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $request = $request->merge([
            'user_id' => Auth::user()->id
        ]);

        $newRequest = \App\Models\Request::createRequest($request->all());

        return response(['message' => 'Request created', 'data' => $newRequest]);
    }

    public function approve(Request $request, $id)
    {
        $localRequest = \App\Models\Request::getRequestById($id);

        $localRequest->update([
            'status' => 'Ожидает одобрения',
            'senior_specialist_id' => User::where('role_id', 2)->first()->id
        ]);

        $localRequest->load(['headSpecialist.role', 'seniorSpecialist.role', 'resource', 'user.role']);

        return response(['data' => $localRequest]);
    }

    public function close(Request $request, $id)
    {
        $localRequest = \App\Models\Request::getRequestById($id);

        UserResource::firstOrCreate([
            'user_id' => $localRequest->user_id,
            'resource_id' => $localRequest->resource_id,
        ]);

        $localRequest->delete();

        return response(['message' => 'Completed']);
    }

    public function destroy(Request $request, $id)
    {
        $localRequest = \App\Models\Request::getRequestById($id);

        if (!$localRequest) {
            return response(['message' => 'Not found'], 404);
        }

        $localRequest->delete();

        return response(['message' => 'Completed']);
    }
}

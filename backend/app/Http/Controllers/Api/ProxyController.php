<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProxyRequest;
use App\Http\Requests\UpdateProxyRequest;
use App\Models\Proxy;
use App\Services\ProxyStatusChecker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $proxies = Proxy::query()
            ->search($request->input('search'))
            ->latest()
            ->get();

        return response()->json($proxies);
    }

    public function store(StoreProxyRequest $request): JsonResponse
    {
        $proxy = Proxy::create($request->validated());

        return response()->json($proxy, 201);
    }

    public function show(Proxy $proxy): JsonResponse
    {
        return response()->json($proxy);
    }

    public function update(UpdateProxyRequest $request, Proxy $proxy): JsonResponse
    {
        $proxy->update($request->validated());
        $proxy->forceFill([
            'status' => ProxyStatusChecker::STATUS_UNKNOWN,
            'checked_at' => null,
            'last_error' => null,
        ])->save();

        return response()->json($proxy->refresh());
    }

    public function destroy(Proxy $proxy): JsonResponse
    {
        $proxy->delete();

        return response()->json(null, 204);
    }

    public function check(Proxy $proxy, ProxyStatusChecker $checker): JsonResponse
    {
        return response()->json($checker->check($proxy));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StoreController extends Controller
{

    protected static $title = "店舗";

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $stores = Store::latest()->paginate(config("app.pagination.admin"));
        return view('admin.stores.index', compact('stores'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Store::create($request->validated());

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store): View
    {
        return view('admin.stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store): View
    {
        return view('admin.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store): RedirectResponse
    {
        $store->update($request->validated());

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store): JsonResponse
    {
        $store->delete();

        return response()->json([
            'success' => true,
            'message' => self::$title . 'を削除しました！',
            'redirectUrl' => route('admin.stores.index'),
        ], 200);

        // return redirect()->route('admin.stores.index')
        //     ->with('success', 'Store deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnketRequest;
use App\Models\Anket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnketController extends Controller
{

    protected static $title = "アンケート";
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $ankets = Anket::paginateById(config("app.pagination.admin"));
        return view('admin.ankets.index', compact('ankets'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.ankets.create');
    }

    /**
     * Anket a newly created resource in storage.
     */
    public function store(AnketRequest $request): RedirectResponse
    {
        Anket::create($request->validated());

        return redirect()->route('admin.ankets.index')
            ->with('success', 'Anket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anket $anket): View
    {
        return view('admin.ankets.show', compact('anket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anket $anket): View
    {
        return view('admin.ankets.edit', compact('anket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnketRequest $request, Anket $anket): RedirectResponse
    {
        $anket->update($request->validated());

        return redirect()->route('admin.ankets.index')
            ->with('success', 'Anket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anket $anket): JsonResponse
    {
        $anket->delete();

        return response()->json([
            'success' => true,
            'message' => self::$title . 'を削除しました！',
            'redirectUrl' => route('admin.ankets.index'),
        ], 200);

        // return redirect()->route('admin.ankets.index')
        //     ->with('success', 'Anket deleted successfully');
    }
}

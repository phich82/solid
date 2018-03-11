<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PromotionServiceContract;

class PromotionController2 extends Controller
{
    protected $service;

    public function __construct(PromotionServiceContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $items = $this->service->paginate();
        $items = $items['total'] ? $items : [];
        return view('promotions.index', compact('items'));
    }

    public function create()
    {
        $items = $this->service->paginate();
        return view('promotions.create');
    }

    public function store(Request $request)
    {
        $this->service->store($request->all());
        return redirect()->route('promotions.index');
    }

    public function show($id)
    {
        $item = $this->service->find($id);
        return view('promotions.show', compact('item'));
    }

    public function edit($id)
    {
        $item = $this->service->find($id);
        return view('promotions.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $this->service->update($id, $request->all());
        return redirect()->route('promotions.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('promotions.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('pages.services.index', [
            'services' => Service::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::query()->where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('pages.services.show', [
            'service' => $service,
            'others' => Service::query()
                ->where('is_active', true)
                ->where('id', '!=', $service->id)
                ->orderBy('sort_order')
                ->take(3)
                ->get(),
        ]);
    }
}

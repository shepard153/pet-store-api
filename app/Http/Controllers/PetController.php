<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('api.url') . 'pet';
    }

    public function __invoke(): View
    {
        $response = Http::get("$this->baseUrl/findByStatus?status=available");

        return view('home', [
            'pets' => $response->json(),
        ]);
    }


    public function search(Request $request): View
    {
        $petId = $request->query('petId');

        $response = Http::get("$this->baseUrl/$petId");

        if ($response->status() === 200) {
            $pets = $response->json();
        }

        return view('home', [
            'pets' => $pets ?? [],
        ]);
    }

    public function show(int $id): View|RedirectResponse
    {
        $response = Http::get("$this->baseUrl/{$id}");

        if ($response->status() === 404) {
            return redirect()->route('pets');
        }

        return view('show', [
            'pet' => $response->json(),
        ]);
    }

    public function store(PetRequest $request): RedirectResponse
    {
        $response = Http::post($this->baseUrl, $request->validated());

        if ($response->status() === 405) {
            return back()
                ->with('message', __('Validation error!'))
                ->with('success', false);
        } else {
            return redirect()
                ->route('pets.show', $response->json()['id'])
                ->with('message', __('Pet created!'))
                ->with('success', true);
        }
    }

    public function update(PetRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();
        $data['id'] = $id;

        $response = Http::put($this->baseUrl, $data);

        if ($response->status() === 405) {
            $success = false;
            $message = __('Validation error!');
        } else {
            $success = true;
            $message = __('Pet updated!');
        }

        return redirect()
            ->route('pets.show', $id)
            ->with('message', $message)
            ->with('success', $success);
    }

    public function destroy(int $id): RedirectResponse
    {
        $response = Http::delete("$this->baseUrl/{$id}");

        if ($response->status() === 404) {
            $message = __('Pet not found!');
        } else {
            $message = __('Pet deleted!');
        }

        return redirect()->route('pets')->with('message', $message);
    }
}

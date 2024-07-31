<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Http\Requests\SearchRequest;
use App\Services\Interfaces\PetsServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PetController extends Controller
{
    public function __construct(private readonly PetsServiceInterface $petsService)
    {
        //
    }

    /**
     * Display a listing of the resource. For demo purposes, we are using the
     * findByStatus endpoint to get all available pets.
     */
    public function __invoke(): View
    {
        return view('home', [
            'pets' => $this->petsService->getPets(),
        ]);
    }

    public function search(SearchRequest $request): View
    {
        return view('home', [
            'pets' => $this->petsService->findPet($request->validated('petId')),
        ]);
    }

    public function show(int $id): View|RedirectResponse
    {
        $response = $this->petsService->getPetById($id);

        if ($response->status() === 404) {
            return redirect()
                ->route('pets')
                ->with('message', __('Pet not found!'));
        }

        return view('show', [
            'pet' => $response->json(),
        ]);
    }

    public function store(PetRequest $request): RedirectResponse
    {
        $response = $this->petsService->createPet($request->validated());

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

        $response = $this->petsService->updatePet($data);

        return redirect()
            ->route('pets.show', $id)
            ->with('message', $response['message'])
            ->with('success', $response['success']);
    }

    public function destroy(int $id): RedirectResponse
    {
        $message = $this->petsService->deletePet($id);

        return redirect()->route('pets')->with('message', $message);
    }
}

<?php

namespace App\Services;

use App\Services\Interfaces\PetsServiceInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PetsService implements PetsServiceInterface
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('api.url') . 'pet';
    }

    public function getPets(): ?array
    {
        $response = Http::get("$this->baseUrl/findByStatus?status=available");

        $pets = null;

        if ($response->status() === 200) {
            $pets = $response->json();
        }

        return $pets;
    }

    public function getPetById(int $id): Response
    {
        return Http::get("$this->baseUrl/$id");
    }

    public function findPet(int $petId): array
    {
        $response = Http::get("$this->baseUrl/$petId");

        $pet = [];

        if ($response->status() === 200) {
            $pet = [$response->json()];
        }

        return $pet;
    }

    public function createPet(array $formData): Response
    {
        return Http::post($this->baseUrl, $formData);
    }

    public function updatePet(array $formData): array
    {
        $response = Http::put($this->baseUrl, $formData);

        switch ($response->status()) {
            case 404:
                $success = false;
                $message = __('Pet not found!');
                break;
            case 405:
                $success = false;
                $message = __('Validation error!');
                break;
            default:
                $success = true;
                $message = __('Pet updated!');
        }

        return [
            'success' => $success,
            'message' => $message,
        ];
    }

    public function deletePet(int $id): string
    {
        $response = Http::delete("$this->baseUrl/$id");

        if ($response->status() === 404) {
            $message = __('Pet not found!');
        } else {
            $message = __('Pet deleted!');
        }

        return $message;
    }
}
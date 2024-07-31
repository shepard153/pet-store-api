<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Client\Response;

interface PetsServiceInterface
{
    public function getPets(): ?array;
    public function getPetById(int $id): Response;
    public function findPet(int $petId): array;
    public function createPet(array $formData): Response;
    public function updatePet(array $formData): array;
    public function deletePet(int $id): string;
}
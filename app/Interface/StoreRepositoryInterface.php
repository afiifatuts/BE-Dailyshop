<?php
namespace App\Interface;

interface StoreRepositoryInterface
{
    public function getAll(?string $search = null,
    ?bool $isVerified = false,
     ?int $limit = 10,
      bool $execute);
    public function getAllPaginated(?string $search = null,
    ?bool $isVerified = false,
     ?int $rowPerPage = 10);
     public function getById(string $id);
     public function create (array $data); 
     public function updateVerifiedStatus(string $id, bool $isVerified);
     public function update(string $id, array $data);
     public function delete(string $id);
}
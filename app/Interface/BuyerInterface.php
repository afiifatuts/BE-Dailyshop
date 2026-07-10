<?php
namespace App\Interface;

interface BuyerInterface
{
    public function getAll(?string $search = null, ?int $limit = 10, bool $execute);
    public function getAllPaginated(?string $search = null, ?int $rowPerPage = 10);
    public function getById(string $id);
    public function create(array $data);
}

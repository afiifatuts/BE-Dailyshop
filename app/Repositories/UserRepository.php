<?php 

namespace App\Repositories;

use App\Interface\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = false)
    {
        $query = User::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(?string $search = null, ?int $rowPerPage = 10)
    {
        $query = $this->getAll($search, null, false);
        return $query->paginate($rowPerPage);
    }

    public function getById(string $id)
    {
        $query = User::where('id', $id);
        return $query->firstOrFail();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try{
            $user = new User();
            $user->name = $data['name'];    
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception('Failed to create user: ' . $e->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();
        try{
            $user = User::findOrFail($id);
            $user->name = $data['name'] ?? $user->name;  
            if (isset($data['password'])) {
                $user->password = bcrypt($data['password']);
            }
            $user->save();
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception('Failed to update user: ' . $e->getMessage());
        }
    }

    public function delete(string $id)
    {
        DB::beginTransaction();
        try{
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception('Failed to delete user: ' . $e->getMessage());
        }
    }
}
 
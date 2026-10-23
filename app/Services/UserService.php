<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * List users with optional search + pagination.
     */
    public function list(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return User::query()
            ->search($filters['search'] ?? null)
            ->when(
                isset($filters['is_active']),
                fn ($q) => $q->where('is_active', (bool) $filters['is_active'])
            )
            ->latest('id')
            ->paginate($perPage);
    }

    /**
     * Create a new user.
     */
    public function create(array $data): User
    {
        return DB::transaction(fn () => User::create($data));
    }

    /**
     * Update an existing user.
     */
    public function update(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            // Only update password if provided
            if (empty($data['password'])) {
                unset($data['password']);
            }

            $user->update($data);
            return $user->refresh();
        });
    }

    /**
     * Delete a user (soft delete).
     */
    public function delete(User $user): bool
    {
        return (bool) $user->delete();
    }
}
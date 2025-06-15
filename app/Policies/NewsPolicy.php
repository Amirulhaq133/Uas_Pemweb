<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, News $news)
    {
        return true;
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'editor', 'wartawan']);
    }

    public function update(User $user, News $news)
    {
        // Admin dan editor bisa edit semua
        if (in_array($user->role, ['admin', 'editor'])) {
            return true;
        }
        
        // Wartawan hanya bisa edit milik sendiri dan masih draft
        if ($user->role === 'wartawan') {
            return $user->id === $news->author_id && $news->status === 'draft';
        }
        
        return false;
    }

    public function delete(User $user, News $news)
    {
        // Admin bisa hapus semua
        if ($user->role === 'admin') {
            return true;
        }
        
        // Editor bisa hapus semua
        if ($user->role === 'editor') {
            return true;
        }
        
        // Wartawan hanya bisa hapus milik sendiri dan masih draft
        if ($user->role === 'wartawan') {
            return $user->id === $news->author_id && $news->status === 'draft';
        }
        
        return false;
    }

    public function approve(User $user, News $news)
    {
        return in_array($user->role, ['admin', 'editor']);
    }
}
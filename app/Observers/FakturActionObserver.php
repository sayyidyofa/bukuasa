<?php

namespace App\Observers;

use App\Models\Faktur;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class FakturActionObserver
{
    public function created(Faktur $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Faktur'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Faktur $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Faktur'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Faktur $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Faktur'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}

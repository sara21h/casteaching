<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

if (! function_exists('create_default_user')) {
    function create_default_user()
    {
        $user = User::create([
            'name' => config('casteaching.default_user.name', 'Sara'),
            'email' => config('casteaching.default_user.email', 'sbogdan@iesebre.com'),
            'password' => Hash::make(config('casteaching.default_user.password', '12345678'))
        ]);
        $user->superadmin = true;
        $user->save();
        add_personal_team($user);
    }
}

if (! function_exists('create_default_videos')) {
    function create_default_videos()
    {
        Video::create([
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
            'url' => 'https://www.youtube.com/watch?v=12345',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);
    }
}

if (! function_exists('create_regular_user')) {
    function create_regular_user()
    {
        $user = User::create([
            'name' => 'regular',
            'email' => 'regular@casteaching.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->superadmin = true;
        $user->save();
        add_personal_team($user);
        return $user;
    }
}

if (! function_exists('create_video_manager_user')) {
    function create_video_manager_user()
    {
        $user = User::create([
            'name' => 'video_manager',
            'email' => 'videosmanager@casteaching.com',
            'password' => Hash::make('12345678')
        ]);
        Permission::create(['name' => 'videos_manage_index']);
        $user->givePermissionTo('videos_manage_index');
        add_personal_team($user);
        return $user;
    }
}

if (! function_exists('create_superadmin_user')) {
    function create_superadmin_user()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'superadmin@casteaching.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->superadmin = true;
        $user->save();
        add_personal_team($user);
        return $user;
    }
}


if (! function_exists('add_personal_team')) {
    function add_personal_team($user): void
    {
        try {
            Team::forceCreate([
                'name' => $user->name . "'s Team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {

        }
    }
}


if (! function_exists('define_gates')) {
    function define_gates()
    {
        Gate::before(function ($user, $ability){
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

    }
}

if (! function_exists('create_permissions')) {
    function create_permissions()
    {
        Permission::firstOrCreate(['name' => 'videos_manage_index']);
    }
}
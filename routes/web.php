<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return Inertia::render('Home', [
        'time' => now()->toTimeString(),
    ]);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
})->middleware('auth');

Route::post('/users', function () {
    $validatedAttributes = request()->validate([
        'name' => [
            'required',
        ],
        'email' => [
            'required',
            'email'
        ],
        'password' => [
            'required',
            'confirmed',
            Password::min(6)->mixedCase()
        ]
    ]);

    User::create($validatedAttributes);

    return to_route('users.index');
})->middleware('auth');


Route::get('/users', function () {
    return Inertia::render('Users', [
        'users' => User::query()
            ->latest('updated_at')
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })->paginate(10, ['id', 'name'])->withQueryString()->through(fn($user) => [
                'name' => $user->name,
                'id' => $user->id,
                'can' => [
                    'edit_user' => auth()->user() ? auth()->user()->can('update', $user) : false
                ]
            ]),
        'filters' => Request::only(['search']),

    ]);
})->name('users.index');

Route::get('/users/{user}/edit', function (User $user) {
    /* if (auth()->user()->cannot('update', $user)) {
         abort(403);
     }*/
    return Inertia::render('Users/Edit', [
        'user' => $user
    ]);
})->name('users.edit')->middleware('auth')->can('update,user');

Route::patch('/users/{user}', function (User $user) {
    if (auth()->user()->cannot('update', $user)) {
        abort(403);
    }
    $validatedAttributes = request()->validate([
        'name' => [
            'required',
        ],
        'email' => [
            'required',
            'email'
        ],
        'password' => [
            'sometimes',
            'confirmed',
            /*Password::min(6)->mixedCase()*/
        ]
    ]);
    if (empty($validatedAttributes['password'])) {
        unset($validatedAttributes['password']);
    }
    $user->update($validatedAttributes);

    return to_route('users.index');
})->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

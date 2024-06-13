<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth');
});

Route::get('/users', function () {
    return view('users');
});

Route::get('/users/{id}', function ($id) {
    return view('user-profile', ['id' => $id]);
});

Route::get('/resources', function () {
    return view('resources');
});
Route::get('/resources/{id}', function ($id) {
    return view('resources', ['id' => $id]);
});

Route::get('/requests', function () {
    return view('requests');
});

Route::get('/my-requests', function () {
    return view('my-requests');
});





// Страница профиля другого пользователя
Route::get('/profile/{id}', function ($id) {
    return view('profile', ['id' => $id]);
});

// Страница списка проектов
Route::get('/projects', function () {
    return view('projects');
});

// Страница профиля проекта
Route::get('/projects/{id}', function ($id) {
    return view('project-profile', ["id" => $id]);
});

// Страница списка счётчиков
Route::get('/counters', function () {
    return view('counters');
});

// Страница профиля счётчика
Route::get('/counters/{id}', function ($id) {
    return view('counter-profile', ["id" => $id]);
});

// Страница списка оборудования
Route::get('/equipment', function () {
    return view('equipment');
});

// Страница профиля оборудования
Route::get('/equipment/{id}', function ($id) {
    return view('equipment-profile', ["id" => $id]);
});

// Станица показаний счётчика
Route::get('/counters/{id}/readings', function ($id) {
    return view('counter-readings', ["id" => $id]);
});

// Страница списка мастеров
Route::get('/masters', function () {
    return view('masters');
});

// Страница создания показаний счётчика
Route::get('/add-counter-reading', function () {
    return view('add-counter-reading');
});

// Страница создания показаний счётчика
Route::get('/techMaintenance', function () {
    return view('techMaintenance');
});

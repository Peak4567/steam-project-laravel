<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\SheetController;
use App\Http\Controllers\Frontend\PortfolioController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\ProjectController as BackendProjectController;
use App\Http\Controllers\Backend\ReportController as BackendReportController;
use App\Http\Controllers\Backend\ActivityController as BackendActivityController;
use App\Http\Controllers\Frontend\ActivityController;
use App\Http\Controllers\Backend\SheetController as BackendSheetController;
use App\Http\Controllers\Backend\PortfolioController as BackendPortfolioController;
use App\Http\Controllers\Backend\UserController as BackendUserController;


Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/terms-of-service', function () {
    return view('terms');
})->name('terms');

Route::get('/projects', [ProjectController::class, 'searchProjects'])->name('projects');
Route::get('/project/{id}', [ProjectController::class, 'showProject'])->name('project.show');

Route::get('/projects/{id}/apply', [ProjectController::class, 'applyPage'])->name('projects.applyPage');

Route::post('/projects/{id}/apply', [ProjectController::class, 'requestJoin'])->name('projects.requestJoin');

Route::get('/projects/reports/view/{id}', [ProjectController::class, 'viewReport'])->name('projects.viewReport');
Route::get('/projects/reports/download/{id}', [ProjectController::class, 'downloadReport'])->name('projects.downloadReport');


Route::get('/sheets', [SheetController::class, 'publicIndex'])->name('sheets');

Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
Route::get('/activity/{id}/apply', [ActivityController::class, 'apply'])->name('activity.apply');
Route::post('/activity/{id}/apply', [ActivityController::class, 'submitApply'])->name('activity.apply.submit');


Route::get('/portfolio', [PortfolioController::class, 'publicIndex'])->name('portfolio');
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::middleware(['auth'])->group(function () {


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-image', [ProfileController::class, 'uploadImage'])->name('profile.upload.image');

    Route::get('/profile/projects', [ProjectController::class, 'index'])->name('profile.projects');

    Route::post('/profile/projects/upload-doc', [ProjectController::class, 'uploadDocument'])->name('profile.projects.upload');

    Route::put('/profile/projects/update', [ProjectController::class, 'update'])->name('profile.projects.update');

    Route::post('/projects/{project}/invite', [ProjectController::class, 'inviteMember'])->name('projects.invite');

    Route::post('/projects/{project_id}/accept/{user_id}', [ProjectController::class, 'acceptMember'])->name('projects.accept');
    Route::post('/projects/{project_id}/decline/{user_id}', [ProjectController::class, 'declineMember'])->name('projects.decline');
    Route::patch('/projects/{id}/status', [ProjectController::class, 'updateStatus'])->name('projects.updateStatus');
    Route::patch('/projects/{id}/max-members', [ProjectController::class, 'updateMaxMembers'])->name('projects.updateMaxMembers');
    Route::patch('/projects/{project_id}/position/{user_id}', [ProjectController::class, 'updatePosition'])->name('projects.updatePosition');
    Route::patch('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');

    Route::get('/profile/reports', [ProjectController::class, 'showReportsWithoutId'])->name('projects.reports');
    Route::post('/projects/{id}/upload-reports', [ProjectController::class, 'uploadReports'])->name('projects.uploadReports');
    Route::delete('/projects/reports/{id}', [ProjectController::class, 'deleteReport'])->name('projects.deleteReport');

    Route::get('/profile/sheets', [SheetController::class, 'index'])->name('profile.sheets');
    Route::post('/profile/sheets', [SheetController::class, 'store'])->name('profile.sheets.store');
    Route::delete('/profile/sheets/{id}', [SheetController::class, 'destroy'])->name('profile.sheets.destroy');

    Route::get('/profile/portfolio', [PortfolioController::class, 'index'])->name('profile.portfolio');
    Route::post('/profile/portfolio', [PortfolioController::class, 'store'])->name('profile.portfolio.store');
    Route::delete('/profile/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('profile.portfolio.destroy');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::prefix('backend')->group(function () {
    Route::get('/home', [BackendHomeController::class, 'index'])->name('backend.home');
    Route::get('/projects', [BackendProjectController::class, 'index'])->name('backend.projects');
    Route::get('/projects/create', [BackendProjectController::class, 'create'])->name('backend.projects.create');
    Route::post('/projects', [BackendProjectController::class, 'store'])->name('backend.projects.store');

    Route::delete('/projects/{id}', [BackendProjectController::class, 'destroy'])->name('backend.projects.destroy');
    Route::get('/projects/{id}/edit', [BackendProjectController::class, 'edit'])->name('backend.projects.edit');
    Route::put('/projects/{id}', [BackendProjectController::class, 'update'])->name('backend.projects.update');

    Route::get('/reports', [BackendReportController::class, 'index'])->name('backend.reports');
    Route::patch('/reports/{id}/status', [BackendReportController::class, 'updateStatus'])->name('backend.reports.update-status');
    Route::delete('/reports/{id}', [BackendReportController::class, 'destroy'])->name('backend.reports.destroy');

    Route::get('/activity', [BackendActivityController::class, 'index'])->name('backend.activity');
    Route::get('/activity/create', [BackendActivityController::class, 'create'])->name('backend.activity.create');
    Route::post('/activity/store', [BackendActivityController::class, 'store'])->name('backend.activity.store');
    Route::delete('/activity/{id}', [BackendActivityController::class, 'destroy'])->name('backend.activity.destroy');

    Route::get('/activity/{id}/participants', [BackendActivityController::class, 'participants'])->name('backend.activity.participants');
    Route::patch('/activity/status/{id}', [BackendActivityController::class, 'updateStatus'])->name('backend.activity.updateStatus');
    Route::get('/activity/{id}/print', [BackendActivityController::class, 'print'])->name('backend.activity.print');

    Route::get('/sheets', [BackendSheetController::class, 'index'])->name('backend.sheets');
    Route::patch('/sheets/{id}/status', [BackendSheetController::class, 'updateStatus'])->name('backend.sheets.updateStatus');
    Route::delete('/sheets/{id}', [BackendSheetController::class, 'destroy'])->name('backend.sheets.destroy');
    
    Route::get('/portfolios', [BackendPortfolioController::class, 'index'])->name('backend.portfolios');
    Route::patch('/portfolios/{id}/status', [BackendPortfolioController::class, 'updateStatus'])->name('backend.portfolios.updateStatus');
    Route::delete('/portfolios/{id}', [BackendPortfolioController::class, 'destroy'])->name('backend.portfolios.destroy');

    Route::get('/users', [BackendUserController::class, 'index'])->name('backend.users');
    Route::get('/users/{id}/edit', [BackendUserController::class, 'edit'])->name('backend.users.edit');
    Route::put('/users/{id}', [BackendUserController::class, 'update'])->name('backend.users.update');
    Route::delete('/users/{id}', [BackendUserController::class, 'destroy'])->name('backend.users.destroy');

    
});

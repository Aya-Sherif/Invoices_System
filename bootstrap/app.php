<?php

use App\Http\Middleware\AccountsMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\IsAdminOrAccounts;
use App\Http\Middleware\IsAdminOrAccountsOrSales;
use App\Http\Middleware\IsAdminOrStock;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\SalesMiddleware;
use App\Http\Middleware\StockMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'is_admin' => AdminMiddleware::class,
            'is_admin_or_sales_or_accounts'=>IsAdminOrAccountsOrSales::class,
            'is_admin_or_accounts'=>IsAdminOrAccounts::class,
            'is_admin_or_stock'=>IsAdminOrStock::class
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();



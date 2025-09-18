<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind Factory by class for type-hint injection
        $this->app->singleton(Factory::class, function ($app) {
            $config = config('firebase');

            $factory = new Factory();
            $credentials = $config['credentials'] ?? null;
            $clientEmail = is_array($credentials) ? ($credentials['client_email'] ?? null) : null;
            $privateKey = is_array($credentials) ? ($credentials['private_key'] ?? null) : null;

            if (is_array($credentials)
                && !empty($clientEmail)
                && filter_var($clientEmail, FILTER_VALIDATE_EMAIL)
                && !empty($privateKey)
            ) {
                $factory = $factory->withServiceAccount($credentials);
            }
            if (!empty($config['database_url'])) {
                $factory = $factory->withDatabaseUri($config['database_url']);
            }
            // Storage bucket is provided when creating Storage, no method here in this version

            return $factory;
        });

        // Alias string accessor 'firebase' to Factory::class
        $this->app->alias(Factory::class, 'firebase');

        // Bind Auth by class for type-hint injection
        $this->app->singleton(Auth::class, function ($app) {
            return $app[Factory::class]->createAuth();
        });
        $this->app->alias(Auth::class, 'firebase.auth');

        // Optional: expose database and storage via string aliases
        $this->app->singleton('firebase.database', function ($app) {
            return $app[Factory::class]->createDatabase();
        });

        $this->app->singleton('firebase.storage', function ($app) {
            return $app[Factory::class]->createStorage();
        });
    }

    public function boot()
    {
        //
    }
}


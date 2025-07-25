<?php

declare(strict_types=1);

use Stancl\Tenancy\Database\Models\Domain;

return [
    'tenant_model' => App\Models\Organization::class,
    'id_generator' => Stancl\Tenancy\UUIDGenerator::class,

    'domain_model' => Domain::class,

    'central_domains' => [
        '127.0.0.1',
        'localhost',
    ],

    'bootstrappers' => [
        Stancl\Tenancy\Bootstrappers\DatabaseTenancyBootstrapper::class,
        Stancl\Tenancy\Bootstrappers\CacheTenancyBootstrapper::class,
        Stancl\Tenancy\Bootstrappers\FilesystemTenancyBootstrapper::class,
        Stancl\Tenancy\Bootstrappers\QueueTenancyBootstrapper::class,
        // Stancl\Tenancy\Bootstrappers\RedisTenancyBootstrapper::class,
    ],

    'database' => [
        'central_connection' => env('DB_CONNECTION'),

        'template_tenant_connection' => null,
        'prefix' => 'tenant',
        'suffix' => '',
        'managers' => [
            'sqlite' => Stancl\Tenancy\TenantDatabaseManagers\SQLiteDatabaseManager::class,
            'mysql' => Stancl\Tenancy\TenantDatabaseManagers\MySQLDatabaseManager::class,
            'pgsql' => Stancl\Tenancy\TenantDatabaseManagers\PostgreSQLDatabaseManager::class,
        ],
    ],

    'cache' => [
        'tag_base' => 'tenant',
    ],

    'filesystem' => [
        'suffix_base' => 'tenant',
        'disks' => [
            'local',
            'public',
        ],
        'root_override' => [
            'local' => '%storage_path%/app/',
            //'public' => '%storage_path%/app/public/',
            'public' => '%storage_path%/tenant%tenant_id%/app/public',
            //'public' => '%storage_path%/app/tenant%tenant_id%/public',


        ],
        'suffix_storage_path' => true,
        'asset_helper_tenancy' => true,
    ],

    'redis' => [
        'prefix_base' => 'tenant',
        'prefixed_connections' => [],
    ],

    'features' => [
        Stancl\Tenancy\Features\TenantConfig::class,
        Stancl\Tenancy\Features\UniversalRoutes::class,
    ],

    'routes' => true,

    'migration_parameters' => [
        '--force' => true,
        '--path' => [database_path('migrations/tenant')],
        '--realpath' => true,
    ],

    'seeder_parameters' => [
        '--class' => \Database\Seeders\TenantPermissionsSeeder::class,
        '--force' => true,
    ],

    'synced_resources' => [
        'organizers_as_patrons' => [
            'central_model' => \App\Models\Organizer::class,
            'tenant_model' => \App\Models\Tenant\Patron::class,
            'queueable' => true,
        ],
    ],

    'exempt_from_tenant_features' => [
        'sessions', // Ceci indique à Stancl de ne pas toucher à la table 'sessions'
    ],
];

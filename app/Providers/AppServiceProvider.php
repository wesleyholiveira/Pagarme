<?php

namespace App\Providers;

use App\Entities\FantasiaEntity;
use App\Entities\FornecedorEntity;
use App\Entities\ImagemEntity;
use App\Repository\FantasiaRepository;
use App\Repository\FornecedorRepository;
use App\Repository\ImagemRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FantasiaRepository::class, function($app) {
           return new FantasiaRepository($app['em'], $app['em']->getClassMetadata(FantasiaEntity::class));
        });

        $this->app->bind(FornecedorRepository::class, function($app) {
           return new FornecedorRepository($app['em'], $app['em']->getClassMetadata(FornecedorEntity::class));
        });

        $this->app->bind(ImagemRepository::class, function($app) {
            return new ImagemRepository($app['em'], $app['em']->getClassMetadata(ImagemEntity::class));
        });

    }
}

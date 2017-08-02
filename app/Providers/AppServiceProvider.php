<?php

namespace App\Providers;

use App\Entities\FantasiaEntity;
use App\Entities\FornecedorEntity;
use App\Entities\ImagemEntity;
use App\Factories\BankAccountFactory;
use App\Factories\FakerFactory;
use App\Repository\FantasiaRepository;
use App\Repository\FornecedorRepository;
use App\Repository\ImagemRepository;
use App\Services\PagarMeService;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use PagarMe\Sdk\PagarMe;

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

        $this->app->bind(PagarMe::class, function() {
           return new PagarMe(env('PAGARME_KEY'));
        });

        $this->app->bind(FakerFactory::class, function() {
            $faker = new FakerFactory();
            return $faker();
        });

        $this->app->bind(BankAccountFactory::class, function() {
            return new BankAccountFactory(app(PagarMeService::class), app(Generator::class));
        });

    }
}

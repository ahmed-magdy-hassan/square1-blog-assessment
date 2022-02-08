<?php

namespace App\Providers;

use App\Services\BlogPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->singleton(BlogPost::class, function ($app) {
            return new BlogPost();
        });

        Blade::directive('pushonce', function ($expression) {
            [$pushName, $pushSub] = explode(':', trim(substr($expression, 1, -1)));

            $key = '__pushonce_' . str_replace('-', '_', $pushName) . '_' . str_replace('-', '_', $pushSub);

            return "<?php if(! isset(\$__env->{$key})): \$__env->{$key} = 1; \$__env->startPush('{$pushName}'); ?>";
        });

        Blade::directive('endpushonce', function ($expression) {
            return '<?php $__env->stopPush(); endif; ?>';
        });

        Component::macro('macroNotify', function ($message) {
            $this->dispatchBrowserEvent('notify', $message);
        });

        Builder::macro('whereMacroSearch', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%' . $string . '%') : $this;
        });
        Builder::macro('orWhereMacroSearch', function ($field, $string) {
            return $string ? $this->orWhere($field, 'like', '%' . $string . '%') : $this;
        });
    }
}

<?php

namespace TomSix\Components;


use Illuminate\Support\ServiceProvider;
use TomSix\Components\View\Components\Button;
use TomSix\Components\View\Components\Checkbox;
use TomSix\Components\View\Components\Checkboxes;
use TomSix\Components\View\Components\Error;
use TomSix\Components\View\Components\Errors;
use TomSix\Components\View\Components\File;
use TomSix\Components\View\Components\InputGroup;
use TomSix\Components\View\Components\ModelSelect;
use TomSix\Components\View\Components\Select;
use TomSix\Components\View\Components\Input;
use TomSix\Components\View\Components\Textarea;

class LibraryServiceProvider extends ServiceProvider
{
    /** @var string  */
    private const CONFIG_FILE = __DIR__.'/../config/library.php';

    /** @var string  */
    private const PATH_VIEWS = __DIR__ . '/../resources/views';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (function_exists('config_path')) { // function not available and 'publish' not relevant in Lumen
            $this->publishes([
                self::CONFIG_FILE => config_path('library.php')
            ], 'config');
        }

        $this->loadViewsFrom(self::PATH_VIEWS, 'laravel-components-library');

        $this->registerFormComponents();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(self::CONFIG_FILE, 'library');
    }

    /**
     * Register the Blade form components
     *
     * @return $this
     */
    private function registerFormComponents(): self
    {
        $this->loadViewComponentsAs('form', [
            Input::class,
            InputGroup::class,
            Select::class,
            ModelSelect::class,
            Textarea::class,
            Checkboxes::class,
            Checkbox::class,
            File::class,
            Button::class,
            Errors::class,
            Error::class
        ]);

        $this->publishes([
            self::PATH_VIEWS . '/form' => resource_path('views/vendor/laravel-components-library/form'),
        ], 'form-components');

        return $this;
    }
}

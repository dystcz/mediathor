<?php

declare(strict_types=1);

namespace Dystcz\MediaThor\Domain\Base\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected string $signature = 'mediathor:install';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Install MediaThor ⚡';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // MediaThor config
        $this->comment('Publishing MediaThor config file...');

        $this->callSilently('vendor:publish', [
            '--provider' => 'Dystcz\MediaThor\MediaThorServiceProvider',
            '--tag' => 'config',
        ]);

        // Laravel Media Library config
        if ($this->confirm('Would you like to publish Laravel Media Library config?', true)) {
            $this->comment('Publishing Laravel Media Library config file...');

            $this->callSilently('vendor:publish', [
                '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
                '--tag' => 'config',
            ]);
        }

        // Laravel FilePond config
        if ($this->confirm('Would you like to publish Laravel FilePond config?', true)) {
            $this->comment('Publishing Laravel FilePond config file...');

            $this->callSilently('vendor:publish', [
                '--provider' => 'Sopamo\LaravelFilepond\LaravelFilepondServiceProvider',
                '--tag' => 'filepond',
            ]);
        }

        // MediaThor migrations
        // $this->comment('Publishing migrations...');
        //
        // $this->callSilently('vendor:publish', [
        //     '--provider' => 'Dystcz\MediaThor\MediaThorServiceProvider',
        //     '--tag' => 'migrations',
        // ]);

        // Laravel Media Library migrations
        if ($this->confirm('Would you like to publish Laravel Media Library migrations?')) {
            $this->comment('Publishing Medialibrary migrations...');

            $this->callSilently('vendor:publish', [
                '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
                '--tag' => 'migrations',
            ]);
        }

        // Run migrations
        if ($this->confirm('Would you like to run the migrations now?')) {
            $this->comment('Running migrations...');

            $this->call('migrate');
        }

        // Run Github star beggar
        if ($this->confirm('Would you like to star our repo on GitHub?')) {
            $repoUrl = 'https://github.com/dystcz/MediaThor';

            if (PHP_OS_FAMILY == 'Darwin') {
                exec("open {$repoUrl}");
            }
            if (PHP_OS_FAMILY == 'Windows') {
                exec("start {$repoUrl}");
            }
            if (PHP_OS_FAMILY == 'Linux') {
                exec("xdg-open {$repoUrl}");
            }
        }

        $this->info('MediaThor has been installed! ⚡');
    }
}

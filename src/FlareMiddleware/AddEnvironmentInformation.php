<?php

namespace Emefye\LaravelErs\FlareMiddleware;

use Closure;
use Emefye\LaravelErsClient\FlareMiddleware\FlareMiddleware;
use Emefye\LaravelErsClient\Report;

class AddEnvironmentInformation implements FlareMiddleware
{
    public function handle(Report $report, Closure $next)
    {
        $report->frameworkVersion(app()->version());

        $report->group('env', [
            'laravel_version' => app()->version(),
            'laravel_locale' => app()->getLocale(),
            'laravel_config_cached' => app()->configurationIsCached(),
            'app_debug' => config('app.debug'),
            'app_env' => config('app.env'),
            'php_version' => phpversion(),
        ]);

        return $next($report);
    }
}

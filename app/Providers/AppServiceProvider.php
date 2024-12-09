<?php

namespace App\Providers;
use Illuminate\Routing\Router;
use App\Http\Middleware\AdminRole;
use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {
        
        $router->aliasMiddleware('roles', Adminrole::class);


        if (Schema::hasTable('smtp_settings')) {
            $smtpsetting = SmtpSetting::first();
            if ($smtpsetting) {
               $data = [
                 'driver' => $smtpsetting->mailer, 
                 'host' => $smtpsetting->host,
                 'port' => $smtpsetting->port,
                 'username' => $smtpsetting->username,
                 'password' => $smtpsetting->password,
                 'encryption' => $smtpsetting->encryption,
                 'from' => [
                     'address' => $smtpsetting->from_address,
                     'name' => 'Sekai Hotel'
                 ]  
               ];
               Config::set('mail',$data);
            }
         } // end if

    }
}

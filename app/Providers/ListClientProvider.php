<?php

namespace App\Providers;

use App\Models\Enterprise\Enterprise;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;

class ListClientProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @param Dispatcher $events
     * @param Enterprise $enterprise
     */
    public function boot(Dispatcher $events, Enterprise $enterprise)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($enterprise) {

            $user = Auth::user();

            if($user->enterprises_id === null){
                $event->menu->add("Listagem de clientes");

                $items = $enterprise::getLasts()->map(function (Enterprise $enterprise) {
                    return [
                        'text' => $enterprise->name,
                        'url' => route('enterprises.edit', $enterprise->id)
                    ];
                });
                $event->menu->add(...$items);
            }

        });
    }
}

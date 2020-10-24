<?php

namespace App\Providers;

use App\Constants\UserConstant;
use App\Http\Middleware\Authenticate;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;

class MountOptionsNavProvider extends ServiceProvider
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
     */
    public function boot(Dispatcher $events )
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $user = Auth::user();
            if($user->user_type_id == UserConstant::ADMIN){
                $event->menu->add(
                    [
                        'text'        => 'Caixa',
                        'url'         => 'cashier',
                        'icon'        => 'fas fa-fw fa-home',
                    ],
                    [
                        'text'        => 'Vendas',
                        'url'         => 'sales',
                        'icon'        => 'fas fa-fw fa-home',
                    ],
                    [
                        'text'        => 'Usuários',
                        'url'         => 'user',
                        'icon'        => 'fas fa-fw fa-user',
                    ],
                    [
                        'text' => 'Produtos',
                        'submenu' => [
                            [
                                'text' => 'Tipos de produtos',
                                'url'  => 'typeProduct',
                                'icon' => 'far fa-plus-square',
                            ],
                            [
                                'text' => 'Produtos',
                                'url'  => 'products',
                                'icon' => 'fas fa-utensils',
                            ],
                        ]
                    ]

                );
                return true;
            }
            $event->menu->add(
                [
                    'text'        => 'Vendas',
                    'url'         => 'sales',
                    'icon'        => 'fas fa-fw fa-home',
                ]
            );

        });

    }
}

<?php

namespace App\Providers;

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
//    public function boot(Dispatcher $events , EnterpriseRepository $enterpriseRepository)
//    {
//        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($enterpriseRepository) {
//            $user = Auth::user();
//            $count = $enterpriseRepository->countAllApps();
//            if($user->enterprises_id == null){
//                $event->menu->add(
//                    [
//                        'text' => 'blog',
//                        'url' => 'admin/blog',
//                        'can' => 'manage-blog',
//                    ],
//
//                    [
//                        'text' => 'Anotações',
//                        'url' => '/notes'
//                    ],
//                    [
//                        'text' => 'Configurações',
//                        'submenu' => [
//                            [
//                                'text' => 'Categorias do Aplicativo',
//                                'url' => '/api-types',
//                                'icon' => 'fas fa-th-list',
//                            ],
//                            [
//                                'text' => 'Modulos',
//                                'url' => '/modules',
//                                'icon' => 'fas fa-th-list',
//                            ],
//                            [
//                                'text' => 'Usuários',
//                                'url' => '/settings/user',
//                                'icon' => 'far fa-user'
//                            ],
//                        ],
//                    ],
//                    [
//                        'text' => 'Clientes',
//                        'url' => '/enterprises',
//                        'label' => $count,
//                        'label_color' => 'success',
//                    ],
//                    [
//                        'text' => 'Implementações',
//                        'url' => '/implementation'
//                    ],
//                    [
//                        'text' => 'Tickets',
//                        'submenu' => [
//                            [
//                                'text' => 'Painel',
//                                'url' => '/ticket/home',
//                                'icon' => 'fas fa-id-card',
//                            ],
//                        ],
//                    ],
//                    [
//                        'text' => 'Testes Internos',
//                        'submenu' => [
//                            [
//                                'text' => 'Criar',
//                                'url' => 'tests/create',
//                                'icon' => 'fas fa-folder-plus',
//                            ],
//                            [
//                                'text' => 'Listar',
//                                'url' => 'tests/',
//                                'icon' => 'fas fa-th-list',
//                            ]
//                        ],
//                    ]
//
//                );
//                return true;
//            }
//            $event->menu->add(
//                [
//                    [
//                        'text' => 'Abrir ticket',
//                        'url' => '/ticket/new',
//                        'icon' => 'fas fa-id-card',
//                    ],
//                    [
//                        'text' => 'Meus tickets',
//                        'url' => '/ticket/my',
//                        'icon' => 'fas fa-id-card',
//                    ],
//                ]
//            );
//
//        });
//
//    }
}

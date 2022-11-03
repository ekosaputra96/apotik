<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            if(auth()->user()->hasRole('owner')){
                $event->menu->addBefore('account_setting',[
                    'key' => 'main_navigation',
                    'header' => 'MAIN NAVIGATION'
                ]);
                $event->menu->addAfter('main_navigation', [
                    'key' => 'data_master',
                    'text' => 'Data Master',
                    'icon' => 'fas fa-fw fa-table'
                ]);
                $event->menu->addin('data_master', [
                    'key' => 'katalog_obat',
                    'text' => 'Katalog Obat',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-pills'
                ]);
                $event->menu->addin('data_master', [
                    'key' => 'stock_obat',
                    'text' => 'Stock Obat',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-cubes'
                ]);
                $event->menu->addin('data_master', [
                    'key' => 'data_pengeluran',
                    'text' => 'Data Pengeluaran',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-sort-amount-up-alt'
                ]);
                $event->menu->addin('data_master', [
                    'key' => 'data_penjualan',
                    'text' => 'Data Penjualan',
                    'url' => '#',
                    'icon' => 'fab fa-fw fa-sellsy'
                ]);
                $event->menu->addAfter('data_master', [
                    'key' => 'transaksi',
                    'text' => 'Transaksi',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-chart-pie'
                ]);
                $event->menu->addin('transaksi', [
                    'key' => 'penjualan_barang',
                    'text' => 'Penjualan Barang',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-chart-line'
                ]);
                $event->menu->addin('transaksi', [
                    'key' => 'belanja_barang',
                    'text' => 'Belanja Barang',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-cart-plus'
                ]);
                $event->menu->addin('transaksi', [
                    'key' => 'laporan_pembayaran',
                    'text' => 'Laporan Pembayaran',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-file-invoice'
                ]);
            }else if(auth()->user()->hasRole('gudang')){
                $event->menu->addBefore('account_setting',[
                    'key' => 'main_navigation',
                    'header' => 'MAIN NAVIGATION'
                ]);
                $event->menu->addAfter('main_navigation', [
                    'key' => 'katalog_obat',
                    'text' => 'Katalog Obat',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-pills'
                ]);
                $event->menu->addAfter('katalog_obat', [
                    'key' => 'stock_obat',
                    'text' => 'Stock Obat',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-warehouse'
                ]);
                $event->menu->addAfter('stock_obat', [
                    'key' => 'opname_barang',
                    'text' => 'Opname Barang',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-boxes'
                ]);
            }else if(auth()->user()->hasRole('kasir')){
                $event->menu->addBefore('account_setting',[
                    'key' => 'main_navigation',
                    'header' => 'MAIN NAVIGATION'
                ]);
                $event->menu->addAfter('main_navigation', [
                    'key' => 'stock_obat',
                    'text' => 'Stock Obat',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-warehouse'
                ]);
                $event->menu->addAfter('stock_obat', [
                    'key' => 'transaksi_penjualan',
                    'text' => 'Transaksi Penjualan',
                    'url' => '#',
                    'icon' => 'fas fa-fw fa-shopping-basket'
                ]);
            }else{
                return view('home');
            }
        });
    }
}

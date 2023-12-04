<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Pacient;
use mysql_xdevapi\Table;

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
        View::composer('home.womac', function ($view) {

            $result = DB::table('d_pacient')
                ->select('d_pacient.id as id_pacient', 'd_pacient.meno', 'd_pacient.priezvisko',
                    'd_operacia.id as id_operacia', 'd_operacia.sar_id', 'd_operacia.typ', 'd_operacia.subtyp')
                ->rightJoin('d_operacia','d_pacient.id', 'd_operacia.id_pac')
                ->rightJoin('')
                ->where('d_pacient.id', '>', '11100')
                ->orderBy('id_pacient')
                ->orderBy('typ')
                ->orderBy('subtyp')
             ->take(500)
             ->get();

            $dataPacient = [];
            foreach ($result as $row) {
                $dataPacient[$row->id_pacient]['id_pacient'] = $row->id_pacient;
                $dataPacient[$row->id_pacient]['meno'] = $row->meno;
                $dataPacient[$row->id_pacient]['priezvisko'] = $row->priezvisko;

                $dataPacient[$row->id_pacient]['operacia'] = [];

                $dataPacient[$row->id_pacient][$row->typ][$row->id_operacia]['id_operacia'] = $row->id_operacia;
                $dataPacient[$row->id_pacient][$row->typ][$row->id_operacia]['sar_id'] = $row->sar_id;
                $dataPacient[$row->id_pacient][$row->typ][$row->id_operacia]['typ'] = $row->typ;
                $dataPacient[$row->id_pacient][$row->typ][$row->id_operacia]['subtyp'] = $row->subtyp;



            }
//            $dataPacient = Pacient::with('operacie.womac')->get();
            $view->with('dataPacient', $dataPacient);
        });
    }
}

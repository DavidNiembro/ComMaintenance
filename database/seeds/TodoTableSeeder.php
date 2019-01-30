<?php

use Illuminate\Database\Seeder;
use App\Todo;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todo1 = new Todo();
        $todo1->title = 'Déblayer la neige';
        $todo1->description = 'Déblayer tout autour du bâtiment';
        $todo1->save();

        $todo2 = new Todo();
        $todo2->title = 'Nettoyer la caféteria';
        $todo2->description = 'Cafétaria au rez';
        $todo2->save();

        $todo3 = new Todo();
        $todo3->title = 'Charger les imprimantes';
        $todo3->description = 'Mettre des feuilles dans les imprimantes du bâtiment';
        $todo3->save();

        $todo4 = new Todo();
        $todo4->title = 'Fermer les portes à clées';
        $todo4->description = 'Passer dans chaque salle du bâtiment pour vérifier les portes';
        $todo4->save();
    }
}

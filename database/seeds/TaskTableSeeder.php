<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Todo;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todo1 = Todo::where('title', 'Déblayer la neige')->first();
        $todo2  = Todo::where('title', 'Nettoyer la caféteria')->first();
        $todo3  = Todo::where('title', 'Charger les imprimantes')->first();
        $todo4  = Todo::where('title', 'Fermer les portes à clées')->first();

        $task1 = new Task();
        $task1->title = 'Déblayer au Nord';
        $task1->description = '';
        $task1->fkTodo = $todo1->id;
        $task1->save();

        $task2 = new Task();
        $task2->title = 'Déblayer au Sud';
        $task2->description = '';
        $task2->fkTodo = $todo1->id;
        $task2->save();

        $task3 = new Task();
        $task3->title = 'Déblayer à l est';
        $task3->description = '';
        $task3->fkTodo = $todo1->id;
        $task3->save();

        $task4 = new Task();
        $task4->title = 'Déblayer à l ouest';
        $task4->description = '';
        $task4->fkTodo = $todo1->id;
        $task4->save();

        $task5 = new Task();
        $task5->title = 'Nettoyer les tables';
        $task5->description = '';
        $task5->fkTodo = $todo2->id;
        $task5->save();

        $task6 = new Task();
        $task6->title = 'Nettoyer les vitres';
        $task6->description = '';
        $task6->fkTodo = $todo2->id;
        $task6->save();

        $task7 = new Task();
        $task7->title = 'Nettoyer le sol';
        $task7->description = '';
        $task7->fkTodo = $todo2->id;
        $task7->save();

        $task8 = new Task();
        $task8->title = 'Mettre du papier';
        $task8->description = '';
        $task8->fkTodo = $todo3->id;
        $task8->save();

        $task9 = new Task();
        $task9->title = 'C332';
        $task9->description = '';
        $task9->fkTodo = $todo4->id;
        $task9->save();

        $task10 = new Task();
        $task10->title = 'C335';
        $task10->description = '';
        $task10->fkTodo = $todo4->id;
        $task10->save();
    }
}

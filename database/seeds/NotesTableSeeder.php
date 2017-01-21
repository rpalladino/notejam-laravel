<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::where(['email' => 'test@example.com'])->first();

        factory(App\Note::class, 50)->create([
            'user_id' => $user->id
        ]);
    }
}

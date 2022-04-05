<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Conversation::create([
            'user_one'=>1,
            'user_two'=>2
        ]);
        Conversation::create([
            'user_one'=>1,
            'user_two'=>3
        ]);
        Conversation::create([
            'user_one'=>1,
            'user_two'=>4
        ]);
        Conversation::create([
            'user_one'=>2,
            'user_two'=>3
        ]);
        Conversation::create([
            'user_one'=>2,
            'user_two'=>4
        ]);
        Conversation::create([
            'user_one'=>3,
            'user_two'=>4
        ]);
    }
}

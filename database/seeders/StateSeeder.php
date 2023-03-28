<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::factory()->create([
            'state'=>'Mymensingh'
        ]);
        State::factory()->create([
            'state'=>'Dhaka'
        ]);
        State::factory()->create([
            'state'=>'Sylhet'
        ]);
        State::factory()->create([
            'state'=>'Khulna'
        ]);
        State::factory()->create([
            'state'=>'Rongpur'
        ]);
        State::factory()->create([
            'state'=>'Borisal'
        ]);
        State::factory()->create([
            'state'=>'Chitagong'
        ]);
    }
}

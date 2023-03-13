<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = config('project');

        foreach ($projects as $project) {
            $new_project = new Project();
            $new_project->fill($project);
            $new_project->save();
        }
    }
}

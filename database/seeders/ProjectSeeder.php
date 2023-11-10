<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                "title" => "Progetto Prova 1",
                "description" => "Lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem",
                "thumb" => "https://imgs.search.brave.com/aUNyvZBXUulb963JH7KnQm9AMr8bcBoLsiHREOqayIU/rs:fit:612:612:1/g:ce/aHR0cHM6Ly9pNS53/YWxtYXJ0aW1hZ2Vz/LmNvbS9hc3IvOWZm/ZWYzMDMtMGZhYy00/OGRkLTg3ODctYzUy/NTk0MDk2ODAwXzEu/MTc1ZDk1Mjg2NzY0/OGEwOTczMTY2NGMy/MTE1NjNlYWIuanBl/Zz9vZG5XaWR0aD02/MTImb2RuSGVpZ2h0/PTYxMiZvZG5CZz1m/ZmZmZmY",
                "release_date" => "2023-06-02",
                "type" => "Html Project",
                "github_link" => "http://...",
                "public_link" => "http://...",
            ]
        ];

        foreach ($projects as $project) {
            $new_project = new Project();
            $new_project->title = $project['title'];
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->description = $project['description'];
            $new_project->thumb = $project['thumb'];
            $new_project->release_date = $project['release_date'];
            $new_project->type = $project['type'];
            $new_project->github_link = $project['github_link'];
            $new_project->public_link = $project['public_link'];
            //save data
            $new_project->save();
        }
    }
}

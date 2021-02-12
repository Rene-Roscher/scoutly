<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ($user = new \App\Models\User([
            'name' => 'Rene Roscher',
            'password' => Hash::make('r.roscher@r-services.eu'),
            'email' => 'r.roscher@r-services.eu',
            'email_verified_at' => now(),
        ]))->save();
        $user->refresh();
        $list = json_decode('[
        {
            "Name": "Necror",
            "Link": "https://necror.de/",
            "Interface": "Eigene Lösung",
            "Rechtsform": "GmbH",
            "Rechenzentren": "First-Colo & Maincubes",
            "logo":"https://necror.de/images/logo.png"
        }]');
        foreach ($list as $key => $data) {
            $arr = [
                'name' => $data->Name,
                'homepage' => $data->Link,
                'logo' => $data->logo,
                'datacenter' => $data->Rechenzentren,
                'legal' => $data->Rechtsform,
                'solution' => $data->Interface,
                'user_id' => $user->id,
            ];

            if (Str::startsWith('data:image/png;base64', $data->logo))
                $arr['logo'] = $data->logo;
            else {
                $name = substr($data->logo, strrpos($data->logo, '/') + 1);
                Storage::disk('public')->put($name = 'logos/'.\Ramsey\Uuid\Uuid::uuid4().'.'.$name, file_get_contents($data->logo));
                $arr['logo'] = Storage::url($name);
            };

            $organisation = new \App\Models\Organisation($arr);
            $organisation->save();
        }

        $perms = [];
        foreach (['user', 'organisation'] as $item) {
            foreach (['create', 'read', 'update', 'delete'] as $kind)
                (new \Spatie\Permission\Models\Permission([
                    'name' => $perms[] = $item.'.'.$kind,
                ]))->save();
        }
        $role = new \Spatie\Permission\Models\Role([
            'name' => 'super-admin',
        ]);
        $role->save();
        $role->syncPermissions($perms);
        $user->assignRole('super-admin');
    }
}

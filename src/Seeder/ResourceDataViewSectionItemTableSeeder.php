<?php

namespace Milestone\SS\Seeder;

use Illuminate\Database\Seeder;

class ResourceDataViewSectionItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $_ = \DB::statement('SELECT @@GLOBAL.foreign_key_checks');
        \DB::statement('set foreign_key_checks = 0');
        \Milestone\Appframe\Model\ResourceDataViewSectionItem::query()
            ->create([	'id' => '330101', 	'section' => '329101', 	'label' => 'Name', 	'attribute' => 'name', 												])
            ->create([	'id' => '330102', 	'section' => '329101', 	'label' => 'Status', 	'attribute' => 'status', 												])
            ->create([	'id' => '330103', 	'section' => '329102', 	'label' => 'Name', 	'attribute' => 'name', 												])
            ->create([	'id' => '330104', 	'section' => '329102', 	'label' => 'Status', 	'attribute' => 'status', 												])
            ->create([	'id' => '330105', 	'section' => '329103', 	'label' => 'Name', 	'attribute' => 'name', 												])
            ->create([	'id' => '330106', 	'section' => '329103', 	'label' => 'Default Value', 	'attribute' => 'value', 												])
            ->create([	'id' => '330107', 	'section' => '329103', 	'label' => 'Status', 	'attribute' => 'status', 												])
            ->create([	'id' => '330108', 	'section' => '329104', 		'attribute' => 'description', 												])
        ;
        \DB::statement('set foreign_key_checks = ' . $_);
    }
}

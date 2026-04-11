<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder {
    public function run(): void {
        $members = [
            ['name'=>'Olusegun Adeyemi','position'=>'Chief Executive Officer','department'=>'Executive','bio'=>'With over 15 years in Nigerian real estate, Olusegun has led SHEFAHOMES to become one of the most trusted names in the industry.','sort_order'=>1,'is_featured'=>true],
            ['name'=>'Amaka Okonkwo','position'=>'Chief Operating Officer','department'=>'Executive','bio'=>'Amaka oversees all operations ensuring every client receives world-class service and every property meets SHEFAHOMES premium standards.','sort_order'=>2,'is_featured'=>true],
            ['name'=>'Taiwo Abiodun','position'=>'Head of Sales','department'=>'Sales','bio'=>'Taiwo leads our high-performing sales team with expertise in matching clients with their perfect properties across Nigeria.','sort_order'=>3,'is_featured'=>true],
            ['name'=>'Funke Adeleke','position'=>'Head of Legal','department'=>'Legal','bio'=>'Funke ensures all our property titles are clean, registered and government approved, protecting every investment.','sort_order'=>4,'is_featured'=>true],
            ['name'=>'Emeka Nwosu','position'=>'Head of Construction','department'=>'Construction','bio'=>'Emeka oversees estate development ensuring premium quality construction and timely delivery of all projects.','sort_order'=>5,'is_featured'=>false],
            ['name'=>'Blessing Okafor','position'=>'Client Relations Manager','department'=>'Customer Service','bio'=>'Blessing ensures every SHEFAHOMES client feels valued and receives prompt support throughout their property journey.','sort_order'=>6,'is_featured'=>false],
        ];
        foreach($members as $m) TeamMember::firstOrCreate(['name'=>$m['name']], array_merge($m, ['photo'=>'team/placeholder.jpg','is_active'=>true]));
    }
}

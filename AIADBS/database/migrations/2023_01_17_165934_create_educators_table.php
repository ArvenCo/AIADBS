<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('department_id')->constrained('departments');
            $table->string('subjects',10000);
            $table->timestamps();
        });


        $data = array(
            'CCIS:College of Computing and Information Science' => 
                array('courses' => array('BSIT:Bachelor of Science in Information Technology',
                    'BSCS:Bachelor of Science in Computer Science',
                    'BLIS:Bachelor of Library and Information Science'),
                'subjects' => array('Programming 1', 'Programming 2', 'Programming 3', 'Programming 4', 'Programming 5', 'Programming 6','Programming 7','Programming 8','Programming 9','Programming 10'),
            ),
        );

        $data = array(
            'CCIS:College of Computing and Information Science' => array(
                'courses' => array(
                    'BSIT:Bachelor of Science in Information Technology',
                    'BSCS:Bachelor of Science in Computer Science',
                    'BLIS:Bachelor of Library and Information Science'
                    )
                
            ),
        );
        
        foreach($data as $key => $value){

            $department = explode(':', $key);
            $name = $department[1];
            $abbrev = $department[0];

            $dep_id = DB::table('departments')->insert([
                'name' => $name,
                'abbreviation' => $abbrev,
            ]);

            foreach($value as $key1 => $values){
                if ($key1 == 'courses'){
                    foreach ($values as $value1){
                        $course = explode(':', $value1);
                        $abbrev = $course[0];
                        $name = $course[1];
                        
                        DB::table('courses')->insert([
                            'name' => $name,
                            'abbreviation' => $abbrev,
                            'department_id' => $dep_id,
                        ]);
                    }
                    
                }else{
                    
                    foreach( $values as $value1){
                        DB::table('subjects')->insert([
                            'name' => $value1,
                            'department_id' => $dep_id
                        ]);
                    }
                    

                }
            }
        }        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educators');
    }
}

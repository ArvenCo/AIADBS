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
            $table->string('department_ids');
            $table->string('education_office');
            $table->string('subjects',10000);
            $table->timestamps();
        });

        // $data = array(
        //     'CCIS:College of Computing and Information Science' =>array(
        //         'courses' =>array(
        //             'BSIT:Bachelor of Science in Information Technology',
        //             'BSCS:Bachelor of Science in Computer Science',
        //             'BLIS:Bachelor of Library and Information Science'
        //         ),
        //         'subjects' => array(
        //             'Programming 1', 'Programming 2', 'Programming 3', 
        //             'Programming 4', 'Programming 5', 'Programming 6',
        //             'Programming 7','Programming 8','Programming 9',
        //             'Programming 10'
        //         ),
        //         'education_office' => 'CHED'
                
        //     ),
        // );

        $data = array(
            'CCIS:College of Computing and Information Science' => array(
                'courses' => array(
                    'BSIT: Bachelor of Science in Information Technology',
                    'BSCS: Bachelor of Science in Computer Science',
                    'BLIS: Bachelor of Library and Information Science'
                ),
                'education_office' => 'College'
            ),
            'CAS: College of Arts and Sciences' => array(
                'courses' => array(
                    'AB English: Bachelor of Arts major in English Language'
                ),
                'education_office' => 'College'
            ),
            'CCJE: College of Criminal Justice Education' => array(
                'courses' => array(
                    'Bachelor of Science in Industrial Security Management',
                    'BSCrim: Bachelor of Science in Criminology'
                ),
                'education_office' => 'College'
            ),
            'CTE: College of Teacher Education' => array(
                'courses' => array(
                    'BEED: Bachelor of Elementary Education',
                    'BSEd English: Bachelor of Secondary Education major in English',
                    'BSEd Science: Bachelor of Secondary Education major in Science',
                    'BSEd Soc Stud: Bachelor of Secondary Education major in Social Studies',
                    'BPEd: Bachelor of Physical Education',
                    'BTVTE: Bachelor of Technical Vocational Teacher Education',
                    'Bachelor of Early Childhood Education'
                ),
                'education_office' => 'College'
            ),
            'CTHBAM: College of Tourism, Hospitality, Business and Management' => array(
                'courses' => array(
                    'BSBA FM: Bachelor of Science in Business Administration major in Financial Management',
                    'BSBA HRM: Bachelor of Science in Business Administration major in Human Resource Management',
                    'BSBA MM: Bachelor of Science in Business Administration major in Marketing Management',
                    'BSHM: Bachelor of Science in Hospitality Management',
                    'BPA: Bachelor of Public Administration',
                    'BSE: Bachelor of Science in Entrepreneurship',
                    'BSTM: Bachelor of Science in Tourism Management'
                ),
                'education_office' => 'College'
            ),
            'TED: Technical Education Department' => array(
                'courses' => array(
                    'Diploma in Hospitality Management Technology',
                    'Diploma in Tourism Management Technology',
                    'Diploma in Information Technology',
                    'Ship\'s Catering Services NC I',
                    'Food and Beverage Services NC II',
                    'Housekeeping NC II'
                ),
                'education_office' => 'College'
            )
        );
        

        foreach($data as $key => $value){

            $department = explode(':', $key);
            $name = $department[1];
            $abbrev = $department[0];
            $dep_id = DB::table('departments')->insertGetId([
                'name' => $name,
                'abbreviation' => $abbrev,
                'education_office' => $value['education_office'],
            ]);
            
            foreach($value as $key1 => $values){
                if ($key1 == 'courses'){
                    foreach ($values as $value1){
                        $course = explode(':', $value1);
                        $abbrev =count($course) > 1 ? $course[0] : null;
                        $name =count($course) > 1 ? $course[1] : $course[0];
                        
                        DB::table('courses')->insert([
                            'name' => $name,
                            'abbreviation' => $abbrev,
                            'department_id' => $dep_id,
                        ]);
                    }
                    
                }elseif($key1 == 'subjects'){
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

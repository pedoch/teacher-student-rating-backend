<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use App\Role;
use App\Rating;
use App\Teacher;
use App\Student;
use App\Section;
use App\Question;
use App\Department;
use App\StudentRatingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function fetchAllSections(){
        $allSections = Section::all();
        return response()->json($allSections);
    }
    public function fetchAllQuestions(){
        $allQuestions = Question::all();
        return response()->json($allQuestions);
    }

    public function fetchEvaluationQuestions(){
        $evaluation = [];
        $allSections = Section::all();
        $i=0;
        foreach($allSections as $section){
            $questions = Question::where('section_id', '=', $section->id)->get();
            $evaluation[$i] = [
                'questions'=> $questions,
                'section'=> $section
            ];
            $i++;
        }
        return response()->json($evaluation);
    }
    public function fetchAllDepatments(){
        $allDepartments = Department::all();
        return response()->json($allDepartments);
    }
    public function addNewTeacher(Request $request){
        $data = $request->all();
        $rules = [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|string|email',
            'department'=>'required|integer',
            'gender'=>'required|integer'
        ];
        $validators = Validator::make($data, $rules);
        if($validators->fails()){
            return response()->json([
                'status'=>'500',
                'response'=>$validators->errors()
            ]);
        }
        if($request->hasFile('image')) {
            $file = $request->File('image');
            //Get filename with extension
            $fileNameToStoreWithExt = $file[0]->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameToStoreWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $file[0]->getClientOriginalExtension();
            //File to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $file[0]->storeAs('teacher', $fileNameToStore);
            $file[0]->move('storage/teacher',$fileNameToStore);
            $user = User::create([
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'role'=>Role::$T,
                'email'=>$data['email'],
                'password'=>'password',
                'image_path'=> $path
            ]);
            $teacher = Teacher::create([
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'teacher_id'=> 'Tch/'.$user->id,
                'gender'=>$data['gender'],
                'email'=>$data['email'],
                'user_id'=> $user->id,
                'department_id'=> $data['department'],
            ]);
            return response()->json([
                'status'=> '200',
                'response'=> 'successfully added teacher'
            ]);
        }
        return response()->json('success');
    }
    public function addNewStudent(Request $request){
        $data = $request->all();
        $rules = [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|string|email',
            'department'=>'required|integer',
            'gender'=>'required|integer'
        ];
        $validators = Validator::make($data, $rules);
        if($validators->fails()){
            return response()->json([
                'status'=>'500',
                'response'=>$validators->errors()
            ]);
        }
        if($request->hasFile('image')) {
            $file = $request->File('image');
            //Get filename with extension
            $fileNameToStoreWithExt = $file[0]->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameToStoreWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $file[0]->getClientOriginalExtension();
            //File to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $file[0]->storeAs('teacher', $fileNameToStore);
            $file[0]->move('storage/teacher',$fileNameToStore);
            $user = User::create([
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'role'=>Role::$S,
                'email'=>$data['email'],
                'password'=>'password',
                'image_path'=> $path
            ]);
            $student = Student::create([
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'matric_no'=> 'Stud/'.$user->id,
                'gender'=>$data['gender'],
                'email'=>$data['email'],
                'user_id'=> $user->id,
                'department_id'=> $data['department'],
            ]);
            return response()->json([
                'status'=> '200',
                'response'=> 'successfully added student'
            ]);
        }
        return response()->json('success');
    }
    public function getAllTeachers(Request $request){
        $teachers = Teacher::all();
        $allDetails = [];
        $i=0;
        foreach($teachers as $teacher){
            $department = Department::where('id', $teacher->department_id)->first();
            $user = User::where('id', $teacher['user_id'])->first();
            $allDetails[$i] = [
                'profile'=>$teacher,
                'department'=>$department
            ];
            $allDetails[$i]['profile']['image_path']=$user->image_path;
            $i++;
        }
        return response()->json($allDetails);
    }
    public function getDepartmentTeachers($user_id, $type){
        $user = [];
        if($type == 'student'){
            $user = Student::where('user_id', $user_id)->first();
        }
        $teachers = Teacher::where('department_id', $user['department_id'])->get();
        $allDetails = [];
        $i=0;
        foreach($teachers as $teacher){
            if(is_null(Rating::where('teacher_id', $teacher['id'])->where('student_id', $user['id'])->first())){
                $department = Department::where('id', $teacher->department_id)->first();
                $user = User::where('id', $teacher['user_id'])->first();
                $allDetails[$i] = [
                    'profile'=>$teacher,
                    'department'=>$department
                ];
                $allDetails[$i]['profile']['image_path']=$user->image_path;
                $i++;
            }
        }
        return response()->json($allDetails);
    }
    public function getRatedDepartmentTeachers($user_id, $type){
        $user = [];
        if($type == 'student'){
            $user = Student::where('user_id', $user_id)->first();
        }
        $teachers = Teacher::where('department_id', $user['department_id'])->get();
        $allDetails = [];
        $i=0;
        foreach($teachers as $teacher){
            if(!is_null(Rating::where('teacher_id', $teacher['id'])->where('student_id', $user['id'])->first())){
                $department = Department::where('id', $teacher->department_id)->first();
                $user = User::where('id', $teacher['user_id'])->first();
                $allDetails[$i] = [
                    'profile'=>$teacher,
                    'department'=>$department
                ];
                $allDetails[$i]['profile']['image_path']=$user->image_path;
                $i++;
            }
        }
        return response()->json($allDetails);
    }
    public function getTeacherInfo($id){
        $teacher = Teacher::where('id', $id)->first();
        $allDetails = [];
        $department = Department::where('id', $teacher->department_id)->first();
        $user = User::where('id', $teacher['user_id'])->first();
        $allDetails = [
            'profile'=>$teacher,
            'department'=>$department
        ];
        $allDetails['profile']['image_path']=$user->image_path;
        return response()->json($allDetails);
    }
    public function getAllStudents(){
        $students = Student::all();
        $allDetails = [];
        $i=0;
        foreach($students as $student){
            $department = Department::where('id', $student->department_id)->first();
            $user = User::where('id', $student['user_id'])->first();
            $allDetails[$i] = [
                'profile'=>$student,
                'department'=>$department
            ];
            $allDetails[$i]['profile']['image_path']=$user->image_path;
            $i++;
        }
        return response()->json($allDetails);
    }
    public function getDepartmentStudents(){
        $students = Student::all();
        $allDetails = [];
        $i=0;
        foreach($students as $student){
            $department = Department::where('id', $student->department_id)->first();
            $user = User::where('id', $student['user_id'])->first();
            $allDetails[$i] = [
                'profile'=>$student,
                'department'=>$department
            ];
            $allDetails[$i]['profile']['image_path']=$user->image_path;
            $i++;
        }
        return response()->json($allDetails);
    }
    public function addNewDepartment(Request $request){
        $data = $request->all();
        $rule = [
            'name'=>'required'
        ];
        $validators = Validator::make($data, $rule);
        if($validators->fails()){
            return response()->json([
                'status'=>'500',
                'response'=>$validators->errors()
            ]);
        }
        $department = Department::where('name', $data['name'])->first();
        if($department){
            return response()->json([
                'status'=>'500',
                'response'=>'Department already exists'
            ]);
        }
        Department::create([
            'name'=>$data['name']
        ]);
        return response()->json([
            'status'=>'200',
            'response'=>'successfully created department'
        ]);
    }
    public function deleteDepartment(Request $request){
        $data = $request->all();
        if(Student::where('department_id', $data['id'])->first()){
            $students = Student::where('department_id', $data['id'])->get();
            foreach($students as $student){
                Student::where('department_id', $data['id'])->delete();
                $this->deleteImage($student);
            }
        }
        if(Teacher::where('department_id', $data['id'])->first()){
            $teachers = Teacher::where('department_id', $data['id'])->get();
            foreach($teachers as $teacher){
                Teacher::where('department_id', $data['id'])->delete();
                $this->deleteImage($teacher);
            }
        }
        Department::where('id', $data['id'])->delete();
        return response()->json('successfully deleted department');
    }
    public function addNewCourse(Request $request){
        $data=$request->all();
        $dep_code;
        $department = Department::where('id', $data['department_id'])->first();
        while(true){
            $dep_code = $this->getDepartmentCode($department->name) . rand(100, 600);
            if(!Course::where('course_code', $dep_code)->first()){
                break;
            }
        }
        $new_course = new Course();
        $new_course->name = $data['name'];
        $new_course->course_code = $dep_code;
        $new_course->department_id = $data['department_id'];
        if(isset($data['teacher_id'])){
            $new_course->teacher_id = $data['teacher_id'];
        }
        $new_course->save();
        return response()->json('Course created');
    }
    public function enableDisableRating(Request $request){
        $data = $request->all();
        Department::where('id', $data['id'])->update([
            'rating_activation'=> $data['rating_activation']
        ]);
        return response()->json('Rating enabled');
    }
    public function enableAllRating(){
        DB::table('departments')->update(['rating_activation'=>1]);
        return response()->json('All courses can be rated now');
    }
    public function disableAllRating(){
        DB::table('departments')->update(['rating_activation'=>0]);
        return response()->json('No course can be rated anymore');
    }
    public function getAllCourses(){
        $all_courses = Course::all();
        if(count($all_courses) > 0){
            $lists = [];
            $i = 0;
            foreach($all_courses as $course){
                $department = Department::where('id', $course['department_id'])->first();
                if($course['teacher_id'] == NULL){
                    $lists[$i] = [
                        'course'=> $course,
                        'department'=>$department,
                        'teacher'=>[]
                    ];
                    $i++;
                }else{
                    $teacher = Teacher::where('id', $course['teacher_id'])->first();
                    $lists[$i] = [
                        'course'=> $course,
                        'department'=>$department,
                        'teacher'=>$teacher
                    ];
                    $i++;
                }
            }
            return response()->json($lists);
        }
        return response()->json([]);
    }
    public function updateCourse(Request $request){
        $data = $request->all();
        if(isset($data['teacher_id'])){
            Course::where('course_code', $data['course_code'])->update([
                'name'=>$data['name'],
                'teacher_id'=>$data['teacher_id'],
                'department_id'=>$data['department_id'],
            ]);
        }
        Course::where('course_code', $data['course_code'])->update([
            'name'=>$data['name'],
            'department_id'=>$data['department_id'],
        ]);
        $course = Course::where('course_code', $data['course_code'])->first();
        $department = Department::where('id', $course['department_id'])->first();
        $list = [];
        if($course['teacher_id'] == NULL){
            $lists = [
                'course'=> $course,
                'department'=>$department,
                'teacher'=>[]
            ];
        }else{
            $teacher = Teacher::where('id', $course['teacher_id'])->first();
            $lists = [
                'course'=> $course,
                'department'=>$department,
                'teacher'=>$teacher
            ];
        }
        return response()->json([
            'response'=>'course updated',
            'data'=>$lists
        ]);
    }
    public function enrollForCourse(Request $request){
        $data = $request->all();
        $student = Student::where('user_id', User::where('id', $data['user_id'])
                                            ->first()['id'])->first();
        foreach($data['courses'] as $c){
            $course = Course::where('course_code', $c['course_code'])->first();
            $course_list = CourseList::where('course_id', $course['id'])->where('student_id', $student['id'])->first();
            if(!$course_list){
                $course = CourseList::create([
                    'course_id'=>$course['id'],
                    'student_id'=>$student['id']
                ]);
            }
        }
        return response()->json([
            'status'=>'200',
            'response'=>'successfully enrolled for the selected courses',
        ]);
    }
    public function getCourseInfo($course_code){
        $course = Course::where('course_code', $course_code)->first();
        $department = Department::where('id', $course['id'])->first();
        $teacher = Teacher::where('id', $course['teacher_id'])->first();
        $user = User::where('id', $teacher['user_id'])->first();
        $data=[
            'course'=>$course,
            'department'=>$department,
            'teacher'=> $teacher ? $teacher : [],
            'user'=> $user
        ];
        return response()->json($data);
    }
    public function unEnrollForCourse(Request $request){
        $data = $request->all();
        $student = Student::where('user_id', User::where('id', $data['user_id'])
                                            ->first()['id'])->first();
        foreach($data['courses'] as $c){
            $course = Course::where('course_code', $c['course_code'])->first();
            $course_list = CourseList::where('course_id', $course['id'])->where('student_id', $student['id'])->delete();
        }
        return response()->json([
            'status'=>'200',
            'response'=>'successfully unenrolled for the selected courses',
        ]);
    }
    public function getAllEnrolledCourses($id){
        $user = User::where('id', $id)->first();
        $student = Student::where('user_id', $user['id'])->first();
        $course_list = CourseList::where('student_id', $student['id'])->get();
        if(count($course_list)>0){
            $list=[];$i=0;
            foreach($course_list as $course){
                $_course = Course::where('id', $course['course_id'])->first();
                $_teacher = Teacher::where('id', $_course['teacher_id'])->first() ?
                                    Teacher::where('id', $_course['teacher_id'])->first() : [];
                $_department = Department::where('id', $_course['department_id'])->first();
                $list[$i] = [
                    'info'=> $course,
                    'course'=> $_course,
                    'teacher'=> $_teacher,
                    'department'=> $_department
                ];
                $i++;
            }
            return response()->json([
                'status'=>'200',
                'data'=>$list
            ]);
        }
        return response()->json([
            'status'=>'500',
            'data'=>[]
        ]);
    }
    public function getAllUnEnrolledCourses($id){
        $user = User::where('id', $id)->first();
        $student = Student::where('user_id', $user['id'])->first();
        $course_list = CourseList::where('student_id', $student['id'])->get();
        $list=[];
        if(count($course_list)){
            $allCourses = Course::all();
            $i=0;
            for($i=0;$i<count($allCourses)-1;$i++){
                $isEnrolled = false;
                for($j=0;$j<count($course_list)-1;$j++){
                    if($course_list[$j]['course_id'] == $allCourses[$i]['id']){
                        $isEnrolled = true;
                    }
                }
                if($isEnrolled ==false){
                    $teacher = Teacher::where('id', $allCourses[$i]['teacher_id'])->first();
                    $department = Department::where('id', $allCourses[$i]['department_id'])->first();
                    $list[$i] = [
                        'course'=>$allCourses[$i],
                        'teacher'=> $teacher ? $teacher : [],
                        'department'=> $department ? $department : []
                    ];
                    $i++;$isEnrolled = false;
                }
            }
            return response()->json($list);
        }
        return response()->json($list);
    }
    public function rateTeacher($student_id, $teacher_id, Request $request){
        $data =  $request->all();
        foreach ( $data as $rating){
            $is_rated = Rating::where('question_id', $rating['question_id'])->where('student_id', $student_id)
            ->where('teacher_id', $teacher_id)->first();
            if($is_rated){
                Rating::where('question_id', $rating['question_id'])->where('student_id', $student_id)
                        ->where('teacher_id', $teacher_id)->update([
                        'value'=>$rating['answer']
                ]);
            }else{
                Rating::create([
                    'question_id'=>$rating['question_id'],
                    'student_id'=>$student_id,
                    'teacher_id' => $teacher_id,
                    'value'=>$rating['answer']
                ]);
            }
            $ha_r = StudentRatingStatus::where('student_id', $student_id)->where('teacher_id',  $teacher_id)->first();
            if(is_null($ha_r)){
                StudentRatingStatus::create([
                    'student_id'=>$student_id,
                    'teacher_id' => $teacher_id,
                    'status'=> 'progress'
                ]);
            }else{
                $quest = Question::latest()->first();
                $has = Rating::where('question_id', $quest['id'])->where('student_id', $student_id)
                        ->where('teacher_id', $teacher_id)->first();
                if($has){
                    StudentRatingStatus::where('student_id', $student_id)->where('teacher_id',  $teacher_id)->update([
                        'status'=> 'finished'
                    ]);
                }
            }
        }
        return response()->json([
            'student_id'=> $student_id,
            'data' => $request->all()
        ]);
    }
    public function getTeachersAssessment($id){
        $data = [];
        $data[0] = Teacher::where('user_id', $id)->first();
        $data[1] = Rating::where('teacher_id', $data[0]['id'])->get();
        if(is_null($data[1])){
            return response()->json([
                'status'=>'500',
                'response'=>'No rating available'
            ], 200);
        }else if(is_null($data[0])){
            return response()->json([
                'status'=>'500',
                'response'=>'Teacher not found'
            ], 200);
        }
        $mappedData = [
            [
                'name' => 'Teaching methodology',
                'data' => [],
                'max'=> Section::where('title', 'Teaching methodology')->first()['rate_max']
            ],
            [
                'name' => 'Assessment procedures',
                'data' => [],
                'max'=> Section::where('title', 'Assessment procedures')->first()['rate_max']
            ],
            [
                'name' => 'Integration of faith/christian concepts/values in teaching',
                'data' => [],
                'max'=> Section::where('title', 'Integration of faith/christian concepts/values in teaching')->first()['rate_max']
            ],
            [
                'name' => 'Classroom management',
                'data' => [],
                'max'=> Section::where('title', 'Classroom management')->first()['rate_max']
            ],
            [
                'name' => 'Teachers attendance and punctuality',
                'data' => [],
                'max'=> Section::where('title', 'Teachers attendance and punctuality')->first()['rate_max']
            ]
        ];
        foreach($data[1] as $d){
            foreach($data[1] as $d){
                $section_id = Question::where('id', $d['question_id'])->first()['section_id'];
                $section = Section::where('id', $section_id)->first();
                for($i=0;$i<count($mappedData);$i++){
                    $ret = $mappedData[$i];
                    if($section['title'] == $ret['name']){
                        array_push($ret['data'], $d['value']);
                        // return response()->json([
                        //     'status'=>'200',
                        //     'response'=>count($ret['data'])
                        // ],200);
                        $mappedData[$i]['data'] = $ret['data'];
                    }
                }
            }
        }
        $i=0;
        foreach($mappedData as $list){
            $mappedData[$i]['data'] = (array_sum($list['data'])/count($list['data'])) * 100;
            $i++;
        }
        return response()->json([
            'status'=>'200',
            'response'=>$mappedData
        ],200);
    }
    public function getTeachersAssessmentWithTeacherId($id){
        $data = [];
        $data[0] = Teacher::where('id', $id)->first();
        $data[1] = Rating::where('teacher_id', $data[0]['id'])->get();
        if(is_null($data[1])){
            return response()->json([
                'status'=>'500',
                'response'=>'No rating available'
            ], 200);
        }else if(is_null($data[0])){
            return response()->json([
                'status'=>'500',
                'response'=>'Teacher not found'
            ], 200);
        }
        $mappedData = [
            [
                'name' => 'Teaching methodology',
                'data' => [],
                'max'=> Section::where('title', 'Teaching methodology')->first()['rate_max']
            ],
            [
                'name' => 'Assessment procedures',
                'data' => [],
                'max'=> Section::where('title', 'Assessment procedures')->first()['rate_max']
            ],
            [
                'name' => 'Integration of faith/christian concepts/values in teaching',
                'data' => [],
                'max'=> Section::where('title', 'Integration of faith/christian concepts/values in teaching')->first()['rate_max']
            ],
            [
                'name' => 'Classroom management',
                'data' => [],
                'max'=> Section::where('title', 'Classroom management')->first()['rate_max']
            ],
            [
                'name' => 'Teachers attendance and punctuality',
                'data' => [],
                'max'=> Section::where('title', 'Teachers attendance and punctuality')->first()['rate_max']
            ]
        ];
        foreach($data[1] as $d){
            foreach($data[1] as $d){
                $section_id = Question::where('id', $d['question_id'])->first()['section_id'];
                $section = Section::where('id', $section_id)->first();
                for($i=0;$i<count($mappedData);$i++){
                    $ret = $mappedData[$i];
                    if($section['title'] == $ret['name']){
                        array_push($ret['data'], $d['value']);
                        // return response()->json([
                        //     'status'=>'200',
                        //     'response'=>count($ret['data'])
                        // ],200);
                        $mappedData[$i]['data'] = $ret['data'];
                    }
                }
            }
        }
        $i=0;
        foreach($mappedData as $list){
            $mappedData[$i]['data'] = (array_sum($list['data'])/count($list['data'])) * 100;
            $i++;
        }
        return response()->json([
            'status'=>'200',
            'response'=>$mappedData
        ],200);
    }
    public function finishRatingCourse(Request $request){
        $data = $request->all();
        $student = Student::where('user_id', $data['user_id'])->first();
        $course = Course::where('course_code', $data['course_code'])->first();
        CourseList::where('course_id', $course['id'])->where('student_id', $student['id'])->update([
            'is_rated'=>TRUE
        ]);
        return response()->json('Thank you for evaluating!');
    }
    private function getDepartmentCode($department){
        $str = str_split($department, 3);
        return $str[0];
    }
    private function deleteImage($path){
        $__dir = '/storage/';
        $image_path = public_path().$__dir.$path;
        unlink($image_path);
    }
}

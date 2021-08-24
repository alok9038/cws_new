<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDO;

class CourseController extends Controller
{
    public function viewCourse(){
        if(Auth::user()->user_type !== 'admin'){
            return redirect()->route('login');
        }
        $data['courses'] = Course::orderBy('id','desc')->get();
        return view('admin.course',$data);
    }

    public function addCourse(){
        if(Auth::user()->user_type !== 'admin'){
            return redirect()->route('login');
        }
        return view('admin.createCourse');
    }

    public function storeCourse(Request $request){
        if(Auth::user()->user_type !== 'admin'){
            return redirect()->route('login');
        }
        $request->validate([
            'title' => 'required',
            'discount_price' => 'required',
            'image' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'course_type' => 'required',
        ]);
        $slug = Str::slug($request->title,'-');

        $image = time() ."-". $slug . "." . $request->image->extension();
        $request->image->move(public_path("assets/images/course"),$image);

        $course = new Course();
        $course->title = $request->title;
        $course->price = $request->price;
        $course->discount_price = $request->discount_price;
        if($request->hasFile('banner_image')){
            $banner = time() ."-". $slug . "." . $request->banner_image->extension();
            $request->banner_image->move(public_path("assets/images/course/banner"),$banner);
            $course->banner_image = $banner;
        }
        $course->image = $image;
        $course->description = $request->description;
        $course->duration = $request->duration;
        $course->course_type = $request->course_type;
        $course->featured = $request->featured;
        $course->slug = $slug;
        $course->save();

        return redirect()->route('view.courses')->with('success_msg','Course Successfully Added!');
    }

    public function edit($id){
        $data['course'] = Course::where('id',$id)->first();
        return view('admin.edit_course',$data);
    }

    public function updateCourse(Request $request){
        if(Auth::user()->user_type !== 'admin'){
            return redirect()->route('login');
        }
        $request->validate([
            'title' => 'required',
            'discount_price' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'course_type' => 'required',
        ]);


        $slug = Str::slug($request->title,'-');

        $course = Course::where('id',$request->course_id)->first();
        $course->title = $request->title;
        $course->price = $request->price;
        $course->discount_price = $request->discount_price;
        if($request->hasFile('banner_image')){
            $banner = time() ."-". $slug . "." . $request->banner_image->extension();
            $request->banner_image->move(public_path("assets/images/course/banner"),$banner);
            $course->banner_image = $banner;
        }
        if($request->hasFile('image')){
            $image = time() ."-". $slug . "." . $request->image->getClientOrignalName();
            $request->image->move(public_path("assets/images/course"),$image);
            $course->image = $image;
        }
        $course->description = $request->description;
        $course->duration = $request->duration;
        $course->course_type = $request->course_type;
        $course->featured = $request->featured;
        $course->save();

        toast('Course Updated!','success');
        return redirect()->route('view.courses');
    }

    public function dropCourse(Request $request){
        $id = $request->course_id;
        $count = Course::where('id',$id)->count();

        if($count == 1){
            Course::where('id',$id)->delete();
            return redirect()->back()->with('success_msg','Course Successfully Deleted!');
        }else{
            return redirect()->back()->with('error_msg','Something Went Wrong!');
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
//        $users = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/users"));
//        $users = Http::get("https://jsonplaceholder.typicode.com/users")->json();
        $users = DB::select('select * from users where user_id > ? and user_id < ?', [2, 8]);

        $data = [
            'user_id_first' => 2,
        ];

        $users = DB::select('select * from users where user_id > :user_id_first', $data);

//        $create_user = [
//           'user_name' => 'Marta',
//           'age' => 40,
//           'phone' => '+138085456224',
//        ];
//
//        dump(DB::insert('insert into users(user_name, age, phone) values(:user_name, :age, :phone)', $create_user));

//        $update_users = [
//            'user_name' => 'Olha',
//            'age' => 11,
//            'user_id' => 3
//        ];
//
//        dump(DB::update('update users set user_name = :user_name, age = :age where user_id = :user_id',
//            $update_users));

//        dump(DB::delete('delete from users where user_id=?', [15]));



//        try {
//            DB::transaction(function (){
//                DB::insert('insert into users(user_name, age, phone) values(?, ?, ?)', ['Bob', 31, '+380996663355']);
//                DB::insert('insert into users(user_name, age, phone) values(?, ?, ?)', ['Bob', 31, '+380996663355']);
//            });
//        }catch(\Exception $exception){
//            dump($exception->getMessage());
//        }

        try {
            DB::beginTransaction();

            DB::insert('insert into users(user_name, age, phone) values(?, ?, ?)', ['Bob', 31, '+380996663355']);
            DB::insert('insert into users(user_name, age, phone) values(?, ?, ?)', ['Bob', 31, '+380996663355']);

            DB::commit();
        }catch(\Exception $exception){
            DB::rollBack();
            dump($exception->getMessage());
        }


        $title = 'Home page';
        return view('home.index', compact('users', 'title'));
    }

    public function contacts()
    {
        $title = 'Contacts page';
        return view('home.contacts', ['title' => $title]);
    }
}

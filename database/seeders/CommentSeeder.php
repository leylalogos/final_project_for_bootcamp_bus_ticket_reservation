<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            ['title' => 'شرکت ماهان', 'content' => 'سایت بسیار خوبیه من هیچ کونه مشکلی نداشتم', 'user_id' => 8],
            ['title' => 'شرکت ماهان', 'content' => ' بخش پرداخت بسیار امن میباشد', 'user_id' => 8],
            ['title' => 'شرکت سیر و سفر', 'content' => 'شرکت سیر سفر به عنوان مشتری قدیمی این شرکت می باشد', 'user_id' => 9],
            ['title' => 'شرکت لوان', 'content' => '  لوان با مستر بلیط میتونه یه گزینه عالی باشه     ', 'user_id' => 10],

        ];
        if (Comment::count() == 0) {
            foreach ($comments as $comment) {
                Comment::create($comment);
            }
        }
    }
}

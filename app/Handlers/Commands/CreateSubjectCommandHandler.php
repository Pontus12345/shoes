<?php
namespace App\Handlers\Commands;

use DB;
use DateTime;
use App\Commands\CreateSubjectCommand;
use Illuminate\Queue\InteractsWithQueue;

class CreateSubjectCommandHandler
{
    public function __construct()
    {
        //
    }

    public function handle(CreateSubjectCommand $command)
    {
        $this->insertsubject($command);
        $this->insertqty($command);

        DB::table('postsubject')->join(
            'subjects', 'post_id', '=', 'post_id'
        )->get();
        
        $CreateSub = DB::table('postsubject')->insert([
            'post_name' => $command->name,
            'post_content' => $command->text,
            'post_date' => $this->getDate(),
            'post_by' => session('username'),
            'cat_page' => $command->post_cat_id
        ]);
        
        return $CreateSub;
    }

    public function insertsubject(CreateSubjectCommand $command)
    {
        $t_CreateSubi = DB::table('subjects')->insert([
            'subjects_name' => $command->name,
            'subjects_date' => $this->getDate(),
            'sub_cat_id' => $command->post_cat_id,
            'subjects_username' => session('username'),
            'subject_post_content' => $command->text
        ]);
        
        return $t_CreateSubi;
    }

    public function insertqty(CreateSubjectCommand $command)
    {
        $t_oForum_cats = DB::table('forum_cat')->get();
        
        foreach ($t_oForum_cats as $v_oForum_cat) {
            
            if ($v_oForum_cat->Forum_cat_id == $command->post_cat_id) {
                
                $iGetqty = $v_oForum_cat->forum_qty += 1;
                
                DB::table('forum_cat')->where(
                    'Forum_cat_id', "=", $command->post_cat_id
                )->update(['forum_qty' => $iGetqty]);
            }
        }
    }

    private function getDate()
    {
        $date = new DateTime();
        $date->format('Y-m-d H:i:s');
        
        return $date;
    }
}

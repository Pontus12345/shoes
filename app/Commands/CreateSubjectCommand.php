<?php
namespace App\Commands;

use DB;
use DateTime;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateSubjectCommand extends Command
{
    public $name;
    public $text;
    public $post_cat_id;

    public function __construct($v1_name, $v2_text, $v3_postCatId)
    {
        $this->name = $v1_name;
        $this->text = $v2_text;    
    	$this->post_cat_id = $v3_postCatId;
    }

    public function handle()
    {
        $this->insertsubject();
        $this->insertqty();

        DB::table('postsubject')->join(
            'subjects', 'post_id', '=', 'post_id'
        )->get();
        
        $CreateSub = DB::table('postsubject')->insert([
            'post_name' => $this->name,
            'post_content' => $this->text,
            'post_date' => $this->getDate(),
            'post_by' => session('username'),
            'cat_page' => $this->post_cat_id
        ]);
        
        return $CreateSub;
    }

    public function insertsubject()
    {
        $t_CreateSubi = DB::table('subjects')->insert([
            'subjects_name' => $this->name,
            'subjects_date' => $this->getDate(),
            'sub_cat_id' => $this->post_cat_id,
            'subjects_username' => session('username'),
            'subject_post_content' => $this->text
        ]);
        
        return $t_CreateSubi;
    }

    public function insertqty()
    {
        $t_oForum_cats = DB::table('forum_cat')->get();
        
        foreach ($t_oForum_cats as $v_oForum_cat) {
            
            if ($v_oForum_cat->Forum_cat_id == $this->post_cat_id) {
                
                $iGetqty = $v_oForum_cat->forum_qty += 1;
                
                DB::table('forum_cat')->where(
                    'Forum_cat_id', "=", $this->post_cat_id
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

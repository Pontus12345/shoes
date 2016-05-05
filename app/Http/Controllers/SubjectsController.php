<?php
namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalController;
use App\Http\Requests\CreatesubjectRequest;
use App\Commands\CreateSubjectCommand;
use App\Http\Requests\ReplyRequest;

class SubjectsController extends GlobalController
{
    private $sHostname;


    public function __construct()
    {
        if (!session('user_id')) return abort(401); 
        
        return $this->sHostname = \Request::server('HTTP_HOST');
    }

    private function getDate() 
    {
        return new \DateTime();
    }

    private function Auth() 
    {   
        return (!session('username')) ? back() : Null;
    }

    public function ForumView()
    {
        $get_forums = DB::table('forum_cat')->groupBy(
            'Forum_cat_name'
        )->orderBy('Forum_cat_id', 'DESC')->get();
        
        return View('Runningshoes/pages/forum/Forum')->with([
            'forum_cats' => $get_forums,
            'sHostname' => $this->sHostname
        ]);
    }

    public function showSubjectsID($v_id)
    {
        $t_oPostsubjects = DB::table('subjects')->join(
            'forum_cat', 'sub_cat_id', '=', 'Forum_cat_id'
        )->where("Forum_cat_name","=", $v_id)->orderBy(
            'subjects_id', 'DESC'
        )->get();
        
        $v_oPostsubject = (count($t_oPostsubjects) === 0) ? 
            redirect("http://$this->sHostname/Forum/create/Subjects")
             : View('Runningshoes/pages/forum/Forumid')->with([
                'postsubjects' => $t_oPostsubjects,
                'categori' => $v_id,
                'sHostname' => $this->sHostname
            ]);

        return $v_oPostsubject;
    }


    public function createSubjectView()
    {     
        $this->Auth();
       
        $t_oForumcats = DB::table('forum_cat')->lists(
            'Forum_cat_name','Forum_cat_id'
        );

        return View('Runningshoes.pages.forum.New-subjects')->with([
            'getforumCats' => $t_oForumcats, 
            'sHostname' => $this->sHostname
        ]);
    }

    public function createSubject(CreatesubjectRequest $request)
    {
        if ($request->name) {

            if (DB::table('subjects')->where('subjects_name', '=', $request->name)->get()) {

               return back()->with('reply', 'The name already exist');   
            }

            $oCreateSubject = new CreateSubjectCommand(
                $request->name,
                $request->form_control_content,
                $request->cat
            );

            $this->dispatch($oCreateSubject);

            return back()->with('Subject', 'You Have Created A New Subject');
        
        } else {  

            return back();
        
        }
    }

    public function postSubjectid($v_id)
    {
        $t_oPostsubjectsid = DB::table('subjects')->where(
            'subjects_name', '=',$v_id
        )->get();
        
        $t_oReplys = DB::table('reply')->where('reply_topic', '=',$v_id)->orderBy(
            'reply_id', 'DESC'
        )->get();

        $oPostsub = (count($t_oPostsubjectsid) === 0) ? back() :
            View('Runningshoes/pages/forum/PostSubjectid')->with([
                'postsubjectsid' => $t_oPostsubjectsid,
                'replys' => $t_oReplys,
                'sHostname' =>$this->sHostname
            ]);

        return $oPostsub;
    }

    public function replyView($v_id)
    {
        $this->Auth();

        $t_oPostsubjects = DB::table('subjects')->where(
            'subjects_id', '=', $v_id
        )->get();

        $oPostsubject = (count($t_oPostsubjects) === 0) ? 
        back()->with('sPostsubject', 'There is no posted subjects yet') 
        : View('Runningshoes/pages/forum/replyView')->with([
                'postsubjects' => $t_oPostsubjects,
                'sHostname' => $this->sHostname
            ]);
    
        return $oPostsubject;
    }

    public function createreply(ReplyRequest $request)
    {
        $this->Auth();

        if (isset($_POST)) {
            
            if (DB::table('reply')->where('reply_name', '=', $request->reply_name)->get()) {
               
               return back()->with('reply', 'The name already exist');   
            }

            DB::table('reply')->insert([
                'reply_text' => $request->reply_content,
                'reply_date' => $this->getDate(),
                'reply_topic' => $request->reply_content_hidden,
                'reply_by' => Session::get('username'),
                'reply_name' => $request->reply_name
            ]); 

            return back()->with('reply', 'Your Reply Have been added');
        }
    }


    public function replyDestroy($oTable, $v_oContent, $vS_oContent, $v3_id)
    {
        DB::table($oTable)->where(
            $v_oContent, '=', $v3_id
        )->where($vS_oContent,'=', Session::get('username'))->delete();
        
        return redirect('/');
    }

    public function Aktuella_Subjects()
    {
        $bId = Null;

        $t_oForumCats = DB::table('subjects')->join(
            'reply','subjects_name','=','reply_topic'
        )->where(
            'reply_date','>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'
        ))->get();
        
        return View('Runningshoes/pages/forum/Forumid')->with([
            'postsubjects' => $t_oForumCats,
            'categori' => $bId,
            'sHostname' => $this->sHostname
        ]);
    }
}
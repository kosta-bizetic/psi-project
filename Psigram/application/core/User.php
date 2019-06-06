<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */

require_once 'PSIController.php';

/**
 * User - Root controller for the all user types.
 *
 * @version 1.0
 */
class User extends PSIController {

    /**
     * @var stdClass $user - Object containing information of the session user.
     */
    var $user;

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();
        if (! ($this->session->has_userdata('user'))) {
            redirect();
        }

        $this->load->model('MUser');
        $this->load->model('MPost');
        $this->load->model('MComment');
        $this->load->model('MFollows');
        $this->load->model('MLikes');
        $this->load->model('MComment');

        $this->user = $this->session->userdata['user'];
    }

    /**
     * Default method for calls to this controller.
     *
     * @return void
     */
    public function index() {
        redirect("$this->class_name/feed");
    }

    /**
     * Method that loads the feed view.
     *
     * @return void
     */
    public function feed() {
        $this->data['posts'] = $this->MPost->getPostsForFeed($this->user);

        $this->load->view('user/feed.php', $this->data);
    }

    /**
     * Method that loads the add post view.
     *
     * @return void
     */
    public function addPost() {
        $this->load->view('user/addPost.php', $this->data);
    }

    /**
     * Method that handles adding posts from the add posts view.
     *
     * @return void
     */
    public function addPostHandler() {
        $config['upload_path']          = 'uploads//';
        $config['file_name']            = $this->user->username."_".time();
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4000;
        $config['max_width']            = 1024*4;
        $config['max_height']           = 768*4;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image')) {
                $this->data['error'] = $this->upload->display_errors();
                $this->addPost();
        } else {
            $this->MPost->addPost($config['file_name'].$this->upload->data('file_ext'), $this->user->id_user );

            redirect("$this->class_name/feed");
        }
    }

    /**
     * Method that loads the profile view of a given user.
     *
     * @param int $user_id - ID of the users whose profile should be loaded.
     *
     * @return void
     */
    public function profile($user_id=NULL) {
        $profile_user = $this->user;
        if ($user_id != NULL) {
            $profile_user = $this->MUser->getUser($user_id);
        }
        $this->data['user'] = $profile_user;
        $this->data['follows'] = $this->MFollows->getFollows($this->user->id_user, $profile_user->id_user);
        $this->data['posts'] = $this->MPost->getPostsForProfile($profile_user->id_user);
        $this->load->view('user/profile.php', $this->data);
    }

    /**
     * Method that loads the edit profile view.
     *
     * @return void
     */
    public function editProfile() {
        $this->form_validation->set_rules('username', 'Username', array('required', array('otherUsernameDoesntExist', array($this->MUser, "otherUsernameDoesntExist"))));
        $this->form_validation->set_message('otherUsernameDoesntExist', '{field} already exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('surname', 'Last name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email', array('required', array('otherEmailDoesntExist', array($this->MUser, "otherEmailDoesntExist"))));
        $this->form_validation->set_message('otherEmailDoesntExist', '{field} already exists');
        $this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required|in_list[m,f]');
        $this->form_validation->set_rules('submit', 'Submit', 'required|in_list[save]');
        if ($this->user->type != 'a') {
            $this->form_validation->set_rules('type', 'Account type', 'required|in_list[s,b]');
        } else {
            $this->form_validation->set_rules('type', 'Account type', 'required|in_list[s,b,a]');
        }


        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'name' => $this->input->post('name'),
                'surname' => $this->input->post('surname'),
                'email' => $this->input->post('email'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'gender' => $this->input->post('gender'),
                'type' => $this->input->post('type')
            );

            $this->MUser->updateUser($this->user->id_user, $data);
            $user = $this->MUser->getUserByUsername($data['username']);

            $this->session->set_userdata('user', $user);

            $this->redirectToType('profile');
        } else {
            if ($this->input->post('submit') == 'cancel') {
                $this->redirectToType('profile');
            }

            $this->data['user'] = $this->user;
            $this->load->view('user/editProfile.php', $this->data);
        }
    }

    /**
     * Method that handles the session user following a given user.
     *
     * @param int $id_user_followed - ID of the user to follow.
     *
     * @return void
     */
    public function followHandler($id_user_followed) {
        $this->MFollows->addFollows($this->user->id_user, $id_user_followed);
        $this->redirectToLastURI();
    }

    /**
     * Method that handles the session user unfollowing a given user.
     *
     * @param int $id_user_followed - ID of the user to be unfollowed.
     *
     * @return void
     */
    public function unfollowHandler($id_user_followed) {
        $this->MFollows->removeFollows($this->user->id_user, $id_user_followed);
        $this->redirectToLastURI();
    }

    /**
     * Method that generates the like text that should be written under a post.
     *
     * @param bool $likes - Does the session user like the given post.
     * @param int $num_likes - The number of likes the post has.
     *
     * @return void
     */
    private function generateLikesText($likes, $num_likes) {
        if ($likes) {
            if ($num_likes == 2) {
                print 'You and '.($num_likes - 1).' other like this.';
            } else if ($num_likes == 1) {
                print 'You like this.';
            } else {
                print 'You and '.($num_likes - 1).' others like this.';
            }
        } else {
            if ($num_likes == 1) {
                print $num_likes.' person likes this.';
            } else {
                print $num_likes.' people like this.';
            }
        }
    }

    /**
     * Method that handles the session user liking/unliking a given post.
     *
     * @param int $id_post - ID of the post to be liked/unliked
     *
     * @return void
     */
    public function likeHandler($id_post) {
        $likes = $this->MLikes->getLikesExist($this->user->id_user, $id_post);
        if (!$likes) {
            $this->MLikes->addLikes($this->user->id_user, $id_post);
        } else {
            $this->MLikes->removeLikes($this->user->id_user, $id_post);
        }
        $num_likes = $this->MPost->getPost($id_post)->num_likes;
        $this->generateLikesText(!$likes, $num_likes);
    }

    /**
     * Method that loads the post view of a given post.
     *
     * @param int $id_post - ID of the post for which the view should be loaded.
     *
     * @return void
     */
    public function post($id_post) {
        $post = $this->MPost->getSinglePost($id_post);
        if ($post == NULL) {
            switch ($this->user->type) {
                case 'a': redirect($this->class_name.'/feed');
                default: redirect($this->class_name.'/profile/'.$this->user->id_user);
            }
        }

        $this->data['post'] = $post;
        $this->data['comments'] = $this->MComment->getComments($id_post);

        $this->load->view('user/post.php', $this->data);
    }

    /**
     * Method that handles the session user adding a comment to a given post.
     *
     * @param int $id_post - ID of the post to which the comment should be added.
     *
     * @return void
     */
    public function addCommentHandler($id_post) {
        $comment_text = $this->input->post('comment_text');
        if ( ! empty($comment_text)) {
            $this->MComment->addComment($comment_text, $this->user->id_user, $id_post);
        }
        $this->redirectToLastURI();
    }

    /**
     * Method that handles the session user logging out.
     *
     * @return void
     */
    public function logOut() {
        $this->session->unset_userdata('user');
        redirect();
    }

    /**
     * Method that handles searching for users and loads the corresponding user list view.
     *
     * @return void
     */
    public function search() {
        $search_text = $this->input->post('search_text');
        $this->data['users'] = $this->MUser->searchUsers($search_text);

        $this->load->view('user/userList.php', $this->data);
    }

    /**
     * Method that loads the user list with all the users that liked a given post.
     *
     * @param int $post_id - ID of the post for which the likers should be shown.
     *
     * @return void
     */
    public function likers($post_id) {
        $this->data['users'] = $this->MLikes->getPostLikers($post_id);

        $this->load->view('user/userList.php', $this->data);
    }

    /**
     * Method the loads the user list view with all the users that follow the session user.
     *
     * @param int $user_id - ID of the user whose followers should be shown.
     *
     * @return void
     */
    public function followers($user_id) {
        $this->data['users'] = $this->MUser->getFollowers($user_id);

        $this->load->view('user/userList.php', $this->data);
    }

    /**
     * Method that loads the user list view with all the users the session user follows.
     *
     * @param int $user_id - ID of the user whose following should be shown.
     */
    public function following($user_id) {
        $this->data['users'] = $this->MUser->getFollowing($user_id);

        $this->load->view('user/userList.php', $this->data);
    }

    /**
     * Method that handles the deletion of a given comment made by session user.
     *
     * @param int $id_comment - ID of the comment to be deleted.
     *
     * @return void
     */
    public function deleteCommentHandler($id_comment) {
        $comment = $this->MComment->getComment($id_comment);
        if ($comment->id_user == $this->user->id_user) {
            $this->MComment->removeComment($id_comment);
            $this->redirectToLastURI();
        } else {
            redirect();
        }
    }

    /**
     * Method that handles the deletion of a given post uploaded by the session user.
     *
     * @param int $id_post - ID of the post to be deleted.
     *
     * @return void
     */
    public function deletePostHandler($id_post) {
        $post = $this->MPost->getPost($id_post);
        if ($post->id_user == $this->user->id_user) {
            $this->MPost->removePost($id_post);
            $this->redirectToLastURI();
        } else {
            redirect();
        }
    }
}
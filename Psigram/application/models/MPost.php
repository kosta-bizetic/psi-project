<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */

/**
 * MPost - Model for the post database table.
 *
 * @version 1.0
 */
class MPost extends CI_Model {

    /**
    * Creating a new instance.
    *
    * @return void
     */
    public function __construct() {
        parent::__construct();

        $this->load->model("MFollows");
    }

    /**
     * Gets a single post with all the necessary data for the
     * user/partial/singlePost view from the database.
     *
     * @param int $id_post - id of the post
     * @return Object containing data about the post
     */
    public function getSinglePost($id_post) {
        $user = $this->session->userdata['user'];

        return $this->db->select('*, Post.id_post, Post.id_user, '
                                . 'CASE WHEN Likes.id_user IS NULL '
                                . 'THEN 0 ELSE 1 END AS likes'
                                , false)
                        ->from('Post')
                        ->join('User', 'User.id_user = Post.id_user')
                        ->join( 'Likes'
                                , "Likes.id_post = Post.id_post"
                                . " AND Likes.id_user = $user->id_user"
                                , "left")
                        ->where('Post.id_post', $id_post)
                        ->order_by('Post.timestamp DESC')
                        ->get()
                        ->row();
    }

    /**
     * Helper method which prepares query to get all posts from a list of given
     * users.
     *
     * @param Array(int) $user_ids - Array of user ids.
     */
    private function prepareToGetPosts($user_ids) {
        $user = $this->session->userdata['user'];

        $this->db   ->select('*, Post.id_post, Post.id_user,'
                            . ' CASE WHEN Likes.id_user IS NULL'
                            . ' THEN 0 ELSE 1 END AS likes'
                            , false)
                    ->from('Post')
                    ->join('User', 'User.id_user = Post.id_user')
                    ->join('Likes', "Likes.id_post = Post.id_post AND Likes.id_user = $user->id_user", "left")
                    ->where_in('Post.id_user', $user_ids)
                    ->order_by('Post.timestamp DESC');
    }

    /**
     * Gets all posts from the database that should appear on a given user's
     * feed.
     *
     * @param Object $user - Object containing user data.
     * @return Array of objects containing post data.
     */
    public function getPostsForFeed($user) {
        $all_users_ids = $this->MFollows->getFollowedUserIds($user->id_user);
        array_push($all_users_ids, $user->id_user);

        $this->prepareToGetPosts($all_users_ids);

        if ($user->type == 's') {
            $this->db->or_where('Post.sponsored', 1);
        }

        return $this->db->get()->result();
    }

    /**
     * Gets all posts from the database that should appear on a given user's
     * profile.
     *
     * @param int $id_user - id of the user.
     * return Array of objects containing post data
     */
    public function getPostsForProfile($id_user) {
        $this->prepareToGetPosts($id_user);

        return $this->db->get()->result();
    }

    /**
     * Checks in the database whether a given post is sponsored or not.
     *
     * @param int $id_post - id of the post.
     * @return boolean - TRUE if sponsored, FALSE otherwise.
     */
    public function isSponsored($id_post) {
        return $this->db->from('Post')
                        ->where('id_post', $id_post)
                        ->get()
                        ->row()->sponsored == 1;
    }

    /**
     * Sets the sponsored column of post in the database to a given value
     *
     * @param int $id_post - id of the post.
     * @param int $value - value to set the column to.
     */
    public function setSponsored($id_post, $value) {
        $this->db   ->from('Post')
                    ->where('id_post', $id_post)
                    ->set('sponsored', $value)
                    ->update();
    }

    /**
     * Gets post from the database.
     *
     * @param int $id_post - id of the post.
     * @return Object containing post data.
     */
    public function getPost($id_post) {
        return $this->db->from("Post")
                        ->where("id_post", $id_post)
                        ->get()->row();
    }

    /**
     * Add a new post to the database with the specified fields.
     *
     * @param string $image_name - name of the image in the post
     * @param int $id_user - id of the post's author
     */
    public function addPost($image_name, $id_user) {
        $data = array(
            'image_name' => $image_name,
            'id_user' => $id_user
        );
        $this->db->insert('Post', $data);
    }

    /**
     * Removes a post from the database and deletes its image from the file
     * system.
     *
     * @param int $id_post - id of the post.
     */
    public function removePost($id_post) {
        $post = $this->getPost($id_post);
        unlink(FCPATH."uploads\\$post->image_name");
        $this->db   ->where('id_post', $id_post)
                    ->delete('Post');
    }
}

<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */
?>

<script>
    <?php
    /**
     * Function that asynchronously updates a post's like text when a user likes it.
     *
     * @param int id_post - ID of the liked post.
     *
     * @returns void
     */
    ?>
    function likeHandler(id_post) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          document.getElementById("LikeText" + id_post).innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "<?php echo site_url($this->class_name) ?>/likeHandler/" + id_post, true);
      xhttp.send();
    }
</script>


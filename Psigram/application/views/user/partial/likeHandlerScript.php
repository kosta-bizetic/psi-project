
<script>
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


<!DOCTYPE html>

<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
        <style>
            #inputfile {
                width: 0.1px;
                height: 0.1px;
                opacity: 0;
                overflow: hidden;
                position: absolute;
                z-index: -1;
            }

            #inputfile + label {
                max-width: 80%;
                font-size: 1.25rem;
                font-weight: 700;
                text-overflow: ellipsis;
                white-space: nowrap;
                cursor: pointer;
                display: inline-block;
                overflow: hidden;
                padding: 0.625rem 1.25rem;
            }

            #inputfile:focus + label,
            #inputfile.has-focus + label {
                outline: 1px dotted #000;
                outline: -webkit-focus-ring-color auto 5px;
            }

            #inputfile + label {
                color: rgb(0, 123, 255);
            }

            #inputfile:focus + label,
            #inputfile.has-focus + label,
            #inputfile + label:hover {
                color: rgb(0, 80, 255);
            }

            #inputfile + label figure {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background-color: rgb(0, 123, 255);
                display: block;
                padding: 20px;
                margin: 0 auto 10px;
            }

            #inputfile:focus + label figure,
            #inputfile.has-focus + label figure,
            #inputfile + label:hover figure {
                background-color: rgb(0, 80, 255);
            }

            #inputfile + label svg {
                width: 100%;
                height: 100%;
                fill: #f1e5e6;
            }
        </style>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);
        ?>
        <div class="container-fluid">
            <div class="row justify-content-center" style="text-align: center; margin-top: 3em">
                <div class="col-md-4" style="display: inline-block; background-color: white; border: 1px solid rgb(0, 123, 255); border-radius: 20px; padding: 1em">
                    <?php
                        echo form_open_multipart("$this->class_name/addPostHandler");
                    ?>
                        <?php if(isset($error)) echo $error."<br>";?>

                        <input type="file" name="image" id="inputfile"/>
                        <label for="inputfile">
                            <figure>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                </svg>
                            </figure>
                            <span>Choose a file&hellip;</span>
                        </label>
                        <br/>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            var input = document.getElementById('inputfile');
            var label = input.nextElementSibling;
            var labelVal = label.innerHTML;

            input.addEventListener('change', function( e )
            {
                var fileName = e.target.value.split( '\\' ).pop();

                if(fileName)
                    label.querySelector('span').innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });

            // Firefox bug fix
            input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
            input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
        </script>
    </body>
</html>
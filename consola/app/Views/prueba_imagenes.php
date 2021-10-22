<!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Image upload with preview example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</head>

<body>
    <div class="container">
        <br>

        <?php if (session('msg')) : ?>
        <div class="alert alert-info alert-dismissible">
            <?= session('msg') ?>
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        </div>
        <?php endif ?>

        <div class="row">
            <div class="col-md-9">
                <form action="<?php echo base_url('ofertas_Descartadas/store');?>" name="ajax_form" id="ajax_form"
                    method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="file" name="file" class="form-control" id="file" onchange="readURL(this);"
                                accept=".png, .jpg, .jpeg" />
                        </div>

                        <div class="form-group col-md-6">
                            <img id="blah" src="https://www.tutsmake.com/wp-content/uploads/2019/01/no-image-tut.png"
                                class="" width="200" height="150" />
                        </div>

                        <div class="form-group">
                            <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                        </div>

                </form>
            </div>
        </div>

    </div>

    </div>
    <script>
    function readURL(input, id) {
        id = id || '#blah';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
</body>

</html>
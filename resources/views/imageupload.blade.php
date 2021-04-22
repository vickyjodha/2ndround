<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">

        <h2 class="text-center">Image Upload with Preview using in Laravel 8 - Tutsmake.com</h2>

        <form method="POST" enctype="multipart/form-data" id="upload-image" action="{{ route('imageuser') }}">
            @csrf
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                        @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {


            $('#image').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>
</body>

</html>
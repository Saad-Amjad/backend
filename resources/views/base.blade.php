<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title>{{ ucfirst(config('nodes.project.name', 'Backend')) }}</title>

    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Mono|Work+Sans:400,500,600' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" media="all" href="/css/project.css">

    @yield('project-css')

</head>

<body class="{{ env('APP_ENV') }} fullbleed">

    @yield('layout')

    @if (env('APP_ENV') == 'local' || env('APP_ENV') == 'staging')
        <div id="environment-notice" class="{{ env('APP_ENV') }}">
            <p>
                <span class="fa fa-warning"></span>
                {{ ucfirst(env('APP_ENV')) }} environment
            </p>
        </div>
    @elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') === false && strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS') === false)
        <div id="environment-notice" class="local">
            <p>
                <span class="fa fa-warning"></span>
                Browser is not supported - To make sure all features work, please use Google chrome
                <a href="http://www.google.com/chrome/" style="color: #000000; text-decoration: underline">Download</a>
            </p>
        </div>
    @endif

    <script src="/js/vendor.js"></script>

    <script src="/js/project.js"></script>

    @yield('project-js')

    <script src="//cdn.ckeditor.com/4.5.2/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function() {

            $('[data-filepicker]').each(function() {

                var $fileInput = $(this).find('input[type="file"]');
                var $thumbnailPreview = $(this).find('.file-picker__preview');
                var $clearThumbnailPreview = $(this).find('.file-picker__clear');

                $fileInput.on('change', function(e) {

                    $clearThumbnailPreview.show();

                    if(fileIsImage(this)) {
                        readFileURL(this, $thumbnailPreview);
                    }

                });

                $clearThumbnailPreview.on('click', function(e) {
                    clearFile($fileInput, $thumbnailPreview, $(this));
                });

            });

            function fileIsImage(input) {

                var file = input.files[0];

                var matcher = 'image/';

                return file.type.match(matcher) ? true : false;

            }

            function readFileURL(input, output) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $(output).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function setThumbnail(src) {

            }

            function clearFile(input, preview, clearBtn) {
                preview.attr('src', '');
                input.val('');
                clearBtn.hide();
            }

        });
    </script>

</body>
</html>
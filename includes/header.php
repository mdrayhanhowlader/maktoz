<?php
$base_url = '/maktoz';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($page_title) ? $page_title . ' - Maktoz' : 'Maktoz - Digital Marketing Agency'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/style.css" />
</head>
<body class="bg-white">
    <header class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="<?php echo $base_url; ?>/index.php">
                        <img class="max-w-40" src="<?php echo $base_url; ?>/assets/images/maktoz_logo_light.png" alt="Maktoz Logo" />
                    </a>
                </div>
                <button onclick="window.location.href='<?php echo $base_url; ?>/contact.php'" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition">
                    Get Free Consultation
                </button>
            </div>
        </div>
    </header>

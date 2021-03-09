<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- CSRFトークン -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- スタイルシート -->
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
</head>

<body>
    <?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src=" <?php echo e(mix('js/app.js')); ?> "></script>
</body>
</html>
<?php /**PATH /work/resources/views/layouts/main.blade.php ENDPATH**/ ?>
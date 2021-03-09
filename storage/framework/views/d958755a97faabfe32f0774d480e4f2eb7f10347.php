<nav class="header clearfix">
    <!-- アプリロゴ -->
    <h1 class="logo">
        <a href='/home'>Task Quest</a>
    </h1>

    <!-- メニュー -->
    <ul class='header-menu'>
        <?php if(auth()->guard()->guest()): ?>
            <!-- ログイン -->
            <li class='menu-item'>
                <a href="<?php echo e(route('login')); ?>">LOGIN</a>
            </li><!--
            <新規登録>
            --><li class='menu-item'>
                <a href="<?php echo e(route('register')); ?>">REGISTER</a>
            </li>
　        　<?php else: ?>
            <!-- ユーザーページ -->
            <li class='menu-item' ><a href="/home"><?php echo e(Auth::user()->name); ?></a></li><!--
            <ログアウトボタン>
            --><li class='menu-item'>
                <a href="<?php echo e(route('logout')); ?>"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    LOGOUT
                </a>
                <form id="logout-form" name = "logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                </form>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php /**PATH /work/resources/views/include/header.blade.php ENDPATH**/ ?>
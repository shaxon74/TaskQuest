<div class="sidemenu">
    @auth
        <div class="content">
            <h>※タスク追加などのメニューを表示</h>
            <h><a href="/tasks">タスク詳細一覧</a></h>
        </div>
    @else
    <div class="content">
        <p>※アプリ説明、ガイダンスを記載</p>
        <p><a href="/#">まずは登録！</a></p>
    </div>
    @endauth
</div>

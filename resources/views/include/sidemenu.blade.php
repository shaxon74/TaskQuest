<div class="sidemenu">
    @auth
        <div class="content">
            <h>※タスク追加などのメニューを表示</h>
            <h><a href="/tasks">タスク詳細一覧</a></h>
        </div>
    @else
    <h2 class="heading">RANKING</h2>
    <ol class="ranking">
        <li class="ranking-item">
            <a href="#">
                <img class="image" src="./images/ranking.jpg" alt="グラフの画像" />
                <span class="text"></span>
                <p>HTML/CSSコーディングと切っても切れないWEBブラウザの
                シェア動向をチェックしよう</p>
            </a>
        </li>
        <li class="ranking-item">
            <a href="#">
                <img class="image" src="./images/ranking.jpg" alt="グラフの画像" />
                <span class="text"></span>
                <p>HTML/CSSコーディングと切っても切れないWEBブラウザの
                シェア動向をチェックしよう</p>
            </a>
        </li>
    </ol>
    @endauth
</div>

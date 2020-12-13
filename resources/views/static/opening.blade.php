@extends('layouts.main')

@section('content')

<section class="overview">
    <h2 class="hidden">OVERVIEW</h2>
    <a href="#" class="overview clearfix">
        <img class="image" src="../images/hot-topic.jpg" alt="コーディング画面" />
        <div class="content">
            <h3 class='title'>人生は、ゲームだ。</h3>
            <p class="desc">日々のタスクや目標をモンスターとして登録し、
                            どんどん倒して自分にご褒美をプレゼントしよう！</p>
            <time class="date" datetime="2020-12-08">Upedate: 2020.12.08 TUE</time>
        </div>
    </a>
</section>

<section class="news">
    <h2 class="heading">NEWS</h2>
    <ul class="scroll-list">
        <li class="scroll-item">
            <a href="#">
                <time class="date" datetime="2020-12-08">2020.12.08 TUE</time>
                <span class="category news">NEWS</span>
                <span class="title">OPENINGページを開設！</span>
            </a>
        </li>
        <li class="scroll-item">
            <a href="#">
                <time class="date" datetime="2020-12-08">2020.12.08 TUE</time>
                <span class="category topic">TOPIC</span>
                <span class="title">WORKSを更新しました。</span>
            </a>
        </li>
    </ul>
</section>

<section class="articles">
    <h2 class="hidden">ARTICLES</h2>
    <div class="clearfix">
        <a href="#" class="article-box">
            <h3 class="title">実務で使えるHTML/CSSモダンコーディングTIPS</h3>
            <p class="desc">新しい要素が植えて大幅に表現力が広がったHTML5/CSS3を活用し、
            モダンなコーディングにチャレンジしましょう。</p>
            <time class="date" datetime="2015-06-17">2015.06.17 WED</time>
            <img class="image" src="./images/article.jpg" alt="コーディング画面" />
        </a>
        <a href="#" class="article-box">
            <h3 class="title">実務で使えるHTML/CSSモダンコーディングTIPS</h3>
            <p class="desc">新しい要素が植えて大幅に表現力が広がったHTML5/CSS3を活用し、
            モダンなコーディングにチャレンジしましょう。</p>
            <time class="date" datetime="2015-06-17">2015.06.17 WED</time>
            <img class="image" src="./images/article.jpg" alt="コーディング画面" />
        </a>
    </div>
</section>

@endsection

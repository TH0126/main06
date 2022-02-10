# PHPを使ってDB接続して何かを作る課題

## プロダクトの紹介

- 各種分析条件を入力してそれらの値をDBに保存し、一覧に出力

## 工夫した点、こだわった点

- Jqueryを使って画面上でいろんな形でボタン、セレクト、テキストボックス
  が表示されるようにしました。
- 一覧で出すままをDBに登録するのではなく値で登録されるようにして、一覧
  表示に変換されるようにしました。

## 苦戦した点、共有したいハマりポイントなど

- 動的な要素でのイベントが最初動かなくて苦労しました。（最終的にはjquery
  のバージョンが。。古かった。。
- 動的な要素を特定の場所に追加したり削除したり、変更したりにチャレンジしたが
  場所指定がとても難しかった。
- ２つ前や２つ上の先祖などを指定するのに、prev()やparent()を連続させる方法
  でしか実装できなかった。もっとスマートな方法があるはず。。


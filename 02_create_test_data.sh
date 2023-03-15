#!/bin/sh
echo 'テストデータを作成します。'

echo 'test' > test/hoge.txt

mkdir test/danger
mkdir test/danger/neko

echo 'えび' >  test/danger/neko/ebi.txt
echo 'かに' >  test/danger/neko/kani.txt



echo "------------ 作成完了"
cmd /k
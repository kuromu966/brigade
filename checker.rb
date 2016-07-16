#設定類似度チェッカー。3-gramを用いて、２つのエントリーの設定テキストの類似度を標準出力へ吐き出す。
require 'yaml'
require 'trigram'
require 'set'

Entry = Struct.new("Entry", :title, :path, :content,:profile)

#適当にYAMLファイルから読み込み
entries = YAML.load_file('entries.yml')

compared = {}
for e1, e2 in entries.product(entries)
  #同一記事を比べても無意味なのでスルー
  next if e1 == e2

  #A-BとB-Aで前後変わっても比較結果は同じなので、Setオブジェクトに入れて等しく扱う
  pair = Set.new([e1,e2])

  #初出の組み合わせなら類似度を測定する
  unless  compared.has_key?(pair)
    value = Trigram.compare(e1.profile, e2.profile)

    #類似度0.05オーバーのものだけ抽出
    compared[pair] = value if value > 0.05
  end
end

#類似度を降順でソートしつつ、タブ区切りで結果を出力
#タブ区切りならコピペでスプレッドシートに貼れるもんね！
compared.each_pair.sort_by{|k,v|v}.reverse_each do |k,v|
  puts k.to_a.map{|a|a.title}.push(v).join("\t")
end
#プレイボード掲示板から特定条件の記事を抜き出し、その内容を適宜修正してYAMLにぶちこむ。

require 'open-uri'
require 'nokogiri'
require 'yaml'

#対象スレッドの全記事URL（▼リンクからのアレ）
url = 'http://cwtg.jp/bbs3/wforum.cgi?list=&no=7795&mode=allread&page=0'

Charset = 'sjis'
html = open(url).read

#読んだ記事は一旦ローカルに保存しておく。
open('source.html','w').write(html)

#何度も掲示板にアクセスする必要がないなら、上をコメントアウト＆下のコメントを外してローカルから読む。
#html = open('source.html','r').read

#HTMLをNokogiriで切り刻む。
doc = Nokogiri::HTML.parse(html, nil, Charset)

entries = []
Entry = Struct.new("Entry", :title, :path, :content,:profile)

#記事１本毎でループ
doc.xpath('//table[@class="thread"]/tr/td').each do |node|
  #記事タイトルを抽出
  title_node = node.xpath('.//tt/a/b')
  title = title_node.inner_text
  #puts title

  #記事の抽出条件。記事タイトルが正規表現とマッチしたら以下続行、さもなくばスルーして次へ。
  next unless  title =~ /アーチャー[：:].+?[：:]アーチャー.+/

  #記事を適宜スクレイピングしてEntry構造体に格納
  entry_node = node.xpath('.//div/p/font')
  entry_node.search('br').each {|br| br.replace("\n") }
  content = entry_node.inner_text

  match = content.match(/設定：(.+)/m )
  profile = match ? match[1] : nil
  entry = Entry.new(title, node.path, content , profile)

  #配列に挿入
  entries.push entry
end

#配列まるっとYAMLで保存
YAML.dump(entries, File.open('entries.yml','w'))

#書式不備でスクレイピングし損ねたエントリーは、entries.ymlを直線編集してフォローすべし（ああめんどい）。

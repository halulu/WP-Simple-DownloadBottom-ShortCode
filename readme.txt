=== Plugin Name ===
Plugin Name: Simple Download Button Shortcode
Plugin URI: http://tech.halulu.org/?p=849
Description: Display CSS3 dwonload bottons by simple Shortcode and lets site visitors donwload source code and images, such as html, php and jpeg.
Contributors: Halulu
Version: 1.1
Author URI: http://tech.halulu.org
Tags: download, button, shortcode
Requires at least: 3.0
Tested up to: 3.4.2
Stable tag: 1.1.0

Display CSS3 dwonload bottons by simple Shortcode.

== Description ==

ショートコードでダウンロードボタンを表示。DLプログラム付きでソースコードや画像もダウンロードできます。<br />
*<a href="http://tech.halulu.org/?p=849" target="_blnak">こちらの記事</a>も参照ください

display a CSS3 download button by a simple short code. It comes with a donwloading program that let your website visitors download html, js, php, images and so on. When you make a link by regular HTML anchor tag to these source code or image file normally it is displayed within an internet browser but you can avoid that with the plugin.
<br />*Please also see <a href="http://tech.halulu.org/?p=849" target="_blnak">here</a> for more information about the plugin.


== Installation ==
**<a href="http://tech.halulu.org/?p=849" target="_blnak">こちらの記事</a>も参照ください**

1.ダウンロードしたファイルを解凍して、以下のパスpluginsフォルダへFTPで、simple-download-buttonフォルダ丸ごとアップロードします<br />
your-wordpress-home/wp-content/plugins/

2.WordPressの管理画面で、インストール済みプラグイン一覧にSimple Download Button Shortcodeが追加されているので、[有効化]リンクを押下して、プラグインを適応します

3.以下のフォルダへユーザーダウンロードファイルをFTPしてください（変更不可）<br />
your-wordpress-home/wp-content/plugins/simple-download-button/download/

4.記事に以下のショートコードを記述してください（sample.htmlはダウンロード対象ファイル名）ボタンは何個でも設置でます<br />
[dlbt file=sample.html]

**Please also see <a href="http://tech.halulu.org/?p=849" target="_blnak">here</a> for more information about the plugin**

1.Extract the saved zip file and upload the whole folder (simple-download-button) by FTP to the directory indicated below.<br />
your-wordpress-home/wp-content/plugins/

2.WordPress Admin -> Plugins -> Installed Plugins, you see Download Button Shortcode is added to the installed plugin list. Click [Activate] to apply the plugin to your wordpress.

3.Upload user download files to the directory indicated below by FTP. (the directory path is fixed)<br />
your-wordpress-home/wp-content/plugins/simple-download-button/download/

4.In the post, write a shortcode like this. (sample.html is the name of user download file) You can put many buttons as you want.<br />
[dlbt file=sample.html]


== Frequently Asked Questions ==

== Screenshots ==
1. available download button designs

== Changelog ==

= 1.0 =
* First Version
= 1.1 =
* Sept17.2012 Reported vulnerability corrected. Verify GET parameter 'file'. From this version, downloding filename can contains only 'a-z', 'A-Z' '0-9', '-' and '_'

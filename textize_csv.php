<?php

echo $_FILES["csvfile"]["name"]."を変換します<br/><br/>";

if (is_uploaded_file($_FILES["csvfile"]["tmp_name"])) {

  $file_tmp_name = $_FILES["csvfile"]["tmp_name"];
  $file_name = $_FILES["csvfile"]["name"];

  //拡張子を判定
  if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
    $err_msg = 'CSVファイルのみ対応しています。';
  } else {
    //ファイルをdataディレクトリに移動
    if (move_uploaded_file($file_tmp_name, "./data/" . $file_name)) {
      //後で削除できるように権限を644に
      chmod("./data/" . $file_name, 0644);
      $msg = $file_name . "をアップロードしました。";
      $file = './data/'.$file_name;
      $fp   = fopen($file, "r");

      //一行目は捨てる
      fgetcsv($fp, 0, ",");
      while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
        echo "登録ID：";
        echo mb_convert_encoding ($data[2], "SJIS", "AUTO");
        echo "<br/>";

        //echo "募集職業：";
        //echo mb_convert_encoding ($data[1], "SJIS", "AUTO");
        //echo "<br/>";

        echo "キャラクター名：";
        echo mb_convert_encoding ($data[5], "SJIS", "AUTO");
        echo "<br/>";

        echo "プレイヤー名：";
        echo mb_convert_encoding ($data[7], "SJIS", "AUTO");
        echo "<br/>";

        //echo "国民番号：";
        //echo mb_convert_encoding ($data[8], "SJIS", "AUTO");
        //echo "<br/>";

        echo "職業：";
        echo mb_convert_encoding ($data[9], "SJIS", "AUTO");
        echo "<br/>";

        //echo "部隊内担当：";
        //echo mb_convert_encoding ($data[10], "SJIS", "AUTO");
        //echo "<br/>";

        echo "設定：<br/>";
        echo mb_convert_encoding ($data[11], "SJIS", "AUTO");
        echo "<br/>";

        //echo "備考：";
        //echo mb_convert_encoding ($data[12], "SJIS", "AUTO");
        //echo "<br/>";

        echo "登録記事URL：";
        echo mb_convert_encoding ($data[4], "SJIS", "AUTO");
        echo "<br/>";

        //echo "名前の由来：":
        //echo mb_convert_encoding ($data[6], "SJIS", "AUTO");

        //echo "複数キャラ番目";
        //echo mb_convert_encoding ($data[3], "SJIS", "AUTO");

        echo "<br>";
      }
      fclose($fp);
      //ファイルの削除
      unlink('./data/'.$file_name);
    } else {
      $err_msg = "ファイルをアップロードできません。";
    }
  }
} else {
  echo "is_uploaded_fileのチェックに失敗しています<br/>";
  $err_msg = "ファイルが選択されていません。";
}

?>



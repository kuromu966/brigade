<?php

echo $_FILES["csvfile"]["name"]."��ϊ����܂�<br/><br/>";

if (is_uploaded_file($_FILES["csvfile"]["tmp_name"])) {

  $file_tmp_name = $_FILES["csvfile"]["tmp_name"];
  $file_name = $_FILES["csvfile"]["name"];

  //�g���q�𔻒�
  if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
    $err_msg = 'CSV�t�@�C���̂ݑΉ����Ă��܂��B';
  } else {
    //�t�@�C����data�f�B���N�g���Ɉړ�
    if (move_uploaded_file($file_tmp_name, "./data/" . $file_name)) {
      //��ō폜�ł���悤�Ɍ�����644��
      chmod("./data/" . $file_name, 0644);
      $msg = $file_name . "���A�b�v���[�h���܂����B";
      $file = './data/'.$file_name;
      $fp   = fopen($file, "r");

      //��s�ڂ͎̂Ă�
      fgetcsv($fp, 0, ",");
      while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
        
        //echo "��W�E�ƁF";
        //echo mb_convert_encoding ($data[1], "SJIS", "AUTO");
        //echo "<br/>";

        // �s����h���폜
        // $data[4] = ltrim($data[4], 'h');
        echo "�o�^�L��URL�F";
        echo mb_convert_encoding ($data[4], "SJIS", "AUTO");
        echo "<br/>";

        echo "�o�^ID�F";
        echo mb_convert_encoding ($data[2], "SJIS", "AUTO");
        echo "<br/>";

        echo "�L�����N�^�[���F";
        echo mb_convert_encoding ($data[5], "SJIS", "AUTO");
        echo "<br/>";

        echo "���O�̗R���F";
        echo mb_convert_encoding ($data[6], "SJIS", "AUTO");
        echo "<br/>";

        echo "�v���C���[���F";
        echo mb_convert_encoding ($data[7], "SJIS", "AUTO");
        echo "<br/>";

        echo "�����ԍ��F";
        echo mb_convert_encoding ($data[8], "SJIS", "AUTO");
        echo "<br/>";

        echo "�E�Ɩ��F";
        echo mb_convert_encoding ($data[9], "SJIS", "AUTO");
        echo "<br/>";

        echo "�������S���F";
        echo mb_convert_encoding ($data[10], "SJIS", "AUTO");
        echo "<br/>";

        echo "�ݒ�F000����<br/>";
        echo mb_convert_encoding ($data[11], "SJIS", "AUTO");
        echo "<br/>";

        //echo "���l�F";
        //echo mb_convert_encoding ($data[12], "SJIS", "AUTO");
        //echo "<br/>";

        //echo "�����L�����Ԗ�";
        //echo mb_convert_encoding ($data[3], "SJIS", "AUTO");

        echo "<br>";
      }
      fclose($fp);
      //�t�@�C���̍폜
      unlink('./data/'.$file_name);
    } else {
      $err_msg = "�t�@�C�����A�b�v���[�h�ł��܂���B";
    }
  }
} else {
  echo "is_uploaded_file�̃`�F�b�N�Ɏ��s���Ă��܂�<br/>";
  $err_msg = "�t�@�C�����I������Ă��܂���B";
}

?>



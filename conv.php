<!-- �f�[�^�̃G���R�[�h�����ł��� enctype �́A�K���ȉ��̂悤�ɂ��Ȃ���΂Ȃ�܂��� -->
<form enctype="multipart/form-data" action="textize_csv.php" method="POST">
    <!-- �Ґ��p�I�v�V���� -->

    <!-- MAX_FILE_SIZE �́A�K�� "file" input �t�B�[���h���O�ɂȂ���΂Ȃ�܂��� -->
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
    <!-- input �v�f�� name �����̒l���A$_FILES �z��̃L�[�ɂȂ�܂� -->
    ���̃t�@�C�����A�b�v���[�h: <input name="csvfile" type="file" />
    <input type="submit" value="�t�@�C���𑗐M" />
</form>


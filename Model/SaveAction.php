<?php 

/**
 * 保存アクションのモデル
 * @author uehara
 *
 */
class SaveAction{
	
	
	/**
	 * 指定したディレクトリからすべてのファイルとディレクトリの名称と更新日を取得し、パスデータにまとめて返す。
	 * @param string $dir ディレクトリのパス　例：'/cat/dog'
	 * @return [] パスデータ
	 */
	public function getPathData($dir){
		
		$pathData = [];

		// ディレクトリ内のファイルとディレクトリの一覧を取得する
		$files = scandir($dir);
		
		// ファイル名と更新日を表示する
		foreach ($files as $file) {
			if ($file !== '.' && $file !== '..') { // '.' と '..' は除外する
				$path = $dir . '/' . $file;
				$update_date = date('Y-m-d H:i:s', filemtime($path));
				$ent = [
						'path_name'=>$file,
						'update_date'=>$update_date,
				];
				$pathData[] = $ent;
			}
		}
		
		return $pathData;
		
		
	}
}
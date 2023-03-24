<?php 

/**
 * 基本モデル
 * @author uehara
 *
 */
class BaseX{
	
	
	
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
				$file_or_dir = '';
				$size = null;
				
				if (is_dir($path)) {
					$file_or_dir = 'dir';
					$size = null;
				}
				else {
					$file_or_dir = 'file';
					$size =  filesize($path);
				}
				
				
				$ent = [
						'path_name'=>$file,
						'update_date'=>$update_date,
						'file_or_dir'=>$file_or_dir,
						'size'=>$size,
				];
				$pathData[] = $ent;
			}
		}
		
		return $pathData;
		
		
	}
	
	// jsonファイルから危険データを取得する
	public function getDangerDataFromJson(){
		// ▼ 正パスデータを取得する
		$file = 'data/danger.json';
		$jsonData = file_get_contents($file);
		$data = [];
		try {
			$data = json_decode($jsonData, true); // 正パスデータ
			if(empty($data)) $data = [];
				
		} catch (Exception $e) {
			
		}
		
		return $data;
		
	}
	
	
}